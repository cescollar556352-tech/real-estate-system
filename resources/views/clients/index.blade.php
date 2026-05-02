@extends('layouts.app')

@section('title', 'Clients')
@section('header', 'Clients')
@section('subheader', 'Manage your client directory')

@section('content')

<div style="background: white; border: 1px solid #E5E7EB; border-radius: 12px; overflow: hidden;">

    {{-- Table Header --}}
    <div style="padding: 18px 24px; border-bottom: 1px solid #F3F4F6; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
        <div>
            <div style="font-size: 15px; font-weight: 600; color: #111827;">All Clients</div>
            <div style="font-size: 13px; color: #9CA3AF; margin-top: 1px;">{{ $clients->total() }} total</div>
        </div>

        <div style="display: flex; align-items: center; gap: 10px;">
            {{-- Search --}}
            <form method="GET" style="display: flex; align-items: center; gap: 8px;">
                <div style="position: relative;">
                    <svg width="15" height="15" fill="none" stroke="#9CA3AF" stroke-width="2" viewBox="0 0 24 24"
                         style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); pointer-events: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 105 11a6 6 0 0012 0z"/>
                    </svg>
                    <input type="text" name="search" placeholder="Search by name..." value="{{ request('search') }}"
                           style="border: 1px solid #E5E7EB; border-radius: 8px; padding: 8px 12px 8px 34px; font-size: 13px; color: #374151; outline: none; width: 220px; font-family: inherit; transition: border-color 0.15s;"
                           onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)';"
                           onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='';">
                </div>
                <button type="submit"
                        style="background: #F3F4F6; border: 1px solid #E5E7EB; border-radius: 8px; padding: 8px 14px; font-size: 13px; font-weight: 600; color: #374151; cursor: pointer; font-family: inherit; transition: all 0.15s;"
                        onmouseover="this.style.background='#E5E7EB'"
                        onmouseout="this.style.background='#F3F4F6'">
                    Search
                </button>
                @if(request('search'))
                <a href="{{ route('clients.index') }}"
                   style="font-size: 13px; color: #9CA3AF; text-decoration: none; font-weight: 500;"
                   onmouseover="this.style.color='#374151'"
                   onmouseout="this.style.color='#9CA3AF'">Clear</a>
                @endif
            </form>

            <a href="{{ route('clients.create') }}"
               style="display: inline-flex; align-items: center; gap: 6px; background: #6366F1; color: white; font-size: 13px; font-weight: 600; padding: 9px 16px; border-radius: 8px; text-decoration: none; white-space: nowrap; font-family: inherit; transition: background 0.15s;"
               onmouseover="this.style.background='#4F46E5'"
               onmouseout="this.style.background='#6366F1'">
                <svg width="14" height="14" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Add Client
            </a>
        </div>
    </div>

    {{-- Table --}}
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #FAFAFA; border-bottom: 1px solid #F3F4F6;">
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 24px; text-align: left;">Name</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Email</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Phone</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 24px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr style="border-bottom: 1px solid #F9FAFB; transition: background 0.1s;"
                    onmouseover="this.style.background='#FAFAFA'"
                    onmouseout="this.style.background=''">
                    <td style="padding: 14px 24px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 34px; height: 34px; background: #EEF2FF; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; color: #6366F1; flex-shrink: 0; text-transform: uppercase;">
                                {{ strtoupper(substr($client->name, 0, 1)) }}
                            </div>
                            <span style="font-size: 14px; font-weight: 600; color: #111827;">{{ $client->name }}</span>
                        </div>
                    </td>
                    <td style="padding: 14px 16px; font-size: 14px; color: #4B5563;">{{ $client->email ?? '—' }}</td>
                    <td style="padding: 14px 16px; font-size: 14px; color: #4B5563; font-variant-numeric: tabular-nums;">{{ $client->phone ?? '—' }}</td>
                    <td style="padding: 14px 24px; text-align: right;">
                        <div style="display: inline-flex; align-items: center; gap: 8px;">
                            <a href="{{ route('clients.edit', $client) }}"
                               style="font-size: 13px; font-weight: 600; color: #6366F1; padding: 6px 12px; border: 1px solid #C7D2FE; border-radius: 7px; text-decoration: none; background: #EEF2FF; transition: all 0.15s;"
                               onmouseover="this.style.background='#E0E7FF'; this.style.borderColor='#A5B4FC';"
                               onmouseout="this.style.background='#EEF2FF'; this.style.borderColor='#C7D2FE';">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('clients.destroy', $client) }}" style="display: inline;" onsubmit="return confirm('Delete this client?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        style="font-size: 13px; font-weight: 600; color: #DC2626; padding: 6px 12px; border: 1px solid #FECACA; border-radius: 7px; cursor: pointer; background: #FEF2F2; font-family: inherit; transition: all 0.15s;"
                                        onmouseover="this.style.background='#FEE2E2'; this.style.borderColor='#FCA5A5';"
                                        onmouseout="this.style.background='#FEF2F2'; this.style.borderColor='#FECACA';">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding: 48px 24px; text-align: center;">
                        <div style="width: 48px; height: 48px; background: #F9FAFB; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                            <svg width="22" height="22" fill="none" stroke="#D1D5DB" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h5M12 12a4 4 0 100-8 4 4 0 000 8z"/>
                            </svg>
                        </div>
                        <p style="font-size: 14px; color: #9CA3AF; margin: 0; font-weight: 500;">
                            {{ request('search') ? 'No clients match your search.' : 'No clients found.' }}
                        </p>
                        @if(!request('search'))
                        <a href="{{ route('clients.create') }}" style="display: inline-block; margin-top: 12px; font-size: 13px; font-weight: 600; color: #6366F1; text-decoration: none;"
                           onmouseover="this.style.textDecoration='underline'"
                           onmouseout="this.style.textDecoration='none'">Add your first client →</a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($clients->hasPages())
    <div style="padding: 14px 24px; border-top: 1px solid #F3F4F6; background: #FAFAFA;">
        {{ $clients->links() }}
    </div>
    @endif

</div>

@endsection