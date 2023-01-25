<?php

namespace Modules\Qrcode\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Qrcode\Models\Qna;
use Illuminate\Http\Request;


class QAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $whatsapp = Qna::paginate(10);
        // dd($whatsapp);
        return view('Qrcode::qa.index', compact('whatsapp'));
    }

    public function create()
    {
        return view('Qrcode::qa.create');
       
    }
   
    public function store(Request $request)
    {
        
        if(!empty($request->all())){

            $whatsapp = new Qna();
            $whatsapp->question      = $request->question;
            $whatsapp->answer        = $request->answer;
            $whatsapp->whatsapp_code = $request->whatsapp_code;
            $whatsapp->language_code = $request->language;
            $whatsapp->status        = '1';
            $whatsapp->updated_at    = null;
            $whatsapp->save();

            return redirect()->route('qa')->with('success', 'Whatsapp Details Inserted Successfully');
        }else{
            return redirect()->route('qa')->with('error', 'Whatsapp Details Insertion Failed');
        }
       
    }

    public function edit($id)
    {
        if(!empty($id)){

            $whatsapp = Qna::find($id);
             return view('Qrcode::qa.edit',compact('whatsapp'));
        }else{
            return redirect()->route('qa')->with('error','Whatsapp Details Not Found');
        }

    }

     public function update(Request $request)
    {

        if(!empty($request)){

            $whatsapp = Qna::find($request->id);
            $whatsapp->question      =  $request->question;
            $whatsapp->answer        =  $request->answer;
            $whatsapp->whatsapp_code =  $request->whatsapp_code;
            $whatsapp->language_code =  $request->language;
            $whatsapp->update();

            return redirect()->route('qa')->with('success','Whatsapp Details Updated Successfully!');
        }else{
            return redirect()->route('qa')->with('error','Whatsapp Details Updation Failed');
        }

    }

    public function destroy(Request $request)
    {   
       
        if($request){
        Qna::find($request->whatsapp_id)->delete();
       
        return response()->json(['Whatsapp Details Delete Successfully!']);
        }else{
              return response()->json(['Whatsapp Details Already Deleted!']);
        }
    }
    public function changeWhatsappStatus(Request $request)
    {
       // dd($request->all());
        if(!empty($request->whatsapp_id)){
        $whatsapp =  Qna::where('id' ,$request->whatsapp_id)->first();
        $whatsapp->status = $request->status;
        $whatsapp->update();
        return response()->json(['success'=>'Whatsapp Status Changed Successfully']);
        }else{
             return response()->json(['error'=>'Whatsapp Status Changes Failed']);
        }

    }

}