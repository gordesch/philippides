<?php

namespace App\Http\Controllers;

use App\ListSubscriber;
use App\BroadcastList;
use App\Person;
use Illuminate\Http\Request;
use App\Http\Requests;

class ListSubscriberController extends Controller
{
    public function create(BroadcastList $broadcast_list)
    {
        $people = Person::whereDoesntHave('list_subscribers', function ($query) use ($broadcast_list) {
            $query->where('broadcast_list_id', '=', $broadcast_list->id);
        })->get();
        return view('list_subscriber.create', compact('broadcast_list', 'people'));
    }

    public function store(Request $request, BroadcastList $broadcast_list)
    {
        $this->validate($request, [
            'people_ids.*' => 'required|numeric',
            'broadcast_list_id' => 'required|numeric',
        ]);
        foreach ($request['people_ids'] as $person_id) {
            $list_subscriber = new ListSubscriber;
            $list_subscriber->person_id = $person_id;
            $list_subscriber->broadcast_list_id = $request->broadcast_list_id;
            $list_subscriber->save();
        }
        $nb_of_list_subscribers = count($request['people_ids']);
        if ($nb_of_list_subscribers > 1) {
            session()->flash('flash_message', $nb_of_list_subscribers . ' abonnés ajoutés à la liste');
        } else {
            session()->flash('flash_message', 'Abonné ajouté à la liste');
        }
        session()->flash('flash_message_type', 'success');

        if($request->creation_origin === 'person') {
            $person = Person::find($list_subscriber->person_id);
            return redirect()->route('person.show', [$person] );
        }

        return redirect()->route('broadcast_list.show', [$broadcast_list]);
    }

    public function destroy(Request $request, BroadcastList $broadcast_list, ListSubscriber $list_subscriber)
    {
        $list_subscriber->delete();

        session()->flash('flash_message', 'Abonné à la liste désinscrit');
        session()->flash('flash_message_type', 'success');

        if ($request->deletion_origin === 'person') {
            $person = Person::find($list_subscriber->person_id);
            return redirect()->route('person.show', [$person] );
        }
        
        return redirect()->route('broadcast_list.show', [$broadcast_list]);
    }
}
