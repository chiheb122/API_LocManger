<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{

    use HasFactory;
    public $timestamps = false;
    protected $table = 'piece';
    protected $primaryKey = 'pie_id';
    protected $fillable =  ['pie_nom', 'pie_quantite', 'pie_prix', 'pie_reference', 'pie_dateEntree'];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_piece', 'SP_pieid', 'SP_serid');
    }

    // table d'association

    public function service_Piece()
    {
        return $this->hasMany(service_piece::class, 'SP_pieid', 'pie_id');
    }
}
