<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'service';
    protected $primaryKey = 'ser_id';
    protected $fillable = ['cli_id', 'ser_type', 'ser_cout', 'ser_empId', 'ser_dateDebut', 'ser_dateFin', 'ser_statuts'];
    // make timestamps disabled
    public $timestamps = false;

    public function client()
    {
        return $this->belongsTo(Client::class, 'cli_id', 'cli_id');
    }

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'ser_empId', 'emp_id');
    }

    // many to many relationship with piece table through service_piece table
    public function pieces()
    {
        return $this->belongsToMany(Piece::class, 'service_piece', 'SP_serid', 'SP_pieid');
    }
  // scope with piece
    public function scopeWithPiece($query)
    {
        return $query->with('pieces');
    }
    
}
