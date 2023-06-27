<?php

namespace App\Http\Controllers;

// use App\Http\Requests\StoreClassesRequest;
// use App\Http\Requests\UpdateClassesRequest;
use App\Http\Resources\ClassesRessource;
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
}
