<div>
    {{-- {{ $this->table }} --}}

    @php
        // dd($images)
    @endphp

    <div class=" grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-4">
        <!--Card 1-->
        @foreach ($images as $img)
            <a target="_blank" href="{{ $this->getStorageName($img->image_national_card_front) }}">
                <div class="rounded overflow-hidden shadow-lg">
                    <img class="w-full" src="{{ $this->getStorageName($img->image_national_card_front) }}"
                        alt="{{ $img->image_national_card_front }}">
                    {{-- <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">Mountain</div>
                    <p class="text-gray-700 text-base">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, Nonea! Maiores et
                        perferendis eaque, exercitationem praesentium nihil.
                    </p>
                </div> --}}
                </div>
            </a>

            <a target="_blank" href="{{ $this->getStorageName($img->image_national_card_back) }}">

                <div class="rounded overflow-hidden shadow-lg">
                    <img class="w-full" src="{{ $this->getStorageName($img->image_national_card_back) }}"
                        alt="{{ $img->image_national_card_back }}">
                    {{-- <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">Mountain</div>
                    <p class="text-gray-700 text-base">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, Nonea! Maiores et
                        perferendis eaque, exercitationem praesentium nihil.
                    </p>
                </div> --}}

                </div>
            </a>

            <a target="_blank" href="{{ $this->getStorageName($img->image_attend) }}">

                <div class="rounded overflow-hidden shadow-lg">
                    <img class="w-full" src="{{ $this->getStorageName($img->image_attend) }}"
                        alt="{{ $img->image_attend }}">
                    {{-- <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">Mountain</div>
                    <p class="text-gray-700 text-base">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, Nonea! Maiores et
                        perferendis eaque, exercitationem praesentium nihil.
                    </p>
                </div> --}}

                </div>
            </a>

            <a target="_blank" href="{{ $this->getStorageName($img->image_contract_direct_work) }}">
                <div class="rounded overflow-hidden shadow-lg">
                    <img class="w-full" src="{{ $this->getStorageName($img->image_contract_direct_work) }}"
                        alt="{{ $img->image_contract_direct_work }}">
                    {{-- <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">Mountain</div>
                    <p class="text-gray-700 text-base">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, Nonea! Maiores et
                        perferendis eaque, exercitationem praesentium nihil.
                    </p>
                </div> --}}

                </div>
            </a>
        @endforeach



    </div>
</div>
