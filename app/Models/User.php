<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function channel(){

        return $this->hasOne(Channel::class);
    }
    
    public function owns(Video $video){
        return $this->id == $video->channel->user_id;
    }

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }

    public function subscribedChannels(){
        return $this->belongsToMany(Channel::class, 'subscriptions');
    }

    public function isSubscribedTo(Channel $channel){
        return (bool) $this->subscriptions->where('channel_id', $channel->id)->count();
    }

    public function comments(){

        return $this->hasMany(Comment::class);
    }
}