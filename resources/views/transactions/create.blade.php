@extends('layouts.app')

@section('header')
    Record Transaction
@endsection

@section('content')
<div style="max-width: 100%;">
    <div style="background: white; border-radius: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.08), 0 8px 24px rgba(0,0,0,0.06); overflow: hidden;">

        <div style="background: linear-gradient(135deg, #1E1B4B 0%, #312E81 100%); padding: 28px 32px; display: flex; align-items: center; gap: 16px;">
            <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg width="24" height="24" fill="none" stroke="white" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size: 20px; font-weight: 700; color: white; margin: 0; letter-spacing: -0.3px;">Record New Transaction</h2>
                <p style="font-size: 13px; color: rgba(255,255,255,0.55); margin: 3px 0 0;">Link a property and client to log a sale or rental</p>
            </div>
        </div>

        <form method="POST" action="{{ route('transactions.store') }}" style="padding: 32px;">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">

                <div style="grid-column: 1 / -1;">
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                        <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 3l9 6.75V21H3V9.75z"/>
                        </svg>
                        Property <span style="color: #EF4444;">*</span>
                    </label>
                    <select name="property_id" required
                            style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; background: white; appearance: none; background-image: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' stroke='%236B7280' stroke-width='2' viewBox='0 0 24 24'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E\"); background-repeat: no-repeat; background-position: right 14px center; box-sizing: border-box;"
                            onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                            onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                        <option value="">-- Select Property --</option>
                        @foreach($properties as $property)
                            <option value="{{ $property->id }}">{{ $property->address }} (₱{{ number_format($property->price, 2) }})</option>
                        @endforeach
                    </select>
                </div>

                <div style="grid-column: 1 / -1;">
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                        <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Client <span style="color: #EF4444;">*</span>
                    </label>
                    <select name="client_id" required
                            style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; background: white; appearance: none; background-image: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' stroke='%236B7280' stroke-width='2' viewBox='0 0 24 24'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E\"); background-repeat: no-repeat; background-position: right 14px center; box-sizing: border-box;"
                            onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                            onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                        <option value="">-- Select Client --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                        <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        Transaction Type <span style="color: #EF4444;">*</span>
                    </label>
                    <select name="type" required
                            style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; background: white; appearance: none; background-image: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' stroke='%236B7280' stroke-width='2' viewBox='0 0 24 24'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E\"); background-repeat: no-repeat; background-position: right 14px center; box-sizing: border-box;"
                            onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                            onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                        <option value="bought">Bought</option>
                        <option value="rented">Rented</option>
                    </select>
                </div>

                <div>
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                        <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Transaction Date <span style="color: #EF4444;">*</span>
                    </label>
                    <input type="date" name="transaction_date" required
                           style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; box-sizing: border-box;"
                           onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                           onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                </div>

            </div>

            <div style="border-top: 1px solid #F3F4F6; margin: 28px 0;"></div>

            <div style="display: flex; align-items: center; gap: 12px;">
                <button type="submit"
                        style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #4F46E5, #6366F1); color: white; font-size: 14px; font-weight: 600; padding: 11px 24px; border-radius: 10px; border: none; cursor: pointer; font-family: inherit; box-shadow: 0 2px 8px rgba(99,102,241,0.35);"
                        onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 14px rgba(99,102,241,0.45)';"
                        onmouseout="this.style.transform=''; this.style.boxShadow='0 2px 8px rgba(99,102,241,0.35)';">
                    <svg width="15" height="15" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Save Transaction
                </button>
                <a href="{{ route('transactions.index') }}"
                   style="display: inline-flex; align-items: center; gap: 8px; background: #F9FAFB; color: #6B7280; font-size: 14px; font-weight: 600; padding: 11px 20px; border-radius: 10px; text-decoration: none; border: 1.5px solid #E5E7EB; font-family: inherit;"
                   onmouseover="this.style.background='#F3F4F6'; this.style.color='#374151';"
                   onmouseout="this.style.background='#F9FAFB'; this.style.color='#6B7280';">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>
@endsection