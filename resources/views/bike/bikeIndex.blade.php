@extends('layouts.app')
@section('content')

<div class="container d-flex flex-column">
    
    <h1 class="text-center">Tutte le bici</h1>

    <a class="btn btn-primary mx-auto my-4 p-3" href="{{route("bikeCreate")}}">Inserisci una nuova bici</a>
    <hr>
</div>

<div class="container d-flex flex-wrap justify-content-center">


    @foreach ($bikes as $bike)
        
    <div class="card m-2" style="width: 18rem; @if ($bike->manutenzione == 1) background-color: red; @elseif ($bike->bloccata == 1) background-color: yellow; @endif">
        <div class="card-body">
            <h5 class="card-title">{{$bike->name}}</h5>
            @if ($bike->bloccata == 1)

                <p class="card-text"> <strong> Contratti Attivi </strong></p>
                @foreach ($bike->contract as$contract )
               
                @if ($contract->data_inizio < $today && $contract->data_fine > $today ) 
                    <p class="card-text">id = {{$contract->id}}</p>
                
                @endif
                
            @endforeach
                
            @else
                <p class="card-text">Nessun Prenotazione attiva al momento</p>
            @endif
            <form action="{{route('bikeManutenzione', $bike->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="custom-control custom-switch">
                    <input name="manutenzione" type="checkbox" class="custom-control-input" id="manutenzione{{$bike->id}}" @if($bike->manutenzione == 1 ) checked @endif @if($bike->bloccata == 1) disabled @endif onchange="this.form.submit()">
                    <label class="custom-control-label" for="manutenzione{{$bike->id}}">Attiva manutenzione</label>
                    <input class="submit" type="submit" hidden>
                </div>

            </form>
            <a href="{{route("bikeEdit", $bike->id)}}" class="btn btn-primary my-4">Modifica informazioni</a>
            <form action="{{route('bikeDelete', $bike->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger my-4" name="delete" onclick="return confirm('Sei sicuro di voler cancellare?')" value="Delete">
            </form>

        </div>
    </div>
    @endforeach

</div>

<script>

</script>

@endsection
