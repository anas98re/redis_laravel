<?php

use Illuminate\Support\Facades\Mail;

function sendMail($tamplate, $to, $subject, $data)
{
    Mail::send($tamplate, $data->toArray(), function ($message) use ($to, $subject) {
        $message->subject($subject);
        $message->to($to);
    });
}
