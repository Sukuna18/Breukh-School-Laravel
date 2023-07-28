<?php

namespace App\Http\Controllers;

// use App\Http\Requests\StoreClassesRequest;
// use App\Http\Requests\UpdateClassesRequest;

use App\Http\Requests\AddNoteResquest;
use App\Http\Requests\EditNotesRequest;
use App\Http\Requests\StoreClassesRequest;
use App\Http\Requests\UpdateClassesRequest;
use App\Http\Resources\ClassesRessource;
use App\Http\Resources\NoteRessource;
use App\Models\AnneeScolaire;
use App\Models\ClasseDiscipline;
use App\Models\Classes;
use App\Models\Discipline;
use App\Models\Eleve;
use App\Models\Evaluation;
use App\Models\Inscriptions;
use App\Models\Note;
use App\Models\Semestre;
use App\Traits\JoinQueryParams;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    use JoinQueryParams;
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
    public function show(Classes $classes, Request $request)
    {
        $associations = $request->input('join', '');
        $associationsArray = explode(',', $associations);
        $with = false;
        foreach ($associationsArray as $association) {
            $this->jointure($classes, $association, $with);
        }
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
    public function getNotes($classes, $disciplines, $evaluations)
    {
        $annee = AnneeScolaire::where('statut', true)->first();
        $classes = Classes::find($classes);
        $evaluations = Evaluation::find($evaluations);
        $semestre = Semestre::where('statut', true)->first();
        $discipline = Discipline::find($disciplines);
        $classesDisciplines = ClasseDiscipline::where('classes_id', $classes->id)->where('evaluation_id', $evaluations->id)->where('discipline_id', $discipline->id)->where('semestre_id', $semestre->id)->get();
        if (!$classesDisciplines->isEmpty()) {
            $notes = Note::where('classe_discipline_id', $classesDisciplines->first()->id)
                ->where('annee_scolaire_id', $annee->id)
                ->get();

            return NoteRessource::collection($notes);
        }
        return [];
    }
    public function addNote(AddNoteResquest $request, $classes, $disciplines, $evaluations)
    {
        $semestre = Semestre::where('statut', true)->first();
        $annee = AnneeScolaire::where('statut', true)->first();
        $classe = Classes::find($classes);
        $evaluation = Evaluation::find($evaluations);
        $discipline = Discipline::find($disciplines);
        $classeDisciplines = ClasseDiscipline::where('classes_id', $classe->id)
            ->where('evaluation_id', $evaluation->id)
            ->where('discipline_id', $discipline->id)
            ->where('semestre_id', $semestre->id)
            ->get();
        if ($classeDisciplines->isEmpty()) {
            return response()->json([
                'message' => 'Cette classe n\'est pas inscrite à cette discipline pour cette évaluation'
            ], 404);
        }
        $invalideNotes = [];
        $notes = [];
        $eleveIds = $request->notes;

        foreach ($eleveIds as $eleveId) {
            if ($eleveId['note'] > $classeDisciplines->first()->max_note || $classeDisciplines->first()->max_note < 0) {
                $invalideNotes[] = $eleveId['note'];
                continue;
            }
            $inscriptions = Inscriptions::where('eleve_id', $eleveId)
                ->where('classes_id', $classe->id)
                ->where('annee_scolaire_id', $annee->id)
                ->first();

            $note = [
                'classe_discipline_id' => $classeDisciplines->first()->id,
                'annee_scolaire_id' => $annee->id,
                'inscriptions_id' => $inscriptions->id,
                'note' => $eleveId['note'],
            ];
            $notes[] = $note;
        }

        Note::insert($notes);

        return response()->json([
            'message' => 'Notes ajoutées avec succès',
            'NotesAjoutes' => NoteRessource::collection(Note::where('classe_discipline_id', $classeDisciplines->first()->id)->where('annee_scolaire_id', $annee->id)->get()),
            'NotesInvalides' => $invalideNotes
        ], 201);
    }
    public function editNotes(EditNotesRequest $request, $classes, $disciplines, $evaluations)
    {
        $semestre = Semestre::where('statut', true)->first();
        $annee = AnneeScolaire::where('statut', true)->first();
        $classe = Classes::find($classes);
        $evaluation = Evaluation::find($evaluations);
        $discipline = Discipline::find($disciplines);
        $classeDisciplines = ClasseDiscipline::where('classes_id', $classe->id)
            ->where('evaluation_id', $evaluation->id)
            ->where('discipline_id', $discipline->id)
            ->where('semestre_id', $semestre->id)
            ->get();
        if ($classeDisciplines->isEmpty()) {
            return response()->json([
                'message' => 'Cette classe n\'est pas inscrite à cette discipline pour cette évaluation'
            ], 404);
        }
        $invalideNotes = [];
        $notes = [];
        $notesData = $request->notes;

        foreach ($notesData as $noteData) {
            $eleveId = $noteData['eleve_id'];
            $noteValue = $noteData['note'];

            if ($noteValue > $classeDisciplines->first()->max_note || $classeDisciplines->first()->max_note < 0) {
                $invalideNotes[] = $noteData['note'];
                continue;
            }

            $inscriptions = Inscriptions::where('eleve_id', $eleveId)
                ->where('classes_id', $classe->id)
                ->where('annee_scolaire_id', $annee->id)
                ->first();

            if (!$inscriptions) {
                continue;
            }

            $note = Note::where('inscriptions_id', $inscriptions->id)
                ->where('classe_discipline_id', $classeDisciplines->first()->id)
                ->where('annee_scolaire_id', $annee->id)
                ->first();

            if (!$note) {
                continue;
            }

            $note->note = $noteValue;
            $note->save();
            $notes[] = $note;
        }

        return response()->json([
            'message' => 'Notes modifiées avec succès',
            'NotesInvalides' => $invalideNotes,
            'notesModifiées' => NoteRessource::collection($notes)
        ], 200);
    }
    public function getNotesByEleve($eleve, $classes, $disciplines, $evaluations)
    {
        $annee = AnneeScolaire::where('statut', true)->first();
        $classe = Classes::find($classes);
        $evaluation = Evaluation::find($evaluations);
        $semestre = Semestre::where('statut', true)->first();
        $discipline = Discipline::find($disciplines);
        $classeDisciplines = ClasseDiscipline::where('classes_id', $classe->id)
            ->where('evaluation_id', $evaluation->id)
            ->where('discipline_id', $discipline->id)
            ->where('semestre_id', $semestre->id)
            ->get();

        if (!$classeDisciplines->isEmpty()) {
            $inscriptions = Inscriptions::where('eleve_id', $eleve)
                ->where('classes_id', $classe->id)
                ->where('annee_scolaire_id', $annee->id)
                ->first();

            if ($inscriptions) {
                $notes = Note::where('classe_discipline_id', $classeDisciplines->first()->id)
                    ->where('annee_scolaire_id', $annee->id)
                    ->where('inscriptions_id', $inscriptions->id)
                    ->get();

                return NoteRessource::collection($notes->load('classe_discipline'));
            }
        }

        return [];
    }
    public function getNotesByDiscipline($classes, $disciplines)
    {
        $annee = AnneeScolaire::where('statut', true)->first();
    $classe = Classes::find($classes);
    $discipline = Discipline::find($disciplines);
    $semestre = Semestre::where('statut', true)->first();
    $classeDisciplines = ClasseDiscipline::where('classes_id', $classe->id)
        ->where('discipline_id', $discipline->id)
        ->where('semestre_id', $semestre->id)
        ->get();
    $notes = Note::whereIn('classe_discipline_id', $classeDisciplines->pluck('id'))
        ->where('annee_scolaire_id', $annee->id)
        ->get();

    $formattedNotes = [];

    foreach ($notes as $note) {
            $eleveId = $note->inscriptions->eleve->id;
            $eleveName = $note->inscriptions->eleve->prenom . ' ' . $note->inscriptions->eleve->nom;

            $eleveExists = false;
            foreach ($formattedNotes as &$formattedNote) {
                    if ($formattedNote['id_eleve'] === $eleveId) {
                            $eleveExists = true;
                $formattedNote['notes'][] = [
                        'id_note' => $note->id,
                        'note' => $note->note,
                        'evaluation' => $note->classe_discipline->evaluation->libelle,
                        'discipline' => $note->classe_discipline->discipline->libelle,
                    ];
                    break;
                }
        }

        if (!$eleveExists) {
            $formattedNotes[] = [
                    'id_eleve' => $eleveId,
                    'eleve' => $eleveName,
                    'notes' => [
                    [
                            'id_note' => $note->id,
                            'note' => $note->note,
                            'evaluation' => $note->classe_discipline->evaluation->libelle,
                            'discipline' => $note->classe_discipline->discipline->libelle,
                        ],
                    ],
                ];
            }
        }
    
        return response()->json([
                'data' => $formattedNotes,
            ]);

    }

    public function getNotesByClasse($classes)
    {
        $semestre = Semestre::where('statut', true)->first();
        $annee = AnneeScolaire::where('statut', true)->first();
        $classe = Classes::find($classes);
        $classesDisciplines = ClasseDiscipline::where('classes_id', $classe->id)
            ->where('semestre_id', $semestre->id)
            ->get();
        $note = Note::whereIn('classe_discipline_id', $classesDisciplines->pluck('id'))
            ->where('annee_scolaire_id', $annee->id)
            ->get();
        return NoteRessource::collection($note->load('classe_discipline'));
    }
    public function getAllNotesEleveByClasse($classes, $eleves)
    {
        $semestre = Semestre::where('statut', true)->first();
        $annee = AnneeScolaire::where('statut', true)->first();
        $classe = Classes::find($classes);
        $eleve = Eleve::find($eleves);
        $classesDisciplines = ClasseDiscipline::where('classes_id', $classe->id)
            ->where('semestre_id', $semestre->id)
            ->get();
        $inscriptions = Inscriptions::where('eleve_id', $eleve->id)
            ->where('classes_id', $classe->id)
            ->where('annee_scolaire_id', $annee->id)
            ->first();

        $notes = Note::where('inscriptions_id', $inscriptions->id)
            ->whereIn('classe_discipline_id', $classesDisciplines->pluck('id'))
            ->where('annee_scolaire_id', $annee->id)
            ->get();

        return NoteRessource::collection($notes->load('classe_discipline'));
    }
}


