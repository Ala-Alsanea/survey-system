<div>
    {{-- {{ $this->table }} --}}

    @php
        // dd($this->images);
    @endphp
{{-- select filter --}}
    {{-- <div class="m-4 mb-6">
        <x-filament::input.wrapper>
            <x-filament::input.select wire:model="images_selected">
                @foreach ($images_selected as $option)
                    <option value="{{ $option }}">{{ __($option) }}</option>
                @endforeach
            </x-filament::input.select>
        </x-filament::input.wrapper>
    </div> --}}

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3">
        <!--Card 1-->
        @foreach ($images as $img)
            @if ($img->image_national_card_front)
                <a target="_blank" href="{{ $this->getStorageName($img->image_national_card_front) }}">
                    <div class="overflow-hidden rounded shadow-lg">
                        <img class="w-full" src="{{ $this->getStorageName($img->image_national_card_front) }}"
                            alt="{{ $img->image_national_card_front }}">
                        <div class="px-6 py-4">
                            <div class="mb-2 text-xl font-bold">{{ __('image_national_card_front') }}</div>
                            <p class="text-base text-gray-700">
                                {{ $img->name }}
                            </p>
                        </div>
                    </div>
                </a>
            @endif

            @if ($img->image_national_card_back)
                <a target="_blank" href="{{ $this->getStorageName($img->image_national_card_back) }}">

                    <div class="overflow-hidden rounded shadow-lg">
                        <img class="w-full" src="{{ $this->getStorageName($img->image_national_card_back) }}"
                            alt="{{ $img->image_national_card_back }}">
                        <div class="px-6 py-4">
                            <div class="mb-2 text-xl font-bold">{{ __('image_national_card_back') }}</div>
                            <p class="text-base text-gray-700">
                                {{ $img->name }}
                            </p>
                        </div>

                    </div>
                </a>
            @endif

            @if ($img->image_attend)
                <a target="_blank" href="{{ $this->getStorageName($img->image_attend) }}">

                    <div class="overflow-hidden rounded shadow-lg">
                        <img class="w-full" src="{{ $this->getStorageName($img->image_attend) }}"
                            alt="{{ $img->image_attend }}">
                        <div class="px-6 py-4">
                            <div class="mb-2 text-xl font-bold">{{ __('image_attend') }}</div>
                            <p class="text-base text-gray-700">
                                {{ $img->name }}
                            </p>
                        </div>

                    </div>
                </a>
            @endif

            @if ($img->image_contract_direct_work)
                <a target="_blank" href="{{ $this->getStorageName($img->image_contract_direct_work) }}">
                    <div class="overflow-hidden rounded shadow-lg">
                        <img class="w-full" src="{{ $this->getStorageName($img->image_contract_direct_work) }}"
                            alt="{{ $img->image_contract_direct_work }}">
                        <div class="px-6 py-4">
                            <div class="mb-2 text-xl font-bold">{{ __('image_contract_direct_work') }}</div>
                            <p class="text-base text-gray-700">
                                {{ $img->name }}
                            </p>
                        </div>

                    </div>
                </a>
            @endif

            {{-- new --}}

            @if ($img->oct_image_attend)
                <a target="_blank" href="{{ $this->getStorageName($img->oct_image_attend) }}">
                    <div class="overflow-hidden rounded shadow-lg">
                        <img class="w-full" src="{{ $this->getStorageName($img->oct_image_attend) }}"
                            alt="{{ $img->oct_image_attend }}">
                        <div class="px-6 py-4">
                            <div class="mb-2 text-xl font-bold">{{ __('oct_image_attend') }}</div>
                            <p class="text-base text-gray-700">
                                {{ $img->name }}
                            </p>
                        </div>

                    </div>
                </a>
            @endif

            @if ($img->nov_image_attend)
                <a target="_blank" href="{{ $this->getStorageName($img->nov_image_attend) }}">
                    <div class="overflow-hidden rounded shadow-lg">
                        <img class="w-full" src="{{ $this->getStorageName($img->nov_image_attend) }}"
                            alt="{{ $img->nov_image_attend }}">
                        <div class="px-6 py-4">
                            <div class="mb-2 text-xl font-bold">{{ __('nov_image_attend') }}</div>
                            <p class="text-base text-gray-700">
                                {{ $img->name }}
                            </p>
                        </div>

                    </div>
                </a>
            @endif

            @if ($img->dec_image_attend)
                <a target="_blank" href="{{ $this->getStorageName($img->dec_image_attend) }}">
                    <div class="overflow-hidden rounded shadow-lg">
                        <img class="w-full" src="{{ $this->getStorageName($img->dec_image_attend) }}"
                            alt="{{ $img->dec_image_attend }}">
                        <div class="px-6 py-4">
                            <div class="mb-2 text-xl font-bold">{{ __('dec_image_attend') }}</div>
                            <p class="text-base text-gray-700">
                                {{ $img->name }}
                            </p>
                        </div>

                    </div>
                </a>
            @endif

            @if ($img->school_image)
                <a target="_blank" href="{{ $this->getStorageName($img->school_image) }}">
                    <div class="overflow-hidden rounded shadow-lg">
                        <img class="w-full" src="{{ $this->getStorageName($img->school_image) }}"
                            alt="{{ $img->school_image }}">
                        <div class="px-6 py-4">
                            <div class="mb-2 text-xl font-bold">{{ __('school_image') }}</div>
                            <p class="text-base text-gray-700">
                                {{ $img->name }}
                            </p>
                        </div>

                    </div>
                </a>
            @endif

            @if ($img->eduqual_image)
                <a target="_blank" href="{{ $this->getStorageName($img->eduqual_image) }}">
                    <div class="overflow-hidden rounded shadow-lg">
                        <img class="w-full" src="{{ $this->getStorageName($img->eduqual_image) }}"
                            alt="{{ $img->eduqual_image }}">
                        <div class="px-6 py-4">
                            <div class="mb-2 text-xl font-bold">{{ __('eduqual_image') }}</div>
                            <p class="text-base text-gray-700">
                                {{ $img->name }}
                            </p>
                        </div>

                    </div>
                </a>
            @endif
        @endforeach


    </div>
    <dir class="mt-20">

        <x-filament::pagination :paginator="$images" />
    </dir>

    {{-- {{$this->table}} --}}
</div>
