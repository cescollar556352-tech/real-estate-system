@extends('layouts.app')


@section('content')

{{-- Banner (header only, no button) --}}
<div style="background: linear-gradient(135deg, #1E1B4B 0%, #4338CA 100%); border-radius: 14px; padding: 24px 28px; margin-bottom: 24px;">
    <h3 style="font-size: 18px; font-weight: 700; color: white; margin: 0;">Clients</h3>
    <p style="font-size: 13px; color: rgba(255,255,255,0.6); margin: 4px 0 0;">Manage your client records</p>
</div>

<div style="background: white; border: 1px solid #E5E7EB; border-radius: 12px; overflow: hidden;">

    <div style="padding: 18px 24px; border-bottom: 1px solid #F3F4F6; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
        <div>
            <div style="font-size: 15px; font-weight: 600; color: #111827;">All Clients</div>
            <div style="font-size: 13px; color: #9CA3AF; margin-top: 1px;">{{ $clients->total() }} total</div>
        </div>
        <div style="display: flex; align-items: center; gap: 10px;">
            <form method="GET" style="display: flex; align-items: center; gap: 8px;">
                <input type="text" name="search" placeholder="Search by name..." value="{{ request('search') }}"
                       style="border: 1px solid #E5E7EB; border-radius: 8px; padding: 8px 12px; font-size: 13px; color: #374151; outline: none; font-family: inherit; width: 200px;"
                       onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                       onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                <button type="submit"
                        style="background: #6366F1; color: white; font-size: 13px; font-weight: 600; padding: 8px 14px; border-radius: 8px; border: none; cursor: pointer; font-family: inherit;"
                        onmouseover="this.style.background='#4F46E5'"
                        onmouseout="this.style.background='#6366F1'">Search</button>
                @if(request('search'))
                    <a href="{{ route('clients.index') }}" style="font-size: 13px; color: #9CA3AF; text-decoration: none;">Clear</a>
                @endif
            </form>
            <a href="{{ route('clients.create') }}"
               style="display: inline-flex; align-items: center; gap: 6px; background: #6366F1; color: white; font-size: 13px; font-weight: 600; padding: 9px 16px; border-radius: 8px; text-decoration: none; white-space: nowrap; font-family: inherit;"
               onmouseover="this.style.background='#4F46E5'"
               onmouseout="this.style.background='#6366F1'">
                <svg width="14" height="14" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Add Client
            </a>
        </div>
    </div>

    @if(session('success'))
        <div style="margin: 16px 24px; background: #F0FDF4; color: #15803D; padding: 12px 16px; border-radius: 8px; font-size: 13px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #FAFAFA; border-bottom: 1px solid #F3F4F6;">
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 24px; text-align: left;">Name</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Email</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Phone</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Address</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Client Type</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 24px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr style="border-bottom: 1px solid #F9FAFB;"
                    onmouseover="this.style.background='#FAFAFA'"
                    onmouseout="this.style.background=''">
                    <td style="padding: 14px 24px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 32px; height: 32px; background: #EEF2FF; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; color: #6366F1; flex-shrink: 0; text-transform: uppercase;">
                                {{ strtoupper(substr($client->first_name ?? '?', 0, 1)) }}
                            </div>
                            <span style="font-size: 14px; font-weight: 600; color: #111827;">{{ $client->full_name }}</span>
                        </div>
                    </td>
                    <td style="padding: 14px 16px; font-size: 13px; color: #6B7280;">{{ $client->email ?? '—' }}</td>
                    <td style="padding: 14px 16px; font-size: 13px; color: #6B7280;">{{ $client->phone ?? '—' }}</td>
                    <td style="padding: 14px 16px; font-size: 13px; color: #6B7280; max-width: 200px;">{{ $client->address ?? '—' }}</td>
                    <td style="padding: 14px 16px; font-size: 13px; color: #6B7280;">{{ ucfirst($client->client_type ?? '—') }}</td>
                    <td style="padding: 14px 24px; text-align: right;">
                        <div style="display: flex; align-items: center; justify-content: flex-end; gap: 8px;">
                            <a href="{{ route('clients.edit', $client) }}"
                               style="font-size: 13px; font-weight: 600; color: #4F46E5; padding: 6px 12px; border: 1px solid #C7D2FE; border-radius: 7px; background: #EEF2FF; text-decoration: none;"
                               onmouseover="this.style.background='#E0E7FF'; this.style.borderColor='#A5B4FC';"
                               onmouseout="this.style.background='#EEF2FF'; this.style.borderColor='#C7D2FE';">Edit</a>
                            <form method="POST" action="{{ route('clients.destroy', $client) }}" style="display: inline;" onsubmit="return confirm('Delete this client?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        style="font-size: 13px; font-weight: 600; color: #DC2626; padding: 6px 12px; border: 1px solid #FECACA; border-radius: 7px; cursor: pointer; background: #FEF2F2; font-family: inherit;"
                                        onmouseover="this.style.background='#FEE2E2'; this.style.borderColor='#FCA5A5';"
                                        onmouseout="this.style.background='#FEF2F2'; this.style.borderColor='#FECACA';">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 48px 24px; text-align: center;">
                        <p style="font-size: 14px; color: #9CA3AF; margin: 0; font-weight: 500;">No clients found.</p>
                        <a href="{{ route('clients.create') }}" style="display: inline-block; margin-top: 12px; font-size: 13px; font-weight: 600; color: #6366F1; text-decoration: none;">Add your first client →</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($clients->hasPages())
    <div style="padding: 14px 24px; border-top: 1px solid #F3F4F6; background: #FAFAFA;">
        {{ $clients->links() }}
    </div>
    @endif

</div>
@endsection