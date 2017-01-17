<?php

namespace App\Http\Controllers;

use App\Person;
use App\BroadcastList;
use Illuminate\Http\Request;

class BroadcastListController extends Controller
{
    public function index()
    {
        $broadcast_lists = BroadcastList::all();

        return view('broadcast_list.index', compact('broadcast_lists'));
    }

    public function create()
    {
        return view('broadcast_list.create', [
            'broadcast_list' => new BroadcastList
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $broadcast_list = new BroadcastList;
        $broadcast_list->name = $request->name;
        $broadcast_list->section_id = session('section')->id;
        $broadcast_list->save();

        session()->flash('flash_message', 'Liste créée');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('broadcast_list.show',[$broadcast_list]);
    }

    public function show(BroadcastList $broadcast_list)
    {
        $broadcast_list->load('list_subscribers', 'sendings');
        $available_list_subscribers = Person::whereDoesntHave('broadcast_lists', function ($query) use ($broadcast_list)  {
            $query->where('broadcast_list_id', '=', $broadcast_list->id);
        })->get();

        return view('broadcast_list.show', compact('broadcast_list', 'available_list_subscribers'));
    }

    public function update(Request $request, BroadcastList $broadcast_list)
    {
        $broadcast_list->update($request->all());

        session()->flash('flash_message', 'Liste modifiée');
        session()->flash('flash_message_type', 'success');

        return view('broadcast_list.show', compact('broadcast_list'));
    }

    public function destroy(BroadcastList $broadcast_list)
    {
        $broadcast_list->delete();

        session()->flash('flash_message', 'Liste supprimée');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('broadcast_list.index');
    }

    public function subscription(BroadcastList $broadcast_list)
    {
        $people = Person::all();

        return view('broadcast_list.subscription', compact('broadcast_list', 'people'));
    }

    public function subscribe(Request $request, BroadcastList $broadcast_list)
    {
        $broadcast_list->list_subscribers()->attach($request->person_id);

        session()->flash('flash_message', 'Contact ajouté à la liste');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('broadcast_list.show', [$broadcast_list]);
    }

    public function unsubscribe(Person $person, BroadcastList $broadcast_list)
    {
        $broadcast_list->list_subscribers()->detach($person->id);

        session()->flash('flash_message', 'Contact retiré de la liste');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('broadcast_list.show', [$broadcast_list]);
    }
}
