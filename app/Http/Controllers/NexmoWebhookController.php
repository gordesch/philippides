<?php

namespace App\Http\Controllers;

use App\VirtualNumber;
use SMS;
use App\Message;
use App\Person;
use App\Sending;

class NexmoWebhookController extends Controller
{
    public function receive(){
        $incoming = SMS::receive();
        $sender = Person::where('mobile_phone', $incoming->from())->first();
        $recipient = $sender->section();

        $sending = new Sending;
        $sending->body = $incoming->message();
        $sending->type = 'incoming';
        $sending->section_id = $sender->section_id;
        $sending->save();

        $message = new Message;
        $message->status = 'incoming';
        $sender->messages_sent()->save($message);
        $recipient->messages_received()->save($message);
        $message->provider_internal_id = $incoming->id();
        $message->sending_id = $sending->id;
        $message->section_id = $sender->section_id;
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
