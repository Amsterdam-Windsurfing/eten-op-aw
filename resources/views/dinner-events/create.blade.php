<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center bg-gray-100">

        <div class="w-full  sm:max-w-xl bg-white shadow-md overflow-hidden sm:rounded-lg">

            <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-bold text-gray-900">Samen eten op de
                    woensdagavond {{ $nextWednesday["date"]->format('j F Y') }}</h3>
            </div>

            @if($nextWednesday["dinnerEvent"])

                <h4 class="px-4 sm:px-6 my-2 text-md font-semibold text-gray-900">Er wordt gekookt door {{ $nextWednesday["dinnerEvent"]->cook_name }}! <span
                        class="text-2xl align-middle">👩‍🍳 🎉</span></h4>

                <p class="px-4 sm:px-6 my-2 mb-6 text-base text-gray-700">{{ $nextWednesday["dinnerEvent"]->description }}</p>

                @include('event-registrations.summary_include', ['dinnerEvent' => $nextWednesday["dinnerEvent"], 'registrationsOptions' => $nextWednesday["dinnerEvent"]->eventRegistrationsOptions()])

                <p class="px-4 sm:px-6 py-2 text-base text-white-700 bg-slate-200">Je kan je aanmelden tot <strong>{{ $nextWednesday["dinnerEvent"]->registration_deadline->format('l \d\e jS - H:m') }}</strong>.</p>

            @else
                @include('dinner-events.create_form_include')
            @endif
        </div>

    </div>
</x-guest-layout>
