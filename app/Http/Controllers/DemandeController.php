<?php

namespace App\Http\Controllers;

use App\Models\Comite;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('demande/create')
        ->with('comiteId', $request->comiteId);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'intitule' => 'required',
            'date-reponse' => 'date|nullable|required_without:reponse',
            'reponse' => 'required_without:date-reponse',
            'comite-id' => 'required|numeric',
        ]);

        $demande = new Demande();

        $demande->intitule = $validated['intitule'];
        if(isset($validated['date-reponse']))
            $demande->estimation_reponse = $validated['date-reponse'];
        if(isset($validated['reponse']))
            $demande->reponse = $validated['reponse'];
        $demande->comite_id = $validated['comite-id'];
        $demande->demande_id = null;

        $demande->save();


        return redirect()
            ->route('comite.show', ['comite' => $validated['comite-id']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Demande $demande)
   {
        return view('demande/show')
            ->with('demande', $demande)
            ->with('demandeAscendante', Demande::find($demande->demande_id))
            ->with('demandesDescendantes', DB::table('demandes')
                ->where('demande_id', '=', $demande->id)
                ->get());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Demande $demande)
    {
        return view('demande/edit')
            ->with('demande', $demande)
            ->with('comite', Comite::find($demande->comite_id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Demande $demande)
    {
        $validated = $request->validate([
            'intitule' => 'required',
            'date-reponse' => 'date|nullable|required_without:reponse',
            'reponse' => 'required_without:date-reponse',
            'comite-id' => 'required|numeric',
        ]);

        $demande->intitule = $validated['intitule'];
        if(isset($validated['date-reponse']))
            $demande->estimation_reponse = $validated['date-reponse'];
        if(isset($validated['reponse']))
            $demande->reponse = $validated['reponse'];
        $demande->comite_id = $validated['comite-id'];

        $demande->save();


        return redirect()
            ->route('demande.show', ['demande' => $demande->id]);
    }

    // Montrer le formulaire de référencement
    public function editReferencer(Demande $demande){
        return view('demande/editReferencer')
        ->with('demandeARef', $demande)
        ->with('demandes', Demande::all());
    }

    // Mettre à jour la référénce
    public function referencer(Request $request, Demande $demande){
        
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demande $demande)
    {
        $comiteId = $demande->comite_id;

        // Modification de toutes les entrées ayant pour référence la demande à supprimer
        DB::table('demandes')
        ->where('demande_id', '=', $demande->id)
        ->update(['demande_id' => null]);


        $demande->delete();

        return redirect()
        ->route('comite.show', ['comite' => $comiteId]);
    }
}
