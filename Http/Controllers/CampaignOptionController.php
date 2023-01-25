<?php

namespace Modules\Qrcode\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Qrcode\Models\Campaign;
use Illuminate\Http\Request;
use Modules\Qrcode\Models\Domain;
use Modules\Qrcode\Models\Link;
use Modules\Qrcode\Traits\LinkTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Modules\Qrcode\Models\CampaignOption;
use Modules\Qrcode\Models\CampaignOptionValue;
use Session;


class CampaignOptionController extends Controller
{
    use LinkTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
      
    }

    public function create()
    {
        $campaignOptionList = CampaignOption::all();
        $CampaignOption = CampaignOption::where('status',1)->get();
        return view('Qrcode::campaign-option.create',compact('campaignOptionList','CampaignOption'));
    }
   
    public function store(Request $request)
    {
       
        
       
        $CampaignOpt                   = new CampaignOption();
        $CampaignOpt->campaign_id      = $request->campaign_id;
        $CampaignOpt->parent_id        = $request->parent_option ?? 0;
        $CampaignOpt->option_name      = $request->name;
        $CampaignOpt->option_message   = $request->message;
        $CampaignOpt->wa_template_code = $request->wp_template_code ?? null;
        $CampaignOpt->sort_order       = $request->sort_order;
        $CampaignOpt->option_type      = $request->option_type;
        $CampaignOpt->parent_value_id  = $request->parent_option_value ?? 0;
        $CampaignOpt->status           = $request->status;
        $CampaignOpt->save();

        $CampaignOpt_id = $CampaignOpt->option_id;

        foreach($request->values as $key => $values){
            if(!empty($values)){
            CampaignOptionValue::create([
                'option_id' => $CampaignOpt_id,
                'name'      => $values
            ]);
        }
        }
       
        return redirect('campaign/'.$request->campaign_id.'/edit')->with('success', 'Campaign Option Created Successfully!');  

    }
  

    public function edit($id)
    {

        if(!empty($id)){
            $CampaignOption = CampaignOption::where('status',1)->get();
            $CampaignOptionlist = CampaignOption::find($id);
            Session::put('parent_value_id', $CampaignOptionlist->parent_value_id);
           
            $CampaignOptionId = $CampaignOptionlist->option_id;
            $parentselected = $CampaignOptionlist->parent_id;
            
            $CampaignOptionValue = CampaignOptionValue::where('option_id',$CampaignOptionId)->get();
            // dd($CampaignOptionValue);
             return view('Qrcode::campaign-option.edit',compact('CampaignOption','CampaignOptionlist','CampaignOptionValue','parentselected'));
        }else{
            return redirect()->route('campaign-option.index')->with('error','Whatsapp Details Not Found');
        }

        

    }

     public function update(Request $request,$id)
    {
      
        $CampaignOpt = CampaignOption::find($id);
        $CampaignOpt->campaign_id      = $request->campaign_id;
        $CampaignOpt->parent_id        = $request->parent_option ?? 0;
        $CampaignOpt->option_name      = $request->name;
        $CampaignOpt->option_message   = $request->message;
        $CampaignOpt->wa_template_code = $request->wp_template_code  ?? null;
        $CampaignOpt->sort_order       = $request->sort_order;
        $CampaignOpt->option_type       = $request->option_type;
        $CampaignOpt->parent_value_id  = $request->parent_option_value ?? 0;
        $CampaignOpt->status           = $request->status;
        $CampaignOpt->update();

        $value_id = $request->value_id;
        foreach($request->values as $key => $values){
            if(!empty($value_id[$key])){
                CampaignOptionValue::where('value_id', $value_id[$key])->update([
                    'name'      => $values,
                    'value_id'  => $value_id[$key],
                    'option_id' => $id
                ]);
            }else{
                CampaignOptionValue::create([
                    'name'      => $values,
                    'option_id' => $id
                ]);
            }
        }
        return redirect('campaign/'.$request->campaign_id.'/edit')->with('success', 'Campaign Option Created Successfully!');  
    }

    public function destroy(Request $request)
    {   
      
      if (CampaignOption::where('option_id', $request->campaginId)->exists()) {
        CampaignOption::where('option_id',$request->campaginId)->delete();
        return response()->json(['success' => 'Campagin Option deleted successfully']);
    } else{
        return response()->json(['error' => 'Campagin Option already deleted!']);
    }
    

        
    }
   
    public function parentValue(Request $request)
    {
       
        $findParentId = $request->data;
        $parentvalueid = Session::get('parent_value_id');
        $filterValueList  = CampaignOptionValue::where('option_id',$findParentId)->get();
       
        return response()->json(['filterValueList'=>$filterValueList,'parentvalueid' => $parentvalueid]);


    }
    public function addmoredelete(Request $request)
    {
       
        $social_link_delete = CampaignOptionValue::where('value_id',$request->campaignvalueid)->delete();
    
        return response()->json(['success'=>'Data deleted successfully']);
        // return redirect()->back();

    }
    public function CampaignStatus(Request $request)
    {
       
        $campaignstatus = CampaignOption::where('option_id' ,$request->campaginOpionId)->first();
        $campaignstatus->status = $request->status;
        $campaignstatus->update();
        return response()->json(['success'=>' Campaign Status Changed Successfully']);
    }

}