<?php

namespace App\Mail\Resetpassword;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendCode extends Mailable
{
    use Queueable, SerializesModels;
    public $restPassword;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($restPassword)
    {
        $this->restPassword =$restPassword;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
        // return $this->markdown('Resetpassword.ResetPassword1',);
        return $this->view('Resetpassword.ResetPassword1')
                    ->with(['restPassword' => $this->restPassword]);
    }
}
