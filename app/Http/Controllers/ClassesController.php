<?php

namespace App\Http\Controllers;

// use App\Http\Requests\StoreClassesRequest;
// use App\Http\Requests\UpdateClassesRequest;
use App\Http\Requests\StoreClassesRequest;
use App\Http\Requests\UpdateClassesRequest;
use App\Http\Resources\ClassesRessource;
use App\Models\AnneeScolaire;
use App\Models\Classes;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = $classes = Classes::with('niveaux')->get();
        return ClassesRessource::collection($classes);
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
    public function store(StoreClassesRequest $request)
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(Classes $classes)
    {
        $anneeScolaire = AnneeScolaire::where('actif', true)->first();

$classes = Classes::join('inscriptions', 'classes.id', '=', 'inscriptions.classes_id')
    ->join('eleves', 'inscriptions.eleve_id', '=', 'eleves.id')
    ->where('classes.id', $classes->id)
    ->where('inscriptions.annee_scolaire_id', $anneeScolaire->id)
    ->select('classes.*')
    ->with('inscriptions.eleve')
    ->first();
    // $classes = Classes::with('inscriptions.eleve')->where('id', $classes->id)->first();
        return new ClassesRessource($classes);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classes $classes)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassesRequest $request, Classes $classes)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classes $classes)
    {
        //
    }

}
