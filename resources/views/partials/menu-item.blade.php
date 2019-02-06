@if (is_string($item))
    <li class="header">{{ $item }}</li>
@else
    <li class="nav-item {{ $item['class'] }}">
        <a href="{{ $item['href'] }}" class="nav-link {{ $item['class'] }}"
           @if (isset($item['target'])) target="{{ $item['target'] }}" @endif
        >
            <i class="nav-icon fa fa-fw fa-{{ isset($item['icon']) ? $item['icon'] : 'circle-o' }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
            <p>{{ $item['text'] }}
                @if (isset($item['label']))
                    <span class="badge badge-{{ isset($item['label_color']) ? $item['label_color'] : 'primary' }} @if(app ()->getLocale ()=="fa" || app ()->getLocale ()=="ar") right @else left @endif">{{ $item['label'] }}</span>
                </span>
                @elseif (isset($item['submenu']))
                <i class="fa fa-angle-left right"></i>
                </span>
                @endif
            </p>
        </a>
        @if (isset($item['submenu']))
            <ul class="{{ $item['submenu_class'] }}">
                @each('adminlte::partials.menu-item', $item['submenu'], 'item')
            </ul>
        @endif
    </li>
@endif
