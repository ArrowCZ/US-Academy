<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name'];

    public function trainings() {
        return $this->hasMany(Training::class);
    }
}
