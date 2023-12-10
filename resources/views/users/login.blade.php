@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
    <form class="inscription-form" action="{{ route('login') }}" method="post">
        @csrf
        <h2>Connexion</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <label for="login" class="inscription-form-label">Login :</label>
        <input type="text" id="login" name="login" required class="inscription-form-input">

        <label for="password" class="inscription-form-label">Mot de passe :</label>
        <input type="password" id="password" name="password" required class="inscription-form-input">

        <input type="submit" value="Se connecter" class="inscription-form-input submit-button">
    </form>
@endsection
