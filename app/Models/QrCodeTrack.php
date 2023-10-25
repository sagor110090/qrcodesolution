<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCodeTrack extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'city',
        'country',
        'region',
        'zip_code',
        'latitude',
        'longitude',
        'qr_code_id',
    ];


    //get created at
    public function getCreatedAtAttribute($value)
    {
        return date('d M Y h:i A', strtotime($value));
    }


    public function qrCode()
    {
        return $this->belongsTo(QrCode::class);
    }


}
