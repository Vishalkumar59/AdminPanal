<?php

namespace Modules\Qrcode\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Qrcode\Models\WpSetting;

class SettingController extends Controller
{
	public function index(){

		$setting = WpSetting::first();
		// dd($settings);
		return view('Qrcode::setting.edit',compact('setting'));
	}

	public function update(Request $request, $id)
	{
		// dd($request->all());
		if(!empty($id)){

            $setting = WpSetting::find($id);
            $setting->sender_number      = $request->sender_number;
            $setting->wa_token        = $request->wa_token;
            $setting->status        = $request->status;
            $setting->update();

            return redirect()->route('setting.index')->with('success', 'Setting Updated Successfully');
        }else{
            return redirect()->route('setting.index')->with('error', 'Setting Updation Failed');
        }
		
	}
}