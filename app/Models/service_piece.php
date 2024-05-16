<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service_piece extends Model
{
    use HasFactory;
    protected $table = 'service_piece';
    protected $primaryKey = ['SP_serid', 'SP_pieid'];
    protected $fillable = ['SP_serid', 'SP_pieid'];


    public function service()
    {
        return $this->belongsTo(Service::class, 'SP_serid', 'ser_id');
    }

    public function piece()
    {
        return $this->belongsTo(Piece::class, 'SP_pieid', 'pie_id');
    }
}

