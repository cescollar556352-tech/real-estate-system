<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Property;
use App\Models\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['property', 'client', 'user']);

        if ($request->filter === 'weekly') {
            $query->whereBetween('transaction_date', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek(),
            ]);
        } elseif ($request->filter === 'monthly') {
            $query->whereMonth('transaction_date', Carbon::now()->month)
                  ->whereYear('transaction_date', Carbon::now()->year);
        }

        $transactions = $query->latest('transaction_date')->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $properties = Property::where('status', 'available')->get();
        $clients    = Client::all();
        return view('transactions.create', compact('properties', 'clients'));
    }

    public function store(Request $request)
    {
        $rules = [
            'property_id'        => 'required|exists:properties,id',
            'client_id'          => 'required|exists:clients,id',
            'type'               => 'required|in:buy,rent,sell',
            'transaction_date'   => 'required|date',
            'amount'             => 'required|numeric|min:0',
            'contract_reference' => 'nullable|string|max:255',
            'status'             => 'required|in:pending,completed,cancelled',
        ];

        if ($request->type === 'rent') {
            $rules['lease_start_date'] = 'required|date';
            $rules['lease_end_date']   = 'required|date|after:lease_start_date';
            $rules['security_deposit'] = 'required|numeric|min:0';
        }

        $request->validate($rules);

        $data = [
            'property_id'        => $request->property_id,
            'client_id'          => $request->client_id,
            'user_id'            => auth()->id(),
            'type'               => $request->type,
            'transaction_date'   => $request->transaction_date,
            'amount'             => $request->amount,
            'contract_reference' => $request->contract_reference,
            'status'             => $request->status,
        ];

        if ($request->type === 'rent') {
            $data['lease_start_date'] = $request->lease_start_date;
            $data['lease_end_date']   = $request->lease_end_date;
            $data['security_deposit'] = $request->security_deposit;
        }

        Transaction::create($data);

        $property = Property::find($request->property_id);
        if ($request->type === 'buy' || $request->type === 'sell') {
            $property->update(['status' => 'sold']);
        } elseif ($request->type === 'rent') {
            $property->update(['status' => 'rented']);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction recorded successfully.');
    }

    public function edit(Transaction $transaction)
    {
        $properties = Property::all();
        $clients    = Client::all();
        return view('transactions.edit', compact('transaction', 'properties', 'clients'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $rules = [
            'property_id'        => 'required|exists:properties,id',
            'client_id'          => 'required|exists:clients,id',
            'type'               => 'required|in:buy,rent,sell',
            'transaction_date'   => 'required|date',
            'amount'             => 'required|numeric|min:0',
            'contract_reference' => 'nullable|string|max:255',
            'status'             => 'required|in:pending,completed,cancelled',
        ];

        if ($request->type === 'rent') {
            $rules['lease_start_date'] = 'required|date';
            $rules['lease_end_date']   = 'required|date|after:lease_start_date';
            $rules['security_deposit'] = 'required|numeric|min:0';
        }

        $request->validate($rules);

        $data = [
            'property_id'        => $request->property_id,
            'client_id'          => $request->client_id,
            'type'               => $request->type,
            'transaction_date'   => $request->transaction_date,
            'amount'             => $request->amount,
            'contract_reference' => $request->contract_reference,
            'status'             => $request->status,
            'lease_start_date'   => null,
            'lease_end_date'     => null,
            'security_deposit'   => null,
        ];

        if ($request->type === 'rent') {
            $data['lease_start_date'] = $request->lease_start_date;
            $data['lease_end_date']   = $request->lease_end_date;
            $data['security_deposit'] = $request->security_deposit;
        }

        $transaction->update($data);

        $property = Property::find($request->property_id);
        if ($request->type === 'buy' || $request->type === 'sell') {
            $property->update(['status' => 'sold']);
        } elseif ($request->type === 'rent') {
            $property->update(['status' => 'rented']);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted.');
    }
}