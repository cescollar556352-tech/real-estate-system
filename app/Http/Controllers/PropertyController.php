<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $query = Property::query();
if (request('status')) {
    $query->where('status', request('status'));
}
$properties = $query->latest()->paginate(10)->withQueryString();
        return view('properties.index', compact('properties'));
    }

    public function mark(Request $request, Property $property)
{
    $request->validate([
        'status' => 'required|in:available,sold,rented',
    ]);

    $property->update(['status' => $request->status]);

    return redirect()->route('properties.index', request()->only('status'))
                     ->with('success', 'Property status updated.');
}

    public function create()
    {
        return view('properties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'address'    => 'required|string|max:255',
            'price'      => 'required|numeric|min:0',
            'type'       => 'required|in:house,condo,lot,commercial',
            'status'     => 'required|in:available,sold,rented',
            'bedrooms'   => 'nullable|integer|min:0',
            'bathrooms'  => 'nullable|integer|min:0',
            'lot_area'   => 'nullable|numeric|min:0',
            'floor_area' => 'nullable|numeric|min:0',
        ]);

        Property::create($request->only(
            'address', 'price', 'type', 'status',
            'bedrooms', 'bathrooms', 'lot_area', 'floor_area'
        ));

        return redirect()->route('properties.index')->with('success', 'Property added.');
    }

    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $request->validate([
            'address'    => 'required|string|max:255',
            'price'      => 'required|numeric|min:0',
            'type'       => 'required|in:house,condo,lot,commercial',
            'status'     => 'required|in:available,sold,rented',
            'bedrooms'   => 'nullable|integer|min:0',
            'bathrooms'  => 'nullable|numeric|min:0',
            'lot_area'   => 'nullable|numeric|min:0',
            'floor_area' => 'nullable|numeric|min:0',
        ]);

        $property->update($request->only(
            'address', 'price', 'type', 'status',
            'bedrooms', 'bathrooms', 'lot_area', 'floor_area'
        ));

        return redirect()->route('properties.index')->with('success', 'Property updated.');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('properties.index')->with('success', 'Property deleted.');
    }
}