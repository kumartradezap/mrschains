<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestAdditionalInformation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Stores the otp
     * @var int
     */
    private $_otp;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->_data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.additionalrequest')
        ->subject(config('general_settings.SEND_REQUEST_ADITIONAL'))
        ->with([
            'data' => $this->_data
        ]);
    }
}
