@extends('layouts.app')

@section('title', 'Liste des utilisateurs')

@section('content')
    <div class="user-table-container">
        <h1>Liste des utilisateurs</h1>

        <div class="user-table-actions">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Ajouter un utilisateur</a>
        </div>

        @if(count($users) > 0)
            <table class="user-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de Naissance</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user['nom'] }}</td>
                            <td>{{ $user['prenom'] }}</td>
                            <td>{{ $user['date_naissance'] }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user['id']) }}" class="btn btn-secondary">Éditer</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Aucun utilisateur trouvé.</p>
        @endif
    </div>
@endsection
