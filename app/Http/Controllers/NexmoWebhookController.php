<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MessageReceived;
use Illuminate\Support\Facades\Mail;

class NexmoWebhookController extends Controller
{
    public function receive(){
        $incoming = SMS::receive();
        /*//Get the sender's number.
        $incoming->from();
        //Get the message sent.
        $incoming->message();
        //Get the to unique ID of the message
        $incoming->id();
        //Get the phone number the message was sent to
        $incoming->to();
        //Get the raw message
        $incoming->raw();*/

        Mail::to('cantiencollinet@gmail.com')->send(new MessageReceived($incoming));
    }
}
