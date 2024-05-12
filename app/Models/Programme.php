<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    protected $fillable = [
        'titre', 'contenu','candidat_id',
        
    ];

    // Relation avec le candidat (un programme appartient à un seul candidat)
    public function candidat()
    {
        return $this->belongsTo(Candidat::class, 'candidat_id'); 
    }

    // Relation avec les utilisateurs (un programme peut être aimé par plusieurs utilisateurs)
    // public function electeurs()
    // {
    //     return $this->belongsToMany(Electeur::class, 'programme_electeur');

    // } 
    public function electeurs()
    {
        return $this->belongsToMany(Electeur::class, 'programme_electeur')
                    ->withPivot('action')
                    ->withTimestamps();
    }
    
    public function likes()
    {
        return $this->electeurs()->wherePivot('action', '=', 'like');
    }
    
    public function dislikes()
    {
        return $this->electeurs()->wherePivot('action', '=', 'dislike');
    }
    
     
}

