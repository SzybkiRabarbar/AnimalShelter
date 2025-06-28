<x-app-layout>
    <x-slot name="header">
        Volunteering
    </x-slot>

    <x-base-div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-border">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-border text-left">Volunteer</th>
                        <th class="py-2 px-4 border-b border-border text-left">Shelter</th>
                        <th class="py-2 px-4 border-b border-border text-left">Date</th>
                        <th class="py-2 px-4 border-b border-border text-left">Status</th>
                        <th class="py-2 px-4 border-b border-border text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($volunteeringRecords as $record)
                    <tr class="{{ $loop->even ? 'bg-dirtyBackground' : 'bg-background' }}">
                        <td class="py-2 px-4 border-b border-border">{{ $record->user->name }}</td>
                        <td class="py-2 px-4 border-b border-border">{{ $record->shelter->name }}</td>
                        <td class="py-2 px-4 border-b border-border">{{ \Carbon\Carbon::parse($record->volunteer_date)->format('Y-m-d') }}</td>
                        <td class="py-2 px-4 border-b border-border">
                            @if ($record->took_place)
                            <span class="text-success">Took Place</span>
                            @elseif ($record->is_accepted)
                            <span class="text-primary">Accepted</span>
                            @else
                            <span class="text-accent">Pending</span>
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b border-border">
                            <a href="{{ route('volunteering.details', $record->uuid) }}" class="text-primary hover:underline">Details</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-4 px-4 text-center text-text">No volunteering records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-base-div>

</x-app-layout>