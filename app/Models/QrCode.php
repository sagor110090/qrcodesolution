<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    protected $casts = [
        'qr_code_info' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
