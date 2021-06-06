@extends('layouts.app')
@section('content')
<div class="container d-flex flex-column">
<h1 class="text-center">Seleziona una bici tra quelle disponibili</h1>
</div>
<form action="{{route('contractBikeStoring', $contract->id)}}">
<div class="container d-flex flex-wrap justify-content-center">

        @foreach ($availables as $bike)

        <div class="card mx-2" style="width: 18rem;">
            <div class="card-body">
            <h5 class="card-title">{{$bike->name}}</h5>
            <p class="card-text">{{$bike->category->tipo}}</p>
                    <div class="form-check">

                        <input name="bike[]" type="checkbox" class="form-check-input" id="bike{{$bike->id}}" value="{{$bike->id}}">
                        <label class="form-check-label" for="bike{{$bike->id}}">Seleziona</label>

                    </div>
            </div>
        </div>

        @endforeach

</div>
<div class="container d-flex">
    <button id="submit" type="submit" class="btn btn-primary mx-auto my-2">Guarda Preview</button>
</div>
</form>

@endsection
