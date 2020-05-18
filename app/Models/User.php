<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;
use App\Models\SocialAccount;
class User extends Authenticatable
{
    use Notifiable,HasApiTokens,SoftDeletes;


    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name', 'email', 'password','phone','active', 'activation_token','avatar'
    ];
    protected $hidden = [
        'password', 'remember_token','activation_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['avatar_url'];
    public function getAvatarUrlAttribute()
    {
        return Storage::url('avatars/'.$this->id.'/'.$this->avatar);
    }
    public function accounts(){
        return $this->hasMany(SocialAccount::class);
    }
    public function items(){
        return $this->hasMany(Item::class);
    }
    public function itemRequests(){
        return $this->hasMany(RequestItems::class);
    }














}
