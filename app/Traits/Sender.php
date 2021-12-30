<?php

namespace  App\Traits;

use Illuminate\Support\Facades\Mail;

trait Sender {
    protected  function sendEmail($to,$message,$subject){
        Mail::raw($message,function ($message)use($to,$subject){
            $message->to($to)
                ->subject($subject);
        });
    }
}
