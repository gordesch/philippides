<?php

namespace App\Http\Controllers;

use App\Person;
use App\BroadcastList;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Jobs\CheckMobilePhone;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{
    public function index()
    {
        $people = Person::all();
        return view('person.index', compact('people'));
    }

    public function create()
    {
        return view('person.create', compact('person'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'string|max:255',
            'zipcode' => 'integer',
            'city' => 'string|max:255',
            'mobile_phone' => 'max:255',
            'landline' => 'max:255',
            'mobile_phone' => 'max:255',
            'university' => 'string|max:255',
            'major' => 'string|max:255',
            'email' => 'email|max:255',
            'messageable' => 'boolean',
            'comments' => '',
        ]);

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
        $person->section_id = 1;

        $person->save();

        session()->flash('flash_message', 'Contact créé');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('person.show', [$person]);
    }

    public function show(Person $person)
    {
        $person->load('list_subscribers.broadcast_list', 'messages.broadcast_message');
        $available_broadcast_lists = BroadcastList::whereDoesntHave('list_subscribers', function ($query) use ($person)  {
            $query->where('person_id', '=', $person->id);
        })->get();  
        return view('person.show', compact('person', 'available_broadcast_lists'));
    }

    public function update(Request $request, Person $person)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'string|max:255',
            'zipcode' => 'integer',
            'city' => 'string|max:255',
            'mobile_phone' => 'max:255',
            'landline' => 'max:255',
            'mobile_phone' => 'max:255',
            'university' => 'string|max:255',
            'major' => 'string|max:255',
            'email' => 'email|max:255',
            'messageable' => 'boolean',
            'comments' => '',
        ]);

        if ($this->mobile_phone_changed($request, $person)){
            $person->mobile_phone_status = 'checking';
        }

        $person->update($request->all());

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

    /**
     * @param Request $request
     * @param Person $person
     * @return bool
     */
    private function mobile_phone_changed(Request $request, Person $person): bool
    {
        return $request->mobile_phone !== $person->mobile_phone;
    }
}
