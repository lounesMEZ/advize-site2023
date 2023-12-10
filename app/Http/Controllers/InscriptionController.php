<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\InscriptionRequest;

class InscriptionController extends Controller
{
    public function showRegistrationForm()
    {
        return view('users.register');
    }

    public function register(InscriptionRequest $request)
    {
        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        $login = $request->input('login');
        $password = $request->input('password');
        $dateNaissance = $request->input('date_naissance');
    
        $user = new User();
        $user->nom = $nom;
        $user->prenom = $prenom;
        $user->login = $login;
        $user->password = Hash::make($password);
        $user->date_naissance = $dateNaissance;
    
        if ($user->save()) {
            return redirect('/login')->with('success', 'Inscription réussie. Connectez-vous maintenant.');
        } else {
            return back()->withInput()->with('error', 'Erreur lors de l\'inscription.');
        }
    }
    
}
