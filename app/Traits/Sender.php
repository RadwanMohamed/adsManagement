<?php

namespace  App\Traits;

use Illuminate\Support\Facades\Mail;

/**
 * Sender trait to handle external services
 */
trait Sender {
    /**
     * send mail function
     * @param $to
     * @param $message
     * @param $subject
     */
    protected  function sendEmail($to,$message,$subject){
        Mail::raw($message,function ($message)use($to,$subject){
            $message->to($to)
                ->subject($subject);
        });
    }
}
