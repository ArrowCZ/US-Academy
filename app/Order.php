<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int    $id
 * @property-read int    $state   0 = novy (nezaplaceno), 1 = zaplaceno, 2 = zruseno
 * @property-read string $email
 * @property-read string $name
 * @property-read string $parent
 * @property int    $count   pocet lidi
 */
class Order extends Model
{
    protected $fillable = [ 'email', 'name','parent', 'phone', 'text', 'trainig_id' ];
}
