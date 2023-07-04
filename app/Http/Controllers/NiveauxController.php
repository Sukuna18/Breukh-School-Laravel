<?php

namespace App\Http\Controllers;

use App\Http\Resources\NiveauxRessource;
use App\Models\Niveaux;
use Illuminate\Http\Request;
use App\Traits\JoinQueryParams;


class NiveauxController extends Controller
{
    use JoinQueryParams;
    public function index(Request $request)
        {
            $table = collect(['classes']);
            $join = $request->input('join');

            $niveaux = Niveaux::query()
        ->when($join !== false, function ($query) use ($join, $table) {
            return $this->joinQuery($query, $join, $table);
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
