<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center bg-gray-100">
        <div class="w-full  sm:max-w-xl bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-bold text-gray-900">Samen eten op de
                    woensdagavond {{ $eventRegistration->DinnerEvent["date"]->translatedFormat('j F Y') }}</h3>
            </div>

            <h4 class="px-4 sm:px-6 py-2 my-4 text-md font-semibold text-gray-900">Helaas pindakaas, je bent te laat met het bevestigen van je aanmelding. Er is dus geen garantie dat je kan mee-eten deze woensdagavond.</h4>
        </div>
    </div>
</x-guest-layout>
