@extends('layouts.app')
@section('content')

<div class="container d-flex flex-wrap">
    @foreach ($bikes as $bike)
        
    <div class="card m-2" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{$bike->name}}</h5>
            @if ($bike->contract_id!=NULL)
                
                <p class="card-text">{{$bike->contract->data_fine}}  </p>
                <p class="card-text"> {{$bike->contract_id}}</p>
            @else
                <p class="card-text">Nessun contratto associato</p>
            @endif

            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
    @endforeach

</div>


@endsection
