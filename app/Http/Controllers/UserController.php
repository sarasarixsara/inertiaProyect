<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(): \Inertia\Response
    {
        $users = User::all();
        return Inertia::render('User/Index', ['usersProp' => $users]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'qrCode' => 'required',
            'role_id' => 'required',
        ]);

        User::create($request->all());
        return redirect()->route('users.index')->with('status', 'Profile updated!');
    }

    public function create(User $users)
    {
        return Inertia::render('User/Create', ['users' => $users]);
    }

    public function show(User $user)
    {
        return Inertia::render('User/Show', ['user' => $user]);
    }

    public function update(Request $request, User $users)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'qrCode' => 'required',
            'role_id' => 'required',
        ]);

        $users->fill($request->post())->save();
        return redirect()->route('/users')->with('success','Company Has Been updated successfully');

    }

    public function destroy(User $users)
    {
        $users -> delete();
        return Inertia::render('User/Index')->with('success','Company has been created successfully.');
    }
}
