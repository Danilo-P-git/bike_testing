@extends('layouts.app')
@section('content')

<div class="container d-flex flex-column">
    <h1 class="text-center">Contratto n° {{$contract->id}}</h1>
    <h2 class="text-center">Nominativo {{$contract->nome}} {{$contract->cognome}}</h2>
    <h5>Bici selezionate</h5>
    <ul>
        @foreach ($contract->bike as $bike)
            <li>{{$bike->name}} <br>
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
    <p>Email: <strong>{{$contract->mail}}</strong></p>
    <p>N° telefonico <strong>+{{$contract->tel}}</strong></p>
    <p>Da data {{$contract->data_inizio}} a data {{$contract->data_fine}}</p>
    @if ($contract->sign != NULL)
        <p>Firma</p>
        <img style="width: 50%;" src="{{asset($contract->sign)}}" alt="">
    @endif
</div>

@endsection
