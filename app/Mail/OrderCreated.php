<?php

namespace App\Mail;

use App\City;
use App\Order;
use App\Training;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    /** @var Order  */
    protected $order;
    /** @var City  */
    protected $city;
    /** @var Training */
    protected $training;
    /** @var bool */
    protected $was_sub;

    /**
     * Create a new message instance.
     *
     * @param Order    $order
     * @param City     $city
     * @param Training $training
     * @param bool     $was_sub
     */
    public function __construct(Order $order, City $city, Training $training, $was_sub = false)
    {
        $this->order = $order;
        $this->city = $city;
        $this->training = $training;
        $this->was_sub = $was_sub;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('info@usacademy.cz')
            ->view('email.order.created')
            ->subject('Přihláška na kroužek')
            ->with('training', $this->training)
            ->with('city', $this->city)
            ->with('order', $this->order)
            ->with('was_sub', $this->was_sub)
        ;
    }
}
