<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center bg-gray-100">
        <div class="w-full  sm:max-w-xl bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-bold text-gray-900">Samen eten op de
                    woensdagavond {{ $eventRegistration->DinnerEvent["date"]->translatedFormat('j F Y') }}</h3>
            </div>

            <h4 class="px-4 sm:px-6 py-2 mt-4 text-md font-semibold text-gray-900">
                Hoi {{ $eventRegistration->name }},</h4>

            <p class="px-4 sm:px-6 my-3 text-base text-gray-700">Gezellig dat je mee eet op
                woensdagavond {{ $eventRegistration->DinnerEvent["date"]->translatedFormat('j F Y') }}!</p>

            <p class="px-4 sm:px-6 my-3 text-base text-gray-700">
                Je aanmelding voor het eten is nu <strong>definitief</strong>.
            </p>

            <h4 class="px-4 sm:px-6 py-2 my-4 text-md font-semibold text-gray-900">Tot woensdag!</h4>
        </div>
    </div>
</x-guest-layout>
