<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Electeur;
use Illuminate\Support\Facades\Hash;
use App\Models\Candidat;
use App\Models\Programme;
use SebastianBergmann\Type\VoidType;

class ElecteurController extends Controller
{
    public function dashboard(){
        $totalCandidats = Candidat::count(); 
        $totalelecteurs = Electeur::count();
        return view('admin.dashboard',compact('totalCandidats', 'totalelecteurs'));
    }

    public  function  index()
    {
        $totalelecteurs = Electeur::count(); 
        $electeurs = Electeur::all();
        return view('electeur.electeur', compact('totalelecteurs'));
        
    }
    public function inscription()
    {
        // Affiche la vue du formulaire d'inscription
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
            'adresse' => $request->input('adresse'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'is_admin' => false,
        ]);

        return redirect('/')->with('success', 'Compte créé avec succès. Connectez-vous maintenant.');
    }


    public function connexion()
    {
        // Affiche la vue du formulaire de connexion
        return view('login');
    }


    /**
     * Traite le formulaire de connexion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function traiterConnexion(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'username' => 'required|exists:electeurs', // Assure que le username existe dans la table des électeurs
            'password' => 'required',
        ]);

        // Récupération de l'électeur par son username
        $electeur = Electeur::where('username', $request->input('username'))->first();

        // Vérification du mot de passe
        if ($electeur && Hash::check($request->input('password'), $electeur->password)) {
            // Mot de passe correct, connectez l'électeur
            session(['electeur_id' => $electeur->id]);

            // Vérifiez si l'électeur est un administrateur
            if ($electeur->is_admin) {
                // Redirection vers le tableau de bord de l'administrateur
                return redirect()->route('admin.dashboard')->with('success', 'Connexion réussie. Bienvenue, Admin !');
            } else {
                // Redirection vers le tableau de bord de l'électeur
                return redirect()->route('electeur.visualiserCandidats')->with('success', 'Connexion réussie. Bienvenue, Electeur !');
            }
        } else {
            // Identifiants incorrects
            return redirect()->back()->withInput()->withErrors(['error' => 'Identifiants incorrects']);
        }
    }


    public function visualiserCandidats()
    {
        $candidats = Candidat::all();
        return view('electeur.visualiser-candidats', compact('candidats'));
        
    }




    // Afficher les details du candidat lorse qu'il clique 

    public function detailsCandidat($id)
    {
        $candidat = Candidat::findOrFail($id);
        $programmes = $candidat->programmes; // Supposons que vous ayez défini une relation dans le modèle Candidat

        // Récupérez le nombre de likes et dislikes pour ce candidat
        $likesCount = $candidat->likes()->count();
        $dislikesCount = $candidat->dislikes()->count();

        return view('electeur.details-candidat', compact('candidat', 'programmes'));
    }


    public function getCandidatData($id)
    {
        // Récupérez les informations sur le candidat
        $candidat = Candidat::findOrFail($id);

        // Récupérez le nombre de likes et dislikes pour ce candidat
        $likesCount = $candidat->likes()->count();
        $dislikesCount = $candidat->dislikes()->count();

        // Retournez les données au format JSON
        return response()->json([
            'nom' => $candidat->nom,
            'prenom' => $candidat->prenom,
            'likes' => $likesCount,
            'dislikes' => $dislikesCount,
        ]);
    }





//Affiche les detail d'un programme lorseque l'utilisateur clique sur un programme
public function detailsProgramme($id)
{
    $programme = Programme::findOrFail($id);

    return view('electeur.details-programme', compact('programme'));
}


    /**
     * Affiche la liste des programmes.
     *
     * @return \Illuminate\View\View
     */
    public function visualiserProgrammes()
    {
        // Logique pour afficher la liste des programmes
        return view('electeur.programmes');
    }

    // Fonction pour gérer les actions de like et dislike

    public function likeProgramme(Request $request, $id)
{
    $programme = Programme::findOrFail($id);

    // Vérifiez si l'utilisateur a déjà aimé ou n'a pas aimé ce programme
    $alreadyLiked = $programme->likes()->where('electeur_id', auth()->id())->exists();
    $alreadyDisliked = $programme->dislikes()->where('electeur_id', auth()->id())->exists();

    if ($request->input('action') == 'like' && !$alreadyLiked && !$alreadyDisliked) {
        // Ajoutez le like en supprimant d'abord les enregistrements existants
        $programme->likes()->sync([auth()->id() => ['action' => 'like']], true);
    } elseif ($request->input('action') == 'dislike' && !$alreadyLiked && !$alreadyDisliked) {
        // Ajoutez le dislike en supprimant d'abord les enregistrements existants
        $programme->dislikes()->sync([auth()->id() => ['action' => 'dislike']], true);
    }

    return redirect()->route('electeur.detailsProgramme', $programme->id);
}

    
    

}









