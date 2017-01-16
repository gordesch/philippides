<?php

namespace App\Http\Controllers;

use App\VirtualNumber;
use Illuminate\Http\Request;

class VirtualNumberController extends Controller
{
    public function index()
    {
        $virtual_numbers = VirtualNumber::all()->load('sections');
        return view('admin.virtual_number.index', compact('virtual_numbers'));
    }

    public function create()
    {
        return view('admin.virtual_number.create', [
            'virtual_number' => new VirtualNumber
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $virtual_number = new VirtualNumber;
        $virtual_number->name = $request->name;
        $virtual_number->number = $request->number;
        $virtual_number->type = $request->type;
        $virtual_number->save();

        session()->flash('flash_message', 'Numéro virtuel créé');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('virtual_number.show', [$virtual_number]);
    }

    public function show(VirtualNumber $virtual_number)
    {
        $sections = $virtual_number->sections();
        return view('admin.virtual_number.show', compact('virtual_number', 'sections'));
    }

    public function update(Request $request, VirtualNumber $virtual_number)
    {
        $virtual_number->update($request->all());
        $virtual_number->save();

        session()->flash('flash_message', 'Numéro virtuel modifié');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('virtual_number.show', [$virtual_number]);
    }

    public function destroy(VirtualNumber $virtual_number)
    {
        $virtual_number->delete();

        session()->flash('flash_message', 'Numéro virtuel supprimé');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('virtual_number.index');
    }
}
