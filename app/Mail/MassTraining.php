<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MassTraining extends Mailable
{
    use Queueable, SerializesModels;

    private $text;

    public function __construct($text) {
        $text = str_replace("\n", '<br>', $text);

        $this->text = $text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this
            ->from('info@usacademy.cz')
            ->view('email.training.mass')
            ->subject($this->subject)
            ->with('text', $this->text);
    }
}
