<div class="p-4 bg-white/5 rounded-xl flex flex-col text-center">
    <div class="self-start text-sm">Laracasts</div>

    <div class="py-8 font-bold">
        <h3>Video Producer</h3>
        <p>Full Time - From $60,000</p>
    </div>

    {{-- mt-auto will force this to be at the bottom in cases where there's some more margin to be had --}}
    <div class="flex justify-between items-center mt-auto">
        <div>
            <x-tag>Tag</x-tag>
            <x-tag>Tag</x-tag>
            <x-tag>Tag</x-tag>
        </div>

        {{-- can use placeholder images from here, 42/42 is the dimensions --}}
        {{-- <img src="http://place-hold.it/42/42" alt="" class="rounded-xl"> --}}
        <x-employer-logo :width='42' />
    </div>
</div>
