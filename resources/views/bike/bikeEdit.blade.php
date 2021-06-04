@extends('layouts.app')
@section('content')

<form action="{{route('bikeUpdate', $bikes->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="container">

    <div class="form-row">



            <div class="form-group col-md-4 col-6">
                <label for="name">Nome</label>
                <input name="name" type="text" id="name" class="form-control" value="{{old("name") ? old("name") : $bikes->name}}" >
                @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            
            <div class="form-group col-md-4 col-6">
                <label for="valore_noleggio">Costo noleggio</label>
                <input name="valore_noleggio" type="number" id="valore_noleggio" class="form-control" value="{{old("valore_noleggio") ? old("valore_noleggio") : $bikes->valore_noleggio}}" >
                @error('valore_noleggio')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            
            <div class="form-group col-md-4 col-6">
                <label for="valore_acquisto">Valore d'acquisto</label>
                <input name="valore_acquisto" type="number" id="valore_acquisto" class="form-control" value="{{old("valore_acquisto") ? old("valore_acquisto") : $bikes->valore_acquisto}}" >
                @error('valore_acquisto')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            
            <div class="form-group col-md-4 col-6">
                <label for="valore_vendita">Valore di vendita</label>
                <input name="valore_vendita" type="number" id="valore_vendita" class="form-control" value="{{old("valore_vendita") ? old("valore_vendita") : $bikes->valore_vendita}}" >
                @error('valore_vendita')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            
            {{-- //manutenzione --}}

            
            {{-- category id  --}}
            <div class="form-group col-md-4 col-6">
                <label for="category_id">Cambia categoria</label>
                <select class="custom-select custom-select-lg" name="category_id" id="category_id">
                    @foreach ($categories as $category )
                        <option value="{{$category->id}}" @if (old("category_id")== $category->id) selected="selected"@endif>{{$category->tipo}}</option>
                    @endforeach
                </select>
            </div>

            <button id="submit" type="submit" class="btn btn-primary">Modifica Bike</button>



    </div>
</div>


@endsection
