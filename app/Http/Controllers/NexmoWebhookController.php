<?php

namespace App\Http\Controllers;

use SMS;
use Log;
use App\Message;
use App\Person;
use App\BroadcastMessage;
use Illuminate\Http\Request;
use App\Mail\MessageReceived;
use Illuminate\Support\Facades\Mail;

class NexmoWebhookController extends Controller
{
    public function receive(){
        $incoming = SMS::receive();
        //Log::debug($incoming->raw());
        $sender = Person::where('mobile_phone', $incoming->from())->first();
        $broadcast_message = new BroadcastMessage;
        $broadcast_message->body = $incoming->message();
        $broadcast_message->type = 'incoming';
        $broadcast_message->save();
        $message = new Message;
        $message->status = 'incoming';
        $message->sender_id = $sender->id;
        $message->contact_id = $sender->id;
        $message->provider_internal_id = $incoming->id();
        $message->broadcast_message_id = $broadcast_message->id;
        $message->save();

        //Get the phone number the message was sent to
        //$incoming->to();
        //Get the raw message
        //$incoming->raw();

        //Mail::to('cantiencollinet@gmail.com')->send(new MessageReceived($incoming));
    }

    public function delivery_receipt(){
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

        //Mail::to('cantiencollinet@gmail.com')->send(new MessageReceived($incoming));
    }
}
