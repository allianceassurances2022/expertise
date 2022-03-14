<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailExpertise extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public $action;

    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $expertise=$this->data;
        $action=$this->action;
        return $this->from('expertise@allianceassurances.com.dz',"E-Expertise")
                    ->subject("E-Expertise")
                    ->view('mail',compact('expertise','action'));
    }
}
