<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDisciplineRequest;
use App\Http\Requests\UpdateDisciplineRequest;
use App\Http\Resources\DisciplineRessource;
use App\Models\Discipline;

class DisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discipline = Discipline::all();
        return DisciplineRessource::collection($discipline);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDisciplineRequest $request)
    {
        //creer linsertion pour la table discipline
        $discipline = Discipline::create([
            'libelle' => $request->libelle,
            'code' => substr($request->libelle, 0, 3),
        ]);
        return new DisciplineRessource($discipline);
    }

    /**
     * Display the specified resource.
     */
    public function show(Discipline $discipline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discipline $discipline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDisciplineRequest $request, Discipline $discipline)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discipline $discipline)
    {
        //
    }
}
