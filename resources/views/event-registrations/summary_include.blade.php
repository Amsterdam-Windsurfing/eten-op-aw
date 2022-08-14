<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 w-full">
                    @if($dinnerEvent->meat_option)
                        <tr class="border-b">
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                               Vlees
                            </th>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                {{ $registrationsOptions['meat'] }}
                            </td>
                        </tr>
                    @endif

                    @if($dinnerEvent->vegetarian_option)
                        <tr class="border-b">
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Vegetarisch
                            </th>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                {{ $registrationsOptions['vegetarian'] }}
                            </td>
                        </tr>
                    @endif

                    @if($dinnerEvent->vegan_option)
                        <tr class="border-b">
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Vegan
                            </th>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                {{ $registrationsOptions['vegan'] }}
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
