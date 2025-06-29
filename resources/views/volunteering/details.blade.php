<x-app-layout>
    <x-slot name="header">
        Volunteering Request
    </x-slot>

    <x-base-div>
        <div class="mb-4">
            <p class="text-text"><strong class="font-medium">Volunteer:</strong> {{ $volunteering->user->name }}</p>
            <p class="text-text"><strong class="font-medium">Shelter:</strong> {{ $volunteering->shelter->name }}</p>
            <p class="text-text"><strong class="font-medium">Date:</strong> {{ \Carbon\Carbon::parse($volunteering->volunteer_date)->format('Y-m-d') }}</p>
        </div>

        <div class="mb-6">
            <strong class="font-medium">Status:</strong>
            @if ($volunteering->took_place)
            <span class="text-success font-semibold">Took Place</span>
            @elseif ($volunteering->is_accepted)
            <span class="text-primary font-semibold">Accepted</span>
            @else
            <span class="text-accent font-semibold">Pending</span>
            @endif
        </div>

        @auth
        @if (Auth::user()->is_admin && !$volunteering->took_place)
        <div class="flex space-x-4">
            @if (!$volunteering->is_accepted)
            <form action="{{ route('volunteering.accept', $volunteering->uuid) }}" method="POST" class="p-1">
                @csrf
                @method('PATCH')
                <x-primary-button>Accept</x-primary-button>
            </form>
            @else
            <form action="{{ route('volunteering.unaccept', $volunteering->uuid) }}" method="POST" class="p-1">
                @csrf
                @method('PATCH')
                <x-secondary-button>Unaccept</x-secondary-button>
            </form>
            @endif

            @if ($volunteering->is_accepted)
            <form action="{{ route('volunteering.taken', $volunteering->uuid) }}" method="POST" class="p-1">
                @csrf
                @method('PATCH')
                <x-primary-button>Mark as Took Place</x-primary-button>

            </form>
            @endif
        </div>
        @endif
        @endauth
    </x-base-div>

</x-app-layout>