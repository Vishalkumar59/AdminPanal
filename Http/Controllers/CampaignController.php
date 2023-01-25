<?php

namespace Modules\Qrcode\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Qrcode\Models\Domain;
use Modules\Qrcode\Models\Link;
use Modules\Qrcode\Traits\LinkTrait;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\Qrcode\Models\CampaignOption;
use Modules\Qrcode\Models\CampaignHistory;
use Modules\Qrcode\Models\Campaign;
use Modules\Qrcode\Models\Contact;
use Modules\Qrcode\Models\CampaignStats;
use Storage;
use Session;


class CampaignController extends Controller
{
    use LinkTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        // public function __construct()
        // {
        //     $this->middleware('auth');
        // }


    public function index()
    {
       
       $campaignlist = Campaign::all();
        return view('Qrcode::campaign.index',compact('campaignlist'));
    }

    public function create()
    {
        if (Domain::where([['user_id', '=', 0], ['id', '=', 1]])->exists()) {
            
            $defaultDomain = 1;
        }

        return view('Qrcode::campaign.create' , compact('defaultDomain'));
       
    }
   
    public function store(Request $request)
    {
       
        $wa_url = "https://wa.me/15550835832?text=".$request->trigger_msg;

        $campaign = new Campaign();
        $campaign->name = $request->name;
        $campaign->trigger_message = $request->trigger_msg;
        $campaign->whatsup_url = $wa_url;
        $campaign->save();

        $campaign_id = $campaign->id;

        $this->linkStore($request);

        $shortlink = Link::where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->limit(1)->first();

        
        $time = time();
        $image = QrCode::format('png')->size(200)->errorCorrection('H')->generate($wa_url);
        $output_file = '/img/' . time() . '.png';
    
    
        $data = Storage::disk('public')->put($output_file, $image);
      


        Campaign::where('id', $campaign_id)->update([
            'shorturl_id' => $shortlink->id, 
            'qr_code' => $output_file,
        ]);

        return redirect()->route('campaign.index')->with('success','Campaign Created Successfully!');
               

    }
    public function show($id)
    {
        // dd($id);
        if(!empty($id)){
            Session::put('getid', $id);
        
            $campaignlist = CampaignHistory::where('campaign_id',$id)->get();
            $contactcout  = Contact::all()->count();
            $sendcount = $campaignlist->where('msg_type','sent')->count();
            $receivecount = $campaignlist->where('msg_type','received')->count();
            $msgcount = $campaignlist->count();

            $now = Carbon::now();
            $year = $now->format('Y');
            $monthcount = CampaignHistory::where('campaign_id',$id)
             ->get()
             ->groupBy(function($campaignlist) {
                    return Carbon::parse($campaignlist->created_at)->format('m'); // grouping by months
             });
          
               
                $usermcount   = [];
                $userArr      = [];
                $monthsent    = [];
                $monthreceive = [];
                $contactmonth = [];

                // campaign month count loop
                foreach ($monthcount as $key => $value) {
                    $usermcount[(int)$key]   = count($value);
                    $contactcount[(int)$key] = count($value->unique('contact_id'));
                    $monthsent[(int)$key]    = $value->where('msg_type','sent')->count();
                    $monthreceive[(int)$key] = $value->where('msg_type','received')->count();
                }

                for($i = 1; $i <= 12; $i++){
                    if(!empty($usermcount[$i])){
                        $userArr[$i]      = $usermcount[$i]; 
                        $countsent[$i]    = $monthsent[$i];
                        $countreceive[$i] = $monthreceive[$i]; 
                        $numbercount[$i]  = $contactcount[$i];
                    }else{
                        $userArr[$i]      = 0;    
                        $countsent[$i]    = 0;
                        $countreceive[$i] = 0;
                        $numbercount[$i]  = 0;
                    }
                }

            $permission_details = CampaignStats::updateOrCreate(
                [
                    'campaign_id' => $id,
                ],
                [
                   'no_of_user'   => $contactcout,
                   'msg_send'     => $sendcount,
                   'msg_received' => $receivecount,
                   'total_msg'    => $msgcount,

                ]
            );
             return view('Qrcode::campaign.show',compact('contactcout','sendcount','receivecount','msgcount','userArr','countsent','countreceive','numbercount','id','year'));
        }else{
            return redirect()->route('campaign.index')->with('error','Whatsapp Details Not Found');
        }
    }

    public function campaign_history(Request $request){

            $campaignContact = Contact::with('campaignHistory')->get();
            
            return view('Qrcode::campaign-history.index', compact('campaignContact'));   
    }
   

    public function edit($id)
    {
        if(!empty($id)){
                 $campaignlist = Campaign::find($id);
                 $campaignOptionList = CampaignOption::where('campaign_id',$id)->get();
                 Session::put('campaignId', $campaignlist->id);
                  return view('Qrcode::campaign-option.index',compact('campaignlist','campaignOptionList'));
             }else{
                 return redirect()->route('campaign-option.index')->with('error','Whatsapp Details Not Found');
             }
    }


    public function destroy(Request $request)
    {   
        if($request){
            Campaign::find($request->campaginId)->delete();
            CampaignOption::where(['campaign_id'=>$request->campaginId])->delete();
           
          
            
                return response()->json(['Whatsapp Details Delete Successfully!']);
            }else{
                  return response()->json(['Whatsapp Details Already Deleted!']);
            }
        
    }
    public function MonthShow(Request $request)
    {
        $listdays = Carbon::now()->month($request->monthid)->daysInMonth;
        $id = $request->campaign_id;
        $campaignlist = [];
        $count = [];

        for($i = 1; $i <= $listdays; $i++){
            $dateformat = $request->yearid.'-'.$request->monthid.'-'.$i;
            
            $campaignlist[$i] = CampaignHistory::where('campaign_id',$request->campaign_id)->WhereDate('created_at',$dateformat)->get();
           
            // $data[$i] = $campaignlist->whereDate('created_at',$i)->get();
            $count[] = count($campaignlist[$i]);
        
        }
     return response()->json(['count' => $count]);

        
    }


    public function qrmodal(Request $request){
        
        $campaign = Campaign::where('id' , $request->campaign_view_id)->first();
        return response()->json(['campaign' => $campaign]);
    }

    public function campaignGraph(Request $request){

        if($request->month != 0){
            $daysinmonth = Carbon::now()->month($request->month)->daysInMonth;
            

            $days = [];
            $total = [];
            $receivemonth = [];
            $sentmonth =[];
            for($i=1; $i<=$daysinmonth; $i++){
                array_push($days, $i);
                $campaignlist = CampaignHistory::where('campaign_id',$request->id)->whereYear('created_at' , $request->year)->whereMonth('created_at' , $request->month)->whereDay('created_at' , $i)->count();
                array_push($total, $campaignlist);

                $monthsent    = CampaignHistory::where('campaign_id',$request->id)->whereYear('created_at' , $request->year)->whereMonth('created_at' , $request->month)->whereDay('created_at' , $i)->where('msg_type','sent')->count();
                
                array_push($sentmonth, $monthsent);

                $monthreceive = CampaignHistory::where('campaign_id',$request->id)->whereYear('created_at' , $request->year)->whereMonth('created_at' , $request->month)->whereDay('created_at' , $i)->where('msg_type','received')->count();
                
                array_push($receivemonth, $monthreceive);
            }
           
            }

            return response()->json(['daysinmonth' => $daysinmonth , 'days' => $days , 'total'=>$total , 'sentmonth'=>$sentmonth ,'receivemonth'=>$receivemonth ]);

        }
}