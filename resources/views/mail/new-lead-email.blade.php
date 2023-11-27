<x-mail::message>
    Hai ricevuto un nuovo messaggio da: <br>
    Name: {{ $lead->name }} <br>
    Email: {{ $lead->email }}

    #### Date: {{ $lead->created_at }}
    ### Original message
    {{ $lead->message }}

</x-mail::message>
