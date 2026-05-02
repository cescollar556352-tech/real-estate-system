@extends('layouts.app')

@section('title', 'Properties')
@section('header', 'Properties')
@section('subheader', 'Manage your property listings')

@section('content')

<div style="background: white; border: 1px solid #E5E7EB; border-radius: 12px; overflow: hidden;">

    {{-- Table Header --}}
    <div style="padding: 18px 24px; border-bottom: 1px solid #F3F4F6; display: flex; align-items: center; justify-content: space-between;">
        <div>
            <div style="font-size: 15px; font-weight: 600; color: #111827;">All Properties</div>
            <div style="font-size: 13px; color: #9CA3AF; margin-top: 1px;">{{ $properties->total() }} total</div>
        </div>
        @if(auth()->user()->isAdmin())
        <a href="{{ route('properties.create') }}"
           style="display: inline-flex; align-items: center; gap: 6px; background: #6366F1; color: white; font-size: 13px; font-weight: 600; padding: 9px 16px; border-radius: 8px; text-decoration: none; transition: background 0.15s; font-family: inherit;"
           onmouseover="this.style.background='#4F46E5'"
           onmouseout="this.style.background='#6366F1'">
            <svg width="14" height="14" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Add Property
        </a>
        @endif
    </div>

    {{-- Table --}}
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #FAFAFA; border-bottom: 1px solid #F3F4F6;">
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 24px; text-align: left;">Address</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Type</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Price</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Status</th>
                    @if(auth()->user()->isAdmin())
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 24px; text-align: right;">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($properties as $property)
                <tr style="border-bottom: 1px solid #F9FAFB; transition: background 0.1s;"
                    onmouseover="this.style.background='#FAFAFA'"
                    onmouseout="this.style.background=''">
                    <td style="padding: 14px 24px; font-size: 14px; font-weight: 600; color: #111827;">{{ $property->address }}</td>
                    <td style="padding: 14px 16px; font-size: 14px; color: #4B5563;">{{ ucfirst($property->type) }}</td>
                    <td style="padding: 14px 16px; font-size: 14px; font-weight: 600; color: #111827; font-variant-numeric: tabular-nums;">₱{{ number_format($property->price, 2) }}</td>
                    <td style="padding: 14px 16px;">
                        @if($property->status === 'available')
                            <span style="background: #F0FDF4; color: #15803D; border: 1px solid #BBF7D0; font-size: 12px; font-weight: 600; padding: 3px 10px; border-radius: 20px;">Available</span>
                        @elseif($property->status === 'sold')
                            <span style="background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; font-size: 12px; font-weight: 600; padding: 3px 10px; border-radius: 20px;">Sold</span>
                        @else
                            <span style="background: #EFF6FF; color: #1D4ED8; border: 1px solid #BFDBFE; font-size: 12px; font-weight: 600; padding: 3px 10px; border-radius: 20px;">{{ ucfirst($property->status) }}</span>
                        @endif
                    </td>
                    @if(auth()->user()->isAdmin())
                    <td style="padding: 14px 24px; text-align: right;">
                        <div style="display: inline-flex; align-items: center; gap: 8px;">
                            <a href="{{ route('properties.edit', $property) }}"
                               style="font-size: 13px; font-weight: 600; color: #6366F1; padding: 6px 12px; border: 1px solid #C7D2FE; border-radius: 7px; text-decoration: none; transition: all 0.15s; background: #EEF2FF;"
                               onmouseover="this.style.background='#E0E7FF'; this.style.borderColor='#A5B4FC';"
                               onmouseout="this.style.background='#EEF2FF'; this.style.borderColor='#C7D2FE';">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('properties.destroy', $property) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this property?')">
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
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="{{ auth()->user()->isAdmin() ? 5 : 4 }}" style="padding: 48px 24px; text-align: center;">
                        <div style="width: 48px; height: 48px; background: #F9FAFB; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                            <svg width="22" height="22" fill="none" stroke="#D1D5DB" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 3l9 6.75V21H3V9.75z"/>
                            </svg>
                        </div>
                        <p style="font-size: 14px; color: #9CA3AF; margin: 0; font-weight: 500;">No properties found.</p>
                        @if(auth()->user()->isAdmin())
                        <a href="{{ route('properties.create') }}" style="display: inline-block; margin-top: 12px; font-size: 13px; font-weight: 600; color: #6366F1; text-decoration: none;"
                           onmouseover="this.style.textDecoration='underline'"
                           onmouseout="this.style.textDecoration='none'">Add your first property →</a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($properties->hasPages())
    <div style="padding: 14px 24px; border-top: 1px solid #F3F4F6; background: #FAFAFA;">
        {{ $properties->links() }}
    </div>
    @endif

</div>

@endsection