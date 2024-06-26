@php
    use Filament\Support\Enums\MaxWidth;
@endphp

<x-filament-panels::layout.base :livewire="$livewire">
    @props([
        'after' => null,
        'heading' => null,
        'subheading' => null,
    ])
    <img src="{{ asset('/img/bg2.jpg') }}" class="absolute w-full h-full " style=" z-index: -10;">
    <div {{-- style="background: url({{asset('/img/bg.jpg')}});" --}}>

        {{-- <img src="/img/logo_1.jpeg" width="100" style="position: fixed; z-index:10; bottom: 0px" alt=""> --}}
        {{-- <img src="/img/logo_2.jpeg" width="100" style="position: fixed; z-index:9; bottom: 0px; right:1px ;" alt=""> --}}

        <div class="flex flex-col items-center min-h-screen  fi-simple-layout" style="padding-left: 15%">
            @if (filament()->auth()->check())
                <div class="flex items-center h-16 end-0 gap-x-4 pe-4 md:pe-6 lg:pe-8">
                    @if (filament()->hasDatabaseNotifications())
                        @livewire(Filament\Livewire\DatabaseNotifications::class, ['lazy' => true])
                    @endif

                    <x-filament-panels::user-menu />
                </div>
            @endif

            <div class="flex items-center justify-between flex-grow w-full fi-simple-main-ctn">
                <main @class([
                    'max-w-xl fi-simple-main w-full bg-white px-6 py-12 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 sm:rounded-xl sm:px-12 ',
                    // match ($maxWidth ?? null) {
                    //     MaxWidth::ExtraSmall, 'xs' => 'sm:max-w-xs',
                    //     MaxWidth::Small, 'sm' => 'sm:max-w-sm',
                    //     MaxWidth::Medium, 'md' => 'sm:max-w-md',
                    //     MaxWidth::ExtraLarge, 'xl' => 'sm:max-w-xl',
                    //     MaxWidth::TwoExtraLarge, '2xl' => 'sm:max-w-2xl',
                    //     MaxWidth::ThreeExtraLarge, '3xl' => 'sm:max-w-3xl',
                    //     MaxWidth::FourExtraLarge, '4xl' => 'sm:max-w-4xl',
                    //     MaxWidth::FiveExtraLarge, '5xl' => 'sm:max-w-5xl',
                    //     MaxWidth::SixExtraLarge, '6xl' => 'sm:max-w-6xl',
                    //     MaxWidth::SevenExtraLarge, '7xl' => 'sm:max-w-7xl',
                    //     default => 'sm:max-w-lg',
                    // },
                ])>
                    {{ $slot }}
                </main>
            </div>

            {{ \Filament\Support\Facades\FilamentView::renderHook('panels::footer') }}
        </div>
    </div>


</x-filament-panels::layout.base>
