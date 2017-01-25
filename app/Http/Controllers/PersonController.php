<?php

namespace App\Http\Controllers;

use App\Person;
use App\BroadcastList;
use App\Http\Requests\PersonRequest;
use Illuminate\Http\Request;
use Event;
use Debugbar;

class PersonController extends Controller
{
    public function index()
    {
        $people = Person::all();

        return view('person.index', compact('people'));
    }

    public function create()
    {
        return view('person.create', [
            'person' => new Person
        ]);
    }

    public function store(PersonRequest $request)
    {
        $person = new Person;
        $person->first_name = $request->first_name;
        $person->last_name = $request->last_name;
        $person->address = $request->address;
        $person->zipcode = $request->zipcode;
        $person->city = $request->city;
        $person->mobile_phone = $request->mobile_phone;
        $person->mobile_phone_status = 'checking';
        $person->university = $request->university;
        $person->major = $request->major;
        $person->email = $request->email;
        $person->messageable = $request->messageable;
        $person->comments = $request->comments;
        $person->section_id = session('section')->id;

        $person->save();

        session()->flash('flash_message', 'Contact créé');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('person.show', [$person]);
    }

    public function show(Person $person)
    {
        $person->load('broadcast_lists', 'messages.sending');
        $available_broadcast_lists = BroadcastList::whereDoesntHave('list_subscribers',
            function ($query) use ($person) {
                $query->where('person_id', '=', $person->id);
            })->get();
        return view('person.show', compact('person', 'available_broadcast_lists'));
    }

    public function update(PersonRequest $request, Person $person)
    {
        $mobile_phone_changed = $this->mobile_phone_changed($request, $person);

        $person->update($request->all());

        if ($mobile_phone_changed) {
            $person->mobile_phone_status = 'checking';
            $person->save();
        }

        session()->flash('flash_message', 'Contact modifié');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('person.show', [$person]);
    }

    public function destroy(Person $person)
    {
        $person->delete();

        session()->flash('flash_message', 'Contact supprimé');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('person.index');
    }

    public function check_mobile_phone(Person $person)
    {
        $person->mobile_phone_status = 'checking';
        $person->save();

        session()->flash('flash_message', 'Vérification du numéro de téléphone mobile lancée');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('person.show', [$person]);
    }

    public function subscribe(Request $request, Person $person)
    {
        $person->broadcast_lists()->attach($request->broadcast_list_id);

        session()->flash('flash_message', 'Contact ajouté à la liste');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('person.show', [$person]);
    }

    public function unsubscribe(Person $person, BroadcastList $broadcast_list)
    {
        $person->broadcast_lists()->detach($broadcast_list->id);

        session()->flash('flash_message', 'Contact retiré de la liste');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('person.show', [$person]);
    }

    private function mobile_phone_changed(Request $request, Person $person): bool
    {
        return $request->mobile_phone !== $person->mobile_phone;
    }
}
