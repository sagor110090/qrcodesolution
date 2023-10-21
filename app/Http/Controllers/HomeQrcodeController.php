<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Helper\Helper;
use App\Models\Qrcode;
use Illuminate\Http\Request;
use App\Imports\QrcodesImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class HomeQrcodeController extends Controller
{
    /**
     * @var mixed
     */
    protected $dynamic_qrcodes;

    /**
     * @var string
     */
    protected $allowed_types = 'in:expiry-management,url,email,text,call,wifi,vcard,whatsapp,sms,pdf,social_link,video,images,app,event,poll';

    public function __construct()
    {
        $this->dynamic_qrcodes = getDynamicQrcodes();
    }


    /**
     * @param Request $request
     */
    public function getPreview(Request $request)
    {
        $request->validate([
            'type' => [
                'required',
                $this->allowed_types,
            ],
        ]);
        $this->qrCodeStylingValidation($request);
        if (!isPureDynamic($request->type)) {
            $this->validateByType($request, $request->type, true);
        }

        return getQrCode($request);
    }

    /**
     * @param Request $request
     */
    public function create(Request $request)
    {
        $this->basicValidation($request);
        $this->validateByType($request, $request->type);
        if (!Auth::check()) {
            $this->addSessions($request);
            return Inertia::location(route('login'));
            // return redirect()->route('login');
        }

        download_counter();
        $this->createByType($request, $request->type);


        return response()->json(['success' => 'Successfully created a Qrcode.', 'code' => 200]);
    }

    public function getPreviewQrcode(Request $request, Qrcode $qrcode)
    {
        $this->qrCodeStylingValidation($request);


        return generateQrCodeForEdit($request, $qrcode);
    }

    public function bulkIndex()
    {
        return view('user.bulk-upload');
    }

    //qr code bulk create
    public function bulkCreate(Request $request)
    {



        $request->validate([
            'file' => 'required|mimes:csv',
            'is_dynamic' => 'required',
        ]);

        $file = $request->file('file');

        $data = [
            "bg_color" => "#ffffff",
            "frontcolor" => "#000000",
            "gradient_color" => "#000000",
            "marker_out_color" => "#000000",
            "marker_in_color" => "#000000",
            "custom_logo" => null,
            "framecolor" => "#000000",
            "static" => "true",
            "pattern" => "default",
            "marker_out" => "default",
            "marker_in" => "default",
            "optionlogo" => "none",
            "outer_frame" => "none",
            "frame_label" => null,
            "label_font" => "AbrilFatface.svg",
            "type" => "link",
            'markers_color' => false,
            'gradient' => false,
            'no_logo_bg' => true,
            'transparent_code' => false,
            'folder_id' => null,
            'user_id' => Auth::id(),
            'status' => 1, // 1 = active, 0 = inactive
            'is_dynamic' => $request->is_dynamic == 2 ? true : false,
            'bg_image' => null,
            'optionbackground' => 'none',
        ];
        $file = fopen($file, 'r');

        while (($line = fgetcsv($file)) !== FALSE) {
            // first row is header
            if ($line[0] == 'name') {
                continue;
            }

            $data['link_data'] = $line[1];
            $data['name'] = $line[0];
            $request = (object) $data;
            download_counter();
            $this->createByType($request, 'link');
        }
        return redirect()->route('user.bulk-upload.index')->with('success', 'Bulk Upload successfully.');
    }



    public function getPreviewApi(Request $request)
    {
        // return response()->json(json_encode($request->all()));

        return response()->json(json_decode(getQrCode($request))->content);
    }

    public function getPreviewApiPublic(Request $request)
    {
        // return response()->json(json_encode($request->all()));

        return response()->json(json_decode(getQrCode($request))->content);
    }

    /**
     * @param $request
     */
    protected function basicValidation($request)
    {
        $request->validate([
            'type' => [
                'required',
                $this->allowed_types,
            ],
        ]);

        $this->qrCodeStylingValidation($request);
    }

    /**
     * @param $request
     */
    public function addSessions($request)
    {
        session(['title' => $request->title]);
        session(['quantity' => $request->quantity]);
        session(['description' => $request->description]);
        session(['image' => $request->image]);
        session(['start_date' => $request->start_date]);
        session(['expiry_date' => $request->expiry_date]);
        session(['link_data' => $request->link_data]);
        session(['email' => $request->email]);
        session(['subject' => $request->subject]);
        session(['message' => $request->message]);
        session(['text_data' => $request->text_data]);
        session(['country_code' => $request->country_code]);
        session(['phone_number' => $request->phone_number]);
        session(['sms_country_code' => $request->sms_country_code]);
        session(['sms_phone_number' => $request->sms_phone_number]);
        session(['sms_message' => $request->sms_message]);
        session(['vcard_fname' => $request->vcard_fname]);
        session(['vcard_lname' => $request->vcard_lname]);
        session(['vcard_phone_number' => $request->vcard_phone_number]);
        session(['vcard_mobile' => $request->vcard_mobile]);
        session(['vcard_email' => $request->vcard_email]);
        session(['vcard_web_url' => $request->vcard_web_url]);
        session(['vcard_company' => $request->vcard_company]);
        session(['vcard_job_title' => $request->vcard_job_title]);
        session(['vcard_fax' => $request->vcard_fax]);
        session(['vcard_address' => $request->vcard_address]);
        session(['vcard_city' => $request->vcard_city]);
        session(['vcard_post_code' => $request->vcard_post_code]);
        session(['vcard_country' => $request->vcard_country]);
        session(['whatsapp_country_code' => $request->whatsapp_country_code]);
        session(['whatsapp_phone_number' => $request->whatsapp_phone_number]);
        session(['whatsapp_message' => $request->whatsapp_message]);
        session(['network_name' => $request->network_name]);
        session(['network_type' => $request->network_type]);
        session(['network_password' => $request->network_password]);
        session(['wifi_hidden' => $request->wifi_hidden]);
        session(['name' => $request->name]);
        session(['url' => $request->url]);
        session(['logo' => $request->logo]);
        session(['logoSize' => $request->logoSize]);
        session(['banner' => $request->banner]);
        session(['color' => $request->color]);
        session(['font' => $request->font]);
        session(['email' => $request->email]);
        session(['phone' => $request->phone]);
        session(['links' => $request->links]);


        // session(['social_facebook_link_title' => $request->social_facebook_link_title]);
        // session(['social_twitter_link_title' => $request->social_twitter_link_title]);
        // session(['social_instagram_link_title' => $request->social_instagram_link_title]);
        // session(['social_linkedin_link_title' => $request->social_linkedin_link_title]);
        // session(['social_pinterest_link_title' => $request->social_pinterest_link_title]);
        // session(['social_youtube_link_title' => $request->social_youtube_link_title]);
        // session(['social_snapchat_link_title' => $request->social_snapchat_link_title]);
        // session(['social_reddit_link_title' => $request->social_reddit_link_title]);
        // session(['social_facebook_link' => $request->social_facebook_link]);
        // session(['social_twitter_link' => $request->social_twitter_link]);
        // session(['social_instagram_link' => $request->social_instagram_link]);
        // session(['social_linkedin_link' => $request->social_linkedin_link]);
        // session(['social_pinterest_link' => $request->social_pinterest_link]);
        // session(['social_youtube_link' => $request->social_youtube_link]);
        // session(['social_snapchat_link' => $request->social_snapchat_link]);
        // session(['social_reddit_link' => $request->social_reddit_link]);
        // session(['social_bg_color' => $request->social_bg_color]);
        session(['type' => $request->type]);
        session(['is_dynamic' => true]);

        session(['static' => $request->static]);
        if (!isPureDynamic($request->type) && !empty($request->static)) {
            session(['is_dynamic' => false]);
        }

        if ($request->type == 'video') {
            $this->validate($request, [
                'video' => 'required|mimes:mp4,3gp,avi,mov,flv,wmv,webm',
            ]);
            // upload video at temp folder
            $video = $request->video->storeAs('temp', rand() . time() . '-' . $request->video->getClientOriginalName(), 'public');
            $video = str_replace('temp/', '', $video);
            session(['video' => $video]);
        }

        if ($request->type == 'pdf') {
            $this->validate($request, [
                'pdf' => 'required|mimes:pdf',
            ]);
            $pdf = $request->pdf->storeAs('temp', rand() . time() . '-' . $request->pdf->getClientOriginalName(), 'public');
            $pdf = str_replace('temp/', '', $pdf);
            session(['pdf' => $pdf]);
        }
        if ($request->type == 'event') {
            session(['formIdx' => $request->formIdx]);
            session(['event' => $request->event]);
            session(['invitees' => $request->invitees]);
            session(['name' => $request->name]);
            session(['url' => $request->url]);
            session(['logo' => $request->logo]);
            session(['logoSize' => $request->logoSize]);
            session(['banner' => $request->banner]);
            session(['color' => $request->color]);
            session(['font' => $request->font]);
            session(['email' => $request->email]);
            session(['phone' => $request->phone]);
            session(['profileImg' => $request->profileImg]);
            session(['type' => $request->type]);
        }

        $this->setQrcodeBasicsSessions($request);
    }

    /**
     * @param $request
     */
    protected function setQrcodeBasicsSessions($request)
    {
        session(['bg_color' => $request->bg_color]);
        session(['frontcolor' => $request->frontcolor]);
        session(['marker_out_color' => $request->marker_out_color]);
        session(['marker_in_color' => $request->marker_in_color]);
        session(['gradient_color' => $request->gradient_color]);
        session(['framecolor' => $request->framecolor]);
        session(['pattern' => $request->pattern]);
        session(['marker_out' => $request->marker_out]);
        session(['marker_in' => $request->marker_in]);
        session(['optionlogo' => $request->optionlogo]);
        session(['optionbackground' => $request->optionbackground]);
        session(['outer_frame' => $request->outer_frame]);
        session(['label_font' => $request->label_font]);
        session(['frame_label' => $request->frame_label ? $request->frame_label : 'Scan Me']);
        session(['markers_color' => $request->markers_color ? true : false]);
        session(['gradient' => $request->gradient ? true : false]);
        session(['no_logo_bg' => $request->no_logo_bg ? true : false]);
        session(['transparent_code' => $request->transparent_code ? true : false]);
    }

    /**
     * @param $request
     * @param $type
     */
    protected function createByType($request, $type)
    {
        switch ($type) {
            case 'expiry-management':
                return createQrCodes($request->quantity, $request) == true ? true : abort(500);
                break;
            case 'link':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                $qrcode->link_data = $request->link_data;
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'email':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // Type fields
                $qrcode->email = $request->email;
                $qrcode->subject = $request->subject;
                $qrcode->message = $request->message;
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'text':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // Type fields
                $qrcode->text_data = $request->text_data;
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'call':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // Type fields
                $qrcode->country_code = $request->country_code;
                $qrcode->phone_number = $request->phone_number;
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'sms':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // Type fields
                $qrcode->sms_country_code = $request->sms_country_code;
                $qrcode->sms_phone_number = $request->sms_phone_number;
                $qrcode->sms_message = $request->sms_message;
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'vcard':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // Type fields
                $qrcode->vcard_fname = $request->vcard_fname;
                $qrcode->vcard_lname = $request->vcard_lname;
                $qrcode->vcard_phone_number = $request->vcard_phone_number;
                $qrcode->vcard_mobile = $request->vcard_mobile;
                $qrcode->vcard_email = $request->vcard_email;
                $qrcode->vcard_web_url = $request->vcard_web_url;
                $qrcode->vcard_company = $request->vcard_company;
                $qrcode->vcard_job_title = $request->vcard_job_title;
                $qrcode->vcard_fax = $request->vcard_fax;
                $qrcode->vcard_address = $request->vcard_address;
                $qrcode->vcard_city = $request->vcard_city;
                $qrcode->vcard_post_code = $request->vcard_post_code;
                $qrcode->vcard_country = $request->vcard_country;
                if ($request->hasFile('vimage')) {
                    $image = $request->file('vimage');
                    $filename = saveImage($image, 'vimage');
                    $qrcode->vimage = $filename;
                }
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'whatsapp':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // Type fields
                $qrcode->whatsapp_country_code = $request->whatsapp_country_code;
                $qrcode->whatsapp_phone_number = $request->whatsapp_phone_number;
                $qrcode->whatsapp_message = $request->whatsapp_message;
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'wifi':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // Type fields
                $qrcode->network_name = $request->network_name;
                $qrcode->network_type = $request->network_type;
                $qrcode->network_password = $request->network_password;
                $qrcode->wifi_hidden = $request->wifi_hidden ? true : false;
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'pdf':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                $qrcode->pdf = saveImage($request->pdf, 'pdfs');
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'social_link':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // Type fields
                $qrcode->social_name = $request->name;
                $links = array_map(function ($link) {
                    return [
                        'title' => $link['name'] ?? null,
                        'link' => $link['url'] ?? null,
                        'icon' => $link['socialImg'] ?? null,
                        'img' => $link['img'] ?? null,
                    ];
                }, $request->links ?? []);

                $qrcode->social_medias = json_encode($links ?? []);
                $qrcode->social_title = $request->logoSize;
                $qrcode->social_website = $request->font;
                $qrcode->social_color = $request->color;
                $qrcode->social_email = $request->email;
                $qrcode->social_phone = $request->phone;

                if ($request->logo) {
                    $qrcode->social_profile_picture = base64_upload($request->logo);
                }
                if($request->banner){
                    $qrcode->social_banner = base64_upload($request->banner);
                }
                $qrcode->subdomain = Helper::createSubdomain($request->url ?? $request->name);
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'video':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // Type fields
                $qrcode->video = saveImage($request->video, 'videos');
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'images':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // Type fields
                $images_names = [];
                foreach ($request->images as $image) {
                    $filename = saveImage($image, 'qrcode_images');
                    $images_names[] = $filename;
                }
                $qrcode->images = implode(',', $images_names);
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;


            case 'app':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // Type fields
                $qrcode->app_store_link = $request->app_store;
                $qrcode->google_play_store = $request->google_play_store;
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;

            case 'event':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                $check = false;
                $data = [];
                foreach ($request->all() as $key => $value) {
                    if ($key == 'type') {
                        $check = true;
                    }
                    if ($check) {
                        break;
                    }
                    $data[$key] = $value;
                }
                if ($request->logo) {
                    $data['logo'] = base64_upload($request->logo, 'event');
                }
                if ($request->banner) {
                    $data['banner'] = base64_upload($request->banner, 'event');
                }
                unset($data['url']);
                $qrcode->event_infos = json_encode($data);
                $qrcode->subdomain = Helper::createSubdomain($request->url ?? $request->name);
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;

            case 'poll':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                $pollType = $request->pollType;
                $name = $request->name;
                $logoSize = $request->logoSize;
                $businessInstruction = $request->businessInstruction;
                $color = $request->color;
                $font = $request->font;
                $pollQuestions = $request->pollQuestions;
                $formQuestions = $request->formQuestions;
                $quizQuestions = $request->quizQuestions;
                if ($request->logo) {
                    $logo = base64_upload($request->logo, 'poll');
                }
                if ($request->banner) {
                    $banner = base64_upload($request->banner, 'poll');
                }
                $data = [
                    'pollType' => $pollType,
                    'name' => $name,
                    'logoSize' => $logoSize,
                    'businessInstruction' => $businessInstruction,
                    'color' => $color,
                    'font' => $font,
                    'pollQuestions' => $pollQuestions,
                    'formQuestions' => $formQuestions,
                    'quizQuestions' => $quizQuestions,
                    'logo' => $logo ?? null,
                    'banner' => $banner ?? null,
                ];
                $qrcode->poll = json_encode($data);
                $qrcode->subdomain = Helper::createSubdomain($request->url ?? $request->name, $qrcode->id);
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);

                break;

        }
    }

    /**
     * @param $qrcode
     * @param $request
     */
    protected function setQrcodeBasics($qrcode, $request)
    {
        $qrcode->bg_color = $request->bg_color;
        $qrcode->frontcolor = $request->frontcolor;
        $qrcode->marker_out_color = $request->marker_out_color;
        $qrcode->marker_in_color = $request->marker_in_color;
        $qrcode->gradient_color = $request->gradient_color;
        $qrcode->framecolor = $request->framecolor;
        $qrcode->pattern = $request->pattern;
        $qrcode->marker_out = $request->marker_out;
        $qrcode->marker_in = $request->marker_in;
        $qrcode->optionlogo = $request->optionlogo;
        $qrcode->optionbackground = $request->optionbackground;
        $qrcode->outer_frame = $request->outer_frame;
        $qrcode->label_font = $request->label_font;
        $qrcode->frame_label = $request->frame_label ? $request->frame_label : 'Scan Me';
        $qrcode->markers_color = $request->markers_color ? true : false;
        $qrcode->gradient = $request->gradient ? true : false;
        $qrcode->no_logo_bg = $request->no_logo_bg ? true : false;
        $qrcode->transparent_code = $request->transparent_code ? true : false;

        $qrcode->folder_id = $request->folder_id ? $request->folder_id : null;
        $qrcode->user_id = auth()->user()->id;
        $qrcode->qrcode = getHash();

        $qrcode->type = $request->type;
        // $qrcode->status = $request->status ? true : false;
        $qrcode->status =   true;
        $qrcode->main_title = ucfirst($request->type);
        $qrcode->is_dynamic = $request->is_dynamic ? true : false;
        if (isPureDynamic($request->type)) {
            $qrcode->is_dynamic = true;
        }
        if ($request->optionbackground == 'background') {
            $qrcode->bg_image = saveImage($request->bg_image, 'bg_images');
        }

        // if (!isPureDynamic($request->type) && !empty($request->static)) {
        //     $qrcode->is_dynamic = false;
        // }
        if ($request->optionlogo == 'custom_image') {
            $request->validate([
                'custom_logo' => 'required|image',
            ]);
            $qrcode->custom_logo = saveImage($request->custom_logo, 'qrcodes');
        }
    }

    /**
     * @param $request
     */
    protected function qrCodeStylingValidation($request)
    {
        if ($request->optionbackground == 'background') {
            $request->validate([
                'bg_image' => 'image',
            ]);
        }



        $request->validate([

            //    Colors
            'bg_color'         => [
                'required',
                'regex:/^#([a-f0-9]{6})$/i',
            ],
            'frontcolor'       => [
                'required',
                'regex:/^#([a-f0-9]{6})$/i',
            ],
            'marker_out_color' => [
                'required',
                'regex:/^#([a-f0-9]{6})$/i',
            ],
            'marker_in_color'  => [
                'required',
                'regex:/^#([a-f0-9]{6})$/i',
            ],
            'gradient_color'   => [
                'required',
                'regex:/^#([a-f0-9]{6})$/i',
            ],
            'framecolor'       => [
                'required',
                'regex:/^#([a-f0-9]{6})$/i',
            ],

            // Radios
            'pattern'          => [
                'required',
                'in:default,flurry,sdoz,drop_in,drop,dropeye,circle,dot,rounded,sun,star,diamond,sparkle,danger,cross,plus,x,heart,shake,blob,special-circle-orizz,special-circle-vert,special-circle,special-diamond,ribbon,oriental,ellipse,vortex,sparkle_dot,9-dots,9-dots-fat,flower,elastic,diagonal,ropes,ropes-vert,bruised',
            ],
            'marker_out'       => [
                'required',
                'in:default,flurry,sdoz,drop_in,drop,dropeye,dropeyeleft,dropeyeleaf,dropeyeright,squarecircle,circle,rounded,flower,flower_in,leaf,3-corners,vortex,dots,bruised,canvas',
            ],
            'marker_in'        => [
                'required',
                'in:default,flurry,sdoz,drop_in,drop,dropeye,circle,dot,rounded,sun,star,diamond,sparkle,danger,cross,plus,x,heart,shake,blob,special-circle-orizz,special-circle-vert,special-circle,special-diamond,ribbon,oriental,ellipse,vortex,sparkle_dot,9-dots,9-dots-fat,flower,elastic,diagonal,ropes,ropes-vert,bruised',
            ],
            'optionlogo'       => [
                'required',
                'in:none,scan-me.svg,youtube.svg,instagram.svg,twitter.svg,whatsapp.svg,messenger.svg,facebook.svg,custom_image',
            ],
            // 'optionbackground' => [
            //     'nullable',
            //     'in:none,bg-1.png,bg-2.png,bg-3.png,background',
            // ],
            'optionbackground' => [
                'nullable'
            ],
            'outer_frame'      => [
                'required',
                'in:none,bottom,top,balloon-bottom,balloon-top,ribbon-bottom,ribbon-top,phone,cine',
            ],
            'label_font'       => [
                'required',
                'in:AbrilFatface.svg,Arial.svg,CormorantGaramond.svg,FredokaOne.svg,Galindo.svg,OleoScript.svg,PlayfairDisplay.svg,Shrikhand.svg,ZCOOLKuaiLe-Regular.svg',
            ],

            // Others
            'custom_logo'      => [
                'nullable',
                'image',
            ],
            'frame_label'       => [
                'nullable',
                'string',
                'max:50',
            ],


        ]);
    }

    /**
     * @param $request
     * @param $type
     */
    protected function validateByType($request, $type)
    {
        switch ($type) {
            case 'expiry-management':
                $request->validate([
                    'quantity' => 'required|integer|min:1|max:100',
                ]);
                break;
            case 'link':
                $request->validate([
                    'link_data' => [
                        'required',
                        'string',
                        'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i',
                    ],
                ]);
                break;
            case 'email':
                $request->validate([
                    'email'   => 'required|email',
                    'subject' => 'required|string',
                    'message' => 'required|string',
                ]);
                break;
            case 'text':
                $request->validate([
                    'text_data' => 'required|string',
                ]);
                break;
            case 'call':
                $request->validate([
                    'country_code' => [
                        'nullable',
                        'in:213,376,244,1264,1268,54,374,297,61,43,994,1242,973,880,1246,375,32,501,229,1441,975,591,387,267,55,673,359,226,257,855,237,1,238,1345,236,56,86,57,269,242,682,506,385,53,90392,357,42,45,253,1809,1809,593,20,503,240,291,372,251,500,298,679,358,33,594,689,241,220,7880,49,233,350,30,299,1473,590,671,502,224,245,592,509,504,852,36,354,91,62,98,964,353,39,1876,81,962,7,254,686,850,82,965,996,856,371,961,266,231,218,417,370,352,853,389,261,265,60,960,223,356,692,596,222,269,52,691,373,377,976,1664,212,258,95,264,674,977,31,687,64,505,227,234,683,672,670,47,968,680,507,675,595,51,63,48,351,1787,974,262,40,7,250,378,239,966,221,381,248,232,65,421,386,677,252,27,34,94,290,1869,1758,249,597,268,46,41,963,886,7,66,228,676,1868,216,90,7,993,1649,688,256,44,380,971,598,1,7,678,379,58,84,84,84,681,969,967,260,263',
                    ],
                    'phone_number' => [
                        'required',
                    ],
                ]);
                break;
            case 'sms':
                $request->validate([
                    'sms_country_code' => [
                        'nullable',
                        'in:213,376,244,1264,1268,54,374,297,61,43,994,1242,973,880,1246,375,32,501,229,1441,975,591,387,267,55,673,359,226,257,855,237,1,238,1345,236,56,86,57,269,242,682,506,385,53,90392,357,42,45,253,1809,1809,593,20,503,240,291,372,251,500,298,679,358,33,594,689,241,220,7880,49,233,350,30,299,1473,590,671,502,224,245,592,509,504,852,36,354,91,62,98,964,353,39,1876,81,962,7,254,686,850,82,965,996,856,371,961,266,231,218,417,370,352,853,389,261,265,60,960,223,356,692,596,222,269,52,691,373,377,976,1664,212,258,95,264,674,977,31,687,64,505,227,234,683,672,670,47,968,680,507,675,595,51,63,48,351,1787,974,262,40,7,250,378,239,966,221,381,248,232,65,421,386,677,252,27,34,94,290,1869,1758,249,597,268,46,41,963,886,7,66,228,676,1868,216,90,7,993,1649,688,256,44,380,971,598,1,7,678,379,58,84,84,84,681,969,967,260,263',
                    ],
                    'sms_phone_number' => [
                        'required',
                    ],
                    'sms_message'      => [
                        'required',
                        'string',
                    ],
                ]);
                break;
            case 'vcard':
                $request->validate([
                    'vcard_fname'        => [
                        'required',
                        'string',
                    ],
                    'vcard_lname'        => [
                        'required',
                        'string',
                    ],
                    'vcard_phone_number' => [
                        'nullable',
                    ],
                    'vcard_mobile'       => [
                        'nullable',
                        'string',
                    ],
                    'vcard_email'        => [
                        'nullable',
                        'email',
                    ],
                    'vcard_web_url'      => [
                        'nullable',
                        'string',
                    ],
                    'vcard_company'      => [
                        'nullable',
                        'string',
                    ],
                    'vcard_job_title'    => [
                        'nullable',
                        'string',
                    ],
                    'vcard_fax'          => [
                        'nullable',
                        'string',
                    ],
                    'vcard_address'      => [
                        'nullable',
                        'string',
                    ],
                    'vcard_city'         => [
                        'nullable',
                        'string',
                    ],
                    'vcard_post_code'    => [
                        'nullable',
                        'string',
                    ],
                    'vcard_country'      => [
                        'nullable',
                        'string',
                    ],
                    'vimage'             => [
                        'nullable',
                        'image',
                    ],
                ]);
                break;
            case 'whatsapp':
                $request->validate([
                    'whatsapp_country_code' => [
                        'nullable',
                        'in:213,376,244,1264,1268,54,374,297,61,43,994,1242,973,880,1246,375,32,501,229,1441,975,591,387,267,55,673,359,226,257,855,237,1,238,1345,236,56,86,57,269,242,682,506,385,53,90392,357,42,45,253,1809,1809,593,20,503,240,291,372,251,500,298,679,358,33,594,689,241,220,7880,49,233,350,30,299,1473,590,671,502,224,245,592,509,504,852,36,354,91,62,98,964,353,39,1876,81,962,7,254,686,850,82,965,996,856,371,961,266,231,218,417,370,352,853,389,261,265,60,960,223,356,692,596,222,269,52,691,373,377,976,1664,212,258,95,264,674,977,31,687,64,505,227,234,683,672,670,47,968,680,507,675,595,51,63,48,351,1787,974,262,40,7,250,378,239,966,221,381,248,232,65,421,386,677,252,27,34,94,290,1869,1758,249,597,268,46,41,963,886,7,66,228,676,1868,216,90,7,993,1649,688,256,44,380,971,598,1,7,678,379,58,84,84,84,681,969,967,260,263',
                    ],
                    'whatsapp_phone_number' => [
                        'required',
                    ],
                    'whatsapp_message'      => [
                        'required',
                        'string',
                    ],
                ]);
                break;
            case 'wifi':
                $request->validate([
                    'network_name'     => [
                        'required',
                        'string',
                    ],
                    'network_type'     => [
                        'required',
                        'in:WEP,WPA/WPA2',
                    ],
                    'network_password' => [
                        'nullable',
                        'string',
                    ],
                ]);
                break;
            case 'video':
                $request->validate([
                    'video' => [
                        'required',
                        'mimes:mp4,avi,flv,mov,wmv,3gp,mkv,ogv,webm',
                        'max:100000',
                    ],
                ]);
                break;
            case 'pdf':
                $request->validate([
                    'pdf' => [
                        'required',
                        'mimes:pdf',
                        'max:10000',
                    ],
                ]);
                break;
            case 'images':
                $request->validate([
                    'images.*' => [
                        'required',
                        'mimes:png,jpg,svg,gif',
                    ],
                ]);
                break;
            case 'social_link':
                // $request->validate([
                //     //titles
                //     'social_facebook_link_title'  => [
                //         'nullable',
                //         'string',
                //         'max:255',
                //     ],
                //     'social_twitter_link_title'   => [
                //         'nullable',
                //         'string',
                //         'max:255',
                //     ],
                //     'social_instagram_link_title' => [
                //         'nullable',
                //         'string',
                //         'max:255',
                //     ],
                //     'social_linkedin_link_title'  => [
                //         'nullable',
                //         'string',
                //         'max:255',
                //     ],
                //     'social_pinterest_link_title' => [
                //         'nullable',
                //         'string',
                //         'max:255',
                //     ],
                //     'social_youtube_link_title'   => [
                //         'nullable',
                //         'string',
                //         'max:255',
                //     ],
                //     'social_snapchat_link_title'  => [
                //         'nullable',
                //         'string',
                //         'max:255',
                //     ],
                //     'social_reddit_link_title'    => [
                //         'nullable',
                //         'string',
                //         'max:255',
                //     ],
                //     // links
                //     'social_facebook_link'        => [
                //         'nullable',
                //         'string',
                //         'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                //     ],
                //     'social_twitter_link'         => [
                //         'nullable',
                //         'string',
                //         'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                //     ],
                //     'social_instagram_link'       => [
                //         'nullable',
                //         'string',
                //         'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                //     ],
                //     'social_linkedin_link'        => [
                //         'nullable',
                //         'string',
                //         'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                //     ],
                //     'social_pinterest_link'       => [
                //         'nullable',
                //         'string',
                //         'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                //     ],
                //     'social_youtube_link'         => [
                //         'nullable',
                //         'string',
                //         'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                //     ],
                //     'social_snapchat_link'        => [
                //         'nullable',
                //         'string',
                //         'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                //     ],
                //     'social_reddit_link'          => [
                //         'nullable',
                //         'string',
                //         'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                //     ],
                //     // others
                //     'social_bg_color'             => [
                //         'required',
                //         'string',
                //         'regex:/^#([a-f0-9]{6})$/i',
                //     ],
                //     'social_logo'                 => [
                //         'nullable',
                //         'image',
                //     ],
                // ]);
                break;
        }
    }

    public function createBySessions()
    {
        $request = convertSessionsToObject();

        // return $request;
        // dd($request);

        if (!$request) {
            return false;
        }


        if ($request->is_dynamic == true) {
            if (subscribe_check()['status'] == 'subscribe') {
                if (Auth::user()->qrcodes()->where('is_dynamic', true)->count() >= subscribe_check()['dynamic_qr_codes']) {
                    return response()->json(['error' => 'You have reached the limit of creating qrcodes. Please upgrade your plan to create more qrcodes.', 'code' => 200]);
                }
            } elseif (subscribe_check()['status'] == 'trial') {
                if (Auth::user()->qrcodes()->where('is_dynamic', true)->count() >= subscribe_check()['dynamic_qr_codes']) {
                    return response()->json(['error' => 'You have reached the limit of creating qrcodes. Please upgrade your plan to create more qrcodes.', 'code' => 200]);
                }
            } elseif (subscribe_check()['status'] == 'expired') {
                return response()->json(['error' => 'Your subscription has been expired. Please upgrade your plan to create more qrcodes.', 'code' => 200]);
            }
        }


        switch ($request->type) {
            case 'expiry-management':
                return createQrCodes($request->quantity, $request) == true ? true : abort(500);
                break;
            case 'link':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // Type fields
                $qrcode->link_data = $request->link_data;
                // dd($request->link_data);
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'email':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // Type fields
                $qrcode->email = $request->email;
                $qrcode->subject = $request->subject;
                $qrcode->message = $request->message;
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'text':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // Type fields
                $qrcode->text_data = $request->text_data;
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'call':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // Type fields
                $qrcode->country_code = $request->country_code;
                $qrcode->phone_number = $request->phone_number;
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'sms':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // Type fields
                $qrcode->sms_country_code = $request->sms_country_code;
                $qrcode->sms_phone_number = $request->sms_phone_number;
                $qrcode->sms_message = $request->sms_message;
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'vcard':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // Type fields
                $qrcode->vcard_fname = $request->vcard_fname;
                $qrcode->vcard_lname = $request->vcard_lname;
                $qrcode->vcard_phone_number = $request->vcard_phone_number;
                $qrcode->vcard_mobile = $request->vcard_mobile;
                $qrcode->vcard_email = $request->vcard_email;
                $qrcode->vcard_web_url = $request->vcard_web_url;
                $qrcode->vcard_company = $request->vcard_company;
                $qrcode->vcard_job_title = $request->vcard_job_title;
                $qrcode->vcard_fax = $request->vcard_fax;
                $qrcode->vcard_address = $request->vcard_address;
                $qrcode->vcard_city = $request->vcard_city;
                $qrcode->vcard_post_code = $request->vcard_post_code;
                $qrcode->vcard_country = $request->vcard_country;

                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'whatsapp':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // Type fields
                $qrcode->whatsapp_country_code = $request->whatsapp_country_code;
                $qrcode->whatsapp_phone_number = $request->whatsapp_phone_number;
                $qrcode->whatsapp_message = $request->whatsapp_message;
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'wifi':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // Type fields
                $qrcode->network_name = $request->network_name;
                $qrcode->network_type = $request->network_type;
                $qrcode->network_password = $request->network_password;
                $qrcode->wifi_hidden = $request->wifi_hidden ? true : false;
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'pdf':
                // dd($request->all());
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                $path = public_path('storage/temp/' . $request->pdf);
                if (file_exists($path)) {
                    Storage::move('public/temp/' . $request->pdf, 'public/pdfs/' . $request->pdf);
                    $qrcode->pdf = $request->pdf;
                }
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'social_link':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                $qrcode->social_name = $request->name;
                $links = array_map(function ($link) {
                    return [
                        'title' => $link['name'] ?? null,
                        'link' => $link['url'] ?? null,
                        'icon' => $link['socialImg'] ?? null,
                        'img' => $link['img'] ?? null,
                    ];
                }, $request->links ?? []);

                $qrcode->social_medias = json_encode($links ?? []);
                $qrcode->social_title = $request->logoSize;
                $qrcode->social_website = $request->font;
                $qrcode->social_color = $request->color;
                $qrcode->social_email = $request->email;
                $qrcode->social_phone = $request->phone;

                if ($request->logo) {
                    $qrcode->social_profile_picture = base64_upload($request->logo);
                }
                if($request->banner){
                    $qrcode->social_banner = base64_upload($request->banner);
                }
                $qrcode->subdomain = Helper::createSubdomain($request->url ?? $request->name);
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'video':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // file exists
                $path = public_path('storage/temp/' . $request->video);
                if (file_exists($path)) {
                    Storage::move('public/temp/' . $request->video, 'public/videos/' . $request->video);
                    $qrcode->video = $request->video;
                }
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'images':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                // Type fields
                $images_names = [];
                foreach ($request->images as $image) {
                    $filename = saveImage($image, 'qrcode_images');
                    $images_names[] = $filename;
                }
                $qrcode->images = implode(',', $images_names);
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
            case 'event':
                $qrcode = new Qrcode();
                $this->setQrcodeBasics($qrcode, $request);
                $data = [
                    'formIdx' => $request->formIdx,
                    'event' => $request->event,
                    'invitees' => $request->invitees,
                    'name' => $request->name,
                    'url' => $request->url,
                    'logo' => $request->logo,
                    'logoSize' => $request->logoSize,
                    'banner' => $request->banner,
                    'color' => $request->color,
                    'font' => $request->font,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'profileImg' => $request->profileImg,
                    'type' => $request->type,
                ];


                if ($request->logo) {
                    $data['logo'] = base64_upload($request->logo, 'event');
                }
                if ($request->banner) {
                    $data['banner'] = base64_upload($request->banner, 'event');
                }
                unset($data['url']);
                $qrcode->event_infos = json_encode($data);
                $qrcode->subdomain = Helper::createSubdomain($request->url ?? $request->name);
                if ($qrcode->save()) {
                    return 'Successfull';
                }
                abort(500);
                break;
        }
    }
}
