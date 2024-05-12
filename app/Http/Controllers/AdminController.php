<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidat;
use App\Models\Electeur;
use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    // Tableau de bord de l'administrateur
    public function dashboard()
    {
        $totalCandidats = Candidat::count();
        $totalProgrammes = Programme::count();

        return view('admin.dashboard', compact('totalCandidats', 'totalProgrammes'));
    }

    // Gestion des candidats

    // Affiche la liste des candidats
    public function candidats()
    {
        $totalCandidats = Candidat::count();
        $total_electeurs = Electeur::count();
        $total_programmes = Programme::count();
        $candidats = Candidat::all();


        return view('admin.candidats.index', compact('candidats', 'totalCandidats','total_electeurs','total_programmes'));
    }

    // Affiche le formulaire de création d'un candidat
    public function createCandidat()
    {
        return view('admin.candidats.create');
    }

    // Stocke un nouveau candidat dans la base de données
    // AdminController.php

public function store(Request $request)
{
    $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'parti' => 'required',
        'biographie' => 'required',
        'validite' => 'required|boolean',
        'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'programmes' => 'array', // Ajoutez une validation pour les programmes
        'programmes.*.titre' => 'required',
        'programmes.*.contenu' => 'required',
    ]);

    // Traitement de la photo
    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $photoPath = $photo->store('candidat-photos', 'public');
    }

    // Crée un nouveau candidat dans la base de données
    $candidat = Candidat::create([
        'nom' => $request->input('nom'),
        'prenom' => $request->input('prenom'),
        'parti' => $request->input('parti'),
        'biographie' => $request->input('biographie'),
        'validite' => $request->input('validite'),
        'photo' => $photoPath,
    ]);

    // Crée les programmes associés au candidat
    if ($request->has('programmes')) {
        foreach ($request->input('programmes') as $programmeData) {
            $programme = new Programme($programmeData);
            $candidat->programmes()->save($programme);
        }
    }

    return redirect()->route('admin.candidats')->with('success', 'Candidat ajouté avec succès.');
}

    // Affiche le formulaire de modification d'un candidat
    public function editCandidat($id)
    {
        $candidat = Candidat::findOrFail($id);
        return view('admin.candidats.edit', compact('candidat'));
    }

    // Met à jour un candidat dans la base de données
    public function updateCandidat(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'parti' => 'required',
            'biographie' => 'required',
            'validite' => 'required|boolean',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $candidat = Candidat::findOrFail($id);

        // Traitement de la photo
        $photoPath = $candidat->photo;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->store('candidat-photos', 'public');
        }

        // Mise à jour du candidat
        $candidat->update([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'parti' => $request->input('parti'),
            'biographie' => $request->input('biographie'),
            'validite' => $request->input('validite'),
            'photo' => $photoPath,
        ]);

        return redirect()->route('admin.candidats')->with('success', 'Candidat mis à jour avec succès.');
    }

    // Supprime un candidat de la base de données
    public function destroyCandidat($id)
    {
        $candidat = Candidat::findOrFail($id);

        // Supprime la photo du stockage
        if ($candidat->photo) {
            Storage::disk('public')->delete($candidat->photo);
        }

        // Supprime le candidat
        $candidat->delete();

        return redirect()->route('admin.candidats')->with('success', 'Candidat supprimé avec succès.');
    }



    
}