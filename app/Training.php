<?php

namespace App;

use DateTime;
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
        'date_to',
        'text',
        'difficulty',
        'age',
        'hidden',
        'leader_id',
        'advanced',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Order[]
     */
    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function leader() {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Image[]
     */
    public function images() {
        return $this->hasMany(Image::class);
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

    public function date(): ?string {
        return $this->date ? (new DateTime($this->date))->format('j.n. Y') : null;
    }

    public function dateTo(): ?string {
        return $this->date_to ? (new DateTime($this->date_to))->format('j.n. Y') : null;
    }
}
