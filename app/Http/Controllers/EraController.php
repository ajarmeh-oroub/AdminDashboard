<?php

namespace App\Http\Controllers;

use App\Models\Era;
use Illuminate\Http\Request;

class EraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eras = Era::orderBy('id','desc')->get();
        return view('era.index', compact('eras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('era.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
   $validated= $request->validate([
       'era_name'=>'required|string|max:255',
       'start_year'=>'required|numeric',
       'end_year'=>'required|numeric',
   ]);
   $era=new Era();
   $era->era_name=$validated['era_name'];
   $era->start_year=$validated['start_year'];
   $era->end_year=$validated['end_year'];
   $era->save($validated);
   return redirect()->route('era.index')->with('success', 'Era created successfully');
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
        $era=Era::findorfail($id);
        return view('era.edit', compact('era'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated= $request->validate([
            'era_name'=>'required|string|max:255',
            'start_year'=>'required|numeric',
            'end_year'=>'required|numeric',
        ]);
        $era= Era::findorfail($id);
        $era->era_name=$validated['era_name'];
        $era->start_year=$validated['start_year'];
        $era->end_year=$validated['end_year'];
        $era->update($validated);
        return redirect()->route('era.index')->with('success', 'Era Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $era=Era::findorfail($id);
        $era->delete();
        return redirect()->route('era.index')->with('success', 'Era  deleted successfully');
    }
}
