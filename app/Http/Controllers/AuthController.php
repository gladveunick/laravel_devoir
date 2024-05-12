<?php

// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Electeur;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $electeur = Electeur::where('username', $credentials['username'])->first();

        if ($electeur && Hash::check($credentials['password'], $electeur->password)) {
            // Connexion réussie
            auth()->login($electeur);

            if ($electeur->isAdmin()) {
                return redirect('/admin-dashboard');
            } else {
                return redirect('/user-dashboard');
            }
        } else {
            // Identifiants incorrects
            return redirect()->back()->withInput()->withErrors(['error' => 'Identifiants incorrects']);
        }
    }

    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'cni' => 'required|unique:electeurs',
            'adresse' => 'required',
            'username' => 'required|unique:electeurs',
            'password' => 'required|min:6',
        ]);

        Electeur::create([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'cni' => $request->input('cni'),
            'adresse' => $request->input('prenom'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'is_admin' => false, 
        ]);

        return redirect('/')->with('success', 'Compte créé avec succès. Connectez-vous maintenant.');
    }
}
