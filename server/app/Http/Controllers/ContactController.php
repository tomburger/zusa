<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $vendor)
    {
        $entries = Contact::where('vendor_id', $vendor)->get();
        return view('contacts.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $vendor)
    {
        $entry = new Contact();
        $entry->vendor_id = $vendor;
        return view('contacts.create', compact('entry'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $vendor)
    {
        $post = new Contact();
        $post->name = $request->input("name");
        $post->vendor_id = $vendor;
        $post->phone = $request->input("phone");
        $post->email = $request->input("email");
        $post->notes = $request->input("notes");
        if ($post->save()) {
            return redirect()->route('vendors.show', ['vendor' => $vendor])->with('success', 'Contact created successfully.');
        }
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
    public function edit(string $vendor, string $id)
    {
        $entry = Contact::findOrFail($id); 
        return view('contacts.edit', compact('entry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $vendor, string $id)
    {
        $post = Contact::findOrFail($id);
        $post->name = $request->input("name");
        $post->phone = $request->input("phone");
        $post->email = $request->input("email");
        $post->notes = $request->input("notes");
        if ($post->save()) {
            return redirect()->route('vendors.show', ['vendor' => $vendor])->with('success', "Contact $post->name updated successfully.");
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
