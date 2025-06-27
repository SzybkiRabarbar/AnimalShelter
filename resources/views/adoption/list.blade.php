<x-app-layout>
    <x-slot name="header">
        {{ __('Adoptions') }}
    </x-slot>

    <x-base-div>
        <h2 class="text-2xl font-semibold mb-4 ">{{ __('Adoption List') }}</h2>

        <div class="overflow-x-auto  shadow-sm sm:rounded-lg border border-border">
            <table class="min-w-full divide-y divide-border">
                <thead class="bg-dirtyBackground">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">{{ __('Animal') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">{{ __('User') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">{{ __('Accepted') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">{{ __('Taken') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">{{ __('Take Date') }}</th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">{{ __('Details') }}</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @foreach ($adoptions as $adoption)
                    <tr class="hover:bg-dirtyBackground">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ">
                            {{ $adoption->animal->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm ">
                            {{ $adoption->user->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm ">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $adoption->is_accepted ? 'bg-success text-white' : 'bg-danger text-white' }}">
                                {{ $adoption->is_accepted ? __('Yes') : __('No') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm ">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $adoption->is_taken ? 'bg-success text-white' : 'bg-danger text-white' }}">
                                {{ $adoption->is_taken ? __('Yes') : __('No') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm ">
                            {{ $adoption->take_date ? \Carbon\Carbon::parse($adoption->take_date)->format('Y-m-d') : __('Not set') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('adoption.details', $adoption->uuid) }}" class="text-primary hover:text-text">{{ __('Details') }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-base-div>

</x-app-layout>