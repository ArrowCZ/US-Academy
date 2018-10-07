<?php

namespace App\Mail;

use App\City;
use App\Order;
use App\Training;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderSub extends Mailable
{
    use Queueable, SerializesModels;

    /** @var Order  */
    protected $order;
    /** @var City  */
    protected $city;
    /** @var Training */
    protected $training;

    /**
     * Create a new message instance.
     *
     * @param Order    $order
     * @param City     $city
     * @param Training $training
     */
    public function __construct(Order $order, City $city, Training $training)
    {
        $this->order = $order;
        $this->city = $city;
        $this->training = $training;
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
            ->view('email.order.sub')
            ->subject('Přihláška na kroužek')
            ->with('training', $this->training)
            ->with('city', $this->city)
            ->with('order', $this->order)
            ;
    }
}
