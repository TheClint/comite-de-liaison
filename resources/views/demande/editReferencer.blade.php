@extends('layouts.app')

@section('content')


<form action="{{route('demande.update', ['demande' => $demandeARef->id])}}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="input-group">
        <select class="form-select" id="selecteurDemande" aria-label="Champs pour selectionner le numéro de la demande de référence">
            <option selected>Choisissez le numéro de la demande</option>
            @foreach ($demandes as $demande)
            <option value={{$demande->id}}>{{$demande->id}}</option>
            @endforeach
        </select>
        <button class="btn btn-outline-secondary" type="submit">Référencer</button>
    </div>

    <div>
        @foreach ($demandes as $demande)
            <p id="paragraphe{{$demande->id}}" class="d-none">{{$demande->intitule}}</p>
        @endforeach
    </div>

    <input type="hidden" name="_method" value="patch" />

    </form>
@endsection