<?php

namespace App\Http\Resources;

use App\Http\Controllers\ClassesController;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassesRessource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'libelle' => $this->libelle,
            'niveau_id' => $this->niveaux_id,
            'classe_discipline' => $this->whenLoaded('classe_discipline', function () {
                return $this->classe_discipline->map(function ($classe_discipline) {
                    return [
                        'id' => $classe_discipline->id,
                        'discipline' => $classe_discipline->discipline->libelle,
                    ];
                });
            }),
            
            'niveau' => $this->whenLoaded('niveaux', function () {
                return $this->niveaux->libelle;
            }),
            'eleves' => InscriptionRessource::collection($this->whenLoaded('inscriptions')),
        ];
        
        return $data;
    }
}