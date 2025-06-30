<x-app-layout>
    <x-slot name="header">
        {{ __('List of Animals') }}
    </x-slot>

    <x-base-div>
        <div class="p-2 flex items-center space-x-4">
            <form method="GET" action="{{ route('animal.list') }}" class="">
                <label for="shelter_uuid" class="sr-only">Filter by Shelter</label>
                <select name="shelter_uuid" id="shelter_uuid" class="border-border focus:border-primary focus:ring-primary rounded-md shadow-sm">
                    <option value="all">All Shelters</option>
                    @foreach ($shelters as $shelter)
                    <option value="{{ $shelter->uuid }}" {{ $selectedShelterUuid == $shelter->uuid ? 'selected' : '' }}>
                        {{ $shelter->name }}
                    </option>
                    @endforeach
                </select>
                <select name="type" id="type" class="border-border focus:border-primary focus:ring-primary rounded-md shadow-sm">
                    <option value="all">All Types</option>
                    @foreach ($types as $type)
                    <option value="{{ $type }}" {{ $selectedType == $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                    @endforeach
                </select>
                <select name="breed" id="breed" class="border-border focus:border-primary focus:ring-primary rounded-md shadow-sm" {{ empty($breeds) ? 'disabled ' : '' }}>
                    <option value="all" {{ empty($breeds) ? 'disabled' : '' }}>All breeds</option>
                    @if (!empty($breeds))
                    @foreach ($breeds as $breed)
                    <option value="{{ $breed }}" {{ $selectedBreed == $breed ? 'selected' : '' }}>
                        {{ $breed }}
                    </option>
                    @endforeach
                    @endif
                </select>
                <x-primary-button type="submit">
                    Apply Filter
                </x-primary-button>
            </form>
            @auth
            @if (Auth::user()->is_admin)
            <a href="{{ route('animal.create') }}">
                <x-secondary-button>
                    Create
                </x-secondary-button>
            </a>
            @endif
            @endauth
        </div>
    </x-base-div>


    <x-base-div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($animals as $animal)
            <a href="{{ route('animal.details', ['uuid' => $animal->uuid]) }}" id="{{$animal->uuid}}" class="border p-4 rounded hover:border-primary block">
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