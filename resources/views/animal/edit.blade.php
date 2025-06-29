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
                    <input id="is_male" type="checkbox" class="rounded border-border text-primary shadow-sm focus:ring-primary" name="is_male" value="1" @checked(old('is_male', $animal->is_male))>
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
                <div class="flex items-center justify-between">
                    <x-input-label for="description" :value="__('Description')" />
                    <button type="button" class="text-sm text-primary hover:text-primary generate-prop-button" data-prop="description" data-target-id="description">
                        Generate with AI
                    </button>
                </div>
                <textarea id="description" class="block mt-1 w-full border-border focus:border-primary focus:ring-primary rounded-md shadow-sm" name="description">{{ old('description', $animal->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <!-- History -->
            <div class="mt-4">
                <div class="flex items-center justify-between">
                    <x-input-label for="history" :value="__('History')" />
                    <button type="button" class="text-sm text-primary hover:text-primary generate-prop-button" data-prop="history" data-target-id="history">
                        Generate with AI
                    </button>
                </div>
                <textarea id="history" class="block mt-1 w-full border-border focus:border-primary focus:ring-primary rounded-md shadow-sm" name="history">{{ old('history', $animal->history) }}</textarea>
                <x-input-error :messages="$errors->get('history')" class="mt-2" />
            </div>

            <!-- Likes -->
            <div class="mt-4">
                <div class="flex items-center justify-between">
                    <x-input-label for="likes" :value="__('Likes')" />
                    <button type="button" class="text-sm text-primary hover:text-primary generate-prop-button" data-prop="likes" data-target-id="likes">
                        Generate with AI
                    </button>
                </div>
                <textarea id="likes" class="block mt-1 w-full border-border focus:border-primary focus:ring-primary rounded-md shadow-sm" name="likes">{{ old('likes', $animal->likes) }}</textarea>
                <x-input-error :messages="$errors->get('likes')" class="mt-2" />
            </div>

            <!-- Dislikes -->
            <div class="mt-4">
                <div class="flex items-center justify-between">
                    <x-input-label for="dislikes" :value="__('Dislikes')" />
                    <button type="button" class="text-sm text-primary hover:text-primary generate-prop-button" data-prop="dislikes" data-target-id="dislikes">
                        Generate with AI
                    </button>
                </div>
                <textarea id="dislikes" class="block mt-1 w-full border-border focus:border-primary focus:ring-primary rounded-md shadow-sm" name="dislikes">{{ old('dislikes', $animal->dislikes) }}</textarea>
                <x-input-error :messages="$errors->get('dislikes')" class="mt-2" />
            </div>

            <!-- Is Archived -->
            <div class="mt-4">
                <input type="hidden" name="is_archived" value="0">
                <label for="is_archived" class="inline-flex items-center">
                    <input id="is_archived" type="checkbox" class="rounded border-border text-primary shadow-sm focus:ring-primary" name="is_archived" value="1" @checked(old('is_archived', $animal->is_archived))>
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
                <textarea id="archive_cause" class="block mt-1 w-full border-border focus:border-primary focus:ring-primary rounded-md shadow-sm" name="archive_cause">{{ old('archive_cause', $animal->archive_cause) }}</textarea>
                <x-input-error :messages="$errors->get('archive_cause')" class="mt-2" />
            </div>

            <!-- Shelter -->
            <div class="mt-4">
                <x-input-label for="shelter_id" :value="__('Shelter')" />
                <select id="shelter_id" name="shelter_id" class="block mt-1 w-full border-border focus:border-primary focus:ring-primary rounded-md shadow-sm">
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

    <!-- AI Generation Modal -->
    <div id="ai-modal" class="fixed inset-0 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-2/3 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-primary" id="modal-title">Generate Text with AI</h3>
                <div class="mt-2">
                    <p class="text-sm" id="modal-prop-name"></p>
                    <div class="flex flex-col md:flex-row gap-4 mt-4">
                        <div class="w-full md:w-1/2">
                            <h4 class="text-md font-semibold">Current Text</h4>
                            <textarea id="modal-old-text" class="mt-1 block w-full border-border focus:border-primary focus:ring-primary rounded-md shadow-sm h-64"></textarea>
                        </div>
                        <div class="w-full md:w-1/2">
                            <h4 class="text-md font-semibold">Generated Text</h4>
                            <textarea id="modal-generated-text" class="mt-1 block w-full border-border focus:border-primary focus:ring-primary rounded-md shadow-sm h-64" placeholder="Generating..."></textarea>
                            <div id="modal-loading" class="mt-2 text-center text-sm hidden">Generating...</div>
                            <div id="modal-error" class="mt-2 text-center text-sm text-red-600 hidden">Error generating text.</div>
                        </div>
                    </div>
                </div>
                <div class="items-center px-4 py-3">
                    <x-primary-button id="copy-generated-text">
                        Copy Generated Text
                    </x-primary-button>
                    <x-secondary-button id="copy-old-text">
                        Copy Current Text
                    </x-secondary-button>
                    <x-secondary-button id="close-modal">
                        Close
                    </x-secondary-button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('ai-modal');
            const closeModalButton = document.getElementById('close-modal');
            const generateButtons = document.querySelectorAll('.generate-prop-button');
            const modalPropName = document.getElementById('modal-prop-name');
            const modalOldText = document.getElementById('modal-old-text');
            const modalGeneratedText = document.getElementById('modal-generated-text');
            const modalLoading = document.getElementById('modal-loading');
            const modalError = document.getElementById('modal-error');
            const copyButton = document.getElementById('copy-generated-text');
            const copyOldButton = document.getElementById('copy-old-text');

            let currentTargetId = null;

            generateButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const prop = this.getAttribute('data-prop');
                    const targetId = this.getAttribute('data-target-id');
                    const targetTextarea = document.getElementById(targetId);

                    if (!targetTextarea) {
                        console.error('Target textarea not found:', targetId);
                        return;
                    }

                    currentTargetId = targetId;

                    const animalData = {
                        type: document.getElementById('type').value,
                        name: document.getElementById('name').value,
                        is_male: document.getElementById('is_male').checked,
                        breed: document.getElementById('breed').value,
                        date_of_birth: document.getElementById('date_of_birth').value,
                        description: document.getElementById('description').value,
                        history: document.getElementById('history').value,
                        likes: document.getElementById('likes').value,
                        dislikes: document.getElementById('dislikes').value,
                    };

                    modalPropName.textContent = `Property: ${prop.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())}`;
                    modalOldText.value = targetTextarea.value;
                    modalGeneratedText.value = '';
                    modalLoading.classList.remove('hidden');
                    modalError.classList.add('hidden');
                    copyButton.disabled = true;
                    copyOldButton.disabled = false;

                    modal.classList.remove('hidden');

                    fetch("{{ route('animal.llm.prop') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                prop: prop,
                                ...animalData
                            })
                        })
                        .then(response => {
                            modalLoading.classList.add('hidden');
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.value) {
                                modalGeneratedText.value = data.value;
                                copyButton.disabled = false;
                            } else {
                                modalGeneratedText.value = 'No text generated.';
                                modalError.textContent = 'AI did not return text.';
                                modalError.classList.remove('hidden');
                                copyButton.disabled = true;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            modalLoading.classList.add('hidden');
                            modalGeneratedText.value = '';
                            modalError.textContent = 'Error generating text: ' + error.message;
                            modalError.classList.remove('hidden');
                            copyButton.disabled = true;
                        });
                });
            });

            closeModalButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });

            copyButton.addEventListener('click', function() {
                if (currentTargetId) {
                    const targetTextarea = document.getElementById(currentTargetId);
                    if (targetTextarea) {
                        targetTextarea.value = modalGeneratedText.value;
                        modal.classList.add('hidden');
                    }
                }
            });

            copyOldButton.addEventListener('click', function() {
                if (currentTargetId) {
                    const targetTextarea = document.getElementById(currentTargetId);
                    if (targetTextarea) {
                        targetTextarea.value = modalGeneratedText.value;
                        modal.classList.add('hidden');
                    }
                }
            });

            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>

</x-app-layout>