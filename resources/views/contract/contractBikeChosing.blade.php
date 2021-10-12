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

        <div class="container mt-5">
            <div class="row">
                @foreach ($accessori as $accessorio)
                <div class="col-12 col-sm-3 accessory">
                    <div class="card accessory m-auto position-relative" name="bgcolor">
                        <input class="cat-id" type="number" value="{{$accessorio->id}}" hidden>
                        <input class="id-cat" type="checkbox" name="accessory[]" id="accessory" value="{{$accessorio->id}}" hidden>
                        <input name="accessorio[]" type="checkbox" class="form-check-input ml-n4" id="accessory{{$accessorio->id}}" value="{{$accessorio->id}}" style="width: 20px;height:20px;">
                        <label class="form-check-label ml-2" for="accessorio{{$accessorio->id}}" style="font-size: 1.5rem;">{{$accessorio->nome}}</label>
                    </div>
                    <div class="number-drop me-auto" style="display: none">
                        <label for="quantity{{$accessorio->id}}">Inserire quantita accessorio</label>
                        <input name="{{$accessorio->id}}" type="number" id="quantity{{$accessorio->id}}" class="form-control text-center my-3" value="0">
                    </div>
                </div>
                @endforeach
            </div>
        </div>

</div>
<div class="container d-flex">
    <button id="submit" type="submit" class="btn btn-primary mx-auto my-2">Guarda Preview</button>
</div>
</form>




<script>
$(document).ready(function() {
    $('.accessory').on('click', function(){
        var id =  $(this).children('.cat-id').val();
        var valueCheckbox = $(this).children('.id-cat');
        console.log(id);
        if (valueCheckbox.is(':checked')) {
            valueCheckbox.prop('checked',false)
            $(this).children('.check').hide();
            $(this).removeClass('bgcard');
        } else {
            valueCheckbox.prop('checked',true)
            $(this).children('.check').show();
            $(this).addClass('bgcard');

           
        }

        $(this).siblings('.number-drop').toggle(200);
    })
});
</script>
@endsection
