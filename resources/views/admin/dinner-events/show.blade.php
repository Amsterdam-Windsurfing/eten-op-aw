<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bekijk dinner evenement
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-6 flex items-center justify-between">
                <a href="{{ route('admin.dinner-events.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Back to list</a>

                <a href="{{ route('admin.dinner-events.edit', $dinnerEvent->id) }}"
                   class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">Evenement
                    bewerken</a>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <tr class="border-b">
                                    <th scope="col"
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Datum
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        {{ \Carbon\Carbon::parse($dinnerEvent->date)->translatedFormat('l j F Y') }}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th scope="col"
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Deadline registratie
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        {{ \Carbon\Carbon::parse($dinnerEvent->registration_deadline)->translatedFormat('l j F Y - H:i') }}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th scope="col"
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Naam kok
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        {{ $dinnerEvent->cook_name }}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th scope="col"
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email kok
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        <a href="mailto:{{ $dinnerEvent->cook_email }}">{{ $dinnerEvent->cook_email }}</a>
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th scope="col"
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Omschrijving
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        {{ $dinnerEvent->description }}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th scope="col"
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Bevestigd
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        {{ $dinnerEvent->event_verified_at ? 'Ja (op ' . \Carbon\Carbon::parse($dinnerEvent->registration_deadline)->translatedFormat('d-m-Y H:i:s') . ')' : 'Nee' }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="font-medium leading-tight text-2xl mt-10 mb-6">Samenvatting inschrijvingen</h5>

            @include('admin.event-registrations.summary_include', ['dinnerEvent' => $dinnerEvent, 'registrationsOptions' => $dinnerEvent->eventRegistrationsOptions()])

            <h5 class="font-medium leading-tight text-2xl mt-10 mb-6">Overzicht inschrijvingen</h5>

            @include('admin.event-registrations.index_include', ['eventRegistrations' => $dinnerEvent->eventRegistrations])

            <div class="mt-8">
                <a href="{{ route('admin.dinner-events.overview-pdf', $dinnerEvent->id) }}"
                   class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">Download PDF
                    registratielijst</a>
            </div>
        </div>
    </div>
</x-app-layout>
