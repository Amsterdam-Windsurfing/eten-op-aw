<form method="post" action="{{ route('dinner-events.store') }}">
    @csrf

    <p class="px-4 sm:px-6 mt-5 text-base text-gray-700">We hebben nog niemand die gaat koken deze
        woensdagavond. Heb je zin om te koken? Meld je dan aan als kok. Je ontvangt na de deadline voor het
        aanmelden een overzicht van iedereen die mee wilt eten per e-mail.</p>

    <h4 class="px-4 sm:px-6 py-2 mt-4 text-md font-semibold text-gray-900">Ja, ik ga koken! <span
            class="text-2xl align-middle">👩‍🍳</span></h4>

    @error('general')
    <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror

    <div class="px-4 py-3 sm:px-6">
        <label for="cook_name" class="block font-medium text-sm text-gray-600">Wat is je naam?</label>
        <input type="text" name="cook_name" id="cook_name"
               class="form-input rounded-md shadow-sm mt-1 block w-full"
               value="{{ old('cook_name', '') }}"/>
        @error('cook_name')
        <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="px-4 py-3 sm:px-6">
        <label for="cook_name" class="block font-medium text-sm text-gray-600">Wat ga je voor eten
            maken?</label>
        <textarea name="description" id="description"
                  class="form-input rounded-md shadow-sm mt-1 block w-full">{{ old('description', '') }}</textarea>

        @error('description')
        <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="px-4 pb-3 sm:px-6">

        <div class="flex flex-wrap">
            <div class="mr-10">
                <input type="checkbox"
                       name="meat_option"
                       id="meat_option"
                       value="true"
                    @checked(old('meat_option')) />
                <label for="meat_option" class="font-medium text-sm pl-2"><span class="text-2xl align-middle">🥩</span>
                    Vlees</label>
            </div>

            <div class="mr-10">
                <input type="checkbox"
                       name="vegetarian_option"
                       id="vegetarian_option"
                       value="true"
                    @checked(old('vegetarian_option')) />
                <label for="vegetarian_option" class="font-medium text-sm pl-2"><span
                        class="text-2xl align-middle">🍆</span> Vegetarisch</label>
            </div>

            <div class="mr-10">
                <input type="checkbox"
                       name="vegan_option"
                       id="vegan_option"
                       value="true"
                    @checked(old('vegan_option')) />
                <label for="vegan_option" class="font-medium text-sm pl-2"><span class="text-2xl align-middle">🌱</span>
                    Vegan</label>
            </div>
        </div>

        @error('dinner_options')
        <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="px-4 py-5 bg-white sm:p-6">
        <label for="registration_deadline" class="block font-medium text-sm text-gray-700">Tot wanneer kunnen leden zich
            aanmelden?</label>
        <input type="datetime-local" name="registration_deadline" id="registration_deadline"
               class="form-input rounded-md shadow-sm mt-1 block w-full"
               value="{{ old('registration_deadline', $suggestedRegistrationDeadline->toDateTimeLocalString()) }}"
               x-model="registration_deadline"/>
        @error('registration_deadline')
        <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="px-4 py-5 sm:px-6">
        <label for="cook_email" class="block font-medium text-sm text-gray-600">Wat is je e-mail?</label>
        <input type="email" name="cook_email" id="cook_email" class="form-input rounded-md shadow-sm mt-1 block w-full"
               value="{{ old('cook_email', '') }}"/>
        @error('cook_email')
        <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-start px-4 py-3 bg-gray-50 text-right sm:px-6">
        <button
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
            Opslaan
        </button>
    </div>
</form>
