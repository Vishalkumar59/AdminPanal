<?php

namespace Modules\Qrcode\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Storage;
use GuzzleHttp\Client;
use Log;
use Illuminate\Foundation\Bootstrap\ConfigureLogging;
use Modules\Qrcode\Models\CampaignOption;
use Modules\Qrcode\Models\Campaign;
use Modules\Qrcode\Models\Contact;
use Modules\Qrcode\Models\CampaignHistory; 
use Modules\Qrcode\Models\CampaignOptionValue;
use Modules\Qrcode\Models\WpSetting;


class QrController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function getWebhook(Request $request)
  {
    if ($request->hub_mode == 'subscribe' && $request->hub_verify_token == '834b2u3y4buy234gdhgfgf') {
      echo $request->hub_challenge;

    }
  }

  public function postWebhook(Request $request)
  {

    
      Log::info($request->all());
    if ($request->object) {
      if (
        $request->entry &&
        $request->entry[0]['changes'] &&
        $request->entry[0]['changes'][0] &&
        $request->entry[0]['changes'][0]['value']['messages'] &&
        $request->entry[0]['changes'][0]['value']['messages'][0]
      ) {
        $phone_number =
          $request->entry[0]['changes'][0]['value']['messages'][0]['from'];
        $msg_body =  $request->entry[0]['changes'][0]['value']['messages'][0]['text']['body']; // extract the message text from the webhook payload
        if ($msg_body) {
          $this->check_start_campaign($msg_body, $phone_number);
        }
        
        
      }
    }
  
  }

  public function check_start_campaign($messgage  , $phone_number){
   
   
    if($messgage != ''){
      $campign_exist = Campaign::whereRaw('LOWER(trigger_message) = (?)' ,[strtolower($messgage)])->first();
      
      if($campign_exist){

        $option_values = CampaignOption::where('campaign_id' , $campign_exist->id)->where('parent_id' , 0)->orderBy('sort_order' , 'asc' )->first();

        
        if(!empty($option_values)){
          if($option_values->option_type == '1'){
              $messagebox = $option_values->wa_template_code;
          }else{
              $messagebox = $option_values->option_message;
          }
          
          $contact_details = Contact::firstOrCreate(
              ['contact_number' => $phone_number]
          );

          if(!empty($contact_details)){
            $phone_number_id = $contact_details->id;
          }

            $campaignhistory = new CampaignHistory();
            $campaignhistory->campaign_id = $option_values->campaign_id;
            $campaignhistory->contact_id  = $phone_number_id;
            $campaignhistory->msg_type    = "received";
            $campaignhistory->message     = $messgage;
            $campaignhistory->option_id   = $option_values->option_id;
            $campaignhistory->save();

            $campaignhistory = new CampaignHistory();
            $campaignhistory->campaign_id = $option_values->campaign_id;
            $campaignhistory->contact_id  = $phone_number_id;
            $campaignhistory->msg_type    = "sent";
            $campaignhistory->message     = $messagebox;
            $campaignhistory->option_id   = $option_values->option_id;
            $campaignhistory->save();

            
           
        
          $this->send_message($phone_number, $messagebox, $option_values->option_type);
        }
      }
      else{

        $contactlist = Contact::where('contact_number' , $phone_number)->first();
        $campaign_history = CampaignHistory::where('contact_id' , $contactlist->id)->orderBy('id', 'desc')->first(); 
        $contact_value_id = 0;
        if(!empty( $campaign_history)){
          $contact_campaign_id =  $campaign_history->campaign_id;
          $contact_option_id =  $campaign_history->option_id;

          if($campaign_history->option_id){
            $option_having_data = CampaignOptionValue::where('option_id' , $campaign_history->option_id)->get();
            if(count($option_having_data)){
              $value_exist = CampaignOptionValue::where('option_id' , $campaign_history->option_id)->whereRaw('LOWER(name) = (?)',[strtolower($messgage)])->first();
              $contact_value_id = $value_exist->value_id;
            }

          }

          $campaign_next_msg = CampaignOption::where('campaign_id' , $contact_campaign_id)->where('parent_id' , $contact_option_id)->where('parent_value_id' , $contact_value_id)->orderBy('sort_order' , 'asc' )->first();

          if($campaign_next_msg->option_type == '1'){
            $messagebox = $campaign_next_msg->wa_template_code;
          }else{
              $messagebox = $campaign_next_msg->option_message;
          }

          $campaignhistory = new CampaignHistory();
          $campaignhistory->campaign_id = $contact_campaign_id;
          $campaignhistory->contact_id  = $contactlist->id;
          $campaignhistory->msg_type    = "received";
          $campaignhistory->message     = $messgage;
          $campaignhistory->option_id   = $campaign_next_msg->option_id;
          $campaignhistory->save();

          $campaignhistory = new CampaignHistory();
          $campaignhistory->campaign_id = $contact_campaign_id;
          $campaignhistory->contact_id  = $contactlist->id;
          $campaignhistory->msg_type    = "sent";
          $campaignhistory->message     = $messagebox;
          $campaignhistory->option_id   = $campaign_next_msg->option_id;
          $campaignhistory->save();



          $this->send_message($phone_number, $messagebox, $campaign_next_msg->option_type);
        }
      }
    }
  }



  public function send_message($phone_number, $message, $type){
    $wpsetting = WpSetting::where('status' , 1)->first();

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL =>  'https://graph.facebook.com/v15.0/'.$wpsetting->sender_number.'/messages',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>
       array(
        'messaging_product' => 'whatsapp',
        'to' => $phone_number ,
        'type' => 'text',
        'recipient_type' => 'individual',
        'text' => '{
          "preview_url": false,
          "body": "'.$message.'"
          }'),
        CURLOPT_HTTPHEADER => array(
          'Authorization: Bearer '.$wpsetting->wa_token
        ),
      ));
    
      $response = curl_exec($curl);
      curl_close($curl);
      

  }


  public function index()
  {


    return view('Qrcode::Qrcode.index');
  }

  public function Generate(Request $request)
  {
    $time = time();
    $image = \QrCode::format('png')
      ->size(200)->errorCorrection('H')
      ->generate($request->qr_message);
    $output_file = '/img/' . time() . '.png';


    $data = Storage::disk('public')->put($output_file, $image);

    \Session::put('qrImage', $output_file);
    $url_hit = $request->qr_message;
    \Session::put('url_hit', $url_hit);

    return redirect()->route('Qr.code');
  }
}
