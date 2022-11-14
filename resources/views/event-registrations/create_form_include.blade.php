<form method="post" action="{{ route('event-registrations.store') }}">
    @csrf

    @error('general')
        <p class="px-4 py-3 sm:px-6 text-sm text-red-600">{{ $message }}</p>
    @enderror

    <div class="px-4 py-3 sm:px-6">
        <div class="flex">
            <label for="name" class="block font-medium text-sm text-gray-600">Wat is je naam?</label>
            <img class="ml-auto mr-1" src="{{ asset('images/information-circle.svg') }}" width="22" height="22" @popper(Je naam wordt niet publiek getoond. Wel kan de kok je naam zien.) />
        </div>

        <input type="text" name="name" id="name"
               class="form-input rounded-md shadow-sm mt-1 block w-full"
               value="{{ old('name', '') }}"/>
        @error('name')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="px-4 py-5 sm:px-6">
        <div class="flex">
            <label for="email" class="block font-medium text-sm text-gray-600">Wat is je e-mail?</label>
            <img class="ml-auto mr-1" src="{{ asset('images/information-circle.svg') }}" width="22" height="22" @popper(Dit is nodig om je aanmelding te bevestigen.) />
        </div>
        <input type="email" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full"
               value="{{ old('email', '') }}"/>
        @error('email')
        <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="px-4 pb-3 sm:px-6">
        <label for="email" class="block font-medium text-sm text-gray-600">Voor welke optie geef je je op?</label>

        <div class="flex flex-wrap">
            <div class="mr-10">
                <input type="radio"
                       name="dinner_option"
                       id="meat_option"
                       value="meat"
                    @checked(old('dinner_option') == 'meat') />
                <label for="meat_option" class="font-medium text-sm pl-2"><span class="text-2xl align-middle">🥩</span>
                    Vlees</label>
            </div>

            <div class="mr-10">
                <input type="radio"
                       name="dinner_option"
                       id="vegetarian_option"
                       value="vegetarian"
                    @checked(old('dinner_option') == 'vegetarian') />
                <label for="vegetarian_option" class="font-medium text-sm pl-2"><span
                        class="text-2xl align-middle">🍆</span> Vegetarisch</label>
            </div>

            <div class="mr-10">
                <input type="radio"
                       name="dinner_option"
                       id="vegan_option"
                       value="vegan"
                    @checked(old('dinner_option') == 'vegan') />
                <label for="vegan_option" class="font-medium text-sm pl-2"><span class="text-2xl align-middle">🌱</span>
                    Vegan</label>
            </div>
        </div>

        @error('dinner_option')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="px-4 py-3 sm:px-6">
        <div class="flex">
            <label for="allergies" class="block font-medium text-sm text-gray-600">Heb je allergieën waar rekening mee gehouden moet worden?</label>
            <img class="ml-auto mr-1" src="{{ asset('images/information-circle.svg') }}" width="22" height="22" @popper(Wat je hier opgeeft wordt doorgegeven aan de kok. Controleer altijd op de avond zelf of hier ook rekening mee is gehouden tijdens het koken.) />
        </div>
        <textarea name="allergies" id="allergies"
                  class="form-input rounded-md shadow-sm mt-1 block w-full">{{ old('allergies', '') }}</textarea>

        @error('allergies')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-start px-4 py-3 bg-gray-50 text-right sm:px-6">
        <button
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
            Aanmelden
        </button>
    </div>
</form>
