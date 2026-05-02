@extends('layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')
@section('subheader', 'Welcome back, ' . Auth::user()->name . '. Here\'s what\'s happening.')

@section('content')

{{-- Stats Row --}}
<div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px; margin-bottom: 24px;">

    @php
    $stats = [
        ['label' => 'Total Properties', 'value' => $totalProperties,     'color' => '#6366F1', 'bg' => '#EEF2FF', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 3l9 6.75V21H3V9.75z"/>'],
        ['label' => 'Available',        'value' => $availableProperties,  'color' => '#16A34A', 'bg' => '#F0FDF4', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>'],
        ['label' => 'Sold',             'value' => $soldProperties,       'color' => '#DC2626', 'bg' => '#FEF2F2', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>'],
        ['label' => 'Clients',          'value' => $totalClients,         'color' => '#D97706', 'bg' => '#FFFBEB', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h5M12 12a4 4 0 100-8 4 4 0 000 8z"/>'],
        ['label' => 'Transactions',     'value' => $totalTransactions,    'color' => '#7C3AED', 'bg' => '#F5F3FF', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>'],
    ];
    @endphp

    @foreach($stats as $stat)
    <div style="background: white; border: 1px solid #E5E7EB; border-radius: 12px; padding: 20px; display: flex; flex-direction: column; gap: 12px;">
        <div style="width: 38px; height: 38px; background: {{ $stat['bg'] }}; border-radius: 9px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <svg width="18" height="18" fill="none" stroke="{{ $stat['color'] }}" stroke-width="2" viewBox="0 0 24 24">{!! $stat['icon'] !!}</svg>
        </div>
        <div>
            <div style="font-size: 26px; font-weight: 700; color: #111827; line-height: 1; margin-bottom: 4px;">{{ $stat['value'] }}</div>
            <div style="font-size: 12px; font-weight: 500; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px;">{{ $stat['label'] }}</div>
        </div>
    </div>
    @endforeach

</div>

{{-- Bottom Row --}}
<div style="display: grid; grid-template-columns: 260px 1fr; gap: 20px;">

    {{-- Quick Links --}}
    <div style="background: white; border: 1px solid #E5E7EB; border-radius: 12px; padding: 20px;">
        <div style="font-size: 11px; font-weight: 700; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 14px;">Quick Actions</div>
        <nav style="display: flex; flex-direction: column; gap: 2px;">

            <a href="{{ route('properties.index') }}" style="display: flex; align-items: center; gap: 10px; padding: 9px 10px; border-radius: 8px; text-decoration: none; color: #374151; font-size: 13px; font-weight: 500; transition: all 0.15s;"
               onmouseover="this.style.background='#F5F3FF'; this.style.color='#6366F1';"
               onmouseout="this.style.background=''; this.style.color='#374151';">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="opacity: 0.5;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 3l9 6.75V21H3V9.75z"/>
                </svg>
                View Properties
            </a>

            @if(auth()->user()->isAdmin())
            <a href="{{ route('properties.create') }}" style="display: flex; align-items: center; gap: 10px; padding: 9px 10px; border-radius: 8px; text-decoration: none; color: #374151; font-size: 13px; font-weight: 500; transition: all 0.15s;"
               onmouseover="this.style.background='#F5F3FF'; this.style.color='#6366F1';"
               onmouseout="this.style.background=''; this.style.color='#374151';">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="opacity: 0.5;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Add Property
            </a>
            @endif

            @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
            <a href="{{ route('clients.index') }}" style="display: flex; align-items: center; gap: 10px; padding: 9px 10px; border-radius: 8px; text-decoration: none; color: #374151; font-size: 13px; font-weight: 500; transition: all 0.15s;"
               onmouseover="this.style.background='#F5F3FF'; this.style.color='#6366F1';"
               onmouseout="this.style.background=''; this.style.color='#374151';">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="opacity: 0.5;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h5M12 12a4 4 0 100-8 4 4 0 000 8z"/>
                </svg>
                View Clients
            </a>

            <a href="{{ route('transactions.index') }}" style="display: flex; align-items: center; gap: 10px; padding: 9px 10px; border-radius: 8px; text-decoration: none; color: #374151; font-size: 13px; font-weight: 500; transition: all 0.15s;"
               onmouseover="this.style.background='#F5F3FF'; this.style.color='#6366F1';"
               onmouseout="this.style.background=''; this.style.color='#374151';">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="opacity: 0.5;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                </svg>
                View Transactions
            </a>

            <div style="height: 1px; background: #F3F4F6; margin: 6px 0;"></div>

            <a href="{{ route('transactions.create') }}" style="display: flex; align-items: center; gap: 10px; padding: 9px 10px; border-radius: 8px; text-decoration: none; color: #6366F1; font-size: 13px; font-weight: 600; background: #EEF2FF; transition: all 0.15s;"
               onmouseover="this.style.background='#E0E7FF';"
               onmouseout="this.style.background='#EEF2FF';">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                New Transaction
            </a>
            @endif

        </nav>
    </div>

    {{-- Recent Transactions --}}
    <div style="background: white; border: 1px solid #E5E7EB; border-radius: 12px; padding: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
            <div style="font-size: 11px; font-weight: 700; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.8px;">Recent Transactions</div>
            <a href="{{ route('transactions.index') }}" style="font-size: 12px; font-weight: 600; color: #6366F1; text-decoration: none;"
               onmouseover="this.style.textDecoration='underline'"
               onmouseout="this.style.textDecoration='none'">View all →</a>
        </div>

        @if($recentTransactions->isEmpty())
            <div style="text-align: center; padding: 32px 0;">
                <div style="width: 44px; height: 44px; background: #F9FAFB; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                    <svg width="20" height="20" fill="none" stroke="#D1D5DB" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6h6v6M9 11V7h6v4"/>
                    </svg>
                </div>
                <p style="font-size: 13px; color: #9CA3AF; margin: 0;">No transactions recorded yet.</p>
            </div>
        @else
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #F3F4F6;">
                        <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 0 0 10px; text-align: left;">Property</th>
                        <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 0 0 10px; text-align: left;">Client</th>
                        <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 0 0 10px; text-align: left;">Type</th>
                        <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 0 0 10px; text-align: right;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentTransactions as $transaction)
                    <tr style="border-bottom: 1px solid #F9FAFB;" onmouseover="this.style.background='#FAFAFA'" onmouseout="this.style.background=''">
                        <td style="padding: 12px 0; font-size: 14px; font-weight: 600; color: #111827;">{{ $transaction->property->address ?? 'N/A' }}</td>
                        <td style="padding: 12px 0; font-size: 14px; color: #4B5563;">{{ $transaction->client->name ?? 'N/A' }}</td>
                        <td style="padding: 12px 0;">
                            @if($transaction->type === 'bought')
                                <span style="background: #F0FDF4; color: #15803D; font-size: 11px; font-weight: 600; padding: 3px 9px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.3px;">Bought</span>
                            @elseif($transaction->type === 'rented')
                                <span style="background: #EFF6FF; color: #1D4ED8; font-size: 11px; font-weight: 600; padding: 3px 9px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.3px;">Rented</span>
                            @else
                                <span style="background: #F5F3FF; color: #6D28D9; font-size: 11px; font-weight: 600; padding: 3px 9px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.3px;">{{ ucfirst($transaction->type) }}</span>
                            @endif
                        </td>
                        <td style="padding: 12px 0; font-size: 13px; color: #9CA3AF; text-align: right;">{{ $transaction->transaction_date->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</div>

@endsection