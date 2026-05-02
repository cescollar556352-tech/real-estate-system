<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::latest()->paginate(10);
        return view('properties.index', compact('properties'));
    }

    public function create()
    {
        return view('properties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'price'   => 'required|numeric|min:0',
            'type'    => 'required|in:house,condo,lot,commercial',
        ]);
        Property::create($request->only('address', 'price', 'type'));
        return redirect()->route('properties.index')->with('success', 'Property added.');
    }

    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'price'   => 'required|numeric|min:0',
            'type'    => 'required|in:house,condo,lot,commercial',
            'status'  => 'required|in:available,sold',
        ]);
        $property->update($request->only('address', 'price', 'type', 'status'));
        return redirect()->route('properties.index')->with('success', 'Property updated.');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('properties.index')->with('success', 'Property deleted.');
    }
}