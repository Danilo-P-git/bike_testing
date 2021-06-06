@extends('layouts.app')
@section('content')

<div class="container d-flex flex-column">
    <h1 class="text-center">Contratto n° {{$contract->id}}</h1>
    <h2 class="text-center">Nominativo {{$contract->nome}} {{$contract->cognome}}</h2>
    <h5>Bici selezionate</h5>
    <ul>
        @foreach ($contract->bike as $bike)
            <li>{{$bike->name}} con costo di {{$bike->valore_noleggio}} €</li>
        @endforeach
    </ul>
    <p>Email: <strong>{{$contract->mail}}</strong></p>
    <p>N° telefonico <strong>+{{$contract->tel}}</strong></p>
    <p>Da data {{$contract->data_inizio}} a data {{$contract->data_fine}}</p>
    @if ($contract->sign != NULL)
        <p>Firma</p>
        <img style="width: 50%;" src="{{asset($contract->sign)}}" alt="">
    @endif
</div>

@endsection
