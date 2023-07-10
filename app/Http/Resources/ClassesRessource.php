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
            'eleves' => InscriptionRessource::collection($this->whenLoaded('inscriptions')),
        ];
        
        return $data;
    }
}