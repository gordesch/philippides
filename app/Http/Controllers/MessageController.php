<?php

namespace App\Http\Controllers;

use App\ListSubscriber;
use App\BroadcastList;
use App\Person;
use App\Jobs\ProcessPodcast;
use Illuminate\Http\Request;
use App\Http\Requests;


class MessageController extends Controller
{
    public function store(Request $request, BroadcastList $broadcast_list, BroadcastMessage $broadcast_message, Message $message)
    {
        $this->validate($request, [
            //
        ]);

        $message = new Message;
        $message->person_id = $request->person_id;
        $message->broadcast_list_id = $request->broadcast_list_id;
        $message->save();

        session()->flash('flash_message', 'Message créé');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('broadcast_list.show', [$broadcast_list]);
    }

    public function destroy(Request $request, BroadcastList $broadcast_list, BroadcastMessage $broadcast_message, Message $message)
    {
        $list_subscriber->delete();

        session()->flash('flash_message', 'Message détruit');
        session()->flash('flash_message_type', 'success');

        if($request->deletion_origin === 'person') {
            return redirect()->route('person.show', [$list_subscriber->person()] );
        }
        
        return redirect()->route('broadcast_list.show', [$broadcast_list]);
    }

    public function send(Request $request, BroadcastList $broadcast_list, BroadcastMessage $broadcast_message, Message $message){
        SMS::send('Test', null, function($sms) {
            $sms->to('+33645645084');
        });

        session()->flash('flash_message', 'L\'envoi du message a débuté');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('broadcast_list.show', [$broadcast_list]);
    }
}
