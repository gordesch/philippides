<?php

namespace App\Http\Controllers;

use App\User;
use App\Section;
use App\VirtualNumber;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::all()->load('users');
        return view('admin.section.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.section.create', [
            'section' => new Section
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $section = new Section;
        $section->name = $request->name;
        $section->global = $request->global;
        $section->save();

        session()->flash('flash_message', 'Section créée');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('section.show', [$section]);
    }

    public function show(Section $section)
    {
        $section->load('virtual_number', 'users');
        $users = User::all();
        $virtual_numbers = VirtualNumber::all();
        return view('admin.section.show', compact('section', 'users', 'virtual_numbers'));
    }

    public function update(Request $request, Section $section)
    {
        $section->update($request->all());
        $section->save();

        session()->flash('flash_message', 'Section modifiée');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('section.show', [$section]);
    }

    public function destroy(Section $section)
    {
        $section->delete();

        session()->flash('flash_message', 'Section supprimée');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('section.index');
    }

    public function add_virtual_number(Request $request, Section $section)
    {
        $section->virtual_number_id = $request->virtual_number_id;
        $section->save();

        session()->flash('flash_message', 'Numéro virtuel ajouté');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('section.show', [$section]);
    }

    public function delete_virtual_number(Section $section)
    {
        $section->virtual_number_id = '';
        $section->save();

        session()->flash('flash_message', 'Numéro virtuel supprimé');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('section.show', [$section]);
    }
}
