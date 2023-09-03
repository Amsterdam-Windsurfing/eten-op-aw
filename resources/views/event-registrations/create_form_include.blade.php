<form method="post" action="{{ route('event-registrations.store') }}" class="w-full sm:max-w-xl"
    x-data="{
        plusOneItems: [
        @if (old('plus_one'))
            @foreach (old('plus_one') as $plus_one)
                {
                    name: {
                        value: '{{ old('plus_one.' . $loop->index .'.name') }}',
                        error: '@if($errors->has('plus_one.' . $loop->index .'.name')){{ $errors->first('plus_one.' . $loop->index .'.name') }}@endif'
                    },
                    dinner_option: {
                        value: '{{ old('plus_one.' . $loop->index .'.dinner_option') }}',
                        error: '@if($errors->has('plus_one.' . $loop->index .'.dinner_option')){{ $errors->first('plus_one.' . $loop->index .'.dinner_option') }}@endif'
                    },
                    allergies: {
                        value: '{{ old('plus_one.' . $loop->index .'.allergies') }}',
                        error: '@if($errors->has('plus_one.' . $loop->index .'.allergies')){{ $errors->first('plus_one.' . $loop->index .'.allergies') }}@endif'
                    },
                    after_training: {
                        value: {{ old('plus_one.' . $loop->index .'.after_training') ? 'true' : 'false' }},
                        error: '@if($errors->has('plus_one.' . $loop->index .'.after_training')){{ $errors->first('plus_one.' . $loop->index .'.after_training') }}@endif'
                    }
                },
            @endforeach
        @endif
        ],
        deleteItem(item) {
            let position = this.plusOneItems.indexOf(item);
            this.plusOneItems.splice(position, 1);
        }
      }"
