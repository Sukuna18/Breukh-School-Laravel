<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NiveauxRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // public function toArray(Request $request): array
    // {
    //     return [
    //         'id' => $this->id,
    //         'niveau' => $this->libelle,
    //         'classes' => $this->classes->map(function ($classe) {
    //             return [
    //                 'libelle' => $classe->libelle,
    //                 'id' => $classe->id,
    //             ];
    //         })
    //     ];
    // }
    public function toArray(Request $request): array
{
    $join = $request->input('join');

    $data = [
        'id' => $this->id,
        'niveau' => $this->libelle,
    ];

    if ($join === 'classes') {
        $data['classes'] = $this->classes->map(function ($classe) {
            return [
                'libelle' => $classe->libelle,
                'id' => $classe->id,
                'id_niveau' => $classe->niveaux_id,
            ];
        });
    }

    return $data;
}

}
