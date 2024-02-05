<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Helpers\Support;

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
        'status'
    ];

    protected $casts = [
        'qr_code_info' => 'array',
        'is_dynamic' => 'boolean',
        'status' => 'boolean'
    ];








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

    //scope is active
    public function scopeIsActive($query)
    {
        return $query->where('status', true);
    }

    //scope is inactive
    public function scopeIsInactive($query)
    {
        return $query->where('status', false);
    }

    //scope search
    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('type', 'like', '%' . $search . '%');
        });
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function qrCodeTracks()
    {
        return $this->hasMany(QrCodeTrack::class)->latest();
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function ($qrCode) {
            $qrCode->subdomain = Support::createSubdomain($qrCode->subdomain ?? $qrCode->type, $qrCode->id);
            $qrCode->save();
        });
    }



}
