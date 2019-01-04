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
        'name', 'email', 'password', 'payment', 'function', 'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin(): bool {
        return $this->name === 'admin';
    }

    public function worked() {
        return $this->hasMany('App\Worked');
    }

    public function hours() {
        $hours = 0;
        foreach($this->worked as $work) {
            $hours += $work->hours;
        }

        return $hours;
    }
}
