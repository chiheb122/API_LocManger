<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    protected $table = 'evaluation';
    protected $primaryKey = 'eva_id';
    protected $fillable = ['eva_commentaire', 'FK_eva_cli_id', 'FK_equ_eva_id'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'FK_eva_cli_id', 'cli_id');
    }

    public function equipement()
    {
        return $this->belongsTo(Equipement::class, 'FK_equ_eva_id', 'equ_id');
    }

    public function scopeWithClient($query)
    {
        return $query->join('client', 'evaluation.FK_eva_cli_id', '=', 'client.cli_id');
    }

    public function scopeWithEquipement($query)
    {
        return $query->join('equipement', 'evaluation.FK_equ_eva_id', '=', 'equipement.equ_id');
    }

    public function scopeWithClientAndEquipement($query)
    {
        return $query->join('client', 'evaluation.FK_eva_cli_id', '=', 'client.cli_id')
            ->join('equipement', 'evaluation.FK_equ_eva_id', '=', 'equipement.equ_id');
    }



    

}
