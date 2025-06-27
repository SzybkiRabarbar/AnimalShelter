<x-app-layout>
    <x-slot name="header">
        {{$animal->type}} - {{ $animal->name }}
    </x-slot>

    <x-base-div>
        <div class="flex">
            <img src="{{ asset('storage/animals/' . $animal->uuid . '.jpg') }}"
                alt="{{ $animal->name }}'s photo"
                style="height: 60vh; width: 60vh;"
                class="object-cover rounded-lg mb-4 block shadow-lg">
            <div class="p-2 flex flex-col">
                @php
                $details = [
                ['label' => 'Name', 'value' => $animal->name],
                ['label' => 'Type', 'value' => $animal->type],
                ['label' => 'Breed', 'value' => $animal->breed],
                ['label' => 'Gender', 'value' => $animal->is_male == 1 ? 'M' : 'F'],
                ['label' => 'DOB', 'value' => $animal->date_of_birth],
                ['label' => 'Arrival', 'value' => $animal->arrival_date],
                ['label' => 'Stays in', 'value' => $shelter->name . ' [' . $shelter->zone->name . ']'],
                ['label' => 'Visiting hours', 'value' => $shelter->open_hour . ' - ' . $shelter->close_hour],
                ];
                $texts = [
                ['label' => 'Description', 'value' => $animal->description],
                ['label' => 'History', 'value' => $animal->history],
                ['label' => 'Likes', 'value' => $animal->likes],
                ['label' => 'Dislikes', 'value' => $animal->dislikes],
                ];
                @endphp

                @foreach ($details as $detail)
                <div class="flex items-center">
                    <span class="p-1">
                        {{ $detail['label'] }}:
                    </span>
                    <span class="p-1 text-primary">
                        {{ $detail['value'] }}
                    </span>
                </div>
                @endforeach

                <a href="{{ route('shelter.details', ['uuid' => $shelter->uuid]) }}" class="p-2">
                    <x-secondary-button>
                        Shelter info 
                    </x-secondary-button>
                </a>


                @foreach ($texts as $text)
                <span class="p-1">
                    {{ $text['label'] }}
                </span>
                <span class="bg-dirtyBackground p-1 border rounded-lg flex justify-between shadow-md">
                    {{ $text['value'] }}
                </span>
                @endforeach

                @auth
                @if (Auth::user()->is_admin)
                <a href="{{ route('animal.edit', ['uuid' => $animal->uuid]) }}" class="p-2">
                    <x-primary-button>
                        Edit
                    </x-primary-button>
                </a>
                @else
                <a href="{{ route('animal.details', ['uuid' => $animal->uuid]) }}" class="p-2">
                    <x-primary-button>
                        Adopt
                    </x-primary-button>
                </a>
                @endif
                @endauth

            </div>
        </div>
    </x-base-div>

</x-app-layout>