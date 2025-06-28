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

        @auth
        @if (!Auth::user()->is_admin)
        <div class="mt-6">
            <h3 class="text-xl font-semibold mb-3">Volunteer at this Shelter</h3>
            <form action="{{ route('volunteering.create') }}" method="POST" class="flex items-center space-x-4">
                @csrf
                <input type="hidden" name="shelter_uuid" value="{{ $shelter->uuid }}">
                <div>
                    <label for="volunteer_date" class="sr-only">Volunteer Date</label>
                    <input type="date" id="volunteer_date" name="volunteer_date" required class="border-border rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                </div>
                <x-primary-button type="submit">
                    Request to Volunteer
                </x-primary-button>
            </form>
        </div>
        @endif
        @endauth

    </x-base-div>

</x-app-layout>