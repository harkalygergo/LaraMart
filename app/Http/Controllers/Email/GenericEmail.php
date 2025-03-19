<?php

namespace App\Http\Controllers\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GenericEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailData;

    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    public function build()
    {
        return $this->from($this->emailData['from_email'], $this->emailData['from_name'])
            ->subject($this->emailData['subject'])
            ->view('emails.generic')
            ->with([
                'fromName' => $this->emailData['from_name'],
                'toName' => $this->emailData['to_name'],
                'content' => $this->emailData['content'],
                'subject' => $this->emailData['subject']
            ]);
    }
}
