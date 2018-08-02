<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int     $id
 * @property-read string  $day
 * @property-read int     $capacity
 * @property-read float   $price
 * @property-read string  $time
 * @property-read Order[] $orders
 */
class Training extends Model
{

}
