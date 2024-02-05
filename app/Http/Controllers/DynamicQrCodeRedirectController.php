<?php

namespace App\Http\Controllers;

use App\Models\QrCode;
use App\Helpers\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DynamicQrCodeRedirectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,$code)
    {



        $qrCode = QrCode::where('code',$code)->first();

        if(!$qrCode){
            $qrCode = QrCode::where('subdomain',$code)->firstOrFail();
            $qrCode->increment('scan_count');
            $qrCode->qrCodeTracks()->create($request->all());
            if(!$qrCode->status){
                abort(404,'Qr Code is not active');
            }
            if($qrCode->type == 'event'){
                return view('dynamic.event-preview',['event'=>(object)$qrCode->qr_code_info]);
            }elseif($qrCode->type == 'social'){
                return view('dynamic.social-preview',['social'=>(object)$qrCode->qr_code_info]);
            }
            elseif($qrCode->type == 'pdf'){
                return view('dynamic.pdf-preview',['pdf'=>(object)$qrCode->qr_code_info]);
            }elseif($qrCode->type == 'video'){
                return view('dynamic.video-preview',['video'=>(object)$qrCode->qr_code_info]);
            }elseif($qrCode->type == 'audio'){
                return view('dynamic.audio-preview',['audio'=>(object)$qrCode->qr_code_info]);
            }elseif($qrCode->type == 'image'){
                return view('dynamic.image-preview',['image'=>(object)$qrCode->qr_code_info]);
            }
        }
        if(!$qrCode->status){
            abort(404,'Qr Code is not active');
        }

        if(!$qrCode->is_dynamic){
            abort(404);
        }
        $qrCode->increment('scan_count');

        $qrCode->qrCodeTracks()->create($request->all());

        if(Support::onlyDynamic($qrCode->type)){
            $url = 'https://'.$qrCode->subdomain . '.' . config('app.domain');
            return redirect()->away($url);
        }


        if($qrCode->type == 'vcard'){
            $url = Support::vCardQrCodeDataGenerate($qrCode->qr_code_info);
            return Response::make(
                $url,
                200,
                ['Content-Type' => 'text/vcard']
            );
            // return redirect()->away($url);
        }
        $url  = Support::staticQrCodeDataGenerate($qrCode->type,$qrCode->qr_code_info);
        return redirect()->away($url);


    }


}
