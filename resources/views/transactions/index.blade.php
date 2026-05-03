@extends('layouts.app')


@section('content')

{{-- Banner (header only, no button) --}}
<div style="background: linear-gradient(135deg, #1E1B4B 0%, #4338CA 100%); border-radius: 14px; padding: 24px 28px; margin-bottom: 24px;">
    <h3 style="font-size: 18px; font-weight: 700; color: white; margin: 0;">Transactions</h3>
    <p style="font-size: 13px; color: rgba(255,255,255,0.6); margin: 4px 0 0;">Track all property sales and rentals</p>
</div>

<div style="background: white; border: 1px solid #E5E7EB; border-radius: 12px; overflow: hidden;">

    <div style="padding: 18px 24px; border-bottom: 1px solid #F3F4F6; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
        <div>
            <div style="font-size: 15px; font-weight: 600; color: #111827;">All Transactions</div>
            <div style="font-size: 13px; color: #9CA3AF; margin-top: 1px;">{{ $transactions->total() }} total</div>
        </div>
        <div style="display: flex; align-items: center; gap: 10px;">
            <form method="GET">
                <select name="filter" onchange="this.form.submit()"
                        style="border: 1px solid #E5E7EB; border-radius: 8px; padding: 8px 32px 8px 12px; font-size: 13px; color: #374151; background: #F9FAFB url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%239CA3AF' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E\") no-repeat right 8px center / 14px; appearance: none; cursor: pointer; font-family: inherit; outline: none;">
                    <option value="">All Time</option>
                    <option value="weekly"  {{ request('filter') == 'weekly'  ? 'selected' : '' }}>This Week</option>
                    <option value="monthly" {{ request('filter') == 'monthly' ? 'selected' : '' }}>This Month</option>
                </select>
            </form>
            @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
            <a href="{{ route('transactions.create') }}"
               style="display: inline-flex; align-items: center; gap: 6px; background: #6366F1; color: white; font-size: 13px; font-weight: 600; padding: 9px 16px; border-radius: 8px; text-decoration: none; white-space: nowrap; font-family: inherit;"
               onmouseover="this.style.background='#4F46E5'"
               onmouseout="this.style.background='#6366F1'">
                <svg width="14" height="14" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Record Transaction
            </a>
            @endif
        </div>
    </div>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #FAFAFA; border-bottom: 1px solid #F3F4F6;">
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 24px; text-align: left;">Date</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Property</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Client</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Type</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Amount</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Contract Ref.</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Status</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Recorded By</th>
                    @if(auth()->user()->isAdmin())
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 24px; text-align: right;">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $t)
                <tr style="border-bottom: 1px solid #F9FAFB;"
                    onmouseover="this.style.background='#FAFAFA'"
                    onmouseout="this.style.background=''">
                    <td style="padding: 14px 24px; font-size: 13px; color: #6B7280; white-space: nowrap;">{{ $t->transaction_date->format('M d, Y') }}</td>
                    <td style="padding: 14px 16px; font-size: 14px; font-weight: 600; color: #111827;">{{ $t->property->address }}</td>
                    <td style="padding: 14px 16px;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <div style="width: 28px; height: 28px; background: #EEF2FF; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; color: #6366F1; flex-shrink: 0; text-transform: uppercase;">
                                {{ strtoupper(substr($t->client->first_name ?? $t->client->name ?? '?', 0, 1)) }}
                            </div>
                            <span style="font-size: 14px; color: #374151; font-weight: 500;">{{ $t->client->full_name ?? $t->client->name ?? '—' }}</span>
                        </div>
                    </td>
                    <td style="padding: 14px 16px;">
                        @if($t->type === 'buy')
                            <span style="background:#F0FDF4;color:#15803D;border:1px solid #BBF7D0;font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;text-transform:uppercase;letter-spacing:0.3px;">Buy</span>
                        @elseif($t->type === 'rent')
                            <span style="background:#EFF6FF;color:#1D4ED8;border:1px solid #BFDBFE;font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;text-transform:uppercase;letter-spacing:0.3px;">Rent</span>
                        @elseif($t->type === 'sell')
                            <span style="background:#F5F3FF;color:#6D28D9;border:1px solid #DDD6FE;font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;text-transform:uppercase;letter-spacing:0.3px;">Sell</span>
                        @endif
                    </td>
                    <td style="padding: 14px 16px;">
                        <div style="font-size: 14px; font-weight: 600; color: #111827; white-space: nowrap;">₱{{ number_format($t->amount, 2) }}</div>
                        @if($t->type === 'rent' && $t->security_deposit)
                            <div style="font-size: 11px; color: #9CA3AF; margin-top: 2px;">Deposit: ₱{{ number_format($t->security_deposit, 2) }}</div>
                        @endif
                    </td>
                    <td style="padding: 14px 16px; font-size: 13px; color: #6B7280;">{{ $t->contract_reference ?? '—' }}</td>
                    <td style="padding: 14px 16px;">
                        @if($t->status === 'completed')
                            <span style="background:#F0FDF4;color:#15803D;border:1px solid #BBF7D0;font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;text-transform:uppercase;letter-spacing:0.3px;">Completed</span>
                        @elseif($t->status === 'cancelled')
                            <span style="background:#FEF2F2;color:#DC2626;border:1px solid #FECACA;font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;text-transform:uppercase;letter-spacing:0.3px;">Cancelled</span>
                        @else
                            <span style="background:#FEFCE8;color:#92400E;border:1px solid #FDE68A;font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;text-transform:uppercase;letter-spacing:0.3px;">Pending</span>
                        @endif
                    </td>
                    <td style="padding: 14px 16px; font-size: 13px; color: #6B7280;">{{ $t->user->name }}</td>
                    @if(auth()->user()->isAdmin())
                    <td style="padding: 14px 24px; text-align: right;">
                        <div style="display: flex; align-items: center; justify-content: flex-end; gap: 8px;">
                            <a href="{{ route('transactions.edit', $t) }}"
                               style="font-size: 13px; font-weight: 600; color: #4F46E5; padding: 6px 12px; border: 1px solid #C7D2FE; border-radius: 7px; background: #EEF2FF; text-decoration: none;"
                               onmouseover="this.style.background='#E0E7FF'; this.style.borderColor='#A5B4FC';"
                               onmouseout="this.style.background='#EEF2FF'; this.style.borderColor='#C7D2FE';">Edit</a>
                            <form method="POST" action="{{ route('transactions.destroy', $t) }}" style="display: inline;" onsubmit="return confirm('Delete this transaction?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        style="font-size: 13px; font-weight: 600; color: #DC2626; padding: 6px 12px; border: 1px solid #FECACA; border-radius: 7px; cursor: pointer; background: #FEF2F2; font-family: inherit;"
                                        onmouseover="this.style.background='#FEE2E2'; this.style.borderColor='#FCA5A5';"
                                        onmouseout="this.style.background='#FEF2F2'; this.style.borderColor='#FECACA';">Delete</button>
                            </form>
                        </div>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="{{ auth()->user()->isAdmin() ? 9 : 8 }}" style="padding: 48px 24px; text-align: center;">
                        <p style="font-size: 14px; color: #9CA3AF; margin: 0; font-weight: 500;">No transactions found.</p>
                        @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
                        <a href="{{ route('transactions.create') }}" style="display: inline-block; margin-top: 12px; font-size: 13px; font-weight: 600; color: #6366F1; text-decoration: none;">Record your first transaction →</a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($transactions->hasPages())
    <div style="padding: 14px 24px; border-top: 1px solid #F3F4F6; background: #FAFAFA;">
        {{ $transactions->links() }}
    </div>
    @endif

</div>
@endsection