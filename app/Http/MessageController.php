<?php

namespace App\Http\Controllers;

use App\ListSubscriber;
use App\BroadcastList;
use App\Person;
use Illuminate\Http\Request;
use App\Http\Requests;

class MessageController extends Controller
{
    public function store(Request $request, BroadcastList $broadcast_list, BroadcastMessage $broadcast_message, Message $message)
    {
        $this->validate($request, [
            'person_id' => 'required|numeric',
            'broadcast_message_id' => 'required|numeric',
        ]);

        $message = new Message;
        $message->person_id = $request->person_id;
        $message->broadcast_list_id = $request->broadcast_list_id;
        $message->save();

        $person = Person::find($list_subscriber->person_id);

        session()->flash('flash_message', 'Abonné ajouté à la liste');
        session()->flash('flash_message_type', 'success');

        if($request->creation_origin === 'person')
        {
            return redirect()->route('person.show', [$person] );
        }

        return redirect()->route('broadcast_list.show', [$broadcast_list]);
    }

    public function destroy(Request $request, BroadcastList $broadcast_list, ListSubscriber $list_subscriber)
    {
        $message->delete();

        session()->flash('flash_message', 'Abonné à la liste désinscrit');
        session()->flash('flash_message_type', 'success');

        if($request->deletion_origin === 'person')
        {
            return redirect()->route('person.show', [$person] );
        }
        
        return redirect()->route('broadcast_list.show', [$broadcast_list]);
    }
}
