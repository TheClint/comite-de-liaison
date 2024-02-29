@extends('layouts.app')

@section('content')

        <h2 class="d-flex flex-row justify-content-center" >Détail d'une demande</h2>
          <div class="card m-3">
                <div class="card-header">
                    Demande (numero : {{$demande->id}})
                </div>
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-start m-3">
                        <p class="card-text w-75">{{$demande->intitule}}</p>
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
                </div>
              <div class="d-flex flex-row justify-content-end">
                <a href="{{route("demande.edit", ['demande' => $demande])}}" class="btn btn-primary m-1">Modifier</a>
                <a href="{{route("demande.editReferencer", ['demande' => $demande])}}" class="btn btn-primary m-1">Modifier la ref</a>
                    <form action="{{route("demande.destroy", ['demande' => $demande])}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="delete" />
                        <button type="submit" class="btn btn-primary m-1">Supprimer</button>
                    </form>
                </div>
            </div>


            @if (isset($demandeAscendante))
                    <div class="card m-3">
                        <div class="card-header">
                            Demande de référence (numero : {{$demandeAscendante->id}})
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-row justify-content-start m-3">
                                <p class="card-text w-75">{{$demandeAscendante->intitule}}</p>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-end m-3">
                            <div class="col-2 d-flex flex-row justify-content-center align-items-center">
                                <div>
                                    Réponse :
                                </div>
            
                            </div>
                            <div class="col-10">
                                @if (isset($demandeAscendante->reponse))
                                    <p class="card-text">{{$demandeAscendante->reponse}}</p>   
                                @else
                                    <h5 class="card-title">Date de réponse estimée :</h5>
                                    <p class="card-text">{{Carbon\Carbon::parse($demandeAscendante->estimation_reponse)->format('d/m/Y')}}</p>  
                                @endif
                            </div>
                        </div>
                        <div class="m-3">
                            <a href="{{route("demande.show", ['demande' => $demandeAscendante->id])}}" class="btn btn-primary">Détail</a>
                        </div>
                    </div>
                @endif
              
          <div class="ms-5">
                @if (isset($demandesDescendantes))
                    @foreach ($demandesDescendantes as $demandeD)
                    <div class="card m-3">
                        <div class="card-header">
                            Demande associée (numero : {{$demandeD->id}})
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-row justify-content-start m-3">
                                <p class="card-text w-75">{{$demandeD->intitule}}</p>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-end m-3">
                            <div class="col-2 d-flex flex-row justify-content-center align-items-center">
                                <div>
                                    Réponse :
                                </div>
            
                            </div>
                            <div class="col-10">
                                @if (isset($demandeD->reponse))
                                    <p class="card-text">{{$demandeD->reponse}}</p>   
                                @else
                                    <h5 class="card-title">Date de réponse estimée :</h5>
                                    <p class="card-text">{{Carbon\Carbon::parse($demandeD->estimation_reponse)->format('d/m/Y')}}</p>  
                                @endif
                            </div>
                        </div>
                        <div class="m-3">
                            <a href="{{route("demande.show", ['demande' => $demandeD->id])}}" class="btn btn-primary">Détail</a>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

@endsection




