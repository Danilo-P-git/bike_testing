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
    <div class="form-row mt-5">
      <div class="form-group col-md-4 col-6">
      
          <input type="text" class="form-control" id="search" placeholder="Type to search..." />
      </div>
    </div>
    <table id="table" class="table rounded shadow table-sm border">
        <thead class="thead-dark">
          <tr>
            <th scope="col">id</th>
            <th scope="col">Nome </th>
            <th scope="col">data di inizio</th>
            <th scope="col">data di fine</th>
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
            <td>
              @if ($contract->sign != null)
              <a class="btn btn-danger" target="_blank" href="{{route("contractPdf", $contract->id)}}">Scarica PDF</a>
                <img style="width: 50px;" src="{{asset('storage\sign'.$contract->id.'.jpg')}}" alt="">
              @endif

              <a class="btn btn-success m-1"  href="{{route("contractSignature", $contract->id)}}">Inserisci firma</a>
              <a class="btn btn-primary m-1" href="{{route("contractMail", $contract->id)}}">Manda una mail</a>
              <a class="btn btn-secondary m-1" class="sms" href="{{route("contractSms", $contract->id)}}" value="{{$contract->id}}">Manda un sms</a>
              <a class="btn btn-secondary m-1" href="{{route("contractShow", $contract->id)}}">SHOW</a>
              <a class="btn btn-secondary m-1" href="{{route("contractEdit", $contract->id)}}">EDIT</a>
              <a class="btn btn-secondary m-1" href="{{route("contractDelete", $contract->id)}}">CANCELLA</a>
            </td>
          </tr>

          @endforeach

        </tbody>

</div>

<script>
      $("#search").keyup(function(){
        var searchText = $(this).val().toLowerCase();
        // Show only matching TR, hide rest of them
        $.each($("#table tbody tr"), function() {
            if($(this).text().toLowerCase().indexOf(searchText) === -1)
               $(this).hide();
            else
               $(this).show();                
        });
    }); 
</script>
@endsection
