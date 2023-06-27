<?php

namespace App\Http\Controllers;

use App\Http\Resources\NiveauxRessource;
use App\Models\Niveaux;
use Illuminate\Http\Request;


class NiveauxController extends Controller
{
    public function index(Request $request)
        {
            $table = collect(['classes']);
            $join = $request->input('join');

            $niveaux = Niveaux::query()
            ->when($join !== false, function ($query) use ($join, $table) {
                if ($table->contains($join)) {
                    return $query->with($join);
                }
                Niveaux::all();
            })
            ->get();

            return NiveauxRessource::collection($niveaux);
        }
    public function find(Niveaux $id)
    {
        $id->load('classes');
        return new NiveauxRessource($id);
    }
    


}
