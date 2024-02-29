<?php

namespace App\Http\Controllers;

use App\Models\Comite;
use App\Models\Departement;

use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function show(String $departementNum){

        $departement = Departement::where('numero', $departementNum)->first();
        
        return view('departement')
            ->with('departement', $departement)
            ->with('comites', Comite::orderBy('date_reunion', 'DESC')
                ->where('departement_id', '=', $departement->id)
                ->simplePaginate(3));
    }
}
