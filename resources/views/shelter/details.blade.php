<x-app-layout>
    <x-slot name="header">
        {{$shelter->name}}
    </x-slot>

    <x-base-div>
        <div class="mb-6">
            <p class="text-lg"><strong>Zone:</strong> {{ $shelter->zone->name }}</p>
            <p class="text-lg"><strong>Opening Hours:</strong> {{ $shelter->open_hour }} - {{ $shelter->close_hour }}</p>
        </div>

        @if($shelter->animals->isEmpty())
        <p>No animals currently in this shelter.</p>
        @else
        <p>There are {{ $shelter->animals->count() }} animals in this shelter.</p>
        <a href="{{ route('animal.list', ['shelter_uuid' => $shelter->uuid]) }}">
            <x-primary-button>
                View all animals in this shelter
            </x-primary-button>
        </a>
        @endif

    </x-base-div>

</x-app-layout>