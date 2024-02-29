@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row m-3">
    <div class="col-md d-flex justify-content-center">
        @include('components/carte')
    </div>

    <div class="col-sm d-flex align-items-center flex-column">

        <div class="d-flex flex-row m-4">
            <select id="afficherSelect" class="form-select" aria-label="Default select example">
            <option selected>Choississez un département</option>
            @foreach ($data['departements'] as $departement)
                <option value="{{$departement->id}}">{{$departement->numero.' - '.$departement->nom}}</option>
            @endforeach
          </select>
          <button class="btn btn-primary" type="button" id="afficherButton">Afficher</button>
        </div>

          


        @foreach ($data['departements'] as $departement)
            <div class='resume-container collapse' id='departement{{$departement->numero}}'>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{url('/departement/'.$departement->numero)}}">{{$departement->nom}} ({{$departement->numero}})</a></h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{$departement->region->nom}}</h6>
                        <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a> Dernier comité départementale : </a> 28/09/2023</li>
                        <li class="list-group-item"><a>Prochain comité départementale : </a> 10/12/2023</li>
                        <li class="list-group-item"><a>Dernier comité régionale : </a> 01/12/2022</li>
                        <li class="list-group-item"><a> Prochain comité régionale : </a> 10/12/2023</li>
                        </ul>
                        <a href="">Gestion des demandes</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
                
@endsection
