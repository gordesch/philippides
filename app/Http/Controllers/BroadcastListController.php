<?php

namespace App\Http\Controllers;

use App\BroadcastList;
use Illuminate\Http\Request;
use App\Http\Requests;

class BroadcastListController extends Controller
{
    public function index()
    {
        $broadcast_lists = BroadcastList::all();
        return view('broadcast_list.index', compact('broadcast_lists'));
    }

    public function create()
    {
        return view('broadcast_list.create', compact('broadcast_list'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $broadcast_list = new BroadcastList;
        $broadcast_list->name = $request->name;
        $broadcast_list->slug = str_slug($broadcast_list->name);
        $broadcast_list->save();

        session()->flash('flash_message', 'Liste "' . $broadcast_list->name . '" créée');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('broadcast_list.index');
    }

    public function show(BroadcastList $broadcast_list)
    {
        $broadcast_list->load('list_subscribers.person', 'broadcast_messages');
        return view('broadcast_list.show', compact('broadcast_list'));
    }

    public function update(Request $request, BroadcastList $broadcast_list)
    {
        $broadcast_list->update($request->all());

        session()->flash('flash_message', 'Liste "' . $broadcast_list->name . '" modifiée');
        session()->flash('flash_message_type', 'success');

        return back();
    }

    public function destroy(Request $request, BroadcastList $broadcast_list)
    {
        $broadcast_list->delete();

        session()->flash('flash_message', 'Liste "' . $broadcast_list->name . '" supprimée');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('broadcast_list.index');
    }
}
