<?php

// app/Models/Electeur.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Electeur extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom', 'prenom', 'cni', 'adresse', 'username', 'password', 'is_admin',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return $this->is_admin;
    }


    
    public function programmes()
    {
        return $this->belongsToMany(Programme::class, 'programme_electeur', 'electeur_id', 'programme_id')
                    ->withPivot('action');
    }
}
