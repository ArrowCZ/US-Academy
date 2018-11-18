<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property int      $state   0 = novy (nezaplaceno), 1 = zaplaceno, 2 = zruseno, 3 = nahradnik
 * @property string   $email
 * @property string   $name
 * @property int      $count   pocet lidi
 */
class Order extends Model
{
    protected $fillable = [ 'email', 'name', 'parent', 'phone', 'text', 'training_id', 'price',
        'street',
        'city',
        'postal_code',
        'company',
        'tin',
        'insurance',
        'pid_number',
        'condition',
    ];

    public function _state() {
        switch ($this->state) {
            case 0:
                return 'Nový';
            case 1:
                return 'Zaplaceno';
            case 2:
                return 'Zrušeno';
            case 3:
                return 'Náhradník';
            default:
                return 'Neznamý';
        }
    }

    public function tableColor() {
        switch ($this->state) {
            case 0:
                return 'table-warning';
            case 1:
                return 'table-success';
            case 2:
                return 'table-danger';
            case 3:
                return 'table-info';
            default:
                return 'table-default';
        }
    }

    public function isPaid(): bool {
        return $this->state == 1;
    }
}
