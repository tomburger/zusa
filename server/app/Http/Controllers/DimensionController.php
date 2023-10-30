<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dimension;
use App\Models\UnitOfMeasure;

class DimensionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dimensions = Dimension::get();
        return view('dimensions.index', compact('dimensions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dimensions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Dimension();
        $post->name = $request->input("name");
        if ($post->save()) {
            return redirect()->route('dimensions.index')->with('success', 'Dimension created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dimension = Dimension::findOrFail($id); 
        return view('dimensions.show', compact('dimension'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dimension = Dimension::findOrFail($id); 
        return view('dimensions.edit', compact('dimension'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Dimension::findOrFail($id);
        $post->name = $request->input("name");
        if ($post->save()) {
            return redirect()->route('dimensions.index')->with('success', "Dimension $post->name updated successfully.");
        }
    }

    public function addUnit(string $id, Request $request)
    {
        $post = new UnitOfMeasure();
        $post->name = $request->input("name");
        $post->dimension_id = $id;
        if ($post->save()) {
            return redirect()->route('dimensions.show', ['dimension'=>$id]);
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
