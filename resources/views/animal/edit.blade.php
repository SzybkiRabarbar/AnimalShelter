<x-app-layout>
    <x-slot name="header">
        Edit animal
    </x-slot>

    <x-base-div>
        <form method="POST" action="{{ route('animal.update', ['uuid' => $animal->uuid]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Type -->
            <div>
                <x-input-label for="type" :value="__('Type')" />
                <x-text-input id="type" class="block mt-1 w-full" type="text" name="type" :value="old('type', $animal->type)" required autofocus />
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="mt-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $animal->name)" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Is Male -->
            <div class="mt-4">
                <input type="hidden" name="is_male" value="0">
                <label for="is_male" class="inline-flex items-center">
                    <input id="is_male" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_male" value="1" @checked(old('is_male', $animal->is_male))>
                    <span class="ms-2 text-sm text-gray-600">{{ __('Is Male') }}</span>
                </label>
                <x-input-error :messages="$errors->get('is_male')" class="mt-2" />
            </div>

            <!-- Breed -->
            <div class="mt-4">
                <x-input-label for="breed" :value="__('Breed')" />
                <x-text-input id="breed" class="block mt-1 w-full" type="text" name="breed" :value="old('breed', $animal->breed)" />
                <x-input-error :messages="$errors->get('breed')" class="mt-2" />
            </div>

            <!-- Date of Birth -->
            <div class="mt-4">
                <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('date_of_birth', $animal->date_of_birth)" />
                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
            </div>

            <!-- Arrival Date -->
            <div class="mt-4">
                <x-input-label for="arrival_date" :value="__('Arrival Date')" />
                <x-text-input id="arrival_date" class="block mt-1 w-full" type="date" name="arrival_date" :value="old('arrival_date', $animal->arrival_date)" required />
                <x-input-error :messages="$errors->get('arrival_date')" class="mt-2" />
            </div>

            <!-- Description -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="description">{{ old('description', $animal->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <!-- History -->
            <div class="mt-4">
                <x-input-label for="history" :value="__('History')" />
                <textarea id="history" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="history">{{ old('history', $animal->history) }}</textarea>
                <x-input-error :messages="$errors->get('history')" class="mt-2" />
            </div>

            <!-- Likes -->
            <div class="mt-4">
                <x-input-label for="likes" :value="__('Likes')" />
                <textarea id="likes" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="likes">{{ old('likes', $animal->likes) }}</textarea>
                <x-input-error :messages="$errors->get('likes')" class="mt-2" />
            </div>

            <!-- Dislikes -->
            <div class="mt-4">
                <x-input-label for="dislikes" :value="__('Dislikes')" />
                <textarea id="dislikes" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="dislikes">{{ old('dislikes', $animal->dislikes) }}</textarea>
                <x-input-error :messages="$errors->get('dislikes')" class="mt-2" />
            </div>

            <!-- Is Archived -->
            <div class="mt-4">
                <input type="hidden" name="is_archived" value="0">
                <label for="is_archived" class="inline-flex items-center">
                    <input id="is_archived" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_archived" value="1" @checked(old('is_archived', $animal->is_archived))>
                    <span class="ms-2 text-sm text-gray-600">{{ __('Is Archived') }}</span>
                </label>
                <x-input-error :messages="$errors->get('is_archived')" class="mt-2" />
            </div>

            <!-- Archived Date -->
            <div class="mt-4">
                <x-input-label for="archived_date" :value="__('Archived Date')" />
                <x-text-input id="archived_date" class="block mt-1 w-full" type="date" name="archived_date" :value="old('archived_date', $animal->archived_date)" />
                <x-input-error :messages="$errors->get('archived_date')" class="mt-2" />
            </div>

            <!-- Archive Cause -->
            <div class="mt-4">
                <x-input-label for="archive_cause" :value="__('Archive Cause')" />
                <textarea id="archive_cause" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="archive_cause">{{ old('archive_cause', $animal->archive_cause) }}</textarea>
                <x-input-error :messages="$errors->get('archive_cause')" class="mt-2" />
            </div>

            <!-- Shelter -->
            <div class="mt-4">
                <x-input-label for="shelter_id" :value="__('Shelter')" />
                <select id="shelter_id" name="shelter_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    @foreach($shelters as $shelter)
                        <option value="{{ $shelter->id }}" @selected(old('shelter_id', $animal->shelter_id) == $shelter->id)>
                            {{ $shelter->name }} [{{ $shelter->zone->name }}]
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('shelter_id')" class="mt-2" />
            </div>

            <!-- Animal Image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('Animal Image (JPG)')" />
                <input id="image" class="block mt-1 w-full" type="file" name="image" accept=".jpg, .jpeg" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </x-base-div>

</x-app-layout>