@component('mail::message')
<b>M/Mme {{ $user->name }}</b>,<br>
<h2>Vos Identifiants Pour Tout Vote Concernant Les Etudiants Pour l'Annee Academique {{ date('Y', time()) }} - {{ date('Y', time()) + 1 }}</h2>

<br>

<h4>Identifiant: <b>{{ $user->username }}</b></h4>

<h4>Mot De Passe: <b>{{ $mdp }}</b></h4>

<center>
    @component('mail::button', ['url' => route('index')])
      Votez A partir De Cette plate-forme
    @endcomponent
</center>

<h5>NB: La Plate-forme est disponible Uniquement Pendant la Periode Des Elections </h5>
<br>
{{ config('app.name') }}
@endcomponent
