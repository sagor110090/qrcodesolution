<?php

namespace App\Helpers;

use App\Http\Qrcdr\QRcdr;
use App\Models\QrCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Storage;
use JeroenDesloovere\VCard\VCard;


require dirname(dirname(__FILE__)) . '/Http/qrcdr/lib/functions.php';
require dirname(dirname(__FILE__)) . '/Http/qrcdr/lib/phpqrcode.php';
require dirname(dirname(__FILE__)) . '/Http/qrcdr/lib/class-qrcdr.php';

class Support extends Facade
{

    //type of qr code
    public static function onlyDynamic($type)
    {

        $types = [
            'event',
            'social_media',
            'image',
            'video',
            'audio',
        ];
        if (in_array($type, $types)) {
            return true;
        }
        return false;
    }


    public static function bytesToHuman($size, $precision = 2)
    {
        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        } else {
            return $size;
        }
    }

    public static function qrCodeGenerate($options)
    {

        $data = $options['data'] ?? '';
        $qr_style = $options['qr_style'] ?? '';
        $qr_logo = $options['qr_logo'] ?? '';
        $qr_color = $options['qr_color'] ?? '';
        $qr_bg_color = $options['qr_bg_color'] ?? '';
        $qr_eye_border = $options['qr_eye_border'] ?? '';
        $qr_eye_center = $options['qr_eye_center'] ?? '';
        $qr_gradient = $options['qr_gradient'] ?? '';
        $qr_eye_color_in = $options['qr_eye_color_in'] ?? '';
        $qr_eye_color_out = $options['qr_eye_color_out'] ?? '';
        $qr_eye_style_in = $options['qr_eye_style_in'] ?? '';
        $qr_eye_style_out = $options['qr_eye_style_out'] ?? '';
        $qr_logo_background = $options['qr_logo_background'] ?? '';
        $qr_bg_image = $options['qr_bg_image'] ?? '';
        $qr_custom_logo = $options['qr_custom_logo'] ?? '';
        $qr_custom_background = $options['qr_custom_background'] ?? '';
        $frame = $options['frame'] ?? '';
        $frame_label = $options['frame_label'] ?? '';
        $frame_label_font = $options['frame_label_font'] ?? '';
        $frame_label_text_color = $options['frame_label_text_color'] ?? '';

        require dirname(dirname(__FILE__)) . '/Http/qrcdr/lib/frames.php';






        $outdir = qrcdr()->getConfig('qrcodes_dir');
        $PNG_TEMP_DIR = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . $outdir . DIRECTORY_SEPARATOR;




        $words = explode(' ', $frame_label);

        $frame_label = self::buildFrameLabel($words);



        $optionstyle = [
            'optionlogo'                 => $qr_custom_logo ? $qr_custom_logo : $qr_logo,
            'pattern'                    => $qr_style,
            'marker_out'                 => $qr_eye_border,
            'marker_in'                  => $qr_eye_center,
            'marker_out_color'           => $qr_eye_color_out,
            'marker_in_color'            => $qr_eye_color_in,
            'marker_top_right_outline'   => $qr_eye_style_out,
            'marker_top_right_center'    => $qr_eye_style_in,
            'marker_bottom_left_outline' => $qr_eye_style_out,
            'marker_bottom_left_center'  => $qr_eye_style_in,
            'gradient'                   => $qr_gradient ? true : false,
            'gradient_color'             => $qr_gradient,
            'markers_color'              => $qr_color,
            'radial'                     => '',
            'no_logo_bg'                 => $qr_logo_background ? false : true,
            'frame'                      => $frame ?? 'none',
            'custom_frame_color'         => false,
            'framecolor'                 => $qr_bg_color,
            'frame_label'                 => $frame_label,
            'label_font'                 => $frame_label_font,
            'labeltext_color'            => $frame_label_text_color,
            'logo_size'                  => '100',
            'label_text_size'            => '100',
            'transparent_code'           => false,
            'bg_image'                   => $qr_custom_background ? $qr_custom_background : $qr_bg_image,
            'negative'                   => false,
        ];


        $stringBackColor = $qr_bg_color;
        $stringFrontColor = $qr_color;
        $backColor = qrcdr()->hexdecColor($stringBackColor, '#FFFFFF');
        $frontColor = qrcdr()->hexdecColor($stringFrontColor, '#000000');

        $level = 'Q';
        if (in_array($level, ['L', 'M', 'Q', 'H'])) {
            $errorCorrectionLevel = $level;
            if ($errorCorrectionLevel == 'H') {
                $errorCorrectionLevel = 'H';
            }
        }

        $size = 24;
        $size = $size ? $size : 16;
        $matrixPointSize = min(max((int) $size, 4), 32);

        $backColor = qrcdr()->hexdecColor($stringBackColor, '#FFFFFF');
        $filename = $PNG_TEMP_DIR . 'qrcode_' . uniqid() . '.png';
        $filenamesvg = $filename . '.svg';

        $codemargin = $frame !== 'none' ? $frames[$frame]['frame_border'] * 2 + 1 : 2;
        $content = QRcdr::svg($data, $filenamesvg, $errorCorrectionLevel, $matrixPointSize, $codemargin, false, $backColor, $frontColor, $optionstyle);

        return $content;
    }

    //hash code create
    public static function hashCode($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $hash = '';
        for ($i = 0; $i < $length; $i++) {
            $hash .= $characters[rand(0, $charactersLength - 1)];
        }
        return $hash;
    }


    public static function createQrCode($data)
    {
        auth()->user()->qrCodes()->create($data);
        return true;
    }



    public static function buildFrameLabel($words)
    {
        $frame_label = '';
        $rearrange = [];
        $start_ltr = false;
        $start_rtl = false;
        $rtl_counter = 0;
        $ltr_counter = 0;
        $thecounter = 0;

        foreach ($words as $key => $word) {
            $new_word = qrcdr()->reverseString($word);
            if (self::isRtl($word)) {
                // reverse word
                $new_word = qrcdr()->reverseString($word);
                if (!$start_rtl) {
                    $rtl_counter++;
                    $thecounter++;
                    $rearrange[$thecounter . '_rtl'] = [];
                }
                $start_ltr = false;
                $start_rtl = true;
                $rearrange[$thecounter . '_rtl'][] = $new_word;
            } else {
                $new_word = $word;
                if (!$start_ltr) {
                    $ltr_counter++;
                    $thecounter++;
                    $rearrange[$thecounter . '_ltr'] = [];
                }
                $start_ltr = true;
                $start_rtl = false;
                $rearrange[$thecounter . '_ltr'][] = $new_word;
            }
        }

        $rearrangeverse = $rearrange;
        if ($ltr_counter > 0 && $rtl_counter > $ltr_counter) {
            $rearrangeverse = array_reverse($rearrange);
        }

        foreach ($rearrangeverse as $key => $value) {
            $direction = substr($key, -3);
            if ($direction == 'rtl') {
                $frame_label .= implode(' ', array_reverse($value)) . ' ';
            } else {
                $frame_label .= implode(' ', $value) . ' ';
            }
        }
        $frame_label = trim($frame_label);

        return $frame_label;
    }


    public static function isRtl($value)
    {
        $rtlChar = '/[\x{0590}-\x{083F}]|[\x{08A0}-\x{08FF}]|[\x{FB1D}-\x{FDFF}]|[\x{FE70}-\x{FEFF}]/u';

        return preg_match($rtlChar, $value) != 0;
    }






    //read folder and return array of files
    public static function readFolder($path)
    {
        $files = array();
        $dir = opendir($path);
        while ($file = readdir($dir)) {
            if ($file != '.' && $file != '..') {
                $files[] = $file;
            }
        }
        closedir($dir);
        return $files;
    }

    //20 color qr_color
    public static function twentyColor()
    {
        return [
            '#000000',
            '#ffffff',
            '#ff0000',
            '#00ff00',
            '#0000ff',
            '#ffff00',
            '#00ffff',
            '#ff00ff',
            '#c0c0c0',
            '#808080',
            '#800000',
            '#808000',
            '#008000',
            '#800080',
            '#008080',
            '#000080',
            '#808040',
            '#804000',
            '#408000',
            '#004040',
        ];
    }

    //frame label font
    public static function frame_label_fonts()
    {
        return [
            'AbrilFatface.svg',
            'Arial.svg',
            'CormorantGaramond.svg',
            'FredokaOne.svg',
            'Galindo.svg',
            'OleoScript.svg',
            'PlayfairDisplay.svg',
            'Shrikhand.svg',
            'ZCOOLKuaiLe-Regular.svg',

        ];
    }

    //color hex to rgb
    public static function hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex)[0];
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = $r . ',' . $g . ',' . $b;
        return $rgb;
    }

    //static qr code data generate
    public static function staticQrCodeDataGenerate($type, $data)
    {


        $url = $data['url'] ?? '';
        $email = $data['email'] ?? '';
        $subject = $data['subject'] ?? '';
        $message = $data['message'] ?? '';
        $sms_phone = $data['sms_phone'] ?? '';
        $sms = $data['sms'] ?? '';
        $call_phone = $data['call_phone'] ?? '';
        $text_data = $data['text_data'] ?? '';
        $bitcoin_address = $data['bitcoin_address'] ?? '';
        $bitcoin_amount = $data['bitcoin_amount'] ?? '';
        $network_name = $data['network_name'] ?? '';
        $network_password = $data['network_password'] ?? '';
        $network_type = $data['network_type'] ?? '';
        $wifi_hidden = $data['wifi_hidden'] ?? '';
        $latitude = $data['latitude'] ?? '';
        $longitude = $data['longitude'] ?? '';



        if ($type == 'url') {
            $data = $url;
        } elseif ($type == 'email') {
            $data =  'mailto:' . $email . '?subject=' . $subject . '&body=' . rawurlencode($message);
        } elseif ($type == 'sms') {
            $number = str_replace(' ', '', $sms_phone);

            if ($number) {
                $number = str_replace('+', '00', $number);
                $data = 'SMSTO:' . $number . ':' . rawurlencode($sms);
            }
        } elseif ($type == 'phone') {
            $number = str_replace(' ', '', $call_phone);

            if ($number) {
                $number = str_replace('+', '00', $number);
                $data = 'tel:' . $number;
            }
        } elseif ($type == 'wifi') {
            $ssid = $network_name;
            $wifipass = $network_password;
            $networktype = $network_type ? $network_type : 'WPA';
            $wifihidden = $wifi_hidden == 'yes';
            if ($ssid) {
                $output_data = 'WIFI:S:' . $ssid . ';';
                if ($networktype) {
                    $output_data .= 'T:' . $networktype . ';';
                }
                if ($wifipass) {
                    $output_data .= 'P:' . $wifipass . ';';
                }
                if ($wifihidden) {
                    $output_data .= 'H:true;';
                }
                $output_data .= ';';
                $data = $output_data;
            }
        } elseif ($type == 'text') {
            $data = $text_data;
        } elseif ($type == 'bitcoin') {
            $data = 'bitcoin:' . $bitcoin_address . '?amount=' . $bitcoin_amount;
        } elseif ($type == 'location') {
            $data = 'geo:' . $latitude . ',' . $longitude;
        } elseif ($type == 'vcard') {
             $data = 'BEGIN:VCARD' . "\n". 'VERSION:3.0' . "\n". 'N:' . $data['vcard_last_name'] . ';' . $data['vcard_first_name'] . "\n". 'FN:' . $data['vcard_first_name'] . ' ' . $data['vcard_last_name'] . "\n". 'ORG:' . $data['vcard_company'] . "\n". 'TITLE:' . $data['vcard_job_title'] . "\n". 'TEL;TYPE=work,voice;VALUE=uri:tel:' . $data['vcard_phone_number'] . "\n". 'TEL;TYPE=home,voice;VALUE=uri:tel:' . $data['vcard_mobile'] . "\n". 'TEL;TYPE=work,fax;VALUE=uri:tel:' . $data['vcard_fax'] . "\n". 'ADR;TYPE=home;LABEL="' . $data['vcard_address'] . '":;;' . $data['vcard_address'] . ';' . $data['vcard_city'] . ';' . $data['vcard_post_code'] . ';' . $data['vcard_country'] . "\n". 'EMAIL:' . $data['vcard_email'] . "\n". 'URL:' . $data['vcard_website'] . "\n". 'END:VCARD';

        }
        return $data;
    }

    //dynamicQrCodeDataGenerate
    public static function dynamicQrCodeDataGenerate($type, $code)
    {
        return  env('APP_URL') . '/q/' . $code;
    }

    //vCardQrCodeDataGenerate
    public static function vCardQrCodeDataGenerate($data){
        $vcard = new VCard();

        $vcard->addName($data['vcard_last_name'], $data['vcard_first_name']);
        $vcard->addCompany($data['vcard_company']);
        $vcard->addJobtitle($data['vcard_job_title']);
        $vcard->addEmail($data['vcard_email']);
        $vcard->addPhoneNumber($data['vcard_phone_number'], 'PREF;WORK');
        $vcard->addPhoneNumber($data['vcard_mobile'], 'WORK');
        $vcard->addPhoneNumber($data['vcard_fax'], 'WORK');
        $vcard->addAddress(null, null, $data['vcard_address'], $data['vcard_city'], null, $data['vcard_post_code'], $data['vcard_country']);
        $vcard->addURL($data['vcard_website']);


        // $vcard->addPhoto(__DIR__ . '/landscape.jpeg');
        return $vcard->download();

    }



    //event font list
    public static function eventFonts()
    {
        $fonts = [
            [
                'name' => 'Abril Fatface',
            ],
            [
                'name' => 'Arial',
            ],
            [
                'name' => 'Cormorant Garamond',
            ],
            [
                'name' => 'Fredoka One',
            ],
            [
                'name' => 'Galindo',
            ],
            [
                'name' => 'Oleo Script',
            ],
            [
                'name' => 'Playfair Display',
            ],
            [
                'name' => 'Shrikhand',
            ],
            [
                'name' => 'ZCOOL KuaiLe',
            ],
        ];

        return $fonts;
    }

    //basic qrcode data generate
    public static function basicDataForQrCode(){
        $qr_style = "default";
        $qr_logo = '';
        $qr_logo_background = false;
        $qr_color = null;
        $qr_bg_color = '255,255,255';
        $qr_eye_border = 'default';
        $qr_eye_center = 'default';
        $qr_eye_color_in = '';
        $qr_eye_color_out = '';
        $qr_eye_style_in = '';
        $qr_eye_style_out = '';
        $qr_gradient = null;
        $qr_bg_image = '';
        $qr_custom_logo = null;
        $qr_custom_background = null;
        $frame = 'none';
        $frame_label = 'Scan me';
        $frame_label_font = 'AbrilFatface.svg';
        $frame_label_text_color = '#FFFFFF';

        $data = [
            'qr_style' => $qr_style,
            'qr_logo' => $qr_logo,
            'qr_logo_background' => $qr_logo_background,
            'qr_color' => $qr_color,
            'qr_bg_color' => $qr_bg_color,
            'qr_eye_border' => $qr_eye_border,
            'qr_eye_center' => $qr_eye_center,
            'qr_eye_color_in' => $qr_eye_color_in,
            'qr_eye_color_out' => $qr_eye_color_out,
            'qr_eye_style_in' => $qr_eye_style_in,
            'qr_eye_style_out' => $qr_eye_style_out,
            'qr_gradient' => $qr_gradient,
            'qr_bg_image' => $qr_bg_image,
            'qr_custom_logo' => $qr_custom_logo,
            'qr_custom_background' => $qr_custom_background,
            'frame' => $frame,
            'frame_label' => $frame_label,
            'frame_label_font' => $frame_label_font,
            'frame_label_text_color' => $frame_label_text_color,
            'code' => self::hashCode(),
        ];
        return $data;
    }

    //bit 64 to image
    public static function base64_to_jpeg($base64_string, $output_file)
    {
        $ifp = fopen($output_file, "wb");
        $data = explode(',', $base64_string);
        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);
        return $output_file;
    }

    //uploadImage
    public static function uploadImage($image, $disk, $path)
    {
        $base64_to_jpeg = self::base64_to_jpeg($image, $path);
        $imageName = '/' . Str::random(10) . '.png';
        Storage::disk($disk)->put($path . $imageName, file_get_contents($base64_to_jpeg));
        return $disk . '/' . $path . $imageName;
    }

    //session store
    public static function saveRequestData($data)
    {
        session()->put('data', $data);
        return true;
    }

    //get from session
    public static function getFromSession()
    {
        if ($data = session()->get('data')) {
            return $data;
        }
        return false;
    }

    //forgetFromSession
    public static function forgetFromSession()
    {
        session()->forget('data');
        return true;
    }


    //image to base64
    public static function imageToBase64($path)
    {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data =  Storage::url($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }

    public static function hexInvert(string $color):string {
        $color = trim($color);
        $prependHash = false;
        if (strpos($color, '#') !== false) {
            $prependHash = true;
            $color = str_replace('#', '', $color);
        }
        $len = strlen($color);
        if($len==3 || $len==6){
            if($len==3) $color = preg_replace('/(.)(.)(.)/', "\\1\\1\\2\\2\\3\\3", $color);
        } else {
            throw new \Exception("Invalid hex length ($len). Length must be 3 or 6 characters");
        }
        if (!preg_match('/^[a-f0-9]{6}$/i', $color)) {
            throw new \Exception(sprintf('Invalid hex string #%s', htmlspecialchars($color, ENT_QUOTES)));
        }

        $r = dechex(255 - hexdec(substr($color, 0, 2)));
        $r = (strlen($r) > 1) ? $r : '0' . $r;
        $g = dechex(255 - hexdec(substr($color, 2, 2)));
        $g = (strlen($g) > 1) ? $g : '0' . $g;
        $b = dechex(255 - hexdec(substr($color, 4, 2)));
        $b = (strlen($b) > 1) ? $b : '0' . $b;

        return ($prependHash ? '#' : '') . $r . $g . $b;
    }

    // visibleColor
    public static function visibleColor($color)
    {
        $color = trim($color);
        $prependHash = false;
        if (strpos($color, '#') !== false) {
            $prependHash = true;
            $color = str_replace('#', '', $color);
        }
        $len = strlen($color);
        if($len==3 || $len==6){
            if($len==3) $color = preg_replace('/(.)(.)(.)/', "\\1\\1\\2\\2\\3\\3", $color);
        } else {
            throw new \Exception("Invalid hex length ($len). Length must be 3 or 6 characters");
        }
        if (!preg_match('/^[a-f0-9]{6}$/i', $color)) {
            throw new \Exception(sprintf('Invalid hex string #%s', htmlspecialchars($color, ENT_QUOTES)));
        }

        $r = hexdec(substr($color, 0, 2));
        $g = hexdec(substr($color, 2, 2));
        $b = hexdec(substr($color, 4, 2));

        $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;

        return ($yiq >= 128) ? '#000000' : '#ffffff';
    }



}
