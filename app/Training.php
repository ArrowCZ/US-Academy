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

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function new_count() {
        $count = 0;
        foreach ($this->orders as $order) {
            if ($order->state === 0) {
                $count ++;
            }
        }

        return $count;
    }

    public function paid_count() {
        $count = 0;
        foreach ($this->orders as $order) {
            if ($order->state === 1) {
                $count ++;
            }
        }

        return $count;
    }

    public function canceled_count() {
        $count = 0;
        foreach ($this->orders as $order) {
            if ($order->state === 2) {
                $count ++;
            }
        }

        return $count;
    }
}
