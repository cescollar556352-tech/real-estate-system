@extends('layouts.app')

@section('header')
    Edit Client
@endsection

@section('content')
<div style="max-width: 100%;">
    <div style="background: white; border-radius: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.08), 0 8px 24px rgba(0,0,0,0.06); overflow: hidden;">

        <div style="background: linear-gradient(135deg, #1E1B4B 0%, #312E81 100%); padding: 28px 32px; display: flex; align-items: center; gap: 16px;">
            <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg width="24" height="24" fill="none" stroke="white" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size: 20px; font-weight: 700; color: white; margin: 0; letter-spacing: -0.3px;">Edit Client</h2>
                <p style="font-size: 13px; color: rgba(255,255,255,0.55); margin: 3px 0 0;">Update the client's information below</p>
            </div>
        </div>

        <form method="POST" action="{{ route('clients.update', $client) }}" style="padding: 32px;">
            @csrf @method('PUT')

            {{-- Personal Information --}}
            <p style="font-size: 11px; font-weight: 700; color: #9CA3AF; letter-spacing: 0.08em; text-transform: uppercase; margin: 0 0 16px;">Personal Information</p>

            <div style="display: grid; gap: 20px; margin-bottom: 32px;">

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
                    <div>
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                            <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            First Name <span style="color: #EF4444;">*</span>
                        </label>
                        <input type="text" name="first_name" value="{{ old('first_name', $client->first_name) }}" required
                               style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                               onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                        @error('first_name') <p style="color: #EF4444; font-size: 12px; margin: 6px 0 0;">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                            Middle Name
                        </label>
                        <input type="text" name="middle_name" value="{{ old('middle_name', $client->middle_name) }}"
                               style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                               onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                    </div>
                    <div>
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                            Last Name <span style="color: #EF4444;">*</span>
                        </label>
                        <input type="text" name="last_name" value="{{ old('last_name', $client->last_name) }}" required
                               style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                               onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                        @error('last_name') <p style="color: #EF4444; font-size: 12px; margin: 6px 0 0;">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div style="max-width: 240px;">
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                        <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Date of Birth
                    </label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $client->date_of_birth) }}"
                           style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; box-sizing: border-box;"
                           onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                           onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                </div>

            </div>

            {{-- Identification --}}
            <p style="font-size: 11px; font-weight: 700; color: #9CA3AF; letter-spacing: 0.08em; text-transform: uppercase; margin: 0 0 16px;">Identification</p>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 32px;">
                <div>
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                        <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/>
                        </svg>
                        ID Type
                    </label>
                    <select name="id_type"
                            style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; background: white; appearance: none; background-image: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' stroke='%236B7280' stroke-width='2' viewBox='0 0 24 24'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E&quot;); background-repeat: no-repeat; background-position: right 14px center; box-sizing: border-box;"
                            onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                            onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                        <option value="">— Select —</option>
                        <option value="passport"        {{ old('id_type', $client->id_type) == 'passport'        ? 'selected' : '' }}>Passport</option>
                        <option value="drivers_license" {{ old('id_type', $client->id_type) == 'drivers_license' ? 'selected' : '' }}>Driver's License</option>
                        <option value="sss"             {{ old('id_type', $client->id_type) == 'sss'             ? 'selected' : '' }}>SSS</option>
                        <option value="tin"             {{ old('id_type', $client->id_type) == 'tin'             ? 'selected' : '' }}>TIN (Tax Identification Number)</option>
                    </select>
                </div>
                <div>
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                        ID Number
                    </label>
                    <input type="text" name="id_number" value="{{ old('id_number', $client->id_number) }}"
                           placeholder="e.g. A12345678"
                           style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; box-sizing: border-box;"
                           onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                           onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                </div>
            </div>

            {{-- Contact Details --}}
            <p style="font-size: 11px; font-weight: 700; color: #9CA3AF; letter-spacing: 0.08em; text-transform: uppercase; margin: 0 0 16px;">Contact Details</p>

            <div style="display: grid; gap: 20px; margin-bottom: 32px;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                            <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Email Address
                        </label>
                        <input type="email" name="email" value="{{ old('email', $client->email) }}"
                               placeholder="email@example.com"
                               style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                               onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                        @error('email') <p style="color: #EF4444; font-size: 12px; margin: 6px 0 0;">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                            <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            Phone Number
                        </label>
                        <input type="text" name="phone" value="{{ old('phone', $client->phone) }}"
                               placeholder="+63 9XX XXX XXXX"
                               style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                               onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                    </div>
                </div>

                <div>
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                        <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Permanent Address
                    </label>
                    <textarea name="address" rows="3"
                              placeholder="Street, City, Province"
                              style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; box-sizing: border-box; resize: vertical;"
                              onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                              onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">{{ old('address', $client->address) }}</textarea>
                </div>
            </div>

            {{-- Real Estate --}}
            <p style="font-size: 11px; font-weight: 700; color: #9CA3AF; letter-spacing: 0.08em; text-transform: uppercase; margin: 0 0 16px;">Real Estate</p>

            <div style="max-width: 300px; margin-bottom: 32px;">
                <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                    <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 3l9 6.75V21H3V9.75z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 21V12h6v9"/>
                    </svg>
                    Client Type
                </label>
                <select name="client_type"
                        style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; background: white; appearance: none; background-image: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' stroke='%236B7280' stroke-width='2' viewBox='0 0 24 24'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E&quot;); background-repeat: no-repeat; background-position: right 14px center; box-sizing: border-box;"
                        onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                        onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                    <option value="">— Select —</option>
                    <option value="tenant"   {{ old('client_type', $client->client_type) == 'tenant'   ? 'selected' : '' }}>Tenant</option>
                    <option value="buyer"    {{ old('client_type', $client->client_type) == 'buyer'    ? 'selected' : '' }}>Buyer</option>
                    <option value="seller"   {{ old('client_type', $client->client_type) == 'seller'   ? 'selected' : '' }}>Seller</option>
                    <option value="investor" {{ old('client_type', $client->client_type) == 'investor' ? 'selected' : '' }}>Investor</option>
                </select>
            </div>

            <div style="border-top: 1px solid #F3F4F6; margin: 0 0 28px;"></div>

            <div style="display: flex; align-items: center; gap: 12px;">
                <button type="submit"
                        style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #4F46E5, #6366F1); color: white; font-size: 14px; font-weight: 600; padding: 11px 24px; border-radius: 10px; border: none; cursor: pointer; font-family: inherit; box-shadow: 0 2px 8px rgba(99,102,241,0.35);"
                        onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 14px rgba(99,102,241,0.45)';"
                        onmouseout="this.style.transform=''; this.style.boxShadow='0 2px 8px rgba(99,102,241,0.35)';">
                    <svg width="15" height="15" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update Client
                </button>
                <a href="{{ route('clients.index') }}"
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