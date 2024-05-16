<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    use HasFactory;
    protected $table = 'historique';
    protected $primaryKey = 'hist_id';
    protected $fillable = ['hist_DateReparation', 'hist_equId'];
    

    public function equipement()
    {
        return $this->belongsTo(Equipement::class, 'hist_equId', 'equ_id');
    }

}
