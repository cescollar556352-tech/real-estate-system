@props(['active'])

@php
$activeStyle = 'display:block;width:100%;padding:8px 16px;border-left:4px solid #fff;font-size:1rem;font-weight:600;color:#fff;background-color:#4338ca;text-decoration:none;';
$inactiveStyle = 'display:block;width:100%;padding:8px 16px;border-left:4px solid transparent;font-size:1rem;font-weight:500;color:#c7d2fe;text-decoration:none;';
$style = ($active ?? false) ? $activeStyle : $inactiveStyle;
@endphp

<a style="{{ $style }}" {{ $attributes }}>
    {{ $slot }}
</a>