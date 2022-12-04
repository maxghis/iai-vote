@component('mail::message')
<h2>Activation Du Compte Reussi</h2>

<br>
{{ $user->name }},
Votre Compte A ete Active Pour La Periode Du {{ \Carbon\Carbon::parse($subscription->start)->format('Y-m-d H:i:s')}} Au {{ \Carbon\Carbon::parse($subscription->end)->format('Y-m-d H:i:s')}}
@component('mail::button', ['url' => route('home')])
Global Investissement +
@endcomponent

Merci De Votre Confiance,<br>
{{ config('app.name') }}
@endcomponent
