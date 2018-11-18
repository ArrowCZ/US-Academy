<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int     $id
 * @property-read string  $address
 * @property-read string  $day
 * @property-read string  $season
 * @property-read string  $trainer
 * @property-read int     $capacity
 * @property-read float   $price
 * @property-read string  $time
 * @property-read Order[] $orders
 * @property-read int     $city_id
 * @property-read int     $type        0 = krouzek, 1 = workshop, 2 = kemp
 */
class Training extends Model
{
    protected $fillable = [
        'city_id',
        'address',
        'day',
        'time',
        'season',
        'trainer',
        'capacity',
        'price',
        'type',
        'date',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Order[]
     */
    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function new_count() {
        $count = 0;
        foreach ($this->orders as $order) {
            if ($order->state === 0) {
                $count++;
            }
        }

        return $count;
    }

    public function paid_count() {
        $count = 0;
        foreach ($this->orders as $order) {
            if ($order->state === 1) {
                $count++;
            }
        }

        return $count;
    }

    public function canceled_count() {
        $count = 0;
        foreach ($this->orders as $order) {
            if ($order->state === 2) {
                $count++;
            }
        }

        return $count;
    }

    public function free_count() {
        return max($this->capacity - $this->paid_count(), 0);
    }

    public function state($state) {
        return $this->orders()->where('state','=', $state)->getModels();
    }

    public function date() {
        return $this->date ? new \DateTime($this->date) : null;
    }
}
