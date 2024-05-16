<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client_notification extends Model
{
 
    use HasFactory;
    protected $table = 'client_notification';
    protected $primaryKey = ['CN_cli_id', 'CN_not_id'];
    protected $fillable = ['CN_cli_id', 'CN_not_id'];
    public $timestamps = true;

    public function client()
    {
        return $this->belongsTo(Client::class, 'CN_cli_id', 'cli_id');
    }

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'CN_not_id', 'not_id');
    }

    public function scopeWithClient($query)
    {
        return $query->with('client');
    }

    public function scopeWithNotification($query)
    {
        return $query->with('notification');
    }

    public function scopeWithAll($query)
    {
        return $query->withClient()->withNotification();
    }
}
