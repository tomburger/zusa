<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('warehouse.read');
        $entries = Warehouse::get();
        return view('warehouses.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('warehouse.write');
        return view('warehouses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('warehouse.write');
        $post = new Warehouse();
        $post->name = $request->input("name");
        $post->notes = $request->input("notes");
        if ($post->save()) {
            return redirect()->route('warehouses.index')->with('success', 'Warehouse created successfully.');
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
    public function edit(string $id)
    {
        $this->authorize('warehouse.write');
        $entry = Warehouse::findOrFail($id); 
        return view('warehouses.edit', compact('entry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('warehouse.write');
        $post = Warehouse::findOrFail($id);
        $post->name = $request->input("name");
        $post->notes = $request->input("notes");
        if ($post->save()) {
            return redirect()->route('warehouses.index')->with('success', "Warehouse $post->name updated successfully.");
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
