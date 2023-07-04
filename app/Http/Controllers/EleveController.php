<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreEleveRequest;
use App\Http\Requests\UpdateEleveRequest;
use App\Http\Resources\EleveRessource;
use App\Models\AnneeScolaire;
use App\Models\Code;
use App\Models\Eleve;
use App\Models\Inscriptions;

class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eleves = Eleve::join('inscriptions', 'eleves.id', '=', 'inscriptions.eleve_id')
            ->join('classes', 'classes.id', '=', 'inscriptions.classes_id')
            ->where('eleves.actif', true)
            ->get();

        return EleveRessource::collection($eleves);
        // $elevesByClasse = Classes::join('inscriptions', 'classes.id', '=', 'inscriptions.classes_id')
        //     ->join('eleves', 'inscriptions.eleve_id', '=', 'eleves.id')
        //     ->join('annee_scolaires', 'inscriptions.annee_scolaire_id', '=', 'annee_scolaires.id')
        //     ->select('eleves.*', 'classes.libelle as classe', 'annee_scolaires.libelle as annee_scolaire')
        //     ->where('eleves.actif', 1)
        //     ->orderBy('eleves.nom')
        //     ->get();

        // return EleveRessource::collection($elevesByClasse);
    }

    public function store(StoreEleveRequest $request)
    {
        DB::beginTransaction();
    
        try {
            $eleve = Eleve::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'date_naissance' => $request->naissance,
                'lieu_naissance' => $request->lieu,
                'gender' => $request->sexe,
                'profil' => $request->profil,
            ]);
            
            if ($request->profil == 1) {
                $actif = Eleve::where('profil', 1)->where('actif', 1)->count();
                $i = 1;
                for ($j = 0; $j < $actif; $j++) {
                    $existingEleve = Eleve::where('profil', 1)->where('actif', 1)->where('code', $i)->first();
                    if (!$existingEleve) {
                        $eleve->code = $i;
                        break;
                    }
                    $i++;
                }
                $eleve->save();
            }
    
            $annee = AnneeScolaire::where('statut', 1)->first();
            $classe = $request->classe;
    
            Inscriptions::create([
                'eleve_id' => $eleve->id,
                'classes_id' => $classe,
                'annee_scolaire_id' => $annee->id,
            ]);
    
            DB::commit();
    
            return response()->json([
                'message' => 'Élève créé avec succès',
                'data' => $eleve
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
    
            return response()->json([
                'message' => 'Une erreur s\'est produite lors de la création de l\'élève',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    




    /**
     * Display the specified resource.
     */
    public function show(Eleve $eleve)
    {
        $student = Eleve::join('inscriptions', 'eleves.id', '=', 'inscriptions.eleve_id')
            ->join('classes', 'classes.id', '=', 'inscriptions.classes_id')
            ->where('eleves.id', $eleve->id)
            ->first();

        return new EleveRessource($student);
    }
    public function update(UpdateEleveRequest $request, Eleve $eleve)
    {

        $eleve->actif = false;
        $eleve->save();
        return EleveRessource::collection(Eleve::all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Eleve $eleve)
    {
        $eleve->delete();
        return EleveRessource::collection(Eleve::all());
    }
}
// $eleve = Eleve::create([
    //     'nom' => $request->nom,
    //     'prenom' => $request->prenom,
    //     'date_naissance' => $request->naissance,
    //     'lieu_naissance' => $request->lieu,
    //     'gender' => $request->sexe,
    //     'profil' => $request->profil,
    // ]);
    
    // if ($request->profil == 1) {
        //     $lastEleve = Eleve::where('profil', 1)->whereNotNull('code')->orderBy('code', 'desc')->first();
        
        //     if ($lastEleve) {
            //         $eleve->code = $lastEleve->code + 1;
            //         $lastEleve->code = null;
            //         $lastEleve->save();
            //     } else {
                //         $lastCode = Eleve::where('profil', 1)->max('code');
                //         $eleve->code = $lastCode ? $lastCode + 1 : 1;
                //     }
                // }
                
                // $eleve->save();
            
                // $annee = AnneeScolaire::where('statut', 1)->first();
                // $classe = $request->classe;
                // Inscriptions::create([
                    //     'eleve_id' => $eleve->id,
                    //     'classes_id' => $classe,
                    //     'annee_scolaire_id' => $annee->id,
                    // ]);
                    
                    //working code
                    // if ($request->profil == 1) {
                        //     $actif = Code::orderBy('code', 'desc')->first();
                        
                        //     if ($actif == null) {
                            //         $lastEleve = Eleve::where('profil', 1)->orderBy('code', 'desc')->first();
                            //         $eleve->code = $lastEleve->code + 1;
                            //     } else {
                                //         $eleve->code = $actif->code;
                                //         $actif->delete();
                                //     }
                                
                                //     $eleve->save();
                // }
                                // Code::create([
                                    //     'code' => $eleve->code,
                                    // ]);