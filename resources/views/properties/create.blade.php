@extends('layouts.app')

@section('header')
    Add Property
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
                <h2 style="font-size: 20px; font-weight: 700; color: white; margin: 0; letter-spacing: -0.3px;">Add New Property</h2>
                <p style="font-size: 13px; color: rgba(255,255,255,0.55); margin: 3px 0 0;">Fill in the details below to list a new property</p>
            </div>
        </div>

        <form method="POST" action="{{ route('properties.store') }}" style="padding: 32px;">
            @csrf

            <div style="display: grid; gap: 24px;">

                <div>
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                        <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Property Address <span style="color: #EF4444;">*</span>
                    </label>
                    <input type="text" name="address" value="{{ old('address') }}" required
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
                        <input type="number" name="price" step="0.01" value="{{ old('price') }}" required
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
                            style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; background: white; appearance: none; background-image: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' stroke='%236B7280' stroke-width='2' viewBox='0 0 24 24'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E&quot;); background-repeat: no-repeat; background-position: right 14px center; box-sizing: border-box;"
                            onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                            onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                        <option value="house" {{ old('type') == 'house' ? 'selected' : '' }}>House</option>
                        <option value="condo" {{ old('type') == 'condo' ? 'selected' : '' }}>Condo</option>
                        <option value="lot" {{ old('type') == 'lot' ? 'selected' : '' }}>Lot</option>
                        <option value="commercial" {{ old('type') == 'commercial' ? 'selected' : '' }}>Commercial</option>
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
                            style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; background: white; appearance: none; background-image: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' stroke='%236B7280' stroke-width='2' viewBox='0 0 24 24'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E&quot;); background-repeat: no-repeat; background-position: right 14px center; box-sizing: border-box;"
                            onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                            onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                        <option value="available" {{ old('status', 'available') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="sold"      {{ old('status') == 'sold'     ? 'selected' : '' }}>Sold</option>
                        <option value="rented"    {{ old('status') == 'rented'   ? 'selected' : '' }}>Rented</option>
                    </select>
                    @error('status') <p style="color: #EF4444; font-size: 12px; margin: 6px 0 0;">{{ $message }}</p> @enderror
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                            <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Bedrooms
                        </label>
                        <select name="bedrooms"
                                style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; background: white; appearance: none; background-image: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' stroke='%236B7280' stroke-width='2' viewBox='0 0 24 24'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E&quot;); background-repeat: no-repeat; background-position: right 14px center; box-sizing: border-box;"
                                onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                                onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                            <option value="">— Select —</option>
                            @foreach(['1','2','3','4'] as $opt)
                                <option value="{{ $opt }}" {{ old('bedrooms') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                            <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Bathrooms
                        </label>
                        <select name="bathrooms"
                                style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; background: white; appearance: none; background-image: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' stroke='%236B7280' stroke-width='2' viewBox='0 0 24 24'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E&quot;); background-repeat: no-repeat; background-position: right 14px center; box-sizing: border-box;"
                                onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                                onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                            <option value="">— Select —</option>
                            @foreach(['1','2','3'] as $opt)
                                <option value="{{ $opt }}" {{ old('bathrooms') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                            <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                            </svg>
                            Lot Area
                        </label>
                        <div style="position: relative;">
                            <input type="number" name="lot_area" step="0.01" min="0" value="{{ old('lot_area') }}"
                                   placeholder="e.g. 120"
                                   style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 42px 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; box-sizing: border-box;"
                                   onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                                   onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                            <span style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); font-size: 12px; color: #9CA3AF; font-weight: 500;">sqm</span>
                        </div>
                    </div>
                    <div>
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                            <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                            </svg>
                            Floor Area
                        </label>
                        <div style="position: relative;">
                            <input type="number" name="floor_area" step="0.01" min="0" value="{{ old('floor_area') }}"
                                   placeholder="e.g. 250"
                                   style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 42px 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; box-sizing: border-box;"
                                   onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                                   onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                            <span style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); font-size: 12px; color: #9CA3AF; font-weight: 500;">sqm</span>
                        </div>
                    </div>
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
                    Save Property
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