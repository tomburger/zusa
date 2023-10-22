<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserUi;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get()->map(fn ($u) => new UserUi($u));
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = new UserUi(User::findOrFail($id));
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = User::findOrFail($id);
        $post->name = $request->input("name");
        $post->profile = $request->input("profile");
        if ($post->save()) {
            return redirect()->route('users.index')->with('success', "User $post->name updated successfully.");
        }
    }

    public function activate(Request $request, string $id)
    {
        $post = User::findOrFail($id);
        if ($post->active) {
            $post->active = false;
        } 
        else {
            $post->active = true;
        }
        if ($post->save()) {
            return redirect()->route('users.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
