<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;
    protected $table = 'employe';
    protected $primaryKey = 'emp_id';
    protected $fillable = ['emp_nom', 'emp_email', 'emp_salaire', 'emp_prenom'];

    public function services()
    {
        return $this->hasMany(Service::class, 'ser_empId', 'emp_id');
    }

    
}
