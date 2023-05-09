<div class="w-full sm:max-w-xl bg-white shadow-md overflow-hidden sm:rounded-lg my-6">

    @if($dinnerEvent->registration_deadline < now())
        <h4 class="px-4 sm:px-6 py-2 my-4 text-md font-semibold text-gray-900">De aanmelding voor het eten is helaas gesloten.</h4>
    @else
        <h4 class="px-4 sm:px-6 py-2 mt-4 text-md font-semibold text-gray-900">Aanmelden voor het eten</h4>

        @if($dinnerEvent)
            @include('event-registrations.create_form_include', ['dinnerEvent' => $dinnerEvent, 'registrationsOptions' => $dinnerEvent->eventRegistrationsOptions()])
        @else
            <p class="px-4 sm:px-6 my-2 mb-6 text-base text-gray-700">Er heeft zich nog geen kok aangediend, je kan je dus
                nog niet aanmelden voor het eten.</p>
        @endif
    @endif
</div>
