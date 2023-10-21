<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use App\Models\QrCode;

name('home');

new class extends Component {

    use WithFileUploads;



     //---> QR Code design-related options  ---//
    public $qr_style = "default";
    public $qr_logo = '';
    public $qr_logo_background = false;
    public $qr_color = null;
    public $qr_bg_color = '255,255,255';
    public $qr_eye_border = 'default';
    public $qr_eye_center = 'default';
    public $qr_eye_color_in = '';
    public $qr_eye_color_out = '';
    public $qr_eye_style_in = '';
    public $qr_eye_style_out = '';
    public $qr_gradient = null;
    public $qr_bg_image = '';
    public $qr_custom_logo = null;
    public $qr_custom_background = null;
    public $frame = 'none';
    public $frame_label = 'Scan me';
    public $frame_label_font = 'AbrilFatface.svg';
    public $frame_label_text_color = '#FFFFFF';
    //---> QR Code design-related options  ---//



    public $type = 'url';

    //url
    public $url = '';

    //email
    public $email = '';
    public $subject = '';
    public $message = '';

    //sms
    public $sms = '';
    public $sms_phone = '';

    //call
    public $call_phone = '';

    //wifi
    public $network_name = '';
    public $network_password = '';
    public $network_type = '';
    public $wifi_hidden = '';

    //text
    public $text_data = '';

    //bitcoin
    public $bitcoin_address = '';
    public $bitcoin_amount = '';

    //location
    public $latitude = '';
    public $longitude = '';



    public $data = 'Qrcode Solution';
    public $error = '';
    public $onlyDynamic = false;


    public $qrcodePreview = '';

    public function qrCodeCreate()
    {
        $data = [
            'data' => $this->data,
            'qr_style' => $this->qr_style,
            'qr_logo' => $this->qr_logo,
            'qr_color' => $this->qr_color,
            'qr_bg_color' => $this->qr_bg_color,
            'qr_eye_border' => $this->qr_eye_border,
            'qr_eye_center' => $this->qr_eye_center,
            'qr_gradient' => $this->qr_gradient,
            'qr_eye_color_in' => $this->qr_eye_color_in,
            'qr_eye_color_out' => $this->qr_eye_color_out,
            'qr_eye_style_in' => $this->qr_eye_style_in,
            'qr_eye_style_out' => $this->qr_eye_style_out,
            'qr_logo_background' => $this->qr_logo_background,
            'qr_bg_image' => $this->qr_bg_image,
            'qr_custom_logo' => $this->qr_custom_logo,
            'qr_custom_background' => $this->qr_custom_background,
            'frame' => $this->frame,
            'frame_label' => $this->frame_label,
            'frame_label_font' => $this->frame_label_font,
            'frame_label_text_color' => $this->frame_label_text_color,
    ];
       $this->qrcodePreview = Support::qrCodeGenerate($data);
    }


    public function updated()
    {
        $this->onlyDynamic = Support::onlyDynamic($this->type);

        if ($this->type == 'url') {

            $rules = ['url' => 'required|url'];
            $this->validate($rules);

        }
        elseif ($this->type == 'email') {

            $rules = ['email' => 'required|email', 'subject' => 'required', 'message' => 'required'];
            $this->validate($rules);

        }
        elseif ($this->type == 'sms') {

            $rules = ['sms' => 'required', 'sms_phone' => 'required'];
            $this->validate($rules);

        }
        elseif ($this->type == 'phone') {

            $rules = ['call_phone' => 'required'];
            $this->validate($rules);

        }

        elseif ($this->type == 'wifi') {

            $rules = ['network_name' => 'required', 'network_password' => 'required'];
            $this->validate($rules);
        }

        elseif ($this->type == 'text') {
            $rules = ['text_data' => 'required'];
            $this->validate($rules);
        }

        elseif($this->type == 'bitcoin') {
            $rules = ['bitcoin_address' => 'required', 'bitcoin_amount' => 'required'];
            $this->validate($rules);
        }

        elseif($this->type == 'location') {
            $rules = ['latitude' => 'required|numeric', 'longitude' => 'required|numeric'];
            $this->validate($rules);
        }

        $data = [
            'url' => $this->url,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
            'sms' => $this->sms,
            'sms_phone' => $this->sms_phone,
            'call_phone' => $this->call_phone,
            'network_name' => $this->network_name,
            'network_password' => $this->network_password,
            'network_type' => $this->network_type,
            'wifi_hidden' => $this->wifi_hidden,
            'text_data' => $this->text_data,
            'bitcoin_address' => $this->bitcoin_address,
            'bitcoin_amount' => $this->bitcoin_amount,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
        $this->data = Support::staticQrCodeDataGenerate($this->type,$data);
        $this->qrCodeCreate();
    }


    // save
    public function save(){
        if ($this->type == 'url') {
            $rules = ['url' => 'required|url'];
            $this->validate($rules);
            $qrCodeInfo['url'] = $this->url;
        }
        elseif ($this->type == 'email') {
            $rules = ['email' => 'required|email', 'subject' => 'required', 'message' => 'required'];
            $this->validate($rules);
            $qrCodeInfo['email'] = $this->email;
            $qrCodeInfo['subject'] = $this->subject;
            $qrCodeInfo['message'] = $this->message;
        }
        elseif ($this->type == 'sms') {
            $rules = ['sms' => 'required', 'sms_phone' => 'required'];
            $this->validate($rules);
            $qrCodeInfo['sms'] = $this->sms;
            $qrCodeInfo['sms_phone'] = $this->sms_phone;
        }
        elseif ($this->type == 'phone') {
            $rules = ['call_phone' => 'required'];
            $this->validate($rules);
            $qrCodeInfo['call_phone'] = $this->call_phone;
        }
        elseif ($this->type == 'wifi') {
            $rules = ['network_name' => 'required', 'network_password' => 'required'];
            $this->validate($rules);
            $qrCodeInfo['network_name'] = $this->network_name;
            $qrCodeInfo['network_password'] = $this->network_password;
            $qrCodeInfo['network_type'] = $this->network_type;
            $qrCodeInfo['wifi_hidden'] = $this->wifi_hidden;
        }
        elseif ($this->type == 'text') {
            $rules = ['text_data' => 'required'];
            $this->validate($rules);
            $qrCodeInfo['text_data'] = $this->text_data;
        }
        elseif($this->type == 'bitcoin') {
            $rules = ['bitcoin_address' => 'required', 'bitcoin_amount' => 'required'];
            $this->validate($rules);
            $qrCodeInfo['bitcoin_address'] = $this->bitcoin_address;
            $qrCodeInfo['bitcoin_amount'] = $this->bitcoin_amount;
        }
        elseif($this->type == 'location') {
            $rules = ['latitude' => 'required|numeric', 'longitude' => 'required|numeric'];
            $this->validate($rules);
            $qrCodeInfo['latitude'] = $this->latitude;
            $qrCodeInfo['longitude'] = $this->longitude;
        }


        $data = [
            'name' => Str::ucfirst($this->type),
            'type' => $this->type,
            'qr_style' => $this->qr_style,
            'qr_logo' => $this->qr_logo,
            'qr_logo_background' => $this->qr_logo_background,
            'qr_color' => $this->qr_color,
            'qr_bg_color' => $this->qr_bg_color,
            'qr_eye_border' => $this->qr_eye_border,
            'qr_eye_center' => $this->qr_eye_center,
            'qr_eye_color_in' => $this->qr_eye_color_in,
            'qr_eye_color_out' => $this->qr_eye_color_out,
            'qr_eye_style_in' => $this->qr_eye_style_in,
            'qr_eye_style_out' => $this->qr_eye_style_out,
            'qr_gradient' => $this->qr_gradient,
            'qr_bg_image' => $this->qr_bg_image,
            'qr_custom_logo' => $this->qr_custom_logo,
            'qr_custom_background' => $this->qr_custom_background,
            'frame' => $this->frame,
            'frame_label' => $this->frame_label,
            'frame_label_font' => $this->frame_label_font,
            'frame_label_text_color' => $this->frame_label_text_color,
            'qr_code_info' => $qrCodeInfo,
            'code' => Support::hashCode(),
        ];

        $qrcode = auth()->user()->qrCodes()->create($data);
    }







};


?>

<x-layouts.frontend>

    @volt('home')
    <div class="relative flex flex-col items-center justify-center w-full h-auto overflow-hidden" x-cloak>
        <x-ui.icons.qrcode
            class="absolute top-0 left-0 w-7/12 -ml-40 -translate-x-1/2 fill-current opacity-10 dark:opacity-5 text-slate-400" />
        <x-ui.icons.qrcode
            class="absolute top-0 right-0 w-7/12 -mr-40 translate-x-1/2 fill-current opacity-10 dark:opacity-5 text-slate-400" />


        <div class="flex items-center w-full max-w-6xl mx-auto">
            <div class="container relative max-w-4xl mx-auto mt-20 text-center sm:mt-24 lg:mt-32">
                <div style="background-image:linear-gradient(160deg,#e66735,#e335e2 50%,#73f7f8, #a729ed)"
                    class="inline-block w-auto p-0.5 shadow rounded-full animate-gradient">
                    <p
                        class="w-auto h-full px-3 bg-slate-50 dark:bg-neutral-900 dark:text-white py-1.5 font-medium text-sm tracking-widest uppercase  rounded-full text-slate-800/90 group-hover:text-white/100">
                        Welcome to Qrcode Solution</p>
                </div>
                <h1
                    class="mt-5 text-4xl font-light leading-tight tracking-tight text-center dark:text-white text-slate-800 sm:text-5xl md:text-8xl">
                    Create QR Codes <br class="hidden md:block"> in seconds
                </h1>
                <p class="w-full max-w-2xl mx-auto mt-8 text-lg dark:text-white/60 text-slate-500">
                    Create QR Codes for free. No sign-up required. Create as many as you like.
                </p>
                @guest
                <div class="flex items-center justify-center w-full max-w-sm px-5 mx-auto mt-8 space-x-5">
                    <x-ui.button
                    type="primary"
                    data-te-toggle="modal"
                    data-te-target="#loginModal"
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    >Get Started</x-ui.button>
                </div>
                @endguest

            </div>
        </div>


        <div class="w-full max-w-6xl mx-auto">
            <x-qrcode.generator :type="$type" :onlyDynamic="$onlyDynamic" />

        </div>



        <x-login />
        <x-register />


    </div>
    @endvolt

</x-layouts.frontend>
