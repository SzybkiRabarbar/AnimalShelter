<x-app-layout>
    <x-slot name="header">
        {{ $adoption->animal->name ?? __('Adoption Details') }}
    </x-slot>

    <x-base-div>
        <h2 class="text-2xl font-semibold mb-6 ">{{ __('Adoption Details') }}</h2>

        <div class=" shadow-sm sm:rounded-lg border border-border p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm font-medium ">{{ __('Animal Name') }}:</p>
                    <a href="{{ route('animal.details', ['uuid' => $adoption->animal->uuid]) }}" id="{{$adoption->animal->uuid}}">
                        <p class="text-primary mt-1 text-lg ">{{ $adoption->animal->name ?? 'N/A' }}</p>
                    </a>
                </div>

                <div>
                    <p class="text-sm font-medium ">{{ __('User Name') }}:</p>
                    <p class="mt-1 text-lg ">{{ $adoption->user->name ?? 'N/A' }}</p>
                </div>

                <div>
                    <p class="text-sm font-medium ">{{ __('Accepted') }}:</p>
                    <p class="mt-1 text-lg">
                        <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full {{ $adoption->is_accepted ? 'bg-success text-white' : 'bg-danger text-white' }}">
                            {{ $adoption->is_accepted ? __('Yes') : __('No') }}
                        </span>
                    </p>
                </div>
                <div>
                    <p class="text-sm font-medium ">{{ __('Taken') }}:</p>
                    <p class="mt-1 text-lg">
                        <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full {{ $adoption->is_taken ? 'bg-success text-white' : 'bg-danger text-white' }}">
                            {{ $adoption->is_taken ? __('Yes') : __('No') }}
                        </span>
                    </p>
                </div>
                <div>
                    <p class="text-sm font-medium ">{{ __('Take Date') }}:</p>
                    <p class="mt-1 text-lg ">
                        {{ $adoption->take_date ? \Carbon\Carbon::parse($adoption->take_date)->format('Y-m-d') : __('Not set') }}
                    </p>
                </div>
            </div>

            @auth
            @if (Auth::user()->is_admin)
            <div class="mt-6 flex justify-end">
                @if (!$adoption->is_accepted)
                <form action="{{ route('adoption.accept', $adoption->uuid) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <x-primary-button>
                        {{ __('Accept Adoption') }}
                    </x-primary-button>
                </form>
                @endif
                @if ($adoption->is_accepted && !$adoption->is_taken)
                <form action="{{ route('adoption.unaccept', $adoption->uuid) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <x-secondary-button>
                        {{ __('Unaccept Adoption') }}
                    </x-secondary-button>
                </form>
                <form action="{{ route('adoption.taken', $adoption->uuid) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <x-primary-button>
                        {{ __('Mark as Taken') }}
                    </x-primary-button>
                </form>
                @endif
            </div>
            @endif
            @endauth
        </div>
    </x-base-div>

</x-app-layout>