<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notification';
    protected $primaryKey = 'not_id';
    protected $fillable = ['not_message', 'not_type', 'not_cli_id', 'not_dateEnvoi', 'not_sujet', 'not_description'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'not_cli_id', 'cli_id');
    }
    public function client_notification()
    {
        return $this->hasMany(Client_notification::class, 'CN_not_id', 'not_id');
    }

    public function scopeWithClient($query)
    {
        return $query->with('client');
    }

    
}
