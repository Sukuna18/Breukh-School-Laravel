<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClasseDisciplineRequest;
use App\Http\Requests\UpdateClasseDisciplineRequest;
use App\Models\ClasseDiscipline;

class ClasseDisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = ClasseDiscipline::all();
        return $all;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClasseDisciplineRequest $request)
    {
        $create = ClasseDiscipline::create([
            'classes_id' => $request->classes_id,
            'discipline_id' => $request->discipline_id,
            'evaluation_id' => $request->evaluation_id,
            'note' => $request->note,
            'max_note' => $request->max_note,
        ]);
        return $create;
    }

    /**
     * Display the specified resource.
     */
    public function show(ClasseDiscipline $classeDiscipline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClasseDiscipline $classeDiscipline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClasseDisciplineRequest $request, ClasseDiscipline $classeDiscipline)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClasseDiscipline $classeDiscipline)
    {
        //
    }
}
