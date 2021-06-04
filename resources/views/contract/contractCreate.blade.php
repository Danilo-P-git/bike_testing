@extends('layouts.app')
@section('content')



<div class="container">
    
    <form action="{{route('contractStore')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="form-row">



                <div class="form-group col-md-4 col-6">
                    <label for="nome">Nome</label>
                    <input name="nome" type="text" id="nome" class="form-control" value="" >
                    @error('nome')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                
                <div class="form-group col-md-4 col-6">
                    <label for="cognome">Costo noleggio</label>
                    <input name="cognome" type="text" id="cognome" class="form-control" value="" >
                    @error('cognome')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                
                <div class="form-group col-md-4 col-6">
                    <label for="tel">Telefono</label>
                    <input name="tel" type="number" id="tel" class="form-control" value="39" >
                    @error('tel')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                
                <div class="form-group col-md-4 col-6">
                    <label for="mail">mail</label>
                    <input name="mail" type="mail" id="mail" class="form-control" value="" >
                    @error('mail')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4 col-6">
                    <label for="nato_a">nato_a</label>
                    <input name="nato_a" type="nato_a" id="nato_a" class="form-control" value="" >
                    @error('nato_a')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4 col-6">
                    <label for="nato_il">nato_il</label>
                    <input name="nato_il" type="date" id="nato_il" class="form-control" value="" >
                    @error('nato_il')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4 col-6">
                    <label for="n_documento">n_documento</label>
                    <input name="n_documento" type="number" id="n_documento" class="form-control" value="" >
                    @error('n_documento')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4 col-6">
                    <label for="data_documento">data_documento</label>
                    <input name="data_documento" type="date" id="data_documento" class="form-control" value="" >
                    @error('data_documento')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4 col-6">
                    <label for="ente_documento">ente_documento</label>
                    <input name="ente_documento" type="text" id="ente_documento" class="form-control" value="" >
                    @error('ente_documento')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4 col-6">
                    <label for="residenza_temp">residenza_temp</label>
                    <input name="residenza_temp" type="text" id="residenza_temp" class="form-control" value="" >
                    @error('residenza_temp')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                
                <div class="form-group col-md-4 col-6">
                    <label for="data_inizio">data_inizio</label>
                    <input name="data_inizio" type="date" id="data_inizio" class="form-control" value="" >
                    @error('data_inizio')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                
                <div class="form-group col-md-4 col-6">
                    <label for="data_fine">data_fine</label>
                    <input name="data_fine" type="date" id="data_fine" class="form-control" value="" >
                    @error('data_fine')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                                
                <div class="form-group col-md-4 col-6">
                    <label for="comune_residenza">comune_residenza</label>
                    <input name="comune_residenza" type="text" id="comune_residenza" class="form-control" value="" >
                    @error('comune_residenza')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4 col-6">
                    <label for="via_residenza">via_residenza</label>
                    <input name="via_residenza" type="text" id="via_residenza" class="form-control" value="" >
                    @error('via_residenza')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Seleziona le tue bici
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bici disponibili</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            @foreach ($bikes as $bike)


                                <div class="form-check">
                                   

                                    <input name="bike[]" type="checkbox" class="form-check-input" id="bike{{$bike->id}}" value="{{$bike->id}}">
                                    <label class="form-check-label" style="font-size: 22px" for="bike{{$bike->id}}">{{$bike->name}} - {{$bike->taglia}}</label>
                                </div>
                
                            @endforeach
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                        </div>
                    </div>
                    </div>
                </div>

                <button id="submit" type="submit" class="btn btn-primary">Guarda Preview</button>



        </div>
    </form>

</div>


@endsection
