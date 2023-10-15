<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Vendor;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::get();
        return view('vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::allows("vendor-create", Auth::user())) {
            abort(403);
        }

        return view('vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::allows("vendor-create", Auth::user())) {
            $post = new Vendor();
            $post->name = $request->input("name");
            $post->notes = $request->input("notes");
            if ($post->save()) {
                return redirect()->route('vendors.index')->with('success', 'Vendor created successfully.');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vendor = Vendor::findOrFail($id); 
        return view('vendors.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Gate::allows("vendor-edit", Auth::user())) {
            abort(403);
        }

        $vendor = Vendor::findOrFail($id); 
        return view('vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Gate::allows("vendor-edit", Auth::user())) {
            $post = Vendor::findOrFail($id);
            $post->name = $request->input("name");
            $post->notes = $request->input("notes");
            if ($post->save()) {
                return redirect()->route('vendors.index')->with('success', 'Vendor created successfully.');
            }
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
