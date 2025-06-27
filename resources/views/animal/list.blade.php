<x-app-layout>
    <x-slot name="header">
        {{ __('List of Animals') }}
    </x-slot>

    <x-base-div>
        <span>Filters</span>
        @auth
        @if (Auth::user()->is_admin)
        <a href="{{ route('animal.create') }}" class="p-2">
            <x-primary-button>
                Create
            </x-primary-button>
        </a>
        @endif
        @endauth
    </x-base-div>


    <x-base-div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($animals as $animal)
            <a href="{{ route('animal.details', ['uuid' => $animal->uuid]) }}" id="animal-{{$animal->uuid}}" class="border p-4 rounded hover:border-primary block">
                <h3 class="text-lg text-center">{{ $animal->name }}</h3>
                <img src="{{ asset('storage/animals/' . $animal->uuid . '.jpg') }}" alt="{{ $animal->name }}'s photo" class="w-64 h-64 object-cover rounded-lg mb-4 block mx-auto shadow-lg">
                <div class="bg-dirtyBackground p-2 border rounded-lg flex justify-between shadow-md">
                    <span class="pl-2 pr-2 border rounded-lg bg-primary shadow-lg">
                        {{ $animal->type }}
                    </span>
                    <span class="pr-2">{{ $animal->breed }}</span>
                </div>
            </a>
            @empty
            <p>No animals found.</p>
            @endforelse
        </div>
    </x-base-div>
</x-app-layout>