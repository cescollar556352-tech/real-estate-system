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
        $request->validate([
            'property_id'      => 'required|exists:properties,id',
            'client_id'        => 'required|exists:clients,id',
            'type'             => 'required|in:bought,rented',
            'transaction_date' => 'required|date',
        ]);

        Transaction::create([
            'property_id'      => $request->property_id,
            'client_id'        => $request->client_id,
            'user_id'          => auth()->id(),
            'type'             => $request->type,
            'transaction_date' => $request->transaction_date,
        ]);

        if ($request->type === 'bought') {
            Property::find($request->property_id)->update(['status' => 'sold']);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction recorded.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted.');
    }
}