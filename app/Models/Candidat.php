<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    protected $fillable = [
        'nom', 'prenom', 'parti', 'biographie', 'validite', 'photo',
        // Ajoutez d'autres champs si nécessaire
    ];

    // Relation avec les programmes (un candidat peut avoir plusieurs programmes)
    public function programmes()
    {
        return $this->hasMany(Programme::class);
    }


    // Ajoutez cette méthode pour gérer la suppression en cascade des programmes
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($candidat) {
            // Supprime en cascade les programmes liés au candidat
            $candidat->programmes()->delete();
        });
    }


    // App\Models\Candidat.php

public function likes()
{
    return $this->hasManyThrough(Like::class, Programme::class);
}

public function dislikes()
{
    return $this->hasManyThrough(Dislike::class, Programme::class);
}

}


