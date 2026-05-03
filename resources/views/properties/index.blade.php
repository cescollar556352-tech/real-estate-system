@extends('layouts.app')

@section('content')

{{-- Banner (header only, no button) --}}
<div style="background: linear-gradient(135deg, #1E1B4B 0%, #4338CA 100%); border-radius: 14px; padding: 24px 28px; margin-bottom: 24px;">
    <h3 style="font-size: 18px; font-weight: 700; color: white; margin: 0;">Properties</h3>
    <p style="font-size: 13px; color: rgba(255,255,255,0.6); margin: 4px 0 0;">Manage your property listings</p>
</div>

<div style="background: white; border: 1px solid #E5E7EB; border-radius: 12px; overflow: hidden;">

    <div style="padding: 18px 24px; border-bottom: 1px solid #F3F4F6; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
        <div>
            <div style="font-size: 15px; font-weight: 600; color: #111827;">All Properties</div>
            <div style="font-size: 13px; color: #9CA3AF; margin-top: 1px;">{{ $properties->total() }} total</div>
        </div>
        <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
            {{-- Status Filter --}}
            <form method="GET" style="display: flex; align-items: center; gap: 8px;">
                <select name="status" onchange="this.form.submit()"
                        style="border: 1px solid #E5E7EB; border-radius: 8px; padding: 8px 32px 8px 12px; font-size: 13px; color: #374151; background: #F9FAFB; appearance: none; cursor: pointer; font-family: inherit; outline: none;">
                    <option value="">All Status</option>
                    <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Available</option>
                    <option value="sold"      {{ request('status') === 'sold'      ? 'selected' : '' }}>Sold</option>
                    <option value="rented"    {{ request('status') === 'rented'    ? 'selected' : '' }}>Rented</option>
                </select>
                @if(request('status'))
                    <a href="{{ route('properties.index') }}" style="font-size: 13px; color: #9CA3AF; text-decoration: none;">Clear</a>
                @endif
            </form>

            @if(auth()->user()->isAdmin())
                <a href="{{ route('properties.create') }}"
                   style="display:inline-flex;align-items:center;gap:6px;background-color:#6366F1;color:#fff;font-size:0.875rem;font-weight:600;padding:9px 16px;border-radius:8px;text-decoration:none;"
                   onmouseover="this.style.background='#4F46E5'"
                   onmouseout="this.style.background='#6366F1'">
                    <svg width="14" height="14" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Property
                </a>
            @endif
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
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 24px; text-align: left;">Address</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Type</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Price</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Beds / Baths</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Lot / Floor Area</th>
                    <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 16px; text-align: left;">Status</th>
                    @if(auth()->user()->isAdmin())
                        <th style="font-size: 11px; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 24px; text-align: right;">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($properties as $property)
                <tr style="border-bottom: 1px solid #F9FAFB;"
                    onmouseover="this.style.background='#FAFAFA'"
                    onmouseout="this.style.background=''">
                    <td style="padding:14px 24px;font-size:14px;font-weight:600;color:#111827;">{{ $property->address }}</td>
                    <td style="padding:14px 16px;font-size:14px;color:#374151;">{{ ucfirst($property->type) }}</td>
                    <td style="padding:14px 16px;font-size:14px;font-weight:600;color:#111827;white-space:nowrap;">₱{{ number_format($property->price, 2) }}</td>
                    <td style="padding:14px 16px;font-size:13px;color:#6B7280;">
                        @if($property->bedrooms || $property->bathrooms)
                            {{ $property->bedrooms ?? '—' }} bed / {{ $property->bathrooms ?? '—' }} bath
                        @else
                            <span style="color:#D1D5DB;">—</span>
                        @endif
                    </td>
                    <td style="padding:14px 16px;font-size:13px;color:#6B7280;">
                        @if($property->lot_area || $property->floor_area)
                            @if($property->lot_area)<span>{{ number_format($property->lot_area, 0) }} sqm lot</span>@endif
                            @if($property->lot_area && $property->floor_area)<br>@endif
                            @if($property->floor_area)<span>{{ number_format($property->floor_area, 0) }} sqm floor</span>@endif
                        @else
                            <span style="color:#D1D5DB;">—</span>
                        @endif
                    </td>
                    <td style="padding:14px 16px;">
                        @if($property->status === 'available')
                            <span style="background:#F0FDF4;color:#15803D;border:1px solid #BBF7D0;font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;text-transform:uppercase;letter-spacing:0.3px;">Available</span>
                        @elseif($property->status === 'sold')
                            <span style="background:#FEF2F2;color:#DC2626;border:1px solid #FECACA;font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;text-transform:uppercase;letter-spacing:0.3px;">Sold</span>
                        @elseif($property->status === 'rented')
                            <span style="background:#EFF6FF;color:#1D4ED8;border:1px solid #BFDBFE;font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;text-transform:uppercase;letter-spacing:0.3px;">Rented</span>
                        @endif
                    </td>
                    @if(auth()->user()->isAdmin())
                    <td style="padding:14px 24px;text-align:right;">
                        <div style="display:flex;align-items:center;justify-content:flex-end;gap:8px;flex-wrap:wrap;">

                            {{-- Mark Sold / Mark Available toggle --}}
                            @if($property->status === 'available')
                                <form method="POST" action="{{ route('properties.mark', $property) }}" style="display:inline;">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="sold">
                                    <button type="submit"
                                            style="font-size:13px;font-weight:600;color:#92400E;padding:6px 12px;border:1px solid #FDE68A;border-radius:7px;cursor:pointer;background:#FEFCE8;font-family:inherit;"
                                            onmouseover="this.style.background='#FEF9C3';"
                                            onmouseout="this.style.background='#FEFCE8';">Mark Sold</button>
                                </form>
                            @elseif($property->status === 'sold' || $property->status === 'rented')
                                <form method="POST" action="{{ route('properties.mark', $property) }}" style="display:inline;">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="available">
                                    <button type="submit"
                                            style="font-size:13px;font-weight:600;color:#15803D;padding:6px 12px;border:1px solid #BBF7D0;border-radius:7px;cursor:pointer;background:#F0FDF4;font-family:inherit;"
                                            onmouseover="this.style.background='#DCFCE7';"
                                            onmouseout="this.style.background='#F0FDF4';">Mark Available</button>
                                </form>
                            @endif

                            <a href="{{ route('properties.edit', $property) }}"
                               style="font-size:13px;font-weight:600;color:#4F46E5;padding:6px 12px;border:1px solid #C7D2FE;border-radius:7px;background:#EEF2FF;text-decoration:none;"
                               onmouseover="this.style.background='#E0E7FF';this.style.borderColor='#A5B4FC';"
                               onmouseout="this.style.background='#EEF2FF';this.style.borderColor='#C7D2FE';">Edit</a>

                            <form method="POST" action="{{ route('properties.destroy', $property) }}" style="display:inline;" onsubmit="return confirm('Delete this property?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        style="font-size:13px;font-weight:600;color:#DC2626;padding:6px 12px;border:1px solid #FECACA;border-radius:7px;cursor:pointer;background:#FEF2F2;font-family:inherit;"
                                        onmouseover="this.style.background='#FEE2E2';this.style.borderColor='#FCA5A5';"
                                        onmouseout="this.style.background='#FEF2F2';this.style.borderColor='#FECACA';">Delete</button>
                            </form>
                        </div>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="{{ auth()->user()->isAdmin() ? 7 : 6 }}" style="padding:48px 24px;text-align:center;color:#9CA3AF;font-size:14px;">No properties found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($properties->hasPages())
    <div style="padding: 14px 24px; border-top: 1px solid #F3F4F6; background: #FAFAFA;">
        {{ $properties->links() }}
    </div>
    @endif

</div>
@endsection