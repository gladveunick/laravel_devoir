<?php

// app/Http/Controllers/CandidatController.php

namespace App\Http\Controllers;

use App\Models\Candidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Electeur;
use App\Models\Programme;

class CandidatController extends Controller
{
    /**
     * Affiche la liste des candidats.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $totalCandidats = Candidat::count(); 
        $total_electeurs = Electeur::count();
        $total_programmes = Programme::count();
        $candidats = Candidat::all();
        return view('admin.candidats.index', compact('candidats','totalCandidats','total_electeurs','total_programmes'));
    }

    /**
     * Affiche le formulaire d'ajout de candidat.
     *
     * @return \Illuminate\View\View
     */
    public function add()
    {
        return view('admin.candidats.add');
    }

    /**
     * Stocke un nouveau candidat dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valide les données du formulaire
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'parti' => 'required',
            'biographie' => 'required',
            'validite' => 'required|boolean',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation pour les images
            // Ajoutez d'autres règles de validation si nécessaire
        ]);

        // Traitement de la photo
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->store('candidat-photos', 'public'); // Stocke la photo dans le dossier 'storage/app/public/candidat-photos'
        }

        // Crée un nouveau candidat dans la base de données
        Candidat::create([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'parti' => $request->input('parti'),
            'biographie' => $request->input('biographie'),
            'validite' => $request->input('validite'),
            'photo' => $photoPath, // Enregistre le chemin de la photo dans la base de données
            // Ajoutez d'autres champs si nécessaire
        ]);

        // Redirige avec un message de succès
        return redirect()->route('admin.candidats')->with('success', 'Candidat ajouté avec succès.');
    }

    /**
     * Affiche le formulaire de modification d'un candidat.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $candidat = Candidat::findOrFail($id);
        return view('admin.candidats.edit', compact('candidat'));
    }

    /**
     * Met à jour un candidat dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Valide les données du formulaire
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'parti' => 'required',
            'biographie' => 'required',
            'validite' => 'required|boolean',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation pour les images
            // Ajoutez d'autres règles de validation si nécessaire
        ]);

        $candidat = Candidat::findOrFail($id);

        // Traitement de la photo
        $photoPath = $candidat->photo; // Conserve l'ancien chemin si la photo n'est pas mise à jour
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->store('candidat-photos', 'public'); // Stocke la nouvelle photo dans le dossier 'storage/app/public/candidat-photos'
        }

        // Met à jour le candidat dans la base de données
        $candidat->update([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'parti' => $request->input('parti'),
            'biographie' => $request->input('biographie'),
            'validite' => $request->input('validite'),
            'photo' => $photoPath, // Met à jour le chemin de la photo
            // Ajoutez d'autres champs si nécessaire
        ]);

        // Redirige avec un message de succès
        return redirect()->route('admin.candidats')->with('success', 'Candidat mis à jour avec succès.');
    }

    /**
     * Supprime un candidat de la base de données.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $candidat = Candidat::findOrFail($id);

        // Supprime la photo du stockage
        if ($candidat->photo) {
            Storage::disk('public')->delete($candidat->photo);
        }

        // Supprime le candidat de la base de données
        $candidat->delete();

        // Redirige avec un message de succès
        return redirect()->route('admin.candidats')->with('success', 'Candidat supprimé avec succès.');
    }

    
}
