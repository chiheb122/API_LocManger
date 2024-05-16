<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Paiement extends Model
{
    use HasFactory;
    protected $table = 'paiement';
    protected $primaryKey = 'pai_id';
    protected $fillable = ['pai_statut', 'pai_mode', 'pai_montant', 'pai_date'];


}
