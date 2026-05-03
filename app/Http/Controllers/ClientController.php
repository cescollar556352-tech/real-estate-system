<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = Client::query();
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->search . '%')
                  ->orWhere('last_name',  'like', '%' . $request->search . '%')
                  ->orWhere('middle_name','like', '%' . $request->search . '%');
            });
        }
        $clients = $query->latest()->paginate(10);
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'    => 'required|string|max:100',
            'middle_name'   => 'nullable|string|max:100',
            'last_name'     => 'required|string|max:100',
            'date_of_birth' => 'nullable|date',
            'id_type'       => 'nullable|string|max:100',
            'id_number'     => 'nullable|string|max:100',
            'email'         => 'nullable|email',
            'phone'         => 'nullable|string|max:20',
            'address'       => 'nullable|string',
            'client_type'   => 'nullable|string|max:100',
        ]);

        Client::create($request->only(
            'first_name', 'middle_name', 'last_name',
            'date_of_birth', 'id_type', 'id_number',
            'email', 'phone', 'address', 'client_type'
        ));

        return redirect()->route('clients.index')->with('success', 'Client added.');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'first_name'    => 'required|string|max:100',
            'middle_name'   => 'nullable|string|max:100',
            'last_name'     => 'required|string|max:100',
            'date_of_birth' => 'nullable|date',
            'id_type'       => 'nullable|string|max:100',
            'id_number'     => 'nullable|string|max:100',
            'email'         => 'nullable|email',
            'phone'         => 'nullable|string|max:20',
            'address'       => 'nullable|string',
            'client_type'   => 'nullable|string|max:100',
        ]);

        $client->update($request->only(
            'first_name', 'middle_name', 'last_name',
            'date_of_birth', 'id_type', 'id_number',
            'email', 'phone', 'address', 'client_type'
        ));

        return redirect()->route('clients.index')->with('success', 'Client updated.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted.');
    }
}