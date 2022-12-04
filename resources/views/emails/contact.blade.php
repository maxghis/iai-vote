@component('mail::message')
<h2>Message De Contact De <b>{{ $contact->name }}</b></h2>

<hr>
Email: <a href = "mailto: {{ $contact->email }}">{{ $contact->email }}</a>,<hr>
Objet: <h3>{{ $contact->subject }}</h3>
<hr>
<p>{{ $contact->message }}</p>
{{ config('app.name') }}
@endcomponent
