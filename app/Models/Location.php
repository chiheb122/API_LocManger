<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = 'location';
    protected $primaryKey = 'loc_id';
    protected $fillable = ['loc_DateDebut', 'loc_DateFin', 'loc_PrixTotal', 'Fk_loc_equ_id', 'loc_EtatEquipement', 'Fk_loc_paie', 'Fk_loc_cli'];

    public function paiement()
    {
        return $this->belongsTo(Paiement::class, 'Fk_loc_paie', 'paie_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'Fk_loc_cli', 'cli_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'Fk_loc_equ_id', 'equ_id');
    }
    

 

}
