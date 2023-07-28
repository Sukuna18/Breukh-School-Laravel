<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    protected $table = "events";
    protected $fillable = [
        'libelle',
        'date_debut',
        'date_fin',
        'user_id',
    ];
    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'events_classes');
    }

}
