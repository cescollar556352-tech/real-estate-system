@extends('layouts.app')

@section('header')
    Add Client
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
                <h2 style="font-size: 20px; font-weight: 700; color: white; margin: 0; letter-spacing: -0.3px;">Add New Client</h2>
                <p style="font-size: 13px; color: rgba(255,255,255,0.55); margin: 3px 0 0;">Enter the client's contact information below</p>
            </div>
        </div>

        <form method="POST" action="{{ route('clients.store') }}" style="padding: 32px;">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">

                <div style="grid-column: 1 / -1;">
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                        <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Full Name <span style="color: #EF4444;">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           placeholder="e.g. Juan dela Cruz"
                           style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; box-sizing: border-box;"
                           onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                           onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                    @error('name') <p style="color: #EF4444; font-size: 12px; margin: 6px 0 0;">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                        <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Email Address
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}"
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
                    <input type="text" name="phone" value="{{ old('phone') }}"
                           placeholder="+63 9XX XXX XXXX"
                           style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; box-sizing: border-box;"
                           onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                           onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">
                </div>

                <div style="grid-column: 1 / -1;">
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                        <svg width="14" height="14" fill="none" stroke="#6366F1" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Address
                    </label>
                    <textarea name="address" rows="3"
                              placeholder="Street, City, Province"
                              style="width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px; font-size: 14px; color: #111827; font-family: inherit; outline: none; transition: border-color 0.2s, box-shadow 0.2s; resize: vertical; box-sizing: border-box;"
                              onfocus="this.style.borderColor='#6366F1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
                              onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none';">{{ old('address') }}</textarea>
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
                    Save Client
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