@extends('layouts.app')

@section('content')

<div>
    <div class="container-md">
        
            <div class="d-flex flex-column">
                <h2 class="d-flex justify-content-center">Modification d'une réunion de comité {{$typeLocalite}}</h2>
                @if ($typeLocalite == 'departemental')
                    <h3 class="d-flex justify-content-center">{{$localite->nom}}</h3>
                @endif
                @if ($typeLocalite == 'regional')</h3>
                    <h3 class="p-2 d-flex justify-content-center">{{$localite->nom}}</h3>
                @endif
            </div>
    
    
        <form action="{{route('comite.update', ['comite' => $comite])}}" method="post" enctype="multipart/form-data">
        @csrf
    
        <div class="mb-3">
            <label for="lieu" class="form-label">Lieu de la réunion :</label>
            <input type="text" name="lieu" class="form-control" id="lieu" aria-describedby="lieuAide"  value="{{$comite->lieu}}">
            <div id="lieuAide" class="form-text">Entrez le lieu de la réunion</div>
        </div>

        <div class="mb-3">
            <label for="date-reunion" class="form-label">Date et heure de la réunion :</label>
            <input type="datetime-local" class="form-control" name="date-reunion" id="date-reunion" value="{{$comite->date_reunion}}">
        </div>

        <div class="input-group mb-3">
            <label class="input-group-text" for="ordre-jour">Ordre du jour : </label>
            <input type="file" name="ordre-jour" class="form-control" id="ordre-jour" aria-describedby="ordreJourAide">
            @if (isset($comite->ordre_jour))
            <div id="ordreJourAide" class="form-text">Ajouter un nouveau fichier remplacera l'ancien</div>
            <a href="{{asset('../storage/app/'.$comite->ordre_jour)}}" target="_blank" class="btn btn-primary">Ordre du jour</a>
            @endif
        </div>    
        
        <div class="input-group mb-3">
            <label class="input-group-text" for="ordre-jour">Compte-Rendu : </label>
            <input type="file" name="compte-rendu" class="form-control" id="compte-rendu" aria-describedby="compteRenduAide">
            @if (isset($comite->compte_rendu))
            <div id="compteRenduAide" class="form-text">Ajouter un nouveau fichier remplacera l'ancien</div>
            <a href="{{asset('../storage/app/'.$comite->compte_rendu)}}" target="_blank" class="btn btn-primary">Compte-rendu</a>
            @endif
        </div>
        
        <input type="hidden" name="localite-type" value="{{$typeLocalite}}">

        @if ($localite->id)
            <input type="hidden" name="localite-id" value="{{$localite->id}}">
        @endif

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Modifier</button>
        </div>

        <input type="hidden" name="_method" value="put" />
        </form>
    
 
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

@endsection




