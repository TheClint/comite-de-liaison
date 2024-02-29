@extends('layouts.app')

@section('content')

<div>
    <div class="container-md">
        
            <div class="d-flex flex-column">
                <h2 class="d-flex justify-content-center">Modifier la demande de la réunion du {{Carbon\Carbon::parse($comite->date_reunion)->format('d/m/Y')}}</h2>
            </div>
        
    
    
        <form action="{{route('demande.update', ['demande' => $demande->id])}}" method="post" enctype="multipart/form-data">
        @csrf
    
        <div class="mb-3">
            <label for="intitule" class="form-label">Intitulé :</label>
            <textarea class="form-control" id="intitule" name="intitule" rows="3" aria-describedby="intituleAide">{{$demande->intitule}}</textarea>
            <div id="intituleAide" class="form-text">Entrez l'intitule de la demande</div>
        </div>

        <div class="mb-3">
            <label for="date-reponse" class="form-label">Date estimée de la réponse :</label>
            <input type="date" class="form-control" name="date-reponse" id="date-reponse" value="{{$demande->estimation_reponse}}">
        </div>

        <div class="mb-3">
            <label for="reponse" class="form-label">Réponse :</label>
            <textarea class="form-control" id="reponse" name="reponse" rows="3" aria-describedby="reponseAide">{{$demande->reponse}}</textarea>
            <div id="reponseAide" class="form-text">Entrez la réponse fournie</div>
        </div>

        <input type="hidden" name="comite-id" value="{{$comite->id}}">
        <input type="hidden" name="_method" value="put" />

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">modifier</button>
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
