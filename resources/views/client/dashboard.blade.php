@extends('layouts.app')

@section('header')
    Welcome, {{ Auth::user()->name }}
@endsection

@section('content')

    {{-- Welcome Banner --}}
    <div style="background:linear-gradient(135deg,#1E1B4B 0%,#4338CA 100%);border-radius:14px;padding:24px 28px;margin-bottom:28px;">
        <h3 style="font-size:20px;font-weight:700;color:white;margin:0;">Find Your Dream Property</h3>
        <p style="font-size:13px;color:rgba(255,255,255,0.6);margin:4px 0 0;">
            Browse available listings, track your transactions, and manage your profile.
            &nbsp;·&nbsp; {{ now()->format('l, F j, Y') }}
        </p>
    </div>

    {{-- Stats Row --}}
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:28px;">

        <div style="background:white;border:1px solid #E5E7EB;border-radius:12px;padding:20px 24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                <p style="font-size:12px;font-weight:600;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.5px;margin:0;">Available Properties</p>
                <div style="width:36px;height:36px;background:#EEF2FF;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <svg width="16" height="16" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 3l9 6.75V21H3V9.75z"/></svg>
                </div>
            </div>
            <p style="font-size:28px;font-weight:700;color:#111827;margin:0;">{{ $availableProperties->count() }}</p>
            <p style="font-size:12px;color:#9CA3AF;margin:4px 0 0;">Ready to buy or rent</p>
        </div>

        <div style="background:white;border:1px solid #E5E7EB;border-radius:12px;padding:20px 24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                <p style="font-size:12px;font-weight:600;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.5px;margin:0;">My Transactions</p>
                <div style="width:36px;height:36px;background:#F0FDF4;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <svg width="16" height="16" fill="none" stroke="#16A34A" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
            </div>
            <p style="font-size:28px;font-weight:700;color:#111827;margin:0;">{{ $myTransactions->count() }}</p>
            <p style="font-size:12px;color:#9CA3AF;margin:4px 0 0;">Active deals</p>
        </div>

        <div style="background:white;border:1px solid #E5E7EB;border-radius:12px;padding:20px 24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                <p style="font-size:12px;font-weight:600;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.5px;margin:0;">Profile</p>
                <div style="width:36px;height:36px;background:#FEF9C3;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <svg width="16" height="16" fill="none" stroke="#CA8A04" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
            </div>
            <p style="font-size:14px;font-weight:600;color:#111827;margin:0;">{{ Auth::user()->name }}</p>
            <a href="{{ route('profile.edit') }}" style="font-size:12px;color:#6366F1;text-decoration:none;margin-top:4px;display:inline-block;"
               onmouseover="this.style.textDecoration='underline'"
               onmouseout="this.style.textDecoration='none'">Edit profile →</a>
        </div>

    </div>

    {{-- Available Properties --}}
    <div style="background:white;border:1px solid #E5E7EB;border-radius:12px;overflow:hidden;margin-bottom:24px;">
        <div style="padding:18px 24px;border-bottom:1px solid #F3F4F6;display:flex;align-items:center;justify-content:space-between;">
            <div>
                <div style="font-size:15px;font-weight:600;color:#111827;">Available Properties</div>
                <div style="font-size:13px;color:#9CA3AF;margin-top:1px;">Browse listings you can buy or rent</div>
            </div>
            <a href="{{ route('properties.index') }}"
               style="font-size:13px;font-weight:600;color:#6366F1;text-decoration:none;"
               onmouseover="this.style.textDecoration='underline'"
               onmouseout="this.style.textDecoration='none'">View all →</a>
        </div>

        @if($availableProperties->isEmpty())
            <p style="font-size:13px;color:#9CA3AF;text-align:center;padding:32px 0;">No available properties at the moment.</p>
        @else
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;padding:20px 24px;">
            @foreach($availableProperties->take(6) as $property)
            <div style="border:1px solid #E5E7EB;border-radius:10px;padding:16px;transition:box-shadow 0.2s;"
                 onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.08)'"
                 onmouseout="this.style.boxShadow='none'">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
                    <span style="background:#EEF2FF;color:#4F46E5;font-size:11px;font-weight:600;padding:3px 8px;border-radius:6px;text-transform:uppercase;">{{ $property->type }}</span>
                    <span style="background:#F0FDF4;color:#15803D;border:1px solid #BBF7D0;font-size:11px;font-weight:600;padding:3px 8px;border-radius:20px;">Available</span>
                </div>
                <p style="font-size:14px;font-weight:600;color:#111827;margin:0 0 6px;">{{ $property->address }}</p>
                <p style="font-size:16px;font-weight:700;color:#4F46E5;margin:0 0 8px;">₱{{ number_format($property->price, 2) }}</p>
                @if($property->bedrooms || $property->bathrooms)
                <p style="font-size:12px;color:#9CA3AF;margin:0;">
                    @if($property->bedrooms) {{ $property->bedrooms }} bed @endif
                    @if($property->bedrooms && $property->bathrooms) · @endif
                    @if($property->bathrooms) {{ $property->bathrooms }} bath @endif
                </p>
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- My Transactions --}}
    @if($myTransactions->isNotEmpty())
    <div style="background:white;border:1px solid #E5E7EB;border-radius:12px;overflow:hidden;">
        <div style="padding:18px 24px;border-bottom:1px solid #F3F4F6;">
            <div style="font-size:15px;font-weight:600;color:#111827;">My Transaction History</div>
            <div style="font-size:13px;color:#9CA3AF;margin-top:1px;">Your property deals and their current status</div>
        </div>
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#FAFAFA;border-bottom:1px solid #F3F4F6;">
                    <th style="font-size:11px;font-weight:600;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.5px;padding:12px 24px;text-align:left;">Property</th>
                    <th style="font-size:11px;font-weight:600;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.5px;padding:12px 16px;text-align:left;">Type</th>
                    <th style="font-size:11px;font-weight:600;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.5px;padding:12px 16px;text-align:left;">Amount</th>
                    <th style="font-size:11px;font-weight:600;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.5px;padding:12px 16px;text-align:left;">Date</th>
                    <th style="font-size:11px;font-weight:600;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.5px;padding:12px 16px;text-align:left;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($myTransactions as $t)
                <tr style="border-bottom:1px solid #F9FAFB;">
                    <td style="padding:14px 24px;font-size:14px;font-weight:600;color:#111827;">{{ $t->property->address ?? '—' }}</td>
                    <td style="padding:14px 16px;">
                        @if($t->type === 'buy')
                            <span style="background:#F0FDF4;color:#15803D;border:1px solid #BBF7D0;font-size:11px;font-weight:600;padding:2px 8px;border-radius:20px;">Buy</span>
                        @elseif($t->type === 'rent')
                            <span style="background:#EFF6FF;color:#1D4ED8;border:1px solid #BFDBFE;font-size:11px;font-weight:600;padding:2px 8px;border-radius:20px;">Rent</span>
                        @else
                            <span style="background:#F5F3FF;color:#6D28D9;border:1px solid #DDD6FE;font-size:11px;font-weight:600;padding:2px 8px;border-radius:20px;">Sell</span>
                        @endif
                    </td>
                    <td style="padding:14px 16px;font-size:13px;font-weight:600;color:#111827;">₱{{ number_format($t->amount, 2) }}</td>
                    <td style="padding:14px 16px;font-size:13px;color:#6B7280;">{{ $t->transaction_date->format('M d, Y') }}</td>
                    <td style="padding:14px 16px;">
                        @if($t->status === 'completed')
                            <span style="background:#F0FDF4;color:#15803D;border:1px solid #BBF7D0;font-size:11px;font-weight:600;padding:2px 8px;border-radius:20px;">Completed</span>
                        @elseif($t->status === 'cancelled')
                            <span style="background:#FEF2F2;color:#DC2626;border:1px solid #FECACA;font-size:11px;font-weight:600;padding:2px 8px;border-radius:20px;">Cancelled</span>
                        @else
                            <span style="background:#FEFCE8;color:#92400E;border:1px solid #FDE68A;font-size:11px;font-weight:600;padding:2px 8px;border-radius:20px;">Pending</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

@endsection