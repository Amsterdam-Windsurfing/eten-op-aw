<div class="px-4 sm:px-6 my-2 text-base text-gray-700">
    <p class="block font-medium text-sm text-gray-600">Aanmeldingen</p>

    <div class="flex flex-row">
        @if($dinnerEvent->meat_option || $registrationsOptions['meat'])
            <div class="basis-1/3">Vlees <span class="text-2xl align-middle">🥩</span>
                <strong>{{ $registrationsOptions['meat'] }}</strong></div>
        @endif

        @if($dinnerEvent->vegetarian_option || $registrationsOptions['vegetarian'])
            <div class="basis-1/3">Vegetarisch <span
                    class="text-2xl align-middle">🍆</span> <strong>{{ $registrationsOptions['vegetarian'] }}</strong>
            </div>
        @endif

        @if($dinnerEvent->vegan_option || $registrationsOptions['vegan'])
            <div class="basis-1/3">Vegan<span
                    class="text-2xl align-middle">🌱</span> <strong>{{ $registrationsOptions['vegan'] }}</strong></div>
        @endif
    </div>
</div>
