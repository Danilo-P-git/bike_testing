@extends('layouts.app')
@section('content')

<div class="container">
    
    <form action="{{route('bikeStore')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="form-row">



                <div class="form-group col-md-4 col-6">
                    <label for="name">Nome</label>
                    <input name="name" type="text" id="name" class="form-control" value="" >
                    @error('name')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                
              
                
                <div class="form-group col-md-4 col-6">
                    <label for="valore_acquisto">Valore d'acquisto</label>
                    <input name="valore_acquisto" type="number" id="valore_acquisto" class="form-control" value="" >
                    @error('valore_acquisto')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                
                <div class="form-group col-md-4 col-6">
                    <label for="valore_vendita">Valore di vendita</label>
                    <input name="valore_vendita" type="number" id="valore_vendita" class="form-control" value="" >
                    @error('valore_vendita')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                
                {{-- //manutenzione --}}

                
                {{-- category id  --}}
                <div class="form-group col-md-4 col-6">
                    <label for="category_id">Categoria</label>
                    <select class="custom-select custom-select-lg" name="category_id" id="category_id">
                        @foreach ($categories as $category )
                            <option value="{{$category->id}}">{{$category->tipo}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group col-md-4 col-6">
                    <label for="cover_photo">Foto di copertina </label>
                    <input class="form-control" type="file" name="cover_photo" id="cover_photo" accept="image/*">
                    
                </div>
                
                <div class="form-group col-12">
                    <label for="photo[]">Foto di copertina </label>
                    <input class="form-control" type="file" name="photo[]" id="photo[]" accept="image/*" multiple>
                    
                </div>


                <button id="submit" type="submit" class="btn btn-primary">Crea BIKE</button>



        </div>
    </form>

</div>
@endsection
