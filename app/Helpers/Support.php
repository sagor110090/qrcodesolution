<?php

namespace App\Helpers;

use App\Http\Qrcdr\QRcdr;
use App\Models\QrCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use JeroenDesloovere\VCard\VCard;

require dirname(dirname(__FILE__)).'/Http/qrcdr/lib/functions.php';
require dirname(dirname(__FILE__)).'/Http/qrcdr/lib/phpqrcode.php';
require dirname(dirname(__FILE__)).'/Http/qrcdr/lib/class-qrcdr.php';

class Support extends Facade
{
    //type of qr code
    public static function onlyDynamic($type)
    {

        $types = self::onlyDynamicList();
        if (in_array($type, $types)) {
            return true;
        }

        return false;
    }

    //only dynamic qr code list
    public static function onlyDynamicList()
    {
        return [
            'event',
            'social',
            'image',
            'video',
            'audio',
            'pdf',
        ];
    }

    //dynamic qr code from create page
    public static function dynamicQrCodeFromCreatePage($type)
    {
        $types = [
            'image',
            'video',
            'audio',
            'pdf',
        ];
        if (in_array($type, $types)) {
            return true;
        }

        return false;
    }

    //dynamic qr code from outside create page
    public static function dynamicQrCodeFromOutsideCreatePage($type)
    {
        $types = [
            'event',
            'social',
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
            $suffixes = [' bytes', ' KB', ' MB', ' GB', ' TB'];

            return round(pow(1024, $base - floor($base)), $precision).$suffixes[floor($base)];
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
        $qr_eye_style_in = $options['qr_eye_color_in'] ?? '';
        $qr_eye_style_out = $options['qr_eye_color_out'] ?? '';
        $qr_logo_background = $options['qr_logo_background'] ?? '';
        $qr_bg_image = $options['qr_bg_image'] ?? '';
        $qr_custom_logo = $options['qr_custom_logo'] ?? '';
        $qr_custom_background = $options['qr_custom_background'] ?? '';
        $frame = $options['frame'] ?? '';
        $frame_label = $options['frame_label'] ?? '';
        $frame_label_font = $options['frame_label_font'] ?? '';
        $frame_label_text_color = $options['frame_label_text_color'] ?? '';

        require dirname(dirname(__FILE__)).'/Http/qrcdr/lib/frames.php';

        $outdir = qrcdr()->getConfig('qrcodes_dir');
        $PNG_TEMP_DIR = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.$outdir.DIRECTORY_SEPARATOR;

        $words = explode(' ', $frame_label);

        $frame_label = self::buildFrameLabel($words);

        // dd($qr_eye_style_out);

        $optionstyle = [
            'optionlogo' => $qr_custom_logo ? $qr_custom_logo : $qr_logo,
            'pattern' => $qr_style,
            'marker_out' => $qr_eye_border,
            'marker_in' => $qr_eye_center,
            'marker_out_color' => $qr_eye_color_out,
            'marker_in_color' => $qr_eye_color_in,
            'marker_top_right_outline' => $qr_eye_style_out,
            'marker_top_right_center' => $qr_eye_style_in,
            'marker_bottom_left_outline' => $qr_eye_style_out,
            'marker_bottom_left_center' => $qr_eye_style_in,
            'gradient' => $qr_gradient ? true : false,
            'gradient_color' => $qr_gradient,
            'markers_color' => $qr_color,
            'radial' => '',
            'no_logo_bg' => $qr_logo_background ? false : true,
            'frame' => $frame ?? 'none',
            'custom_frame_color' => false,
            'framecolor' => $qr_bg_color,
            'frame_label' => $frame_label,
            'label_font' => $frame_label_font,
            'labeltext_color' => $frame_label_text_color,
            'logo_size' => '100',
            'label_text_size' => '100',
            'transparent_code' => false,
            'bg_image' => $qr_custom_background ? $qr_custom_background : $qr_bg_image,
            'negative' => false,
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
        $filename = $PNG_TEMP_DIR.'qrcode_'.uniqid().'.png';
        $filenamesvg = $filename.'.svg';

        $codemargin = $frame !== 'none' ? $frames[$frame]['frame_border'] * 2 + 1 : 2;
        $content = QRcdr::svg($data, $filenamesvg, $errorCorrectionLevel, $matrixPointSize, $codemargin, false, $backColor, $frontColor, $optionstyle);

        return $content;
    }

    //hash code create
    public static function hashCode($length = 10)
    {
        return random_int(1000000000, 9999999999);
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
                if (! $start_rtl) {
                    $rtl_counter++;
                    $thecounter++;
                    $rearrange[$thecounter.'_rtl'] = [];
                }
                $start_ltr = false;
                $start_rtl = true;
                $rearrange[$thecounter.'_rtl'][] = $new_word;
            } else {
                $new_word = $word;
                if (! $start_ltr) {
                    $ltr_counter++;
                    $thecounter++;
                    $rearrange[$thecounter.'_ltr'] = [];
                }
                $start_ltr = true;
                $start_rtl = false;
                $rearrange[$thecounter.'_ltr'][] = $new_word;
            }
        }

        $rearrangeverse = $rearrange;
        if ($ltr_counter > 0 && $rtl_counter > $ltr_counter) {
            $rearrangeverse = array_reverse($rearrange);
        }

        foreach ($rearrangeverse as $key => $value) {
            $direction = substr($key, -3);
            if ($direction == 'rtl') {
                $frame_label .= implode(' ', array_reverse($value)).' ';
            } else {
                $frame_label .= implode(' ', $value).' ';
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
        $files = [];
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
        $hex = str_replace('#', '', $hex)[0];
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1).substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1).substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1).substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = $r.','.$g.','.$b;

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
            $data = 'mailto:'.$email.'?subject='.$subject.'&body='.rawurlencode($message);
        } elseif ($type == 'sms') {
            $number = str_replace(' ', '', $sms_phone);

            if ($number) {
                $number = str_replace('+', '00', $number);
                $data = 'SMSTO:'.$number.':'.rawurlencode($sms);
            }
        } elseif ($type == 'phone') {
            $number = str_replace(' ', '', $call_phone);

            if ($number) {
                $number = str_replace('+', '00', $number);
                $data = 'tel:'.$number;
            }
        } elseif ($type == 'wifi') {
            $ssid = $network_name;
            $wifipass = $network_password;
            $networktype = $network_type ? $network_type : 'WPA';
            $wifihidden = $wifi_hidden == 'yes';
            if ($ssid) {
                $output_data = 'WIFI:S:'.$ssid.';';
                if ($networktype) {
                    $output_data .= 'T:'.$networktype.';';
                }
                if ($wifipass) {
                    $output_data .= 'P:'.$wifipass.';';
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
            $data = 'bitcoin:'.$bitcoin_address.'?amount='.$bitcoin_amount;
        } elseif ($type == 'location') {
            $data = 'geo:'.$latitude.','.$longitude;
        } elseif ($type == 'vcard') {
            $data = 'BEGIN:VCARD'."\n".'VERSION:3.0'."\n".'N:'.$data['vcard_last_name'].';'.$data['vcard_first_name']."\n".'FN:'.$data['vcard_first_name'].' '.$data['vcard_last_name']."\n".'ORG:'.$data['vcard_company']."\n".'TITLE:'.$data['vcard_job_title']."\n".'TEL;TYPE=work,voice;VALUE=uri:tel:'.$data['vcard_phone_number']."\n".'TEL;TYPE=home,voice;VALUE=uri:tel:'.$data['vcard_mobile']."\n".'TEL;TYPE=work,fax;VALUE=uri:tel:'.$data['vcard_fax']."\n".'ADR;TYPE=home;LABEL="'.$data['vcard_address'].'":;;'.$data['vcard_address'].';'.$data['vcard_city'].';'.$data['vcard_post_code'].';'.$data['vcard_country']."\n".'EMAIL:'.$data['vcard_email']."\n".'URL:'.$data['vcard_website']."\n".'END:VCARD';
        }

        return $data;
    }

    //dynamicQrCodeDataGenerate
    public static function dynamicQrCodeDataGenerate($type, $code)
    {
        return env('APP_URL').'/q/'.$code;
    }

    //vCardQrCodeDataGenerate
    public static function vCardQrCodeDataGenerate($data)
    {
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

        return $vcard->getOutput();

        // dd($vcard->getOutput());
        // dd($vcard);
        // $vcard->addPhoto(__DIR__ . '/landscape.jpeg');
        // return $vcard->download();

        $vcard->setSavePath(storage_path('app/public/vcard/'));
        $vcard->save();

        return asset('storage/vcard/'.$vcard->getFilename().'.vcf');

    }

    //event font list
    public static function eventFonts()
    {
        $fonts = [
            [
                'name' => 'Roboto',
            ],
            [
                'name' => 'Fredoka',
            ],
            [
                'name' => 'Cormorant',
            ],
            [
                'name' => 'Rubik',
            ],
            [
                'name' => 'Montserrat',
            ],
            [
                'name' => 'Unbounded',
            ],
            [
                'name' => 'Lora',
            ],
            [
                'name' => 'Poppins',
            ],
            [
                'name' => 'Oswald',
            ],
            [
                'name' => 'Raleway',
            ],
            [
                'name' => 'Merriweather',
            ],
            [
                'name' => 'Nunito',
            ],
            [
                'name' => 'Bitter',
            ],
            [
                'name' => 'Teko',
            ],
            [
                'name' => 'Domine',
            ],
        ];

        return $fonts;
    }

    //basic qrcode data generate
    public static function basicDataForQrCode()
    {
        $qr_style = 'default';
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
        $ifp = fopen($output_file, 'wb');
        $data = explode(',', $base64_string);
        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);

        return $output_file;
    }

    //uploadImage
    public static function uploadImage($image, $disk, $path)
    {
        $base64_to_jpeg = self::base64_to_jpeg($image, $path);
        $imageName = '/'.Str::random(10).'.png';
        Storage::disk($disk)->put($path.$imageName, file_get_contents($base64_to_jpeg));

        return $disk.'/'.$path.$imageName;
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
        $data = Storage::url($path);
        $base64 = 'data:image/'.$type.';base64,'.base64_encode($data);

        return $base64;
    }

    public static function hexInvert(string $color): string
    {
        $color = trim($color);
        $prependHash = false;
        if (strpos($color, '#') !== false) {
            $prependHash = true;
            $color = str_replace('#', '', $color);
        }
        $len = strlen($color);
        if ($len == 3 || $len == 6) {
            if ($len == 3) {
                $color = preg_replace('/(.)(.)(.)/', '\\1\\1\\2\\2\\3\\3', $color);
            }
        } else {
            throw new \Exception("Invalid hex length ($len). Length must be 3 or 6 characters");
        }
        if (! preg_match('/^[a-f0-9]{6}$/i', $color)) {
            throw new \Exception(sprintf('Invalid hex string #%s', htmlspecialchars($color, ENT_QUOTES)));
        }

        $r = dechex(255 - hexdec(substr($color, 0, 2)));
        $r = (strlen($r) > 1) ? $r : '0'.$r;
        $g = dechex(255 - hexdec(substr($color, 2, 2)));
        $g = (strlen($g) > 1) ? $g : '0'.$g;
        $b = dechex(255 - hexdec(substr($color, 4, 2)));
        $b = (strlen($b) > 1) ? $b : '0'.$b;

        return ($prependHash ? '#' : '').$r.$g.$b;
    }

    // visibleColor
    public static function visibleColor($color)
    {
        if (is_null($color) || $color == '') {
            $color = '#ffffff';
        }
        $color = trim($color);
        $prependHash = false;
        if (strpos($color, '#') !== false) {
            $prependHash = true;
            $color = str_replace('#', '', $color);
        }
        $len = strlen($color);
        if ($len == 3 || $len == 6) {
            if ($len == 3) {
                $color = preg_replace('/(.)(.)(.)/', '\\1\\1\\2\\2\\3\\3', $color);
            }
        } else {
            throw new \Exception("Invalid hex length ($len). Length must be 3 or 6 characters");
        }
        if (! preg_match('/^[a-f0-9]{6}$/i', $color)) {
            throw new \Exception(sprintf('Invalid hex string #%s', htmlspecialchars($color, ENT_QUOTES)));
        }

        $r = hexdec(substr($color, 0, 2));
        $g = hexdec(substr($color, 2, 2));
        $b = hexdec(substr($color, 4, 2));

        $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;

        return ($yiq >= 128) ? '#000000' : '#ffffff';
    }

    //uploadFile
    public static function uploadFile($file, $disk)
    {
        //take the file extension means after dot (.) sign
        // $file_type = str_split($file, strrpos($file, '.') + 1);
        $file_type = explode('-.', $file);
        $file_type = $file_type[1];
        $file_name = Str::random(20).'.'.$file_type;
        // dd($file_name);
        $file_path = $file_name;
        Storage::disk($disk)->put($file_path, file_get_contents($file));

        return $disk.'/'.$file_path;
    }

    // currency to symbol
    public static function currencyToSymbol($name)
    {
        $currencies = [
            'usd' => '$',
            'eur' => '€',
            'gbp' => '£',
        ];

        return $currencies[$name];
    }

    public static function createSubdomain($title, $id = 0)
    {
        $slug = Str::slug($title);
        $allSlugs = self::getRelatedSubdomains($slug, $id);
        if (! $allSlugs->contains('subdomain', $slug)) {
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('subdomain', $newSlug)) {
                $is_contain = false;

                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }

    protected static function getRelatedSubdomains($slug, $id = 0)
    {
        return DB::table('qr_codes')->select('subdomain')->where('subdomain', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }

    //get social icon
    public static function socialIcons($key = null)
    {
        $icons = [
            'facebook' => '<svg height="30px" width="30px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 291.319 291.319" xml:space="preserve">
                    <g>
                        <path style="fill:#3B5998;" d="M145.659,0c80.45,0,145.66,65.219,145.66,145.66c0,80.45-65.21,145.659-145.66,145.659
                            S0,226.109,0,145.66C0,65.219,65.21,0,145.659,0z"/>
                        <path style="fill:#FFFFFF;" d="M163.394,100.277h18.772v-27.73h-22.067v0.1c-26.738,0.947-32.218,15.977-32.701,31.763h-0.055
                            v13.847h-18.207v27.156h18.207v72.793h27.439v-72.793h22.477l4.342-27.156h-26.81v-8.366
                            C154.791,104.556,158.341,100.277,163.394,100.277z"/>
                    </g>
                    </svg>',
            'twitter' => '<svg width="30px" height="30px" viewBox="0 -4 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

                        <title>Twitter-color</title>
                        <desc>Created with Sketch.</desc>
                        <defs>

                    </defs>
                        <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Color-" transform="translate(-300.000000, -164.000000)" fill="#00AAEC">
                                <path d="M348,168.735283 C346.236309,169.538462 344.337383,170.081618 342.345483,170.324305 C344.379644,169.076201 345.940482,167.097147 346.675823,164.739617 C344.771263,165.895269 342.666667,166.736006 340.418384,167.18671 C338.626519,165.224991 336.065504,164 333.231203,164 C327.796443,164 323.387216,168.521488 323.387216,174.097508 C323.387216,174.88913 323.471738,175.657638 323.640782,176.397255 C315.456242,175.975442 308.201444,171.959552 303.341433,165.843265 C302.493397,167.339834 302.008804,169.076201 302.008804,170.925244 C302.008804,174.426869 303.747139,177.518238 306.389857,179.329722 C304.778306,179.280607 303.256911,178.821235 301.9271,178.070061 L301.9271,178.194294 C301.9271,183.08848 305.322064,187.17082 309.8299,188.095341 C309.004402,188.33225 308.133826,188.450704 307.235077,188.450704 C306.601162,188.450704 305.981335,188.390033 305.381229,188.271578 C306.634971,192.28169 310.269414,195.2026 314.580032,195.280607 C311.210424,197.99061 306.961789,199.605634 302.349709,199.605634 C301.555203,199.605634 300.769149,199.559408 300,199.466956 C304.358514,202.327194 309.53689,204 315.095615,204 C333.211481,204 343.114633,188.615385 343.114633,175.270495 C343.114633,174.831347 343.106181,174.392199 343.089276,173.961719 C345.013559,172.537378 346.684275,170.760563 348,168.735283" id="Twitter">

                    </path>
                            </g>
                        </g>
                    </svg>',
            'facebook-1' => '<svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

                    <title>Facebook-color</title>
                    <desc>Created with Sketch.</desc>
                    <defs>

                </defs>
                    <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Color-" transform="translate(-200.000000, -160.000000)" fill="#4460A0">
                            <path d="M225.638355,208 L202.649232,208 C201.185673,208 200,206.813592 200,205.350603 L200,162.649211 C200,161.18585 201.185859,160 202.649232,160 L245.350955,160 C246.813955,160 248,161.18585 248,162.649211 L248,205.350603 C248,206.813778 246.813769,208 245.350955,208 L233.119305,208 L233.119305,189.411755 L239.358521,189.411755 L240.292755,182.167586 L233.119305,182.167586 L233.119305,177.542641 C233.119305,175.445287 233.701712,174.01601 236.70929,174.01601 L240.545311,174.014333 L240.545311,167.535091 C239.881886,167.446808 237.604784,167.24957 234.955552,167.24957 C229.424834,167.24957 225.638355,170.625526 225.638355,176.825209 L225.638355,182.167586 L219.383122,182.167586 L219.383122,189.411755 L225.638355,189.411755 L225.638355,208 L225.638355,208 Z" id="Facebook">

                </path>
                        </g>
                    </g>
                </svg>',
            'instagram' => '<svg width="30px" height="30px" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="2" width="28" height="28" rx="6" fill="url(#paint0_radial_87_7153)"/>
                        <rect x="2" y="2" width="28" height="28" rx="6" fill="url(#paint1_radial_87_7153)"/>
                        <rect x="2" y="2" width="28" height="28" rx="6" fill="url(#paint2_radial_87_7153)"/>
                        <path d="M23 10.5C23 11.3284 22.3284 12 21.5 12C20.6716 12 20 11.3284 20 10.5C20 9.67157 20.6716 9 21.5 9C22.3284 9 23 9.67157 23 10.5Z" fill="white"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16 21C18.7614 21 21 18.7614 21 16C21 13.2386 18.7614 11 16 11C13.2386 11 11 13.2386 11 16C11 18.7614 13.2386 21 16 21ZM16 19C17.6569 19 19 17.6569 19 16C19 14.3431 17.6569 13 16 13C14.3431 13 13 14.3431 13 16C13 17.6569 14.3431 19 16 19Z" fill="white"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6 15.6C6 12.2397 6 10.5595 6.65396 9.27606C7.2292 8.14708 8.14708 7.2292 9.27606 6.65396C10.5595 6 12.2397 6 15.6 6H16.4C19.7603 6 21.4405 6 22.7239 6.65396C23.8529 7.2292 24.7708 8.14708 25.346 9.27606C26 10.5595 26 12.2397 26 15.6V16.4C26 19.7603 26 21.4405 25.346 22.7239C24.7708 23.8529 23.8529 24.7708 22.7239 25.346C21.4405 26 19.7603 26 16.4 26H15.6C12.2397 26 10.5595 26 9.27606 25.346C8.14708 24.7708 7.2292 23.8529 6.65396 22.7239C6 21.4405 6 19.7603 6 16.4V15.6ZM15.6 8H16.4C18.1132 8 19.2777 8.00156 20.1779 8.0751C21.0548 8.14674 21.5032 8.27659 21.816 8.43597C22.5686 8.81947 23.1805 9.43139 23.564 10.184C23.7234 10.4968 23.8533 10.9452 23.9249 11.8221C23.9984 12.7223 24 13.8868 24 15.6V16.4C24 18.1132 23.9984 19.2777 23.9249 20.1779C23.8533 21.0548 23.7234 21.5032 23.564 21.816C23.1805 22.5686 22.5686 23.1805 21.816 23.564C21.5032 23.7234 21.0548 23.8533 20.1779 23.9249C19.2777 23.9984 18.1132 24 16.4 24H15.6C13.8868 24 12.7223 23.9984 11.8221 23.9249C10.9452 23.8533 10.4968 23.7234 10.184 23.564C9.43139 23.1805 8.81947 22.5686 8.43597 21.816C8.27659 21.5032 8.14674 21.0548 8.0751 20.1779C8.00156 19.2777 8 18.1132 8 16.4V15.6C8 13.8868 8.00156 12.7223 8.0751 11.8221C8.14674 10.9452 8.27659 10.4968 8.43597 10.184C8.81947 9.43139 9.43139 8.81947 10.184 8.43597C10.4968 8.27659 10.9452 8.14674 11.8221 8.0751C12.7223 8.00156 13.8868 8 15.6 8Z" fill="white"/>
                        <defs>
                        <radialGradient id="paint0_radial_87_7153" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(12 23) rotate(-55.3758) scale(25.5196)">
                        <stop stop-color="#B13589"/>
                        <stop offset="0.79309" stop-color="#C62F94"/>
                        <stop offset="1" stop-color="#8A3AC8"/>
                        </radialGradient>
                        <radialGradient id="paint1_radial_87_7153" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(11 31) rotate(-65.1363) scale(22.5942)">
                        <stop stop-color="#E0E8B7"/>
                        <stop offset="0.444662" stop-color="#FB8A2E"/>
                        <stop offset="0.71474" stop-color="#E2425C"/>
                        <stop offset="1" stop-color="#E2425C" stop-opacity="0"/>
                        </radialGradient>
                        <radialGradient id="paint2_radial_87_7153" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(0.500002 3) rotate(-8.1301) scale(38.8909 8.31836)">
                        <stop offset="0.156701" stop-color="#406ADC"/>
                        <stop offset="0.467799" stop-color="#6A45BE"/>
                        <stop offset="1" stop-color="#6A45BE" stop-opacity="0"/>
                        </radialGradient>
                        </defs>
                        </svg>',
            'linkedin' => '<svg width="30px" height="30px" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="24" cy="24" r="20" fill="#0077B5"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7747 14.2839C18.7747 15.529 17.8267 16.5366 16.3442 16.5366C14.9194 16.5366 13.9713 15.529 14.0007 14.2839C13.9713 12.9783 14.9193 12 16.3726 12C17.8267 12 18.7463 12.9783 18.7747 14.2839ZM14.1199 32.8191V18.3162H18.6271V32.8181H14.1199V32.8191Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M22.2393 22.9446C22.2393 21.1357 22.1797 19.5935 22.1201 18.3182H26.0351L26.2432 20.305H26.3322C26.9254 19.3854 28.4079 17.9927 30.8101 17.9927C33.7752 17.9927 35.9995 19.9502 35.9995 24.219V32.821H31.4922V24.7838C31.4922 22.9144 30.8404 21.6399 29.2093 21.6399C27.9633 21.6399 27.2224 22.4999 26.9263 23.3297C26.8071 23.6268 26.7484 24.0412 26.7484 24.4574V32.821H22.2411V22.9446H22.2393Z" fill="white"/>
                    </svg>',
            'youtube' => '<svg height="30px" width="30px" viewBox="0 -7 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

            <title>Youtube-color</title>
            <desc>Created with Sketch.</desc>
            <defs>

        </defs>
            <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="Color-" transform="translate(-200.000000, -368.000000)" fill="#CE1312">
                    <path d="M219.044,391.269916 L219.0425,377.687742 L232.0115,384.502244 L219.044,391.269916 Z M247.52,375.334163 C247.52,375.334163 247.0505,372.003199 245.612,370.536366 C243.7865,368.610299 241.7405,368.601235 240.803,368.489448 C234.086,368 224.0105,368 224.0105,368 L223.9895,368 C223.9895,368 213.914,368 207.197,368.489448 C206.258,368.601235 204.2135,368.610299 202.3865,370.536366 C200.948,372.003199 200.48,375.334163 200.48,375.334163 C200.48,375.334163 200,379.246723 200,383.157773 L200,386.82561 C200,390.73817 200.48,394.64922 200.48,394.64922 C200.48,394.64922 200.948,397.980184 202.3865,399.447016 C204.2135,401.373084 206.612,401.312658 207.68,401.513574 C211.52,401.885191 224,402 224,402 C224,402 234.086,401.984894 240.803,401.495446 C241.7405,401.382148 243.7865,401.373084 245.612,399.447016 C247.0505,397.980184 247.52,394.64922 247.52,394.64922 C247.52,394.64922 248,390.73817 248,386.82561 L248,383.157773 C248,379.246723 247.52,375.334163 247.52,375.334163 L247.52,375.334163 Z" id="Youtube">

        </path>
                </g>
            </g>
        </svg>',
            'link' => '
        <?xml version="1.0" encoding="utf-8"?>
        <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
        <svg width="30px" height="30px" viewBox="0 0 1024 1024" class="icon"  version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M918.921721 338.938807c0-53.646472-20.831971-104.012415-58.682964-141.866479-37.8213-37.834611-88.203625-58.666581-141.850097-58.666581-53.646472 0-104.028797 20.831971-141.850096 58.682963L149.409442 624.075512l-1.742653 2.645719-2.132753 2.328315c-25.902251 28.211112-40.146544 64.560065-40.146543 102.332219 0 40.434255 15.762715 78.513574 44.376213 107.210009 28.650359 28.647288 66.693842 44.426384 107.13117 44.426384 38.919929 0 75.864783-14.69685 104.061561-41.373158 0 0 70.440239 34.202889 74.736461 38.512422 3.422849 3.409538 7.748764 5.202361 12.561026 5.202362 4.812261 0 9.141248-1.792823 12.531332-5.185979l399.453501-399.387973c37.850993-37.834611 58.682964-88.203625 58.682964-141.847025z" fill="#F4CE73" /><path d="M134.037852 742.876926l494.208968-494.063577c37.8213-37.850993 88.203625-58.682964 141.850097-58.682964 41.211384 0 80.451789 12.402323 113.586766 35.251348-6.909178-10.010527-14.661014-19.522421-23.444926-28.309405-37.8213-37.834611-88.203625-58.666581-141.850097-58.666581-53.646472 0-104.028797 20.831971-141.850096 58.682963L149.409442 624.075512l-15.37159 118.801414z" fill="#79CCBF" /><path d="M640.066553 342.232646c4.005439 2.566881 7.848081 5.522837 11.337482 9.025549 25.806006 25.727167 25.998496 67.503736 0.873374 93.664006-0.228326 0.145392-0.453581 0.225255-0.581567 0.370646 0 0-333.597197 333.547027-432.489161 432.410322 12.240549 3.132065 24.738093 5.314989 37.689219 5.314989 8.816677 0 17.471579-0.986002 25.998496-2.457325C421.966692 741.862255 701.208889 463.347017 701.208889 463.347017c0.12901-0.161774 0.354264-0.258019 0.612283-0.403411 27.033644-28.098485 26.838082-72.961044-0.968595-100.573183-16.53882-16.55213-39.176924-23.093734-60.786024-20.137777z" fill="#FFFFFF" /><path d="M864.922009 192.405459c-80.809125-80.821412-212.257571-80.821412-293.066697 0L144.50196 619.696354c-0.839586 0.839586-1.226615 1.938215-1.938215 2.844353-28.098485 29.583119-43.794647 67.887693-43.794647 108.841058 0 42.243461 16.470219 81.969187 46.311357 111.876878 29.90769 29.906666 69.57096 46.376886 111.814421 46.376886s82.03574-16.470219 111.876878-46.376886c0.12901-0.066553 0.12901-0.195562 0.258019-0.324572 0.066553-0.063481 0.12901-0.063481 0.195562-0.129009L707.958341 504.201065c0.320476-0.258019 0.710576-0.320476 0.903067-0.645047 42.308989-42.308989 42.308989-111.10282 0-153.412834-42.308989-42.308989-111.10282-42.308989-153.412834 0-0.12901 0.132081-0.12901 0.261091-0.258019 0.3901L221.431584 684.16427c-9.495513 9.495513-9.495513 24.867103 0 34.428144 9.495513 9.495513 24.870175 9.495513 34.365687 0L589.556242 384.896924c0.12901-0.12901 0.195562-0.191467 0.258019-0.320477 23.382469-23.385541 61.365543-23.385541 84.684531 0 23.057898 22.995441 23.25346 60.330395 0.774057 83.712865-0.194538 0.12901-0.387029 0.195562-0.516038 0.324571L334.858624 808.44347c-0.12901 0.062457-0.12901 0.191467-0.191467 0.320476-0.066553 0.066553-0.195562 0.066553-0.258019 0.12901-20.670197 20.670197-48.252644 32.1029-77.515286 32.1029s-56.711984-11.432704-77.319724-32.1029c-42.762571-42.759499-42.762571-112.263906-0.062457-155.026477 0.387029-0.320476 0.516038-0.839586 0.774057-1.226615l425.935271-425.868718c61.881581-61.819124 162.453741-61.819124 224.335323 0 61.815029 61.881581 61.815029 162.517222 0 224.336346l-399.515959 399.386949c-9.494489 9.494489-9.494489 24.867103 0 34.361591 9.495513 9.495513 24.933655 9.495513 34.428145 0L864.922009 485.46806c80.80503-80.80503 80.80503-212.253476 0-293.062601z" fill="#27323A" /></svg>',
            'tiktok' => '<svg fill="#000000" height="30px" width="30px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><path d="M19.589 6.686a4.793 4.793 0 0 1-3.77-4.245V2h-3.445v13.672a2.896 2.896 0 0 1-5.201 1.743l-.002-.001.002.001a2.895 2.895 0 0 1 3.183-4.51v-3.5a6.329 6.329 0 0 0-5.394 10.692 6.33 6.33 0 0 0 10.857-4.424V8.687a8.182 8.182 0 0 0 4.773 1.526V6.79a4.831 4.831 0 0 1-1.003-.104z"/></svg>',
        ];
        if ($key) {
            return $icons[$key];
        }

        return $icons;
    }

    //check if there is http or https in url if not then add https
    public static function checkUrl($url)
    {
        if (strpos($url, 'http') === false) {
            $url = 'https://'.$url;
        }

        return $url;
    }


    //get static qrCode data
    public static function getQrCodeSvg($qrcode)
    {
        $qcode = (object) $qrcode;

        $data = [

                'qr_style' => $qcode->qr_style,
                'qr_logo' => $qcode->qr_logo,
                'qr_color' => $qcode->qr_color,
                'qr_bg_color' => $qcode->qr_bg_color,
                'qr_eye_border' => $qcode->qr_eye_border,
                'qr_eye_center' => $qcode->qr_eye_center,
                'qr_gradient' => $qcode->qr_gradient,
                'qr_eye_color_in' => $qcode->qr_eye_color_in,
                'qr_eye_color_out' => $qcode->qr_eye_color_out,
                'qr_eye_style_in' => $qcode->qr_eye_style_in,
                'qr_eye_style_out' => $qcode->qr_eye_style_out,
                'qr_logo_background' => $qcode->qr_logo_background,
                'qr_bg_image' => $qcode->qr_bg_image,
                'qr_custom_logo' => $qcode->qr_custom_logo,
                'qr_custom_background' => $qcode->qr_custom_background,
                'frame' => $qcode->frame,
                'frame_label' => $qcode->frame_label,
                'frame_label_font' => $qcode->frame_label_font,
                'frame_label_text_color' => $qcode->frame_label_text_color

            ];


        if ($qcode->is_dynamic != true) {
            $data['data'] = Support::staticQrCodeDataGenerate(
                    $qcode->type,
                    $qcode->qr_code_info,
                    );
        }else{
            $data['data'] = Support::dynamicQrCodeDataGenerate(
                    $qcode->type,
                    $qcode->code,
                    );
        }


        $qrCode = Support::qrCodeGenerate($data);
        $markup = '<div class="qr-code" style="width: 157px; height: 157px; display:none;">'.$qrCode.'</div>';
        $markup .= '<img src="data:image/svg+xml;base64,'.base64_encode($qrCode).'" alt="qr code"  style="height: 157px;
        width: 157px;"/>';
        return $markup;
    }


}
