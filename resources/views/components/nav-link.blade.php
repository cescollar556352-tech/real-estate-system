@props(['active'])

@php
$activeStyle = 'display:inline-flex;align-items:center;padding:6px 12px;border-radius:6px;font-size:0.875rem;font-weight:600;background-color:#fff;color:#4338ca;text-decoration:none;';
$inactiveStyle = 'display:inline-flex;align-items:center;padding:6px 12px;border-radius:6px;font-size:0.875rem;font-weight:500;color:#c7d2fe;text-decoration:none;';
$style = ($active ?? false) ? $activeStyle : $inactiveStyle;
@endphp

<a style="{{ $style }}" {{ $attributes }}>
    {{ $slot }}
</a>