@extends('layouts.app')

@section('content')
<div>

    {{-- Header Card --}}
    <div style="background:linear-gradient(135deg,#312e81,#4338ca);border-radius:14px;padding:24px 28px;margin-bottom:24px;display:flex;align-items:center;gap:16px;">
        <div style="background:rgba(255,255,255,0.15);border-radius:10px;padding:10px;">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:24px;height:24px;display:block;" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
        </div>
        <div>
            <h2 style="color:#fff;font-size:1.25rem;font-weight:700;margin:0;">Record New Transaction</h2>
            <p style="color:rgba(255,255,255,0.65);font-size:0.875rem;margin:4px 0 0;">Link a property and client to log a sale or rental</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <form method="POST" action="{{ route('transactions.store') }}" class="space-y-6">
            @csrf

            {{-- Property --}}
            <div>
                <label style="display:flex;align-items:center;gap:6px;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;flex-shrink:0;display:block;margin-top:1px;" fill="none" viewBox="0 0 24 24" stroke="#6366f1" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 3l9 6.75V21a.75.75 0 01-.75.75H3.75A.75.75 0 013 21V9.75z" />
                    </svg>
                    Property <span style="color:#EF4444;">*</span>
                </label>
                <select name="property_id" required
                        class="w-full border @error('property_id') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    <option value="">-- Select Property --</option>
                    @foreach($properties as $property)
                        <option value="{{ $property->id }}" {{ old('property_id') == $property->id ? 'selected' : '' }}>
                            {{ $property->address }} (₱{{ number_format($property->price, 2) }})
                        </option>
                    @endforeach
                </select>
                @error('property_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Client --}}
            <div>
                <label style="display:flex;align-items:center;gap:6px;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;flex-shrink:0;display:block;margin-top:1px;" fill="none" viewBox="0 0 24 24" stroke="#6366f1" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Client <span style="color:#EF4444;">*</span>
                </label>
                <select name="client_id" required
                        class="w-full border @error('client_id') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    <option value="">-- Select Client --</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                            {{ $client->first_name }} {{ $client->last_name }}
                        </option>
                    @endforeach
                </select>
                @error('client_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Type + Date --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;align-items:end;">
                <div>
                    <label style="display:flex;align-items:center;gap:6px;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;flex-shrink:0;display:block;margin-top:1px;" fill="none" viewBox="0 0 24 24" stroke="#6366f1" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        Transaction Type <span style="color:#EF4444;">*</span>
                    </label>
                    <select name="type" id="type" required onchange="toggleRentalFields()"
                            style="width:100%;border:1px solid #D1D5DB;border-radius:8px;padding:8px 12px;font-size:0.875rem;color:#111827;font-family:inherit;outline:none;box-sizing:border-box;background:white;"
                            onfocus="this.style.borderColor='#6366F1';this.style.boxShadow='0 0 0 2px rgba(99,102,241,0.2)';"
                            onblur="this.style.borderColor='#D1D5DB';this.style.boxShadow='none';">
                        <option value="buy"  {{ old('type', 'buy') === 'buy'  ? 'selected' : '' }}>Buy</option>
                        <option value="rent" {{ old('type') === 'rent' ? 'selected' : '' }}>Rent</option>
                        <option value="sell" {{ old('type') === 'sell' ? 'selected' : '' }}>Sell</option>
                    </select>
                    @error('type')<p style="color:#EF4444;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label style="display:flex;align-items:center;gap:6px;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;flex-shrink:0;display:block;margin-top:1px;" fill="none" viewBox="0 0 24 24" stroke="#6366f1" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Transaction Date <span style="color:#EF4444;">*</span>
                    </label>
                    <input type="date" name="transaction_date" required value="{{ old('transaction_date') }}"
                           style="width:100%;border:1px solid #D1D5DB;border-radius:8px;padding:8px 12px;font-size:0.875rem;color:#111827;font-family:inherit;outline:none;box-sizing:border-box;"
                           onfocus="this.style.borderColor='#6366F1';this.style.boxShadow='0 0 0 2px rgba(99,102,241,0.2)';"
                           onblur="this.style.borderColor='#D1D5DB';this.style.boxShadow='none';">
                    @error('transaction_date')<p style="color:#EF4444;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Amount --}}
            <div>
                <label style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">
                    Transaction Amount <span style="color:#EF4444;">*</span>
                </label>
                <div style="position:relative;">
                    <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);font-size:0.875rem;font-weight:600;color:#6B7280;">₱</span>
                    <input type="number" name="amount" step="0.01" min="0" required value="{{ old('amount') }}"
                           placeholder="0.00"
                           style="width:100%;border:1px solid #D1D5DB;border-radius:8px;padding:8px 12px 8px 28px;font-size:0.875rem;color:#111827;font-family:inherit;outline:none;box-sizing:border-box;"
                           onfocus="this.style.borderColor='#6366F1';this.style.boxShadow='0 0 0 2px rgba(99,102,241,0.2)';"
                           onblur="this.style.borderColor='#D1D5DB';this.style.boxShadow='none';">
                </div>
                @error('amount')<p style="color:#EF4444;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>

            {{-- Rental Details (conditional) --}}
            <div id="rental-section" style="display:none;">
                <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;padding:16px 18px;">
                    <p style="display:flex;align-items:center;gap:6px;font-size:0.875rem;font-weight:700;color:#1d4ed8;margin:0 0 16px;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;flex-shrink:0;display:block;margin-top:1px;" fill="none" viewBox="0 0 24 24" stroke="#1d4ed8" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Rental Details
                    </p>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                        <div>
                            <label style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">Lease Start Date <span style="color:#EF4444;">*</span></label>
                            <input type="date" name="lease_start_date" id="lease_start_date" value="{{ old('lease_start_date') }}"
                                   style="width:100%;border:1px solid #D1D5DB;border-radius:8px;padding:8px 12px;font-size:0.875rem;color:#111827;font-family:inherit;outline:none;box-sizing:border-box;"
                                   onfocus="this.style.borderColor='#6366F1';this.style.boxShadow='0 0 0 2px rgba(99,102,241,0.2)';"
                                   onblur="this.style.borderColor='#D1D5DB';this.style.boxShadow='none';">
                            @error('lease_start_date')<p style="color:#EF4444;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">Lease End Date <span style="color:#EF4444;">*</span></label>
                            <input type="date" name="lease_end_date" id="lease_end_date" value="{{ old('lease_end_date') }}"
                                   style="width:100%;border:1px solid #D1D5DB;border-radius:8px;padding:8px 12px;font-size:0.875rem;color:#111827;font-family:inherit;outline:none;box-sizing:border-box;"
                                   onfocus="this.style.borderColor='#6366F1';this.style.boxShadow='0 0 0 2px rgba(99,102,241,0.2)';"
                                   onblur="this.style.borderColor='#D1D5DB';this.style.boxShadow='none';">
                            @error('lease_end_date')<p style="color:#EF4444;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">Security Deposit <span style="color:#EF4444;">*</span></label>
                        <div style="position:relative;">
                            <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);font-size:0.875rem;font-weight:600;color:#6B7280;">₱</span>
                            <input type="number" name="security_deposit" id="security_deposit" step="0.01" min="0" value="{{ old('security_deposit') }}"
                                   placeholder="0.00"
                                   style="width:100%;border:1px solid #D1D5DB;border-radius:8px;padding:8px 12px 8px 28px;font-size:0.875rem;color:#111827;font-family:inherit;outline:none;box-sizing:border-box;"
                                   onfocus="this.style.borderColor='#6366F1';this.style.boxShadow='0 0 0 2px rgba(99,102,241,0.2)';"
                                   onblur="this.style.borderColor='#D1D5DB';this.style.boxShadow='none';">
                        </div>
                        @error('security_deposit')<p style="color:#EF4444;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Status --}}
            <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:10px;padding:16px 18px;">
                <p style="display:flex;align-items:center;gap:6px;font-size:0.875rem;font-weight:700;color:#374151;margin:0 0 12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;flex-shrink:0;display:block;margin-top:1px;" fill="none" viewBox="0 0 24 24" stroke="#6366f1" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Status
                </p>
                <div>
                    <label style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">Transaction Status <span style="color:#EF4444;">*</span></label>
                    <select name="status" required
                            style="width:100%;border:1px solid #D1D5DB;border-radius:8px;padding:8px 12px;font-size:0.875rem;color:#111827;font-family:inherit;outline:none;box-sizing:border-box;background:white;"
                            onfocus="this.style.borderColor='#6366F1';this.style.boxShadow='0 0 0 2px rgba(99,102,241,0.2)';"
                            onblur="this.style.borderColor='#D1D5DB';this.style.boxShadow='none';">
                        <option value="pending"   {{ old('status', 'pending') === 'pending'   ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')<p style="color:#EF4444;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Buttons --}}
            <div style="display:flex;align-items:center;gap:12px;padding-top:4px;">
                <button type="submit"
                        style="display:inline-flex;align-items:center;gap:8px;background:#4f46e5;color:#fff;font-size:0.875rem;font-weight:600;padding:10px 22px;border-radius:8px;border:none;cursor:pointer;font-family:inherit;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;flex-shrink:0;display:block;" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Save Transaction
                </button>
                <a href="{{ route('transactions.index') }}"
                   style="background:#e5e7eb;color:#374151;font-size:0.875rem;font-weight:600;padding:10px 22px;border-radius:8px;text-decoration:none;display:inline-block;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function toggleRentalFields() {
    const type = document.getElementById('type').value;
    const section = document.getElementById('rental-section');
    const isRent = type === 'rent';

    section.style.display = isRent ? 'block' : 'none';

    ['lease_start_date', 'lease_end_date', 'security_deposit'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.required = isRent;
    });
}

document.addEventListener('DOMContentLoaded', toggleRentalFields);
</script>
@endsection