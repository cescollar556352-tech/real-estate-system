<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PropTrack') }} — @yield('title', 'Dashboard')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased" style="font-family: 'Plus Jakarta Sans', sans-serif; background: #F4F5F7; min-height: 100vh;">

    {{-- Top Navigation --}}
    <nav style="background: #1E1B4B; border-bottom: 1px solid rgba(255,255,255,0.08); position: sticky; top: 0; z-index: 50;">
        <div style="max-width: 1280px; margin: 0 auto; padding: 0 24px; display: flex; align-items: center; height: 60px; gap: 32px;">

            {{-- Logo --}}
            <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; gap: 10px; text-decoration: none; flex-shrink: 0;">
                <div style="width: 32px; height: 32px; background: #6366F1; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 3l9 6.75V21H3V9.75z"/>
                    </svg>
                </div>
                <span style="color: white; font-weight: 700; font-size: 15px; letter-spacing: -0.3px;">Real Estate System</span>            </a>

            {{-- Nav Links --}}
            <div style="display: flex; align-items: center; gap: 4px; flex: 1;">
                @php $current = request()->routeIs('dashboard') ? 'dashboard' : (request()->routeIs('properties.*') ? 'properties' : (request()->routeIs('clients.*') ? 'clients' : (request()->routeIs('transactions.*') ? 'transactions' : ''))); @endphp

                <a href="{{ route('dashboard') }}" style="padding: 6px 14px; border-radius: 6px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.15s;
                    {{ $current === 'dashboard' ? 'background: rgba(99,102,241,0.25); color: #A5B4FC;' : 'color: rgba(255,255,255,0.6); hover:background: rgba(255,255,255,0.06);' }}"
                    onmouseover="if('{{ $current }}' !== 'dashboard') this.style.background='rgba(255,255,255,0.06)'; this.style.color='rgba(255,255,255,0.9)';"
                    onmouseout="if('{{ $current }}' !== 'dashboard') { this.style.background=''; this.style.color='rgba(255,255,255,0.6)'; }">
                    Dashboard
                </a>

                <a href="{{ route('properties.index') }}" style="padding: 6px 14px; border-radius: 6px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.15s;
                    {{ $current === 'properties' ? 'background: rgba(99,102,241,0.25); color: #A5B4FC;' : 'color: rgba(255,255,255,0.6);' }}"
                    onmouseover="if('{{ $current }}' !== 'properties') this.style.background='rgba(255,255,255,0.06)'; this.style.color='rgba(255,255,255,0.9)';"
                    onmouseout="if('{{ $current }}' !== 'properties') { this.style.background=''; this.style.color='rgba(255,255,255,0.6)'; }">
                    Properties
                </a>

                @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
                <a href="{{ route('clients.index') }}" style="padding: 6px 14px; border-radius: 6px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.15s;
                    {{ $current === 'clients' ? 'background: rgba(99,102,241,0.25); color: #A5B4FC;' : 'color: rgba(255,255,255,0.6);' }}"
                    onmouseover="if('{{ $current }}' !== 'clients') this.style.background='rgba(255,255,255,0.06)'; this.style.color='rgba(255,255,255,0.9)';"
                    onmouseout="if('{{ $current }}' !== 'clients') { this.style.background=''; this.style.color='rgba(255,255,255,0.6)'; }">
                    Clients
                </a>

                <a href="{{ route('transactions.index') }}" style="padding: 6px 14px; border-radius: 6px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.15s;
                    {{ $current === 'transactions' ? 'background: rgba(99,102,241,0.25); color: #A5B4FC;' : 'color: rgba(255,255,255,0.6);' }}"
                    onmouseover="if('{{ $current }}' !== 'transactions') this.style.background='rgba(255,255,255,0.06)'; this.style.color='rgba(255,255,255,0.9)';"
                    onmouseout="if('{{ $current }}' !== 'transactions') { this.style.background=''; this.style.color='rgba(255,255,255,0.6)'; }">
                    Transactions
                </a>
                @endif
            </div>

            {{-- User Menu --}}
            <div style="position: relative;" x-data="{ open: false }">
                <button @click="open = !open" style="display: flex; align-items: center; gap: 10px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); border-radius: 8px; padding: 6px 12px 6px 8px; cursor: pointer; transition: all 0.15s;"
                    onmouseover="this.style.background='rgba(255,255,255,0.14)'"
                    onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                    <div style="width: 28px; height: 28px; background: #6366F1; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; color: white;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div style="text-align: left;">
                        <div style="font-size: 13px; font-weight: 600; color: white; line-height: 1.2;">{{ Auth::user()->name }}</div>
                        <div style="font-size: 11px; color: rgba(255,255,255,0.45); line-height: 1.2; text-transform: capitalize;">{{ Auth::user()->role }}</div>
                    </div>
                    <svg width="14" height="14" fill="none" stroke="rgba(255,255,255,0.5)" stroke-width="2" viewBox="0 0 24 24" style="margin-left: 2px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false" x-transition
                    style="position: absolute; right: 0; top: calc(100% + 8px); background: white; border: 1px solid #E5E7EB; border-radius: 10px; padding: 6px; min-width: 180px; box-shadow: 0 10px 25px rgba(0,0,0,0.12); z-index: 100;">
                    <div style="padding: 8px 12px 10px; border-bottom: 1px solid #F3F4F6; margin-bottom: 4px;">
                        <div style="font-size: 13px; font-weight: 600; color: #111827;">{{ Auth::user()->name }}</div>
                        <div style="font-size: 12px; color: #6B7280; margin-top: 1px;">{{ Auth::user()->email }}</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="width: 100%; text-align: left; padding: 8px 12px; border-radius: 6px; border: none; background: none; font-size: 13px; font-weight: 500; color: #EF4444; cursor: pointer; display: flex; align-items: center; gap: 8px; font-family: inherit;"
                            onmouseover="this.style.background='#FEF2F2'"
                            onmouseout="this.style.background='none'">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/>
                            </svg>
                            Sign out
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
    <div style="max-width: 1280px; margin: 20px auto 0; padding: 0 24px;">
        <div style="background: #F0FDF4; border: 1px solid #BBF7D0; border-radius: 10px; padding: 12px 16px; display: flex; align-items: center; gap: 10px;">
            <svg width="16" height="16" fill="none" stroke="#16A34A" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink: 0;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span style="font-size: 14px; font-weight: 500; color: #15803D;">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div style="max-width: 1280px; margin: 20px auto 0; padding: 0 24px;">
        <div style="background: #FEF2F2; border: 1px solid #FECACA; border-radius: 10px; padding: 12px 16px; display: flex; align-items: center; gap: 10px;">
            <svg width="16" height="16" fill="none" stroke="#DC2626" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink: 0;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span style="font-size: 14px; font-weight: 500; color: #DC2626;">{{ session('error') }}</span>
        </div>
    </div>
    @endif

    {{-- Page Header --}}
    @if(View::hasSection('header'))
    <div style="max-width: 1280px; margin: 28px auto 0; padding: 0 24px;">
        <h1 style="font-size: 22px; font-weight: 700; color: #111827; letter-spacing: -0.4px; margin: 0;">@yield('header')</h1>
        @if(View::hasSection('subheader'))
        <p style="font-size: 14px; color: #6B7280; margin: 4px 0 0;">@yield('subheader')</p>
        @endif
    </div>
    @endif

    {{-- Main Content --}}
    <main style="max-width: 1280px; margin: 24px auto 48px; padding: 0 24px;">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>