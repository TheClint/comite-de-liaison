@extends('layouts.app')

@section('content')

<div>
    <div class="container-md">
        <a href="{{route("comite.edit", ['comite' => $comite])}}" class="btn btn-primary">Modifier la réunion</a>
        <form action="{{route("comite.destroy", ['comite' => $comite])}}" method="post">
            @csrf
            <input type="hidden" name="_method" value="delete" />
            <button type="submit" class="btn btn-primary">Supprimer la réunion</button>
        </form>

          <h3>Réunion du comité
          @if (isset($comite->departement_id))
              départemental : </h3>
              <h2>{{$comite->departement->nom}}</h2>
          @endif
          @if (isset($comite->region_id))
              régional : </h3>
              <h2>{{$comite->region->nom}}</h2>
          @endif
          @if (($comite->region_id==null)&&($comite->departement_id==null))
              national </h3>
          @endif

          <span>Date : {{Carbon\Carbon::parse($comite->date_reunion)->format('d/m/Y')}}</span>
          <span>Lieu : {{$comite->lieu}}</span>

          @foreach ($demandes as $demande)
                    <div class="card m-3">
                        <div class="card-header">
                            Demande {{ $loop->iteration }}
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-row justify-content-start m-3">
                                <p class="card-text w-75">{{$demande->intitule}}</p>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-end m-3">
                            <div class="col-2 d-flex flex-row justify-content-center align-items-center">
                                <div>
                                    Réponse :
                                </div>
            
                            </div>
                            <div class="col-10">
                                @if (isset($demande->reponse))
                                    <p class="card-text">{{$demande->reponse}}</p>   
                                @else
                                    <h5 class="card-title">Date de réponse estimée :</h5>
                                    <p class="card-text">{{Carbon\Carbon::parse($demande->estimation_reponse)->format('d/m/Y')}}</p>  
                                @endif
                            </div>
                        </div>
                        <div class="m-3">
                            <a href="{{route("demande.show", ['demande' => $demande->id])}}" class="btn btn-primary">Détail</a>
                        </div>
                    </div>
                @endforeach

        <a href="{{route("demande.create", ['comiteId' => $comite->id])}}">ajouter une demande</a>
                @if (isset($comite->ordre_jour))
                  <a href="{{asset('../storage/app/'.$comite->ordre_jour)}}" target="_blank" class="btn btn-primary">Ordre du jour</a>
                @endif
                @if (isset($comite->compte_rendu))
                  <a href="{{asset('../storage/app/'.$comite->compte_rendu)}}" target="_blank" class="btn btn-primary">Compte-rendu</a>
                @endif
            
    </div>
</div>

@endsection




