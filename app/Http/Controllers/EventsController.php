<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddParticipationRequest;
use App\Http\Requests\StoreEventsRequest;
use App\Http\Requests\UpdateEventsRequest;
use App\Models\AnneeScolaire;
use App\Models\Events;
use App\Models\EventsClasse;
use Request;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Events::all();
        return $events;
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
    public function store(StoreEventsRequest $request)
    {
        $data = [];
        foreach ($request->data as $events) {
            $data[] = [
                'libelle' => $events['libelle'],
                'date_debut' => $events['date_debut'],
                'date_fin' => $events['date_fin'],
                'user_id' => $events['user_id'],
            ];
        }
        Events::insert($data);
        return response()->json([
            'message' => 'Events created successfully',
            'donnees' => $data,
        ], 201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Events $events)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Events $events)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventsRequest $request, Events $events)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Events $events)
    {
        //
    }
    public function addParticipation(AddParticipationRequest $request, $evenement)
    {
        $data = [];
        $particiaptions = $request->data;
        $annee = AnneeScolaire::where('statut', 1)->first();
        foreach ($particiaptions as $particiaption) {
            $data[] = [
                'events_id' => $evenement,
                'classes_id' => $particiaption['classes_id'],
                'annee_scolaire_id' => $annee->id,
            ];
        }
        EventsClasse::insert($data);
        return response()->json([
            'message' => 'EventsClasse created successfully',
            'donnees' => $data,
        ], 201);
    }
    public function getParticipations($evenement)
    {
        $content = "notification d'événements.";
        $participations = EventsClasse::all();
        $eventsIds = $participations->pluck('events_id')->toArray();
        $classesIds = $participations->pluck('classes_id')->toArray();

        $inscrit = \App\Models\Inscriptions::whereIn('classes_id', $classesIds)->get();
        $eleves = \App\Models\Eleve::whereIn('id', $inscrit->pluck('eleve_id'))->get();

        $events = Events::whereIn('id', $eventsIds)->get();
        $userIds = $events->pluck('user_id')->toArray();
        $users = \App\Models\User::whereIn('id', $userIds)->get();
        dd($users, $eleves, $events, $content, $participations, $eventsIds, $classesIds, $inscrit);
        $participations = Events::where('id', $evenement)->get();
        return $participations;
    }
}
