<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorreoElectronico extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Envío de Credenciales - Sistema SAPSP";

    public $datos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request){
        $this->datos = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('correo.credenciales');
    }
}
