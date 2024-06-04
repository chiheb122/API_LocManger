<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;
    protected $table = 'equipement';
    protected $primaryKey = 'equ_id';
    protected $fillable = ['equ_Description', 'equ_Nom', 'equ_PrixParJour', 'equ_StockDisponible', 'equ_Catégorie', 'FK_equ_eva_id', 'FK_loc_equi', 'equ_Image'];

  
    public function location()
    {
        return $this->belongsTo(Location::class, 'FK_loc_equi', 'loc_id');
    }
    
    public function scopeWithLocation($query)
    {
        return $query->join('location', 'equipement.FK_loc_equi', '=', 'location.loc_id');
    }






}
