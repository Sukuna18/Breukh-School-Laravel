<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsClasse extends Model
{
    use HasFactory;
    protected $table = "events_classes";
    protected $fillable = [
        'events_id',
        'classe_id',
    ];
    public function classe()
    {
        return $this->belongsTo(Classes::class);
    }
    public function events()
    {
        return $this->belongsTo(Events::class);
    }
}
