<?php

namespace App\Http\Controllers;

use App\Models\Comite;
use App\Models\Region;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;

class ComiteController extends Controller
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
    public function create(String $typeLocalite = 'national', int $id = null)
    {
        $localite = null;

        if($typeLocalite == 'departemental'){
            $localite= Departement::find($id);
        }
        if($typeLocalite == 'regional'){
            $localite= Region::find($id);
        }

        return view('comite/create')
            ->with('typeLocalite', $typeLocalite)
            ->with('localite', $localite);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'date-reunion' => 'required',
            'compte-rendu' => File::types(['pdf', 'doc', 'docx']),
            'ordre-jour' => File::types(['pdf', 'doc', 'docx']),
            'lieu' => 'required|max:255',
            'localite-type' => 'required',
            'localite-id' => 'nullable|numeric',
        ]);

        $comite = new Comite();

        $comite->date_reunion = $validated['date-reunion'];
        if(isset($validated['ordre-jour'])){
            $comite->ordre_jour = Storage::disk('local')->put('public/ordreJour', $validated['ordre-jour']);
        }
        if(isset($validated['compte-rendu'])){
            $comite->compte_rendu = Storage::disk('local')->put('public/compteRendu', $validated['compte-rendu']);
        }
        $comite->lieu = $validated['lieu'];

        switch($validated['localite-type']){
            case 'departemental':
                $comite->departement_id = $validated['localite-id'];
                $lienReponse = "departement/".$comite->departement->numero;
                break;
            case 'regional':
                $comite->region_id = $validated['localite-id'];
                $lienReponse = "region/".$comite->region_id;
                break;
            case 'national':
                $lienReponse = "nation";
                break;
        }

        $comite->save();
       
        return redirect(url($lienReponse));
    }

    /**
     * Display the specified resource.
     */
    public function show(Comite $comite)
    {
        return view('comite/show')
            ->with('comite', $comite)
            ->with('demandes', $comite->demandes);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comite $comite)
    {
        $localite = null;
        if($comite->departement!==null){
            $typeLocalite = "departemental";
            $localite = $comite->departement;
        }
        elseif($comite->region!==null){
            $typeLocalite = "régional";
            $localite = $comite->region;    
        }
        else
            $typeLocalite = "national";
        
        return view('comite/edit')
            ->with('comite', $comite)
            ->with('typeLocalite', $typeLocalite)
            ->with('localite', $localite);;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comite $comite)
    {
        $validated = $request->validate([
            'date-reunion' => 'required',
            'compte-rendu' => File::types(['pdf', 'doc', 'docx']),
            'ordre-jour' => File::types(['pdf', 'doc', 'docx']),
            'lieu' => 'required|max:255',
            'localite-type' => 'required',
            'localite-id' => 'nullable|numeric',
        ]);

        $comite->date_reunion = $validated['date-reunion'];
        if(isset($validated['ordre-jour'])){
            if(isset($comite->ordre_jour))
                Storage::delete($comite->ordre_jour);
            $comite->ordre_jour = Storage::disk('local')->put('public/ordreJour', $validated['ordre-jour']);
        }
        if(isset($validated['compte-rendu'])){
            if(isset($comite->comte_rendu))
                Storage::delete($comite->comte_rendu);
            $comite->compte_rendu = Storage::disk('local')->put('public/compteRendu', $validated['compte-rendu']);
        }
        $comite->lieu = $validated['lieu'];

        $comite->save();
       
        return view('comite.show')
            ->with('comite', $comite);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comite $comite)
    {
        if($comite->departement!==null){
            $lien = "departement/".$comite->departement->numero;
        }
        elseif($comite->region!==null){
            $lien = "region/".$comite->region->id;
        }
        else
            $lien = "nation";

        if(isset($comite->comte_rendu))
            Storage::delete($comite->comte_rendu);
        if(isset($comite->ordre_jour))
            Storage::delete($comite->ordre_jour);

        $comite->delete();

        return redirect(url($lien));
    }
}