>
    @csrf

    <div class="bg-white shadow-md overflow-hidden sm:rounded-lg my-6">
        <h4 class="px-4 sm:px-6 py-2 mt-4 text-md font-semibold text-gray-900">Aanmelden voor het eten</h4>

        @error('general')
            <p class="px-4 py-3 sm:px-6 text-sm text-red-600">{{ $message }}</p>
        @enderror

        <div class="px-4 py-3 sm:px-6"
             x-data="{ name: localStorage.getItem('name') }"
             x-init="$watch('name', (val) => localStorage.setItem('name', val))"
        >
            <div class="flex">
                <label for="name" class="block font-medium text-sm text-gray-600">Wat is je naam?</label>
                <img class="ml-auto mr-1" src="{{ asset('images/information-circle.svg') }}" width="22" height="22"
                     @popper(Je naam wordt niet publiek getoond. Wel kan de kok je naam zien.)/>
            </div>

            <input type="text" name="name" id="name"
                   class="form-input rounded-md shadow-sm mt-1 block w-full"
                   value="{{ old('name', '') }}"
                   x-model="name"
            />
            @error('name')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="px-4 py-5 sm:px-6"
             x-data="{ email: localStorage.getItem('email') }"
             x-init="$watch('email', (val) => localStorage.setItem('email', val))"
        >
            <div class="flex">
                <label for="email" class="block font-medium text-sm text-gray-600">Wat is je e-mail?</label>
                <img class="ml-auto mr-1" src="{{ asset('images/information-circle.svg') }}" width="22" height="22"
                     @popper(Dit is nodig om je aanmelding te bevestigen.)/>
            </div>
            <input type="email" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full"
                   value="{{ old('email', '') }}"
                   x-model="email"
            />
            @error('email')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="px-4 pb-3 sm:px-6">
            <label for="dinner_option" class="block font-medium text-sm text-gray-600">Voor welke optie geef je je op?</label>

            <div class="flex flex-wrap">
                @if($dinnerEvent->meat_option)
                    <div class="mr-10">
                        <input type="radio"
                               name="dinner_option"
                               id="meat_option"
                               value="meat"
                            @checked(old('dinner_option') == 'meat') />
                        <label for="meat_option" class="font-medium text-sm pl-2"><span
                                class="text-2xl align-middle">🥩</span>
                            Vlees</label>
                    </div>
                @endif

                @if($dinnerEvent->vegetarian_option)
                    <div class="mr-10">
                        <input type="radio"
                               name="dinner_option"
                               id="vegetarian_option"
                               value="vegetarian"
                            @checked(old('dinner_option') == 'vegetarian') />
                        <label for="vegetarian_option" class="font-medium text-sm pl-2"><span
                                class="text-2xl align-middle">🍆</span> Vegetarisch</label>
                    </div>
                @endif

                @if($dinnerEvent->vegan_option)
                    <div class="mr-10">
                        <input type="radio"
                               name="dinner_option"
                               id="vegan_option"
                               value="vegan"
                            @checked(old('dinner_option') == 'vegan') />
                        <label for="vegan_option" class="font-medium text-sm pl-2"><span
                                class="text-2xl align-middle">🌱</span>
                            Vegan</label>
                    </div>
                @endif
            </div>

            @error('dinner_option')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="px-4 py-3 sm:px-6"
             x-data="{ allergies: localStorage.getItem('allergies') }"
             x-init="$watch('allergies', (val) => localStorage.setItem('allergies', val))"
        >
            <div class="flex">
                <label for="allergies" class="block font-medium text-sm text-gray-600">Heb je allergieën waar rekening mee
                    gehouden moet worden?</label>
                <img class="ml-auto mr-1" src="{{ asset('images/information-circle.svg') }}" width="22" height="22"
                     @popper(Wat je hier opgeeft wordt doorgegeven aan de kok. Controleer altijd op de avond zelf of hier
                     ook rekening mee is gehouden tijdens het koken.)/>
            </div>
            <textarea name="allergies" id="allergies"
                      x-model="allergies"
                      class="form-input rounded-md shadow-sm mt-1 block w-full">{{ old('allergies', '') }}</textarea>

            @error('allergies')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
       </div>

        <div class="px-4 sm:px-6 mb-4">
            <input type="checkbox" name="after_training" id="after_training" class="shadow-sm" value="1" @checked(old('after_training')) />

            <label for="after_training" class="font-medium text-sm text-gray-600 ml-2">Ik doe mee aan de training en wil graag daarna eten </label>

            @error('after_training')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div x-show="plusOneItems.length == 0">
            @include('event-registrations.action_section_include')
        </div>

    </div>

    <template x-for="(item, index) in plusOneItems" :key="index">
        <div class="bg-white shadow-md overflow-hidden sm:rounded-lg my-6">
            <div class="flex items-center justify-between mt-4">
                <h6 class="px-4 sm:px-6 py-2 text-md font-semibold text-gray-900">Gast <span x-text="index+1"></span></h6>

                <button @click="deleteItem(item)" type="button" class="mx-4 sm:mx-6 bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-900 hover:text-black hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div>
                <div class="px-4 py-3 sm:px-6">
                    <div class="flex">
                        <label x-bind:for="`plus_one[${index}][name]`" class="block font-medium text-sm text-gray-600">Wat is de naam van je gast?</label>
                    </div>

                    <input type="text" x-bind:name="`plus_one[${index}][name]`" x-bind:id="`plus_one[${index}][name]`" x-bind:value="item.name.value" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                     <p class="text-sm text-red-600" x-show="item.name.error" x-text="item.name.error"></p>
                </div>

                <div class="px-4 pb-3 sm:px-6">
                    <label x-bind:for="`plus_one[${index}][dinner_option]`" class="block font-medium text-sm text-gray-600">Voor welke optie geef je je gast op?</label>

                    <div class="flex flex-wrap">
                        @if($dinnerEvent->meat_option)
                            <div class="mr-10">
                                <input type="radio"
                                       x-bind:name="`plus_one[${index}][dinner_option]`"
                                       x-model="item.dinner_option.value"
                                       x-bind:id="`plus_one[${index}]meat_option`"
                                       value="meat" />
                                <label x-bind:for="`plus_one[${index}]meat_option`" class="font-medium text-sm pl-2"><span
                                        class="text-2xl align-middle">🥩</span>
                                    Vlees</label>
                            </div>
                        @endif

                        @if($dinnerEvent->vegetarian_option)
                            <div class="mr-10">
                                <input type="radio"
                                       x-bind:name="`plus_one[${index}][dinner_option]`"
                                       x-model="item.dinner_option.value"
                                       x-bind:id="`plus_one[${index}]vegetarian_option`"
                                       value="vegetarian" />
                                <label x-bind:for="`plus_one[${index}]vegetarian_option`" class="font-medium text-sm pl-2"><span
                                        class="text-2xl align-middle">🍆</span> Vegetarisch</label>
                            </div>
                        @endif

                        @if($dinnerEvent->vegan_option)
                            <div class="mr-10">
                                <input type="radio"
                                       x-bind:name="`plus_one[${index}][dinner_option]`"
                                       x-model="item.dinner_option.value"
                                       x-bind:id="`plus_one[${index}]vegan_option`"
                                       value="vegan" />
                                <label x-bind:for="`plus_one[${index}]vegan_option`" class="font-medium text-sm pl-2"><span
                                        class="text-2xl align-middle">🌱</span>
                                    Vegan</label>
                            </div>
                        @endif
                    </div>

                    <p class="text-sm text-red-600" x-show="item.dinner_option.error" x-text="item.dinner_option.error"></p>
                </div>

                <div class="px-4 py-3 sm:px-6">
                    <div class="flex">
                        <label x-bind:for="`plus_one[${index}][allergies]`" class="block font-medium text-sm text-gray-600">Heeft je gast allergieën waar rekening mee
                            gehouden moet worden?</label>
                    </div>
                    <textarea  x-bind:name="`plus_one[${index}][allergies]`"  x-bind:id="`plus_one[${index}][allergies]`" x-bind:value="item.allergies.value"
                              class="form-input rounded-md shadow-sm mt-1 block w-full"></textarea>

                    <p class="text-sm text-red-600" x-show="item.allergies.error" x-text="item.allergies.error"></p>

            </div>

                <div class="px-4 sm:px-6 mb-4">
                    <input type="checkbox" x-bind:name="`plus_one[${index}][after_training]`"  x-bind:id="`plus_one[${index}][after_training]`" x-model="item.after_training.value" class="shadow-sm" value="1" />

                    <label for="after_training" x-bind:for="`plus_one[${index}][after_training]`" class="font-medium text-sm text-gray-600 ml-2">Mijn gast doet mee aan de training en wil graag daarna eten</label>

                    <p class="text-sm text-red-600" x-show="item.after_training.error" x-text="item.after_training.error"></p>
                </div>
            </div>

            <div x-show="index === plusOneItems.length - 1">
                @include('event-registrations.action_section_include')
            </div>
        </div>
    </template>
</form>
