<?php

namespace App\Models;

use Support;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QrCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'code',
        'qr_style',
        'qr_logo',
        'qr_color',
        'qr_bg_color',
        'qr_eye_border',
        'qr_eye_center',
        'qr_gradient',
        'qr_eye_color_in',
        'qr_eye_color_out',
        'qr_eye_style_in',
        'qr_eye_style_out',
        'qr_logo_background',
        'qr_bg_image',
        'qr_custom_logo',
        'qr_custom_background',
        'frame',
        'frame_label',
        'frame_label_font',
        'frame_label_text_color',
        'is_dynamic',
        'qr_code_info',
        'subdomain',
    ];

    protected $casts = [
        'qr_code_info' => 'array',
        'is_dynamic' => 'boolean',
    ];

    //append static qrCode data
    protected $appends = [
        'static_qr_code_svg',
        'dynamic_qr_code_svg'
    ];




    //get static qrCode data
    public function getStaticQrCodeSvgAttribute()
    {
        $data = [
            'data' => Support::staticQrCodeDataGenerate(
                $this->type,
                $this->qr_code_info,
                ),

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
                'frame_label_text_color' => $this->frame_label_text_color

            ];
        $qrCode = Support::qrCodeGenerate($data);
        return $qrCode;
    }

    //dynamic_qr_code_svg
    public function getDynamicQrCodeSvgAttribute()
    {
        $data = [
            'data' => Support::dynamicQrCodeDataGenerate(
                $this->type,
                $this->code,
                ),

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
                'frame_label_text_color' => $this->frame_label_text_color

            ];
        $qrCode = Support::qrCodeGenerate($data);
        return $qrCode;
    }

    //scope is dynamic
    public function scopeIsDynamic($query)
    {
        return $query->where('is_dynamic', true);
    }

    //scope is static
    public function scopeIsStatic($query)
    {
        return $query->where('is_dynamic', false);
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function qrCodeTracks()
    {
        return $this->hasMany(QrCodeTrack::class)->latest();
    }
}
