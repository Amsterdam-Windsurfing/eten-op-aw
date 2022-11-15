<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dinner evenement bewerken
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('admin.dinner-events.update', $dinnerEvent->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="shadow overflow-hidden sm:rounded-md">

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="date" class="block font-medium text-sm text-gray-700">Datum</label>
                            <div>{{ \Carbon\Carbon::parse($dinnerEvent->date)->translatedFormat('l j F Y') }}</div>
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="registration_deadline" class="block font-medium text-sm text-gray-700">Deadline registratie</label>
                            <input type="datetime-local" name="registration_deadline" id="registration_deadline" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('registration_deadline', $dinnerEvent->registration_deadline) }}" />
                            @error('registration_deadline')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="cook_name" class="block font-medium text-sm text-gray-700">Naam kok</label>
                            <input type="text" name="cook_name" id="cook_name" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('cook_name', $dinnerEvent->cook_name) }}" />
                            @error('cook_name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="cook_email" class="block font-medium text-sm text-gray-700">Email kok</label>
                            <input type="email" name="cook_email" id="cook_email" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('cook_email', $dinnerEvent->cook_email) }}" />
                            @error('cook_email')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="description" class="block font-medium text-sm text-gray-700">Beschrijving</label>
                            <textarea name="description" id="description" class="form-input rounded-md shadow-sm mt-1 block w-full">{{ old('description', $dinnerEvent->description) }}</textarea>

                            @error('description')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label class="block font-medium text-sm text-gray-700 mb-2">Dinner opties</label>

                            <div class="flex flex-wrap">
                                <div class="mr-10">
                                    <input type="checkbox"
                                           name="meat_option"
                                           id="meat_option"
                                           value="true"
                                        @checked(old('meat_option', $dinnerEvent->meat_option)) />
                                    <label for="meat_option" class="font-medium text-sm pl-2">Vlees</label>
                                </div>

                                <div class="mr-10">
                                    <input type="checkbox"
                                           name="vegetarian_option"
                                           id="vegetarian_option"
                                           value="true"
                                        @checked(old('vegetarian_option', $dinnerEvent->vegetarian_option)) />
                                    <label for="vegetarian_option" class="font-medium text-sm pl-2">Vegetarisch</label>
                                </div>

                                <div class="mr-10">
                                    <input type="checkbox"
                                           name="vegan_option"
                                           id="vegan_option"
                                           value="true"
                                        @checked(old('vegan_option', $dinnerEvent->vegan_option)) />
                                    <label for="vegan_option" class="font-medium text-sm pl-2">Vegan</label>
                                </div>
                            </div>

                            @error('dinner_options')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Opslaan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
