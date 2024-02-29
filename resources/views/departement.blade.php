@extends('layouts.app')

@section('content')

    <div>
        
        <h3 class="d-flex justify-content-center">Comité de liaison :</h3>
        <h2 class="d-flex justify-content-center">{{$departement->nom}}</h2>
        <div class="d-flex justify-content-end">
          <a href="{{route("dashboard")}}" class="btn btn-primary m-3">retour à la carte</a>
      </div>

        @foreach ($comites as $comite)

        <div class="card text-center m-3" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">réunion du {{Carbon\Carbon::parse($comite->date_reunion)->format('d/m/Y')}}</h5>
              <h6 class="card-title">au {{$comite->lieu}}</h6>
              <p class="card-text">demande particulière
                demande particulière
                demande particulière.</p>
                @if (isset($comite->ordre_jour))
                  <a href="{{asset('../storage/app/'.$comite->ordre_jour)}}" target="_blank" class="btn btn-primary">Ordre du jour</a>
                @endif
                @if (isset($comite->compte_rendu))
                  <a href="{{asset('../storage/app/'.$comite->compte_rendu)}}" target="_blank" class="btn btn-primary">Compte-rendu</a>
                @endif
                <a href="{{route("comite.show", ['comite' => $comite])}}">détail</a>
            </div>
          </div>
        
        @endforeach

        
        
        {{-- pour les boutons de pagination --}}
            {{$comites->links()}}
        
            <div class="d-flex justify-content-start">
              <a href="{{url('comite/create/departemental/'.$departement->id)}}" class="btn btn-primary m-3">créer une nouvelle réunion</a>
            </div>
        

        
    </div>

@endsection
