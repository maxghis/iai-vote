@component('mail::message')
<b>M/Mme {{ $user->name }}</b>,<br>
<h2>Vos Identifiants Pour Tout Vote Concernant Les Etudiants Pour l'Annee Academique{{ date('Y', time()) }} - {{ date('Y', time()) + 1 }}</h2>

<br>

<h5>Identifiant: <b>{{ $user->username }}</b></h5>

<h5>Mot De Passe: <b>{{ $mdp }}</b></h5>

<center>
    @component('mail::button', ['url' => "https://vote.goshua.org"])
      Votez A partir De Cette plate-forme
    @endcomponent
</center>

<h5>NB: La Plate-forme est disponible Uniquement Pendant la Periode Des Elections </h5>
<br>
{{ config('app.name') }}
@endcomponent
