@extends('layouts.app')
@section('content')

<div class="container d-flex flex-column">
    <h1 class="text-center">Contratto n° {{$contract->id}}</h1>
    <h2 class="text-center">Nominativo {{$contract->nome}} {{$contract->cognome}}</h2>
    <h2>Bici selezionate</h2>
    <ul>
        @foreach ($contract->bike as $bike)
            <li style="font-size: 1.2rem">{{$bike->name}} <br>
                <img style="width: 100px" src="{{asset('storage/'.$bike->cover_photo)}}" alt="">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
                  Mostra le altre foto
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Mostra foto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                <ul>
                                @foreach ($bike->photo as $photo)
                                    <li class="py-3">
                                        <img style="width: 300px;" src="{{ asset('storage/'.$photo->path)}}" alt="">
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        <hr>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                <h2 class="ml-n3">Accessori selezionati</h2>
                <ul>
                @foreach ($accessory->accessori as $item)
                    <li style="font-size: 1.2rem;">{{$item->nome}}</li>
                @endforeach
                </ul> 
            </div>
            </div>
        </div>
    
    <h2 class="ml-n4">Email: <strong>{{$contract->mail}}</strong></h2>
    <h2 class="ml-n4">N° telefonico <strong>+{{$contract->tel}}</strong></h2>
    <h2 class="ml-n4">Da data {{$contract->data_inizio}} a data {{$contract->data_fine}}</h2>
    @if ($contract->sign != NULL)
        <h2 class="ml-n4">Firma</h2>
        <img style="width: 50%;" src="{{asset($contract->sign)}}" alt="">
    @endif
    <a href="{{route('contractEdit', $contract->id)}}"><button class="btn btn-danger">Modifica</button></a>
</div>

@endsection
