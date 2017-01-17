<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all()->load('role');
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create', [
            'user' => new User
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->global = $request->global;
        $user->save();

        session()->flash('flash_message', 'Utilisateur·rice créé·e');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('user.show', [$user]);
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        session()->flash('flash_message', 'Utilisateur·rice modifié·e');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('user.show', [$user]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        session()->flash('flash_message', 'Utilisateur·rice supprimé·e');
        session()->flash('flash_message_type', 'success');

        return redirect()->route('user.index');
    }
}
