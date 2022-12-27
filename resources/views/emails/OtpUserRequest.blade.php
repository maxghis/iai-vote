@component('mail::message')
<b>M/Mme {{ $user->name }}</b>,<br>
<h2>Une Tentative De Connexion a votre compte IAI-VOTE vient de se produire</h2>

<br>


<h4>Code d'acces: </h4><h1><b>{{ $otp }}</b></h1>



<h5>NB: Si Vous n'etes pas a l'origine de cette transaction veillez supprimer ce message </h5>
<br>
{{ config('app.name') }}
@endcomponent
