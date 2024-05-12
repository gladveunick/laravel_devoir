<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidat;
use App\Models\Programme;
use App\Models\Electeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProgrammeController extends Controller
{
    // Affiche la liste des programmes
    public function index()
    {
        $totalprogramme = Programme::count(); 
        $totalCandidats = Candidat::count(); 
        $total_electeurs = Electeur::count();
        $total_programmes = Programme::count();
        $programmes = Programme::all();
        return view('admin.programmes.index', compact('programmes','totalprogramme','$total_programmes','total_electeurs','totalCandidats'));
    }

    // Affiche le formulaire de création d'un programme
    public function create()
    {
        $candidats = Candidat::all();
        return view('admin.programmes.create', compact('candidats'));
    }

    // Stocke un nouveau programme dans la base de données
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'candidat_id' => 'required|exists:candidats,id',
            'titre' => 'required',
            'contenu' => 'required|file|mimes:pdf|max:2048', // Limite la taille à 2 Mo
        ]);
    
        // Vérifiez s'il y a un fichier téléchargé
        if ($request->hasFile('contenu')) {
            // Récupère le fichier
            $file = $request->file('contenu');
            // Déplace le fichier vers le dossier de stockage public
            $filePath = $file->store('public/pdf');
            // Stocke le chemin relatif dans la base de données (sans le préfixe 'public/')
            $filePath = str_replace('public/', '', $filePath);
        } else {
            // Si aucun fichier n'est téléchargé, retournez une erreur
            return redirect()->back()->with('error', 'Aucun fichier PDF n\'a été téléchargé.');
        }
    
        // Création d'un nouveau programme avec le chemin du fichier
        Programme::create([
            'candidat_id' => $request->input('candidat_id'),
            'titre' => $request->input('titre'),
            'contenu' => $filePath,
        ]);
    
        return redirect()->route('admin.programmes.add')->with('success', 'Programme ajouté avec succès.');
    }
    // Affiche le formulaire de modification d'un programme
    public function edit($id)
    {
        $programme = Programme::findOrFail($id);
        $candidats = Candidat::all();
        return view('admin.programmes.edit', compact('programme', 'candidats'));
    }

    // Met à jour un programme dans la base de données
    public function update(Request $request, $id)
    {
        $request->validate([
            'candidat_id' => 'required|exists:candidats,id',
            'titre' => 'required',
            'contenu' => 'nullable|file|mimes:pdf|max:2048', // Vous pouvez rendre le champ "contenu" facultatif lors de la mise à jour
        ]);
    
        $programme = Programme::findOrFail($id);
    
        // Mise à jour des données du programme
        $programme->update([
            'candidat_id' => $request->input('candidat_id'),
            'titre' => $request->input('titre'),
        ]);
    
        // Si un nouveau fichier est téléchargé, mettez à jour le contenu du programme
        if ($request->hasFile('contenu')) {
            $file = $request->file('contenu');
            $filePath = $file->store('public/pdf');
            $filePath = str_replace('public/', '', $filePath);
    
            // Supprimez l'ancien fichier s'il existe
            if ($programme->contenu) {
                Storage::delete('public/' . $programme->contenu);
            }
    
            $programme->update(['contenu' => $filePath]);
        }
    
        return redirect()->route('admin.programmes.index')->with('success', 'Programme mis à jour avec succès.');
    }
    

    // Supprime un programme de la base de données
    public function destroy($id)
    {
        $programme = Programme::findOrFail($id);

        // Supprime le programme
        $programme->delete();

        return redirect()->route('admin.programmes.index')->with('success', 'Programme supprimé avec succès.');
    }
}
