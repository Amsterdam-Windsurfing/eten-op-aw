@if($dinnerEvent)
    @if($dinnerEvent->registration_deadline < now())
        <div class="w-full sm:max-w-xl bg-white shadow-md overflow-hidden sm:rounded-lg my-6">
            <h4 class="px-4 sm:px-6 py-2 mt-4 text-md font-semibold text-gray-900">Aanmelden voor het eten</h4>
            <p class="px-4 sm:px-6 py-2 my-4 text-md font-semibold text-gray-900">De aanmelding voor het eten is helaas gesloten.</p>
        </div>
    @else
        @include('event-registrations.create_form_include', ['dinnerEvent' => $dinnerEvent, 'registrationsOptions' => $dinnerEvent->eventRegistrationsOptions()])
    @endif
@else
    <div class="w-full sm:max-w-xl bg-white shadow-md overflow-hidden sm:rounded-lg my-6">
        <h4 class="px-4 sm:px-6 py-2 mt-4 text-md font-semibold text-gray-900">Aanmelden voor het eten</h4>
        <p class="px-4 sm:px-6 my-2 mb-6 text-base text-gray-700">Er heeft zich nog geen kok aangediend, je kan je dus
            nog niet aanmelden voor het eten.</p>
    </div>
@endif
