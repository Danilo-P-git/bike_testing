@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Cosa vuoi fare?</h1>

    <div class="row my-5">
        <div class="col d-flex">
            <a class="btn  btn_menu shadow  m-auto d-flex" href="{{route('bikeIndex')}}"><span class="m-auto">BICI</span></a>
  
        </div>
        <div class="col">
          <a class="btn  btn_menu shadow m-auto d-flex" href="{{route('contractIndex')}}"><span class="m-auto">CONTRATTI</span></a>
        </div>
        <div class="col">
            <a class="btn  btn_menu shadow m-auto d-flex" href="{{route('indexAccessory')}}"><span class="m-auto">ACCESSORI</span></a>
          </div>
    </div>
    
</div>
@endsection
