Hoi {{ $dinnerEvent->cook_name }},

Het aanmelden voor "Samen eten op woensdag" waarvoor jij hebt aangegeven om te gaan koken op {{ $dinnerEvent->date }} is gesloten. @if ( $dinnerEvent->eventRegistrationsCount() === 1)
Er heeft zich 1 persoon geregistreerd.
@else
Er hebben zich {{ $dinnerEvent->eventRegistrationsCount() }} personen geregistreerd.
@endif

Bijgaand vind je een overzicht van alle aanmelingen, voor welke optie er gekozen is (vlees, vegetarisch of vegan),
en of er evt. allergieën zijn waar je regening mee moet houden.

Succes met koken woensdag!
