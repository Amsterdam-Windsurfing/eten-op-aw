<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center bg-gray-100">

        <div class="w-full  sm:max-w-xl bg-white shadow-md overflow-hidden sm:rounded-lg">


            <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-bold text-gray-900">Samen eten op de
                    woensdagavond {{ $nextWednesday["date"]->format('j F Y') }}</h3>
            </div>


            <p class="px-4 sm:px-6 mt-5 text-base text-gray-700">We hebben nog niemand die gaat koken deze
                woensdagavond. Heb je zin om te koken? Meld je dan aan als kok. Je ontvangt na de deadline voor het
                aanmelden een overzicht van iedereen die mee wilt eten per e-mail.</p>

            @if($nextWednesday["dinnerEvent"])
                <div>
                    Er is een kok
                </div>

            @else

                @include('dinner-events.create_form_include')

            @endif
        </div>

    </div>
</x-guest-layout>
