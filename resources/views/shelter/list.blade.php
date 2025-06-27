<x-app-layout>
    <x-slot name="header">
        {{ __('List of Shelters') }}
    </x-slot>

    <x-base-div>
        @foreach($shelters as $shelter)
        <div class="overflow-hidden shadow-sm sm:rounded-lg mb-6 p-6 text-center">
            <a href="{{ route('shelter.details', ['uuid' => $shelter->uuid]) }}" id="{{$shelter->uuid}}">
                <x-primary-button class="w-full">
                    <h2 class="text-2xl font-bold mb-2 w-full">
                        {{ $shelter->name }}
                    </h2>
                </x-primary-button>
            </a>
            <p>{{ $shelter->zone->name}}</p>

        </div>
        @endforeach

        @if($shelters->isEmpty())
        <p>No shelters found.</p>
        @endif
    </x-base-div>

</x-app-layout>