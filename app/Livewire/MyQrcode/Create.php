<?php

namespace App\Livewire\MyQrcode;

use Support;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

use function Laravel\Folio\middleware;

class Create extends Component
{

    use WithFileUploads;

    //query string
    protected $queryString = ['type'];



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


    //vCard
    public $vcard_first_name = '';
    public $vcard_last_name = '';
    public $vcard_phone_number = '';
    public $vcard_mobile = '';
    public $vcard_email = '';
    public $vcard_website = '';
    public $vcard_company = '';
    public $vcard_job_title = '';
    public $vcard_address = '';
    public $vcard_fax = '';
    public $vcard_city = '';
    public $vcard_post_code = '';
    public $vcard_country = '';




    public $data = 'Qrcode Solution';
    public $error = '';
    public $onlyDynamic = false;

    public $dynamic = false;


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
        if (Support::onlyDynamic($this->type)) {
            return;
        }

        if ($this->type == 'url') {

            $rules = ['url' => 'required|url|max:255|active_url'];
            $this->validate($rules);
        } elseif ($this->type == 'email') {

            $rules = ['email' => 'required|email', 'subject' => 'required|max:255', 'message' => 'required|max:300'];
            $this->validate($rules);
        } elseif ($this->type == 'sms') {

            $rules = ['sms' => 'required|max:300', 'sms_phone' => 'required|max:255'];
            $this->validate($rules);
        } elseif ($this->type == 'phone') {

            $rules = ['call_phone' => 'required|max:255'];
            $this->validate($rules);
        } elseif ($this->type == 'wifi') {

            $rules = ['network_name' => 'required|max:255', 'network_password' => 'required|max:255'];
            $this->validate($rules);
        } elseif ($this->type == 'text') {
            $rules = ['text_data' => 'required'];
            $this->validate($rules);
        } elseif ($this->type == 'bitcoin') {
            $rules = ['bitcoin_address' => 'required|max:255', 'bitcoin_amount' => 'required|max:255'];
            $this->validate($rules);
        } elseif ($this->type == 'location') {
            $rules = ['latitude' => 'required|numeric|max:255', 'longitude' => 'required|numeric|max:255'];
            $this->validate($rules);
        } elseif ($this->type == 'vcard') {
            $rules = [
                'vcard_first_name' => 'required|max:255',
                'vcard_last_name' => 'required|max:255',
                'vcard_phone_number' => 'required|max:17',
                'vcard_mobile' => 'required|max:17',
                'vcard_email' => 'required|email|max:255',
                'vcard_website' => 'required|max:255',
                'vcard_company' => 'required|max:255',
                'vcard_job_title' => 'required|max:255',
                'vcard_address' => 'required|max:255',
                'vcard_fax' => 'required|max:17',
                'vcard_city' => 'required|max:255',
                'vcard_post_code' => 'required|max:255',
                'vcard_country' => 'required|max:255',
            ];
            $message = [
                'vcard_first_name.required' => 'The first name field is required.',
                'vcard_last_name.required' => 'The last name field is required.',
                'vcard_phone_number.required' => 'The phone number field is required.',
                'vcard_mobile.required' => 'The mobile field is required.',
                'vcard_email.required' => 'The email field is required.',
                'vcard_website.required' => 'The website field is required.',
                'vcard_company.required' => 'The company field is required.',
                'vcard_job_title.required' => 'The job title field is required.',
                'vcard_address.required' => 'The address field is required.',
                'vcard_fax.required' => 'The fax field is required.',
                'vcard_city.required' => 'The city field is required.',
                'vcard_post_code.required' => 'The post code field is required.',
                'vcard_country.required' => 'The country field is required.',

                'vcard_first_name.max' => 'The first name may not be greater than 255 characters.',
                'vcard_last_name.max' => 'The last name may not be greater than 255 characters.',
                'vcard_phone_number.max' => 'The phone number may not be greater than 17 characters.',
                'vcard_mobile.max' => 'The mobile may not be greater than 17 characters.',
                'vcard_email.max' => 'The email may not be greater than 255 characters.',
                'vcard_website.max' => 'The website may not be greater than 255 characters.',
                'vcard_company.max' => 'The company may not be greater than 255 characters.',
                'vcard_job_title.max' => 'The job title may not be greater than 255 characters.',
                'vcard_address.max' => 'The address may not be greater than 255 characters.',
                'vcard_fax.max' => 'The fax may not be greater than 17 characters.',
                'vcard_city.max' => 'The city may not be greater than 255 characters.',
                'vcard_post_code.max' => 'The post code may not be greater than 255 characters.',
                'vcard_country.max' => 'The country may not be greater than 255 characters.',

                'vcard_email.email' => 'The email must be a valid email address.',

            ];
            $this->validate($rules, $message);
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
            'vcard_first_name' => $this->vcard_first_name,
            'vcard_last_name' => $this->vcard_last_name,
            'vcard_phone_number' => $this->vcard_phone_number,
            'vcard_mobile' => $this->vcard_mobile,
            'vcard_email' => $this->vcard_email,
            'vcard_website' => $this->vcard_website,
            'vcard_company' => $this->vcard_company,
            'vcard_job_title' => $this->vcard_job_title,
            'vcard_address' => $this->vcard_address,
            'vcard_fax' => $this->vcard_fax,
            'vcard_city' => $this->vcard_city,
            'vcard_post_code' => $this->vcard_post_code,
            'vcard_country' => $this->vcard_country,
        ];
        $this->data = Support::staticQrCodeDataGenerate($this->type, $data);
        $this->qrCodeCreate();
    }


    // save
    public function save()
    {

        if (Support::onlyDynamic($this->type)) {
            return;
        }

        if ($this->type == 'url') {
            $rules = ['url' => 'required|url'];
            $this->validate($rules);
            $qrCodeInfo['url'] = $this->url;
        } elseif ($this->type == 'email') {
            $rules = ['email' => 'required|email', 'subject' => 'required', 'message' => 'required'];
            $this->validate($rules);
            $qrCodeInfo['email'] = $this->email;
            $qrCodeInfo['subject'] = $this->subject;
            $qrCodeInfo['message'] = $this->message;
        } elseif ($this->type == 'sms') {
            $rules = ['sms' => 'required', 'sms_phone' => 'required'];
            $this->validate($rules);
            $qrCodeInfo['sms'] = $this->sms;
            $qrCodeInfo['sms_phone'] = $this->sms_phone;
        } elseif ($this->type == 'phone') {
            $rules = ['call_phone' => 'required'];
            $this->validate($rules);
            $qrCodeInfo['call_phone'] = $this->call_phone;
        } elseif ($this->type == 'wifi') {
            $rules = ['network_name' => 'required', 'network_password' => 'required'];
            $this->validate($rules);
            $qrCodeInfo['network_name'] = $this->network_name;
            $qrCodeInfo['network_password'] = $this->network_password;
            $qrCodeInfo['network_type'] = $this->network_type;
            $qrCodeInfo['wifi_hidden'] = $this->wifi_hidden;
        } elseif ($this->type == 'text') {
            $rules = ['text_data' => 'required'];
            $this->validate($rules);
            $qrCodeInfo['text_data'] = $this->text_data;
        } elseif ($this->type == 'bitcoin') {
            $rules = ['bitcoin_address' => 'required', 'bitcoin_amount' => 'required'];
            $this->validate($rules);
            $qrCodeInfo['bitcoin_address'] = $this->bitcoin_address;
            $qrCodeInfo['bitcoin_amount'] = $this->bitcoin_amount;
        } elseif ($this->type == 'location') {
            $rules = ['latitude' => 'required|numeric', 'longitude' => 'required|numeric'];
            $this->validate($rules);
            $qrCodeInfo['latitude'] = $this->latitude;
            $qrCodeInfo['longitude'] = $this->longitude;
        } elseif ($this->type == 'vcard') {
            $rules = [
                'vcard_first_name' => 'required|max:255',
                'vcard_last_name' => 'required|max:255',
                'vcard_phone_number' => 'required|max:17',
                'vcard_mobile' => 'required|max:17',
                'vcard_email' => 'required|email|max:255',
                'vcard_website' => 'required|max:255',
                'vcard_company' => 'required|max:255',
                'vcard_job_title' => 'required|max:255',
                'vcard_address' => 'required|max:255',
                'vcard_fax' => 'required|max:17',
                'vcard_city' => 'required|max:255',
                'vcard_post_code' => 'required|max:255',
                'vcard_country' => 'required|max:255',
            ];
            $message = [
                'vcard_first_name.required' => 'The first name field is required.',
                'vcard_last_name.required' => 'The last name field is required.',
                'vcard_phone_number.required' => 'The phone number field is required.',
                'vcard_mobile.required' => 'The mobile field is required.',
                'vcard_email.required' => 'The email field is required.',
                'vcard_website.required' => 'The website field is required.',
                'vcard_company.required' => 'The company field is required.',
                'vcard_job_title.required' => 'The job title field is required.',
                'vcard_address.required' => 'The address field is required.',
                'vcard_fax.required' => 'The fax field is required.',
                'vcard_city.required' => 'The city field is required.',
                'vcard_post_code.required' => 'The post code field is required.',
                'vcard_country.required' => 'The country field is required.',

                'vcard_first_name.max' => 'The first name may not be greater than 255 characters.',
                'vcard_last_name.max' => 'The last name may not be greater than 255 characters.',
                'vcard_phone_number.max' => 'The phone number may not be greater than 17 characters.',
                'vcard_mobile.max' => 'The mobile may not be greater than 17 characters.',
                'vcard_email.max' => 'The email may not be greater than 255',
                'vcard_website.max' => 'The website may not be greater than 255 characters.',
                'vcard_company.max' => 'The company may not be greater than 255 characters.',
                'vcard_job_title.max' => 'The job title may not be greater than 255 characters.',
                'vcard_address.max' => 'The address may not be greater than 255 characters.',
                'vcard_fax.max' => 'The fax may not be greater than 17 characters.',
                'vcard_city.max' => 'The city may not be greater than 255 characters.',
                'vcard_post_code.max' => 'The post code may not be greater than 255 characters.',
                'vcard_country.max' => 'The country may not be greater than 255 characters.',
                'vcard_email.email' => 'The email must be a valid email address.',
            ];

            $this->validate($rules, $message);

            $qrCodeInfo['vcard_first_name'] = $this->vcard_first_name;
            $qrCodeInfo['vcard_last_name'] = $this->vcard_last_name;
            $qrCodeInfo['vcard_phone_number'] = $this->vcard_phone_number;
            $qrCodeInfo['vcard_mobile'] = $this->vcard_mobile;
            $qrCodeInfo['vcard_email'] = $this->vcard_email;
            $qrCodeInfo['vcard_website'] = $this->vcard_website;
            $qrCodeInfo['vcard_company'] = $this->vcard_company;
            $qrCodeInfo['vcard_job_title'] = $this->vcard_job_title;
            $qrCodeInfo['vcard_address'] = $this->vcard_address;
            $qrCodeInfo['vcard_fax'] = $this->vcard_fax;
            $qrCodeInfo['vcard_city'] = $this->vcard_city;
            $qrCodeInfo['vcard_post_code'] = $this->vcard_post_code;
            $qrCodeInfo['vcard_country'] = $this->vcard_country;
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
            'is_dynamic' => $this->dynamic ? true : false,
        ];

        if(auth()->check() == false){
            Support::saveRequestData($data);
            return redirect()->route('login');
        }

        auth()->user()->qrCodes()->create($data);
        toastr()->success('QR Code Created Successfully');

        if ($this->dynamic) {
            return redirect()->route('my-qrcode.dynamic');
        }
        return redirect()->route('my-qrcode.static');
    }



    public function render()
    {
        return view('livewire.my-qrcode.create');
    }
}
