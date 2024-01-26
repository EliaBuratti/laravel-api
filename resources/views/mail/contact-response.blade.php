<x-mail::message>
    Ciao, {{ $lead->name }}! Grazie per avermi contattato! <br>
    Qui sotto ti riporto il tuo messaggio di contatto e ti farò sapere il prima possibile!! <br>
    <h2>Il tuo messaggio:</h2>
    <p> {{ $lead->message }}</p>
</x-mail::message>
