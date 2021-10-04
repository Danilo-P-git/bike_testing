@extends('layouts.app')
@section('content')

<div class="container d-flex flex-column">
        <h2>Ricerca per giorno {{$dataOggi}}</h2>

    @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    <div class="container ml-n3">
        <div class="row">
            <div class="col-12 mt-3">

                <h1 class="btn btn-danger p-3 ms-n5"><a href="{{route('contractIndex')}}"style="text-decoration:none;color:white;">Vai a Contratti</a></h1>
            </div>
        </div>
    </div>
    <h1 class="text-center">Tutte le bici</h1>
    <div class="col-auto ml-auto">
        <form action="{{route('bikeIndex')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <label for="data">Controlla disponibilità</label>
            <input class="form-control" name="data" id="data" type="date" value="{{$dataOggi}}">

            <button class="btn btn-primary" type="submit">Check</button>
        </form>
    </div>
    <a class="btn btn-primary mx-auto my-3 p-3" href="{{route("bikeCreate")}}">Inserisci una nuova bici</a>

    <h3 class="text-center">AGGIUNGI UNA CATEGORIA</h3>
    <div class="offset-3 col-6 d-flex">


        <form action="{{route("category")}}" method="POST" class="w-100" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-row">

                <div class="form-group col-10">

                    <label for="tipo">Nome Categoria</label>
                    <input name="tipo" type="text" id="tipo" class="form-control" value="">
                    @error('tipo')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-2  d-flex">

                    <button id="showCat" class="btn btn-primary align-self-end mr-1" type="button" ><i class="fas fa-dollar-sign"></i></button>
                    <button class="btn btn-primary align-self-end mr-1" type="submit" onclick=""><i class="fas fa-plus"></i></button>
                    <a class="btn btn-secondary align-self-end show"><i class="fas fa-eye"></i></a>
                </div>
                {{-- endprice --}}

                {{-- <div id="priceCat"> --}}

                    <div class="form-group col-md-2 col-lg-1 col-4 priceCat" style="display: none">

                        <label for="base">1 giorno</label>
                        <input type="number" style="-moz-appearance:textfield;" name="base" class="form-control" id="base"  >

                    </div>

                    <div class="form-group col-md-2 col-lg-1 col-4 priceCat" style="display: none">
                        <label for="twoDay">2 giorni</label>
                        <input type="number" style="-moz-appearance:textfield;" name="twoDay" class="form-control" id="twoDay" >
                    </div>


                    <div class="form-group col-md-2 col-lg-1 col-4 priceCat" style="display: none">
                        <label for="threeDay">3 giorni</label>
                        <input type="number" style="-moz-appearance:textfield;" name="threeDay" class="form-control" id="threeDay" >
                    </div>


                    <div class="form-group col-md-2 col-lg-1 col-4 priceCat" style="display: none">
                        <label for="fourDay">4 giorni</label>
                        <input type="number" style="-moz-appearance:textfield;" name="fourDay" class="form-control" id="fourDay" >
                    </div>


                    <div class="form-group col-md-2 col-lg-1 col-4 priceCat" style="display: none">
                        <label for="fiveDay">5 giorni</label>
                        <input type="number" style="-moz-appearance:textfield;" name="fiveDay" class="form-control" id="fiveDay" >
                    </div>


                    <div class="form-group col-md-2 col-lg-1 col-4 priceCat" style="display: none">
                        <label for="sixDay">6 giorni</label>
                        <input type="number" style="-moz-appearance:textfield;" name="sixDay" class="form-control" id="sixDay" >
                    </div>


                    <div class="form-group col-md-2 col-lg-1 col-4 priceCat" style="display: none">
                        <label for="sevenDay">7 giorni</label>
                        <input type="number" style="-moz-appearance:textfield;" name="sevenDay" class="form-control" id="sevenDay" >
                    </div>


                    <div class="form-group col-md-2 col-lg-1 col-4 priceCat" style="display: none">
                        <label class="d-none d-sm-block" for="overprice">overprice</label>
                        <label class="d-block d-sm-none" for="overprice">Giorno aggiuntivo</label>
                        <input type="number" style="-moz-appearance:textfield;" name="overprice" class="form-control" id="overprice" >
                    </div>

                    <div class="form-group col-md-4 col-lg-6 col-12 priceCat" style="display: none">
                        <p><small>Seleziona immagine cover</small></p>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="coverImage" name="cover_image" accept="image/*">
                            <label class="custom-file-label" for="coverImage">Seleziona immagine</label>

                          </div>
                    </div>





                {{-- </div> --}}

                {{-- endprice --}}
            </div>

        </form>


    </div>

    <div id="table-cat" class="form-row" style="display: none">
        <table class="table rounded shadow table-sm border">
            <thead class="thead-dark">
                <tr>
                    <th>nome</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td scope="row">{{$category->tipo}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editCat{{$category->id}}">
                        <i class="fas fa-edit"></i>
                        </button>

                        <!-- Modal -->
                        <form action="{{route('editCategory', $category->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal fade" id="editCat{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modifica categoria</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="tipo{{$category->id}}" class="col-sm-2 col-form-label">Nome Categoria</label>
                                                    <div class="col-sm-10">
                                                    <input type="text" required name="tipo" class="form-control" id="tipo{{$category->id}}" value="{{$category->tipo}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="base{{$category->id}}" class="col-sm-2 col-form-label">Prezzo Base</label>
                                                    <div class="col-sm-10">
                                                    <input type="number" style="-moz-appearance:textfield;" required name="base" class="form-control" step=".01" id="base{{$category->id}}" value="{{$category->base}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="twoDay{{$category->id}}" class="col-sm-2 col-form-label">Prezzo 2 giorni</label>
                                                    <div class="col-sm-10">
                                                    <input type="number" style="-moz-appearance:textfield;" required name="twoDay" class="form-control" step=".01" id="twoDay{{$category->id}}" value="{{$category->twoDay}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="threeDay{{$category->id}}" class="col-sm-2 col-form-label">Prezzo tre giorni</label>
                                                    <div class="col-sm-10">
                                                    <input type="number" style="-moz-appearance:textfield;" required name="threeDay" class="form-control" step=".01" id="threeDay{{$category->id}}" value="{{$category->threeDay}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="fourDay{{$category->id}}" class="col-sm-2 col-form-label">Prezzo 4 giorni</label>
                                                    <div class="col-sm-10">
                                                    <input type="number" style="-moz-appearance:textfield;" required name="fourDay" class="form-control" step=".01" id="fourDay{{$category->id}}" value="{{$category->fourDay}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="fiveDay{{$category->id}}" class="col-sm-2 col-form-label">Prezzo 5 giorni</label>
                                                    <div class="col-sm-10">
                                                    <input type="number" style="-moz-appearance:textfield;" required name="fiveDay" class="form-control" step=".01" id="fiveDay{{$category->id}}" value="{{$category->fiveDay}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="sixDay{{$category->id}}" class="col-sm-2 col-form-label">Prezzo sei giorni</label>
                                                    <div class="col-sm-10">
                                                    <input type="number" style="-moz-appearance:textfield;" required name="sixDay" class="form-control" step=".01" id="sixDay{{$category->id}}" value="{{$category->sixDay}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="sevenDay{{$category->id}}" class="col-sm-2 col-form-label">Prezzo sevenDay</label>
                                                    <div class="col-sm-10">
                                                    <input type="number" style="-moz-appearance:textfield;" required name="sevenDay" class="form-control" step=".01" id="sevenDay{{$category->id}}" value="{{$category->sevenDay}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="overprice{{$category->id}}" class="col-sm-2 col-form-label">Prezzo giorno aggiuntivo</label>
                                                    <div class="col-sm-10">
                                                    <input type="number" style="-moz-appearance:textfield;" required name="overprice" class="form-control" step=".01" id="overprice{{$category->id}}" value="{{$category->overprice}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row ">
                                                    <p><small>Seleziona immagine cover</small></p>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="cover_image" name="cover_image" accept="image/*">
                                                        <label class="custom-file-label" for="cover_image">Seleziona immagine</label>
                                                      </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </td>
                </tr>
                @endforeach

        </table>

    </div>
    <h4 class="text-center">Cerca BICI</h4>
    <div class="form-row mx-auto">

        <div class="form-group mx-auto">

            <input type="text" class="form-control" id="search" placeholder="Type to search..." />
        </div>
    </div>
</div>

<div id="table" class="container d-flex flex-wrap justify-content-center">


    @foreach ($bikes as $bike)

    <div class="card m-2" style="width: 18rem; @if ($bike->manutenzione == 1) background-color: red; @elseif (isset($bike->temp) && $bike->temp == 1) background-color: yellow; @endif
        @if ($bike->bloccata == 1) background-color: green; @elseif (isset($bike->temp) && $bike->temp == 1) background-color: yellow; @endif">
        <div class="card-body">
            <h5 class="card-title">{{$bike->name}}</h5>
            @if (isset($bike->temp) && $bike->temp == 1)

                <p class="card-text"> <strong> Contratti Attivi </strong></p>
                @foreach ($bike->contract as$contract )

                @if ($contract->data_inizio <= $dataOggi && $contract->data_fine >= $dataOggi )
                    <a href="{{route('contractShow', $contract->id)}}">Contratto {{$contract->cognome}}</a>
                    {{-- <p class="card-text">id = {{$contract->id}}</p> --}}

                @endif

            @endforeach

            @else
                <p class="card-text">Nessun Prenotazione attiva al momento</p>
            @endif
            <form action="{{route('bikeManutenzione', $bike->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="custom-control custom-switch">
                    <input name="manutenzione" type="checkbox" class="custom-control-input" id="manutenzione{{$bike->id}}" @if($bike->manutenzione == 1 ) checked @endif @if(isset($bike->temp) && $bike->temp == 1) disabled @endif onchange="this.form.submit()">
                    <label class="custom-control-label" for="manutenzione{{$bike->id}}">Attiva manutenzione</label>
                    <input class="submit" type="submit" hidden>
                </div>
                <div class="custom-control custom-switch">
                    <input name="bloccoesc" type="checkbox" class="custom-control-input" id="bloccoesc{{$bike->id}}" @if($bike->bloccata == 1 ) checked @endif @if(isset($bike->temp) && $bike->temp == 1) disabled @endif onchange="this.form.submit()">
                    <label class="custom-control-label" for="bloccoesc{{$bike->id}}">Attiva Blocco escursionista</label>
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
      $("#search").keyup(function(){
        var searchText = $(this).val().toLowerCase();
        // Show only matching TR, hide rest of them
        $.each($("#table .card"), function() {
            if($(this).find('.card-title').text().toLowerCase().indexOf(searchText) === -1)
               $(this).hide();
            else
               $(this).show();
        });
    });
    $(".show").on('click', function(){
        console.log('ciao');
        $("#table-cat").slideToggle('slow');
    })
    $("#showCat").on('click', function(){
        $('.priceCat').toggle('fast');
        var required =  $('.priceCat').children('.form-control');
        console.log(required);
        if (required.attr('required')) {
        required.prop('required', false);
        } else {
            required.prop('required', true);
        }
    })
</script>

@endsection
