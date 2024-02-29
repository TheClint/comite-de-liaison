<div class='resume-container collapse' id='departement{{$departement->numero}}'>
    {{-- {{$numDep}} --}}
    {{-- {{$nomDep}} --}}
    {{-- <a href="{{url('/departement/'.$numDep)}}">lien</a> --}}
    <span><a href="{{url('/departement/'.$departement->id)}}">{{$departement->nom}} ({{$departement->numero}})</a></span>
    <span>{{$departement->region->nom}}</span>
    <span><a> Dernier comité départementale : </a> 28/09/2023</span>
    <span><a> Prochain comité départementale : </a> 10/12/2023</span>
    <span><a> Dernier comité régionale : </a> 01/12/2022</span>
    <span><a> Prochain comité régionale : </a> 10/12/2023</span>
    <a href="">Gestion des demandes</a>
</div>

