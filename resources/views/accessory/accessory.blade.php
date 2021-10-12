

<div class="container">
    <div class="row">
        <div class="col-12">
            @extends('layouts.app')
@section('content')

<div class="container d-flex flex-column">
  <h1 class="text-center">Tutti i contratti</h1>
  <a class="btn btn-primary mx-auto my-4 p-3" href="{{route('createAccessory')}}">Crea un nuovo Accessorio</a>
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
                <th scope="col">ID </th>
                <th scope="col">Nome </th>
                <th scope="col">Quantita</th>
            </tr>
        </thead>
    @foreach ($accessori as $accessorio)
        <tbody>
            <tr>
                <td>{{$accessorio->id}}</td>
                <td>{{$accessorio->nome}}</td>
                <td>{{$accessorio->quantita}}</td>
            </tr>
        </tbody>
    @endforeach

</div>



        </div>
    </div>
</div>


@endsection