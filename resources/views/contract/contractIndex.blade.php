@extends('layouts.app')
@section('content')

<div class="container d-flex flex-column">
  <h1 class="text-center">Tutti i contratti</h1>
  <a class="btn btn-primary mx-auto my-4 p-3" href="{{route("contractCreate")}}">Crea un nuovo contratto</a>
</div>
<div class="container">
    @if ($message = Session::get('message'))
        {{$message}}
    @endif
    <table class="table rounded shadow">
        <thead class="thead-dark">
          <tr>
            <th scope="col">id</th>
            <th scope="col">Nome </th>
            <th scope="col">data di inizio</th>
            <th scope="col">data di fine</th>
            <th scope="col">numero Bici</th>
            <th scope="col">Azioni</th>



          </tr>
        </thead>
        <tbody>
          @foreach ($contracts as $contract)

          <tr>
            <td>{{$contract->id}}</td>
            <td>{{$contract->nome}}  {{$contract->cognome}}</td>
            <td>{{$contract->data_inizio}}</td>
            <td>{{$contract->data_fine}}</td>
            <td>{{count($contract->bike)}}</td>
            <td>
              <a class="btn btn-danger" href="#">Scarica PDF</a>
              <a href="{{route("contractSignature", $contract->id)}}">Inserisci firma</a>
              <a href="{{route("contractMail", $contract->id)}}">Manda una mail</a>
            </td>
          </tr>

          @endforeach

        </tbody>

</div>

@endsection
