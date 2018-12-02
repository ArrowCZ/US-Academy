<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worked extends Model
{
    protected $table = 'worked';
    
    protected $fillable = [
        'date',
        'hours',
        'city_id',
        'user_id',
    ];

    public function city() {
        return $this->belongsTo('App\City');
    }
}
