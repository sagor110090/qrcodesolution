<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    //isOnTrial
    public static function isOnTrial(){
        $user = auth()->user();
        if($user->created_at->diffInDays() <= 14){
            return true;
        }
        return false;
    }

    //isNotOnSubscription
    public static function isNotOnSubscription($user = null){
        if(!$user){
            $user = auth()->user();
        }
        if(!$user->subscriptions()->active()
        ->first()){
            return true;
        }
        return false;
    }

    //trialDaysLeft
    public static function trialDaysLeft(){
        $user = auth()->user();
        return 14 - $user->created_at->diffInDays();
    }


    /**
     * Get the qrcodes for the user.
     */
    public function qrCodes(){
        return $this->hasMany(QrCode::class);
    }
}
