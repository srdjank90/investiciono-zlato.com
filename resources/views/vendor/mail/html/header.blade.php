@props(['url'])
<tr>
    {{-- <td class="header" style="display: none">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td> --}}
    <td class="header">
        <a href="https://reklamni-materijal.com" style="display: inline-block;">
            <img width="200" src="https://reklamni-materijal.com/themes/mooncart/assets/images/logo.png"
                alt="Reklamni materijal by Jefimija dizajn">
        </a>
    </td>
</tr>
