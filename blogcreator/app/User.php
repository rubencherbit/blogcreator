<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    public function blogs() {
        return $this->hasMany('App\Blog');
    }

    public function articles() {
        return $this->hasMany('App\Article');
    }

    public function categories() {
        return $this->hasManyThrough(
            'App\Categorie', 'App\Blog'
        );
    }

    public function comments() {
        return $this->hasManyThrough(
            'App\Comment', 'App\Article'
        );
    }

    public function receivedMessages() {
        return $this->hasMany('App\Message', 'receiver_id');
    }

    public function sentMessages() {
        return $this->hasMany('App\Message', 'sender_id');
    }

    public function unreadMessages() {
        return $this->receivedMessages()->where('is_read', '0');
    }
    public function follow_blogs()
    {
        return $this->belongsToMany('App\Blog');
    }

}
