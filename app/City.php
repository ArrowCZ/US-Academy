<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int        $id
 * @property-read string     $name
 * @property-read Training[] $trainings
 * @property-read int        $x
 * @property-read int        $y
 *
 * @package App
 */
class City extends Model
{
    protected $fillable = [ 'name' ];

    public function trainings() {
        return $this->hasMany(Training::class);
    }
}
