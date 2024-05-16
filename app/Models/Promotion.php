<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $table = 'promotion';
    protected $primaryKey = 'pro_id';
    protected $fillable = ['pro_nom', 'pro_pourcentage', 'pro_dateDebut', 'pro_dateFin', 'fk_pro_locId'];

    public function location()
    {
        return $this->belongsTo(Location::class, 'fk_pro_locId', 'loc_id');
    }

    
}
