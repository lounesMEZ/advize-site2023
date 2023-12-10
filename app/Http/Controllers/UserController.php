<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{


    public function showLoginForm()
    {
        return view('users.login');
    }


    public function login(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');
    
        if (Auth::attempt(['login' => $login, 'password' => $password])) {
            $token = auth()->user()->createToken('auth-token')->plainTextToken;
            session(['auth_token' => $token]);
            return redirect()->route('home');
        }
    
        // L'authentification a échoué
        return back()->withInput()->withErrors(['login' => 'Identifiants incorrects']);
    }
    
    public function index()
    {
        $token = session('auth_token');

        $users = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('advize.test/api/users')->json();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.userEdition');
    }
    public function edit($id)
    {
        $token = session('auth_token');
        $user = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get("advize.test/api/users/{$id}")->json();
        return view('users.userEdition', compact('user'));
    }


    public function userForm($id = null)
    {
        $token = session('auth_token');

        $user = $id ? Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get("advize.test/api/users/{$id}")->json() : null;

        return view('users.form', compact('user'));
    }

    public function saveUser(Request $request, $id = null)
    {
        $token = session('auth_token');
       
        $response = $id ?
            Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->put("advize.test/api/users/{$id}", $request->all()) :
            Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post("advize.test/api/users", $request->all());

        if ($response->successful()) {
            return redirect()->route('users.index')->with('success', 'Utilisateur enregistré avec succès.');
        }

        return back()->withErrors(['error' => 'Erreur lors de l\'enregistrement de l\'utilisateur.']);
    }
}
