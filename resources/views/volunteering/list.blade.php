<x-app-layout>
    <x-slot name="header">
        Volunteering
    </x-slot>

    <x-base-div>
        <div class="overflow-x-auto shadow-sm sm:rounded-lg border border-border">
            <table class="min-w-full divide-y divide-border">
                <thead class="bg-dirtyBackground">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">{{ __('Volunteer') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">{{ __('Shelter') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">{{ __('Date') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">{{ __('Status') }}</th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">{{ __('Actions') }}</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($volunteeringRecords as $record)
                    <tr class="{{ $loop->even ? 'bg-dirtyBackground' : 'bg-background' }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ">{{ $record->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm ">{{ $record->shelter->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm ">{{ \Carbon\Carbon::parse($record->volunteer_date)->format('Y-m-d') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm ">
                            @if ($record->took_place)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-success text-white">{{ __('Took Place') }}</span>
                            @elseif ($record->is_accepted)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-primary text-white">{{ __('Accepted') }}</span>
                            @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-accent text-white">{{ __('Pending') }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('volunteering.details', $record->uuid) }}" class="text-primary hover:underline">{{ __('Details') }}</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-4 px-4 text-center text-text">{{ __('No volunteering records found.') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-base-div>

</x-app-layout>