<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

        @foreach ($nextWednesdays as $nextWednesday)

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div className="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
                    <h3 className="text-lg leading-6 font-medium text-gray-900">Samen eten op de Woensdagavond  {{ \Carbon\Carbon::createFromTimestamp($nextWednesday["date"])->format('j F Y') }}</h3>
                </div>

                @if($nextWednesday["dinnerEvent"])
                <div>
                    Er is een kok
                </div>

                @else
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="cook_name" class="block font-medium text-sm text-gray-700">Wat is je naam</label>
                        <input type="text" name="cook_name" id="cook_name" class="form-input rounded-md shadow-sm mt-1 block w-full"
                               value="{{ old('cook_name', '') }}" />
                        @error('cook_name')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
            </div>
        @endforeach

    </div>
</x-guest-layout>
