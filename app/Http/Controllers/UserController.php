<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserUi;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('user.read');
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
        $this->authorize('user.write');
        $user = new UserUi(User::findOrFail($id));
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('user.write');
        $post = User::findOrFail($id);
        $post->name = $request->input("name");
        if ($post->save()) {
            $allRoles = Role::all();
            $assignedRoles = [];
            foreach ($allRoles as $role) {
                if ($request->input($role->name)) {
                    $assignedRoles[] = $role->name;
                }
            }
            $post->syncRoles($assignedRoles);

            return redirect()->route('users.index')->with('success', "User $post->name updated successfully.");
        }
    }

    public function activate(Request $request, string $id)
    {
        $this->authorize('user.write');
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