// $annee = AnneeScolaire::where('statut', true)->first();
//     $classe = Classes::find($classes);
//     $discipline = Discipline::find($disciplines);
//     $semestre = Semestre::where('statut', true)->first();
//     $classeDisciplines = ClasseDiscipline::where('classes_id', $classe->id)
//         ->where('discipline_id', $discipline->id)
//         ->where('semestre_id', $semestre->id)
//         ->get();
//     $notes = Note::whereIn('classe_discipline_id', $classeDisciplines->pluck('id'))
//         ->where('annee_scolaire_id', $annee->id)
//         ->get();

//     $formattedNotes = [];

//     foreach ($notes as $note) {
//             $eleveId = $note->inscriptions->eleve->id;
//             $eleveName = $note->inscriptions->eleve->prenom . ' ' . $note->inscriptions->eleve->nom;

//             $eleveExists = false;
//             foreach ($formattedNotes as &$formattedNote) {
//                     if ($formattedNote['id_eleve'] === $eleveId) {
//                             $eleveExists = true;
//                 $formattedNote['notes'][] = [
//                         'id_note' => $note->id,
//                         'note' => $note->note,
//                         'evaluation' => $note->classe_discipline->evaluation->libelle,
//                         'discipline' => $note->classe_discipline->discipline->libelle,
//                     ];
//                     break;
//                 }
//         }

//         if (!$eleveExists) {
//             $formattedNotes[] = [
//                     'id_eleve' => $eleveId,
//                     'eleve' => $eleveName,
//                     'notes' => [
//                     [
//                             'id_note' => $note->id,
//                             'note' => $note->note,
//                             'evaluation' => $note->classe_discipline->evaluation->libelle,
//                             'discipline' => $note->classe_discipline->discipline->libelle,
//                         ],
//                     ],
//                 ];
//             }
//         }
    
//         return response()->json([
//                 'data' => $formattedNotes,
//             ]);




        # code...join params




        // $validAssociations = ['niveaux', 'inscriptions', 'classe_discipline'];
        // $loadAssociations = [];
        
        // foreach ($associationsArray as $association) {
        //     if (in_array($association, $validAssociations)) {
        //         $loadAssociations[] = $association;
        //     }
        // }
        
        // if (empty($loadAssociations)) {
        //     return new ClassesRessource($classes);
        // }
        
        // $classes->load($loadAssociations);
        
        // return new ClassesRessource($classes);