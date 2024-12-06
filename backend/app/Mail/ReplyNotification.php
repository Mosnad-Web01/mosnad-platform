<?php
// app/Mail/ReplyNotification.php

namespace App\Mail;

use App\Models\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $reply;

    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    public function build()
    {
        return $this->subject('تم إرسال رد جديد على رسالتك')
                    ->view('emails.reply-notification');
    }
}
