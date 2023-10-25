<?php

namespace App\Http\Controllers;

use App\Helpers\SupportFacade;
use App\Models\QrCode;
use Illuminate\Http\Request;

class DynamicQrCodeRedirectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,$code)
    {
        $qrCode = QrCode::where('code',$code)->firstOrFail();

        if(!$qrCode->is_dynamic){
            abort(404);
        }
        $qrCode->increment('scan_count');

        $qrCode->qrCodeTracks()->create($request->all());


        if($qrCode->type == 'vcard'){
            $url = SupportFacade::vCardQrCodeDataGenerate($qrCode->qr_code_info);
            return redirect()->away($url);
        }

        $url  = SupportFacade::staticQrCodeDataGenerate($qrCode->type,$qrCode->qr_code_info);
        return redirect()->away($url);


    }
}
