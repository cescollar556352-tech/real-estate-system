@extends('layouts.app')

@section('header')
    Dashboard
@endsection

@section('content')

    {{-- Welcome Banner --}}
    <div style="background: linear-gradient(135deg, #1E1B4B 0%, #4338CA 100%); border-radius: 14px; padding: 24px 28px; margin-bottom: 28px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
        <div>
            <h3 style="font-size: 20px; font-weight: 700; color: white; margin: 0;">Welcome back, {{ Auth::user()->name }}</h3>
            <p style="font-size: 13px; color: rgba(255,255,255,0.6); margin: 4px 0 0;">
                Role: <span style="font-weight: 600; color: rgba(255,255,255,0.9); text-transform: capitalize;">{{ Auth::user()->role }}</span>
                &nbsp;·&nbsp; {{ now()->format('l, F j, Y') }}
            </p>
        </div>
        @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
        <a href="{{ route('transactions.create') }}"
           style="display: inline-flex; align-items: center; gap: 6px; background: rgba(255,255,255,0.15); color: white; font-size: 13px; font-weight: 600; padding: 9px 18px; border-radius: 8px; text-decoration: none; border: 1px solid rgba(255,255,255,0.25);"
           onmouseover="this.style.background='rgba(255,255,255,0.25)'"
           onmouseout="this.style.background='rgba(255,255,255,0.15)'">
            <svg width="14" height="14" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            New Transaction
        </a>
        @endif
    </div>

    {{-- Stats Cards Row 1 --}}
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 16px;">

        {{-- Total Properties --}}
        <div style="background: white; border: 1px solid #E5E7EB; border-radius: 12px; padding: 20px 24px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <p style="font-size: 12px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">Total Properties</p>
                <div style="width: 36px; height: 36px; background: #EEF2FF; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <svg width="16" height="16" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 3l9 6.75V21H3V9.75z"/>
                    </svg>
                </div>
            </div>
            <p style="font-size: 28px; font-weight: 700; color: #111827; margin: 0;">{{ $totalProperties }}</p>
            <p style="font-size: 12px; color: #9CA3AF; margin: 4px 0 0;">All listings</p>
        </div>

        {{-- Available --}}
        <div style="background: white; border: 1px solid #E5E7EB; border-radius: 12px; padding: 20px 24px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <p style="font-size: 12px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">Available</p>
                <div style="width: 36px; height: 36px; background: #F0FDF4; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <svg width="16" height="16" fill="none" stroke="#16A34A" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>
            <p style="font-size: 28px; font-weight: 700; color: #111827; margin: 0;">{{ $availableProperties }}</p>
            <p style="font-size: 12px; color: #9CA3AF; margin: 4px 0 0;">Ready for sale/rent</p>
        </div>

        {{-- Sold --}}
        <div style="background: white; border: 1px solid #E5E7EB; border-radius: 12px; padding: 20px 24px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <p style="font-size: 12px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">Sold</p>
                <div style="width: 36px; height: 36px; background: #FEF2F2; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <svg width="16" height="16" fill="none" stroke="#DC2626" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
            </div>
            <p style="font-size: 28px; font-weight: 700; color: #111827; margin: 0;">{{ $soldProperties }}</p>
            <p style="font-size: 12px; color: #9CA3AF; margin: 4px 0 0;">Properties sold</p>
        </div>

        {{-- Rented --}}
        <div style="background: white; border: 1px solid #E5E7EB; border-radius: 12px; padding: 20px 24px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <p style="font-size: 12px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">Rented</p>
                <div style="width: 36px; height: 36px; background: #EFF6FF; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <svg width="16" height="16" fill="none" stroke="#1D4ED8" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <p style="font-size: 28px; font-weight: 700; color: #111827; margin: 0;">{{ $rentedProperties }}</p>
            <p style="font-size: 12px; color: #9CA3AF; margin: 4px 0 0;">Currently rented</p>
        </div>

    </div>

    {{-- Stats Cards Row 2 --}}
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 28px;">

        {{-- Total Clients --}}
        <div style="background: white; border: 1px solid #E5E7EB; border-radius: 12px; padding: 20px 24px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <p style="font-size: 12px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">Total Clients</p>
                <div style="width: 36px; height: 36px; background: #FEF9C3; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <svg width="16" height="16" fill="none" stroke="#CA8A04" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h5M12 12a4 4 0 100-8 4 4 0 000 8z"/>
                    </svg>
                </div>
            </div>
            <p style="font-size: 28px; font-weight: 700; color: #111827; margin: 0;">{{ $totalClients }}</p>
            <p style="font-size: 12px; color: #9CA3AF; margin: 4px 0 0;">Registered clients</p>
        </div>

        {{-- Total Transactions --}}
        <div style="background: white; border: 1px solid #E5E7EB; border-radius: 12px; padding: 20px 24px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <p style="font-size: 12px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">Transactions</p>
                <div style="width: 36px; height: 36px; background: #F5F3FF; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <svg width="16" height="16" fill="none" stroke="#7C3AED" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
            <p style="font-size: 28px; font-weight: 700; color: #111827; margin: 0;">{{ $totalTransactions }}</p>
            <p style="font-size: 12px; color: #9CA3AF; margin: 4px 0 0;">
                <span style="color: #F59E0B; font-weight: 600;">{{ $pendingTransactions }}</span> pending
            </p>
        </div>

        {{-- Total Revenue --}}
        <div style="background: linear-gradient(135deg, #4F46E5, #6366F1); border-radius: 12px; padding: 20px 24px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <p style="font-size: 12px; font-weight: 600; color: rgba(255,255,255,0.7); text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">Total Revenue</p>
                <div style="width: 36px; height: 36px; background: rgba(255,255,255,0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <svg width="16" height="16" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                </div>
            </div>
            <p style="font-size: 24px; font-weight: 700; color: white; margin: 0;">₱{{ number_format($totalRevenue, 2) }}</p>
            <p style="font-size: 12px; color: rgba(255,255,255,0.6); margin: 4px 0 0;">From completed transactions</p>
        </div>

    </div>

    {{-- Bottom Section --}}
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px;">

        {{-- Quick Links --}}
        <div style="background: white; border: 1px solid #E5E7EB; border-radius: 12px; padding: 20px 24px;">
            <h4 style="font-size: 12px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 16px;">Quick Links</h4>
            <nav style="display: flex; flex-direction: column; gap: 4px;">
                <a href="{{ route('properties.index') }}"
                   style="display: flex; align-items: center; gap: 10px; padding: 9px 12px; border-radius: 8px; font-size: 13px; font-weight: 500; color: #374151; text-decoration: none;"
                   onmouseover="this.style.background='#EEF2FF'; this.style.color='#4F46E5';"
                   onmouseout="this.style.background=''; this.style.color='#374151';">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 3l9 6.75V21H3V9.75z"/>
                    </svg>
                    View Properties
                </a>
                @if(auth()->user()->isAdmin())
                <a href="{{ route('properties.create') }}"
                   style="display: flex; align-items: center; gap: 10px; padding: 9px 12px; border-radius: 8px; font-size: 13px; font-weight: 500; color: #374151; text-decoration: none;"
                   onmouseover="this.style.background='#EEF2FF'; this.style.color='#4F46E5';"
                   onmouseout="this.style.background=''; this.style.color='#374151';">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Property
                </a>
                @endif
                @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
                <a href="{{ route('clients.index') }}"
                   style="display: flex; align-items: center; gap: 10px; padding: 9px 12px; border-radius: 8px; font-size: 13px; font-weight: 500; color: #374151; text-decoration: none;"
                   onmouseover="this.style.background='#EEF2FF'; this.style.color='#4F46E5';"
                   onmouseout="this.style.background=''; this.style.color='#374151';">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h5M12 12a4 4 0 100-8 4 4 0 000 8z"/>
                    </svg>
                    View Clients
                </a>
                <a href="{{ route('clients.create') }}"
                   style="display: flex; align-items: center; gap: 10px; padding: 9px 12px; border-radius: 8px; font-size: 13px; font-weight: 500; color: #374151; text-decoration: none;"
                   onmouseover="this.style.background='#EEF2FF'; this.style.color='#4F46E5';"
                   onmouseout="this.style.background=''; this.style.color='#374151';">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Client
                </a>
                <a href="{{ route('transactions.index') }}"
                   style="display: flex; align-items: center; gap: 10px; padding: 9px 12px; border-radius: 8px; font-size: 13px; font-weight: 500; color: #374151; text-decoration: none;"
                   onmouseover="this.style.background='#EEF2FF'; this.style.color='#4F46E5';"
                   onmouseout="this.style.background=''; this.style.color='#374151';">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    View Transactions
                </a>
                <a href="{{ route('transactions.create') }}"
                   style="display: flex; align-items: center; gap: 10px; padding: 9px 12px; border-radius: 8px; font-size: 13px; font-weight: 500; color: #374151; text-decoration: none;"
                   onmouseover="this.style.background='#EEF2FF'; this.style.color='#4F46E5';"
                   onmouseout="this.style.background=''; this.style.color='#374151';">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    New Transaction
                </a>
                @endif
            </nav>
        </div>

        {{-- Recent Transactions --}}
        <div style="background: white; border: 1px solid #E5E7EB; border-radius: 12px; padding: 20px 24px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                <h4 style="font-size: 12px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">Recent Transactions</h4>
                <a href="{{ route('transactions.index') }}" style="font-size: 12px; font-weight: 600; color: #6366F1; text-decoration: none;"
                   onmouseover="this.style.textDecoration='underline'"
                   onmouseout="this.style.textDecoration='none'">View all →</a>
            </div>

            @if($recentTransactions->isEmpty())
                <p style="font-size: 13px; color: #9CA3AF; text-align: center; padding: 32px 0;">No transactions recorded yet.</p>
            @else
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #F3F4F6;">
                        <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 0 0 10px; text-align: left;">Property</th>
                        <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 0 0 10px 16px; text-align: left;">Client</th>
                        <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 0 0 10px 16px; text-align: left;">Type</th>
                        <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 0 0 10px 16px; text-align: left;">Amount</th>
                        <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 0 0 10px 16px; text-align: left;">Status</th>
                        <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 0 0 10px 16px; text-align: left;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentTransactions as $t)
                    <tr style="border-bottom: 1px solid #F9FAFB;"
                        onmouseover="this.style.background='#FAFAFA'"
                        onmouseout="this.style.background=''">
                        <td style="padding: 12px 0; font-size: 13px; font-weight: 600; color: #111827;">{{ $t->property->address ?? 'N/A' }}</td>
                        <td style="padding: 12px 16px; font-size: 13px; color: #6B7280;">{{ $t->client->full_name ?? $t->client->name ?? 'N/A' }}</td>
                        <td style="padding: 12px 16px;">
                            @if($t->type === 'buy')
                                <span style="background:#F0FDF4;color:#15803D;border:1px solid #BBF7D0;font-size:11px;font-weight:600;padding:2px 8px;border-radius:20px;text-transform:uppercase;">Buy</span>
                            @elseif($t->type === 'rent')
                                <span style="background:#EFF6FF;color:#1D4ED8;border:1px solid #BFDBFE;font-size:11px;font-weight:600;padding:2px 8px;border-radius:20px;text-transform:uppercase;">Rent</span>
                            @elseif($t->type === 'sell')
                                <span style="background:#F5F3FF;color:#6D28D9;border:1px solid #DDD6FE;font-size:11px;font-weight:600;padding:2px 8px;border-radius:20px;text-transform:uppercase;">Sell</span>
                            @endif
                        </td>
                        <td style="padding: 12px 16px; font-size: 13px; font-weight: 600; color: #111827; white-space: nowrap;">₱{{ number_format($t->amount, 2) }}</td>
                        <td style="padding: 12px 16px;">
                            @if($t->status === 'completed')
                                <span style="background:#F0FDF4;color:#15803D;border:1px solid #BBF7D0;font-size:11px;font-weight:600;padding:2px 8px;border-radius:20px;text-transform:uppercase;">Completed</span>
                            @elseif($t->status === 'cancelled')
                                <span style="background:#FEF2F2;color:#DC2626;border:1px solid #FECACA;font-size:11px;font-weight:600;padding:2px 8px;border-radius:20px;text-transform:uppercase;">Cancelled</span>
                            @else
                                <span style="background:#FEFCE8;color:#92400E;border:1px solid #FDE68A;font-size:11px;font-weight:600;padding:2px 8px;border-radius:20px;text-transform:uppercase;">Pending</span>
                            @endif
                        </td>
                        <td style="padding: 12px 16px; font-size: 12px; color: #9CA3AF; white-space: nowrap;">{{ $t->transaction_date->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>  

    </div>

@endsection