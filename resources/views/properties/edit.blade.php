@extends('layouts.app')

@section('header')
    Edit Property
@endsection

@section('content')
<div style="max-width: 100%;">
    <div style="background: white; border-radius: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.08), 0 8px 24px rgba(0,0,0,0.06); overflow: hidden;">

        <div style="background: linear-gradient(135deg, #1E1B4B 0%, #312E81 100%); padding: 28px 32px; display: flex; align-items: center; gap: 16px;">
            <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg width="24" height="24" fill="none" stroke="white" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 3l9 6.75V21H3V9.75z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 21V12h6v9"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size: 20px; font-weight: 700; color: white; margin: 0; letter-spacing: -0.3px;">Edit Property</h2>
                <p style="font-size: 13px; color: rgba(255,255,255,0.55); margin: 3px 0 0;">Update the details for this property listing</p>
            </div>
        </div>

        <form method="POST" action="{{ route('properties.update', $property) }}" style="padding: 32px;">
            @csrf @method('PUT')

            <div style="display: grid; gap: 24px;">

                <div>
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                        <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Property Address <span style="color: #EF4444;">*</span>
                    </label>
                    <input type="text" name="address" value="{{ old('address', $property->address) }}" required
                           placeholder="e.g. 123 Rizal St., Davao City"
                           style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; box-sizing: border-box;"
                           onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                           onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                    @error('address') <p style="color: #EF4444; font-size: 12px; margin: 6px 0 0;">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                        <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Price (₱) <span style="color: #EF4444;">*</span>
                    </label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); font-size: 14px; font-weight: 600; color: #9CA3AF;">₱</span>
                        <input type="number" name="price" step="0.01" value="{{ old('price', $property->price) }}" required
                               placeholder="0.00"
                               style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px 11px 30px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                               onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                    </div>
                    @error('price') <p style="color: #EF4444; font-size: 12px; margin: 6px 0 0;">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                        <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        Property Type <span style="color: #EF4444;">*</span>
                    </label>
                    <select name="type"
                            style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; background: white; appearance: none; background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2216%22 height=%2216%22 fill=%22none%22 stroke=%22%236B7280%22 stroke-width=%222%22 viewBox=%220 0 24 24%22><path stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M19 9l-7 7-7-7%22/></svg>'); background-repeat: no-repeat; background-position: right 14px center; box-sizing: border-box;"
                            onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                            onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                        @foreach(['house','condo','lot','commercial'] as $type)
                            <option value="{{ $type }}" {{ $property->type == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                        <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Status <span style="color: #EF4444;">*</span>
                    </label>
                    <select name="status"
                            style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; background: white; appearance: none; background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2216%22 height=%2216%22 fill=%22none%22 stroke=%22%236B7280%22 stroke-width=%222%22 viewBox=%220 0 24 24%22><path stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M19 9l-7 7-7-7%22/></svg>'); background-repeat: no-repeat; background-position: right 14px center; box-sizing: border-box;"
                            onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                            onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                        <option value="available" {{ $property->status == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="sold" {{ $property->status == 'sold' ? 'selected' : '' }}>Sold</option>
                    </select>
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
                    Update Property
                </button>
                <a href="{{ route('properties.index') }}"
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