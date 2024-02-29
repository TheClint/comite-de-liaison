@extends('layouts.app')

@section('content')

<div>
    <div class="container-md">
        
            <div class="d-flex flex-column">
                <h2 class="d-flex justify-content-center">Création d'une réunion de comité {{$typeLocalite}}</h2>
                @if ($typeLocalite == 'departemental')
                    <h3 class="d-flex justify-content-center">{{$localite->nom}}</h3>
                @endif
                @if ($typeLocalite == 'regional')</h3>
                    <h3 class="p-2 d-flex justify-content-center">{{$localite->nom}}</h3>
                @endif
            </div>
        
    
    
        <form action="{{route('comite.store')}}" method="post" enctype="multipart/form-data">
        @csrf
    
        <div class="mb-3">
            <label for="lieu" class="form-label">Lieu de la réunion :</label>
            <input type="text" name="lieu" class="form-control" id="lieu" aria-describedby="lieuAide">
            <div id="lieuAide" class="form-text">Entrez le lieu de la réunion</div>
        </div>

        <div class="mb-3">
            <label for="date-reunion" class="form-label">Date et heure de la réunion :</label>
            <input type="datetime-local" class="form-control" name="date-reunion" id="date-reunion">
        </div>

        <div class="input-group mb-3">
            <label class="input-group-text" for="ordre-jour">Ordre du jour : </label>
            <input type="file" name="ordre-jour" class="form-control" id="ordre-jour">
        </div>
        
        <div class="input-group mb-3">
            <label class="input-group-text" for="ordre-jour">Compte-Rendu : </label>
            <input type="file" name="compte-rendu" class="form-control" id="compte-rendu">
        </div>
        
        <input type="hidden" name="localite-type" value="{{$typeLocalite}}">

        @if ($localite->id)
            <input type="hidden" name="localite-id" value="{{$localite->id}}">
        @endif

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Créer</button>
        </div>
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




