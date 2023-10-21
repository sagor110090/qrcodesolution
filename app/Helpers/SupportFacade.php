<?php

namespace App\Helpers;

use App\Http\Qrcdr\QRcdr;
use App\Models\QrCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Storage;

require dirname(dirname(__FILE__)) . '/Http/qrcdr/lib/functions.php';
require dirname(dirname(__FILE__)) . '/Http/qrcdr/lib/phpqrcode.php';
require dirname(dirname(__FILE__)) . '/Http/qrcdr/lib/class-qrcdr.php';

class SupportFacade extends Facade
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
            'vcard',
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

    public static function qrCodeGenerate(
        $data,
        $qr_style,
        $qr_logo,
        $qr_color,
        $qr_bg_color,
        $qr_eye_border,
        $qr_eye_center,
        $qr_gradient,
        $qr_eye_color_in,
        $qr_eye_color_out,
        $qr_eye_style_in,
        $qr_eye_style_out,
        $qr_logo_background,
        $qr_bg_image,
        $qr_custom_logo,
        $qr_custom_background,
        $frame,
        $frame_label,
        $frame_label_font,
        $frame_label_text_color
    ) {



        require dirname(dirname(__FILE__)) . '/Http/qrcdr/lib/frames.php';






        $outdir = qrcdr()->getConfig('qrcodes_dir');
        $PNG_TEMP_DIR = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . $outdir . DIRECTORY_SEPARATOR;




        $words = explode(' ', $frame_label);

        $frame_label = self::buildframe_label($words);



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


        $stringbackcolor = $qr_bg_color;
        $stringfrontcolor = $qr_color;
        $backcolor = qrcdr()->hexdecColor($stringbackcolor, '#FFFFFF');
        $frontcolor = qrcdr()->hexdecColor($stringfrontcolor, '#000000');

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

        $backcolor = qrcdr()->hexdecColor($stringbackcolor, '#FFFFFF');
        $filename = $PNG_TEMP_DIR . 'qrcode_' . uniqid() . '.png';
        $filenamesvg = $filename . '.svg';

        $codemargin = $frame !== 'none' ? $frames[$frame]['frame_border'] * 2 + 1 : 2;
        $content = QRcdr::svg($data, $filenamesvg, $errorCorrectionLevel, $matrixPointSize, $codemargin, false, $backcolor, $frontcolor, $optionstyle);

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


    public static function createQrCode($data) {
        auth()->user()->qrCodes()->create($data);
        return true;
    }

    public static function base64_upload($image_64, $type = 'social_media')
    {
        // check if image is base64
        if (substr($image_64, 0, 10) == 'data:image') {
            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1]; // .jpg .png .pdf
            $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
            $image = str_replace($replace, '', $image_64);
            $image = str_replace(' ', '+', $image);
            $imageName = '/' . Str::random(10) . '.' . $extension;
            Storage::disk($type)->put($imageName, base64_decode($image));
            return $imageName;
        } elseif ($type == 'event') {
            $base_url = url('/') . '/storage/event';
            $image_64 = str_replace($base_url, '', $image_64);
            return $image_64;
        } else {
            // base url
            $base_url = url('/') . '/storage/social_media';
            $image_64 = str_replace($base_url, '', $image_64);
            return $image_64;
        }
    }

    public static function buildframe_label($words)
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

    //svg to png
    public static function svg2png($svgPath)
    {
    }
}
