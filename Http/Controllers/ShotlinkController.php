<?php

namespace Modules\Qrcode\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Qrcode\Http\Requests\StoreLinkRequest;
use Modules\Qrcode\Models\Link;
use Modules\Qrcode\Models\Plan;
use Illuminate\Http\Request;
use Modules\Qrcode\Traits\LinkTrait;
use Modules\Qrcode\Models\Domain;
use Illuminate\Support\Facades\Auth;



class ShotlinkController extends Controller
{
    use LinkTrait;
    
    
    public function shortlink(Request $request)
    {
        // If there's a payment processor enabled
        if (paymentProcessors()) {
            $user = Auth::user();

            $plans = Plan::where('visibility', 1)->orderBy('position')->orderBy('id')->get();

            $domains = Domain::select('name')->where('user_id', '=', 0)
                ->whereNotIn('id', [config('settings.short_domain')])
                ->get()
                ->map(function ($item) {
                    return $item->name;
                })
                ->toArray();
        } else {
            $user = null;
            $plans = null;
            $domains = null;
        }

        $defaultDomain = null;

        if (Domain::where([['user_id', '=', 0], ['id', '=', 1]])->exists()) {
         
            $defaultDomain = 1;
        }
        return view('Qrcode::whatsapp-boat.shortlink' ,['defaultDomain' => $defaultDomain]);
    }
    public function createLink(Request $request)
    {
        //  dd($request->all());
        // if (!config('settings.short_guest')) {
        //     abort(404);
        // }

        $this->linkStore($request);

      
        return redirect()->back()->with('link', Link::where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->limit(1)->get());
    }

}
 