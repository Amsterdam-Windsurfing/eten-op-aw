<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center bg-gray-100">

        <div class="w-full  sm:max-w-xl bg-white shadow-md overflow-hidden sm:rounded-lg">

            <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-bold text-gray-900">Samen eten op de
                    woensdagavond {{ $dinnerEvent["date"]->translatedFormat('j F Y') }}</h3>
            </div>

            <h4 class="px-4 sm:px-6 py-2 mt-4 text-md font-semibold text-gray-900">Hoi <span
                    class="text-2xl align-middle">👩‍🍳</span> {{ $dinnerEvent["cook_name"] }},</h4>

            <p class="px-4 sm:px-6 my-3 text-base text-gray-700">Leuk dat je wilt gaan koken op woensdagavond {{ $dinnerEvent["date"]->translatedFormat('j F Y') }}!
            </p>
            <p class="px-4 sm:px-6 my-3 text-base text-gray-700">
                Je aanmelding is nu <strong>definitief</strong> en iedereen kan zich tot {{ $dinnerEvent["registration_deadline"]->translatedFormat('j F Y H:i') }} inschrijven voor jouw maaltijd.
            </p>
            <p class="px-4 sm:px-6 my-3 text-base text-gray-700">
                Na de deadline voor het aanmelden ontvang je een overzicht van iedereen die mee wil eten en eventuele opgegeven allergenen waar je rekening mee moet houden.
            </p>

            <h4 class="px-4 sm:px-6 py-2 my-4 text-md font-semibold text-gray-900">Succes met koken woensdag!</h4>

        </div>

    </div>
</x-guest-layout>
