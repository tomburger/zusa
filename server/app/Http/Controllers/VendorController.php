<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('vendor.read');
        $vendors = Vendor::get();
        return view('vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('vendor.write');
        return view('vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('vendor.write');
        $post = new Vendor();
        $post->name = $request->input("name");
        $post->notes = $request->input("notes");
        if ($post->save()) {
            return redirect()->route('vendors.index')->with('success', 'Vendor created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('vendor.read');
        $vendor = Vendor::findOrFail($id);
        return view('vendors.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('vendor.write');
        $vendor = Vendor::findOrFail($id); 
        return view('vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('vendor.write');
        $post = Vendor::findOrFail($id);
        $post->name = $request->input("name");
        $post->notes = $request->input("notes");
        if ($post->save()) {
            return redirect()->route('vendors.index')->with('success', "Vendor $post->name updated successfully.");
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
