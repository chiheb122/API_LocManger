<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    use HasFactory;

    protected $table = 'client';
    protected $primaryKey = 'cli_id';
    protected $fillable = ['cli_nom', 'cli_prenom', 'cli_email', 'cli_note', 'cli_tel', 'cli_adresse', 'cli_ville', 'cli_pays', 'cli_codePostal'];

    
    //faire une relation avec la table user pour récupérer les détails de l'utilisateur connecté
    public function user()
    {
        return $this->hasOne(User::class, 'Fk_cli_id');
    }

        

    }


