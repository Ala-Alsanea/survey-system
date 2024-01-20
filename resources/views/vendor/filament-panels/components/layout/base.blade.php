@props(['livewire'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ __('filament-panels::layout.direction') ?? 'ltr' }}"
    @class(['fi min-h-screen', 'dark' => filament()->hasDarkModeForced()])>

<head>
    {{ \Filament\Support\Facades\FilamentView::renderHook('panels::head.start') }}

    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no,maximum-scale=1.0" />

    @if ($favicon = filament()->getFavicon())
        <link rel="icon" href="{{ $favicon }}" />
    @endif

    <title>
        {{ filled($title = strip_tags($livewire->getTitle())) ? "{$title} - " : null }}
        {{ filament()->getBrandName() }}
    </title>



    {{ \Filament\Support\Facades\FilamentView::renderHook('panels::styles.before') }}

    <style>
        [x-cloak=''],
        [x-cloak='x-cloak'],
        [x-cloak='1'] {
            display: none !important;
        }

        @media (max-width: 1023px) {
            [x-cloak='-lg'] {
                display: none !important;
            }
        }

        @media (min-width: 1024px) {
            [x-cloak='lg'] {
                display: none !important;
            }
        }
    </style>

    @filamentStyles

    {{ filament()->getTheme()->getHtml() }}
    {{ filament()->getFontHtml() }}

    <style>
        :root {
            --font-family: {!! filament()->getFontFamily() !!};
            --sidebar-width: {{ filament()->getSidebarWidth() }};
            --collapsed-sidebar-width: {{ filament()->getCollapsedSidebarWidth() }};
        }
    </style>

    @stack('styles')

    {{ \Filament\Support\Facades\FilamentView::renderHook('panels::styles.after') }}

    @if (!filament()->hasDarkMode())
        <script>
            localStorage.setItem('theme', 'light')
        </script>
    @elseif (filament()->hasDarkModeForced())
        <script>
            localStorage.setItem('theme', 'dark')
        </script>
    @else
        <script>
            const theme = localStorage.getItem('theme') ?? 'system'

            if (
                theme === 'dark' ||
                (theme === 'system' &&
                    window.matchMedia('(prefers-color-scheme: dark)')
                    .matches)
            ) {
                document.documentElement.classList.add('dark')
            }
        </script>
    @endif

    {{ \Filament\Support\Facades\FilamentView::renderHook('panels::head.end') }}

    <script defer src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <style type="text/css">
        #map {
            height: 400px;
        }
    </style>
</head>

<body class="min-h-screen antialiased font-normal fi-body bg-gray-50 text-gray-950 dark:bg-gray-950 dark:text-white">
    {{ \Filament\Support\Facades\FilamentView::renderHook('panels::body.start') }}

    {{ $slot }}

    @livewire(Filament\Livewire\Notifications::class)

    {{ \Filament\Support\Facades\FilamentView::renderHook('panels::scripts.before') }}

    @filamentScripts(withCore: true)

    @if (config('filament.broadcasting.echo'))
        <script data-navigate-once>
            window.Echo = new window.EchoFactory(@js(config('filament.broadcasting.echo')))

            window.dispatchEvent(new CustomEvent('EchoLoaded'))
        </script>
    @endif

    @stack('scripts')


    {{ \Filament\Support\Facades\FilamentView::renderHook('panels::scripts.after') }}

    {{ \Filament\Support\Facades\FilamentView::renderHook('panels::body.end') }}

    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"></script>
</body>

</html>
