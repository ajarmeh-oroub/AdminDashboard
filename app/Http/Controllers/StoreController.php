<?php

namespace App\Http\Controllers;
use App\Models\Store;
use App\Models\User;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::orderBy('id', 'desc')->with('users')->get();

        return view('store.index', compact('stores'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('store.create', compact('users'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255',
            'phone' => 'required|numeric',
            'address'=>'required|string|max:255',
            'description'=>'required|string|max:255',
            'owner_id'=>'required|integer',
            'active'=>'required|boolean',
            'password'=>'required|string',
        ]);
//dd($validated);
        $store=new Store();
        $store->name=$validated['name'];
        $store->email=$validated['email'];
        $store->phone=$validated['phone'];
        $store->address=$validated['address'];
        $store->description=$validated['description'];
        $store->owner_id=$validated['owner_id'];
        $store->password=$validated['password'];
        $store->active=$validated['active'];
        $store->save();
        return  redirect()->route('store.index')->with('message', 'Store created successfully!')
            ->with('alert-type', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $store = Store::with('users')->findOrFail($id);
return view('store.view', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function toggleStatus(string $id , int $visible)
    {
        $store = Store::findorfail($id);

        $store->active = $visible ? 0 : 1;
        $store->save();
        return redirect()->route('store.index');
    }
}
