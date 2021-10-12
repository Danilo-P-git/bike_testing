@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-12">
            <form action="{{route('StoreAccessory')}}" method="POST">
                @csrf
                <label>Nome Accessorio</label>
                <input type="text" name="nomeAccessorio" value=""><br>
                <label>Quantita disponibile</label>
                <input type="number" name="quantitaAccessorio" value=""><br>
                <button class="btn btn-success" type="submit">Salva</button>
            </form>
        </div>
    </div>
</div>

@endsection
