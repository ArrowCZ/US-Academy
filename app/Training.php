<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int     $id
 * @property-read string  $day
 * @property-read string  $season
 * @property-read string  $trainer
 * @property-read int     $capacity
 * @property-read float   $price
 * @property-read string  $time
 * @property-read Order[] $orders
 */
class Training extends Model
{
    protected $fillable = [
        'city_id',
        'day',
        'time',
        'season',
        'trainer',
        'capacity',
        'price',
    ];

    public function trainings() {
        return $this->hasMany(Order::class);
    }
}
