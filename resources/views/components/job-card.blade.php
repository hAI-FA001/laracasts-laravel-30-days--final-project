@props(['job'])

<x-panel class="flex flex-col text-center">
    <div class="self-start text-sm">{{ $job->employer->name }}</div>

    <div class="py-8">
        <h3 class="group-hover:text-blue-800 text-xl font-bold transition-colors duration-300">
            <a href="{{ $job->url }}" target="_blank">
                {{ $job->title }}
            </a>
        </h3>
        <p class="text-sm mt-4">{{ $job->schedule }} - From {{ $job->salary }}</p>
    </div>

    {{-- mt-auto will force this to be at the bottom in cases where there's some more margin to be had --}}
    <div class="flex justify-between items-center mt-auto">
        <div>
            @foreach ($job->tags as $tag)
                <x-tag size="small" :$tag />
            @endforeach
        </div>

        {{-- can use placeholder images from here, 42/42 is the dimensions --}}
        {{-- <img src="http://place-hold.it/42/42" alt="" class="rounded-xl"> --}}
        <x-employer-logo :width='42' />
    </div>
</x-panel>
