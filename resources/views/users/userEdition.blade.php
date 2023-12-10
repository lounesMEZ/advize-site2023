@extends('layouts.app')

@section('title', 'Formulaire Utilisateur')

@section('content')
    <div class="inscription-form userEdition-form-container">
        <h1>{{ isset($user) ? 'Modifier' : 'Ajouter' }} un utilisateur</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ isset($user) ? route('users.save', $user['id']) : route('users.store') }}">
            @csrf
            @if (isset($user))
                @method('put')
            @endif

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="{{ isset($user) ? $user['nom'] : old('nom') }}" required>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="{{ isset($user) ? $user['prenom'] : old('prenom') }}" required>

            <label for="login">Login :</label>
            <input type="text" id="login" name="login" value="{{ isset($user) ? $user['login'] : old('login') }}" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" @if (!isset($user)) required @endif>

            <label for="date_naissance">Date de naissance :</label>
            <input type="date" id="date_naissance" name="date_naissance" value="{{ isset($user) ? $user['date_naissance'] : old('date_naissance') }}" required>

            <input type="submit" value="{{ isset($user) ? 'Modifier' : 'Ajouter' }}">
        </form>
    </div>
@endsection
