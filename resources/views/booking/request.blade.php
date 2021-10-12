@extends('layouts.navbar')
@section('content')

<div id="jumbotron" class="container-fluid">
    <div class="row parallax mb-5">
        <div class="col-auto m-auto jumbo-title">
            <h2 class="py-2">{{__('payment.page.title')}}</h2>
            <h4>{{__('payment.page.subtitle')}}</h4>
        </div>
    </div>
    @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-danger') }} text-center">{{ Session::get('message') }}</p>
    @endif
    <form action="{{route('bookingAvaliable')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="container-fluid" style="max-width: 90%">
            <div class="row no-gutters">
            
               
                    
                    {{-- seleziona --}}
                    <div class="col-sm-9 col-12 bg-light shadow pt-2 pl-3">
                            <div class="row justify-content-center">
                                <div class="col-sm-12 col-md-6 col-12">
                                    <h3 class="text-center">
                                        {{__('payment.page.date')}}
                                    </h3>
                                    <div class="pt-2">
                                        <div class="input-group mb-2 justify-content-center">
                                            <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                            </div>
                                            <input type="text" class="form-control text-center" id="range_date" name="range_date" placeholder="inserisci un dato" style="max-width: 35%">
                                            {{-- <button class="btn btn-primary" name="range_date" type="submit">Controlla disponibilita</button> --}}
                                        </div>
                                        <p class="text-center"><strong>* modifica le date per verificare la disponibilità delle bici in quei giorni</strong></p>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center"><span style="font-size: 1.5rem; color:#ce2e30">1° selezionare le categorie desiderate<br>2° inserisci la quantita per categoria <br>3° compila il modulo per inoltrare la richiesta</span></p>
                            <div class="row" style="margin-top: 10%">
                                <div class="col col-md-12">
                                    <div class="row d-flex no-gutters  flex-wrap">
                                        @foreach ($category as $cat)
                                        <div class="col pb-5 m-1">
                                            <input type="text" id="idcat" value="idcat_{{$cat->id}}" hidden>
                                            <?php 
                                            
                                            
                                            $categoryId=DB::table('categories')->select('id')->orderBy('id', 'asc')->get();
                                                foreach ($categoryId as $key) {
    
                                                    //assegno alla chiave l'id della categoria in modo da poter richiamare il dato nella vista, in questo modo avrò un array chiave=>valore dove la chiave è l'id della categoria e il valore è il conteggio delle bici trovate in quella categoria 
                                                    $quantity[$key->id]=DB::table('bikes')->where('category_id','=',$key->id)->count('*');
                                                }
                                            ?>
                                        
                                            
                                            <div class="card cat m-auto position-relative" name="bgcolor" id="refresh{{$cat->id}}">
                                                
                                            
                                                
                                                {{-- @foreach ($quantity as $item=>$val)
                                                @if ($item==$cat->id)  --}}
                                                <p class="m-3 " id="cat{{$cat->id}}" style="font-weight: bold;color:#ce2e30;text-shadow: 2px 5px 3px rgba(150, 150, 150, 0.92);"></p> 
                                                {{-- @endif
                                                @endforeach --}}
                                                <p class="check position-absolute" style="display: none"><i class="fa fa-check" aria-hidden="true"></i></p>

                                                <input class="cat-id" type="number" value="{{$cat->id}}" hidden>
                                                <input class="id-cat" type="checkbox" name="category[]" id="category" value="{{$cat->id}}" hidden>
                                                <img class="card-img-top p-3" src="{{asset('storage/'.$cat->cover_image)}}" alt="" style="border-radius: 50px;">
                                                <div class="card-body my-n3">
                                                    <h3 class="card-title text-center" style="text-shadow: 2px 5px 3px rgba(150, 150, 150, 0.92);">{{$cat->tipo}}</h3>


                                                            
                                                        {{-- <h3 class="card-title">Disponibilità: {{$val}}</h3> --}}
                                                            
                                                                <button class="btn btn-primary pl-5 pr-5 ml-5 drop"  type="button">{{__('payment.page.price')}}</button>

                                                                <button class="btn btn-primary pl-5 pr-5 drop2"  type="button">Dettagli</button>

                                                    
                                                    

                                                    <div class="show-drop" style="display: none">
                                                        <h3 class="text-center my-1">{{__('payment.page.price')}}</h3>
                                                        
                                                        <p class="text-center">    {{__('payment.page.1day')}} {{$cat->base}} </p> <hr>
                                                        <p class="text-center">     {{__('payment.page.2day')}} {{$cat->twoDay}}</p> <hr>
                                                        <p class="text-center">     {{__('payment.page.3day')}} {{$cat->threeDay}}</p> <hr>
                                                        <p class="text-center">    {{__('payment.page.4day')}} {{$cat->fourDay}}</p> <hr>
                                                        <p class="text-center">   {{__('payment.page.5day')}} {{$cat->fiveDay}}</p> <hr>
                                                        <p class="text-center">     {{__('payment.page.6day')}} {{$cat->sixDay}}</p> <hr>
                                                        <p class="text-center">   {{__('payment.page.7day')}} {{$cat->sevenDay}}</p>
                                                        <p class="text-center">   {{$cat->overprice}} {{__('payment.page.overprice')}}</p>
                                                        {{-- <p>{{$cat->overprice}}</p> --}}
                                                        <br>
                                                        <p class="text-center" style="font-size: 1.5rem;">Chiudi</p>

                                                    </div>

                                                    <div class="show-drop2" style="display: none">
                                                        {{$cat->caratteristiche}}
                                                        <br>
                                                        <p class="text-center" style="font-size: 1.5rem;">Chiudi</p>
                                                    </div>
                                                    

                                                    
                                                </div>

                                            </div>
                                            
                                            <div class="number-drop text-center mt-4" style="display: none">
                                                <label for="quantity{{$cat->id}}">Inserire il numero di Bici richiesto per {{$cat->tipo}}</label>
                                                <input name="{{$cat->id}}" type="number" id="quantity{{$cat->id}}" class="form-control text-center" value="0">
                                            </div>
                                        </div>
                                        @endforeach

                                    </div>
                                    
                                </div>
                            </div>

                    </div>

                    {{-- dati e richiedi disponibilità --}}

                    <div class="col-sm-3 col-12 bg-primary shadow pt-2 text-white ">
                        <h2 class="text-center text-uppercase py-3">{{__('payment.page.dispTitle')}}</h2>
                        <hr class="border border-white ">
                        <div class="mx-lg-5 mx-2 py-2">
                            <label for="name">Nome</label>
                            <input name="name" type="text" id="name" class="form-control" value="" >
                        </div>
                        <div class="mx-lg-5 mx-2 py-2">
                            <label for="cognome">Cognome</label>
                            <input name="cognome" type="text" id="cognome" class="form-control" value="" >
                        </div>
                        <div class="mx-lg-5 mx-2 py-2">
                            <label for="mail">mail</label>
                            <input name="mail" type="mail" id="mail" class="form-control" value="" >
                        </div>
                        <div class="mx-lg-5 mx-2 py-2">
                            <label for="tel">Telefono</label>
                            <input name="tel" type="text" id="tel" class="form-control" value="+39" >
                        </div>
                        <div class="mx-lg-5 mx-2 py-5">

                        <button class="btn btn-secondary w-100 py-5">Richiedi disponibilità</button>
                        </div>
                        <div class="mx-lg-5 mx-2 py-5">
                            <p>Si avverte la clientela che ogni giorno di prenotazione oltre il settimo avrà una tariffa extra dipendente dalle bike prenotate</p>
                        </div>
                        
                    </div>
            </div>
        </form>

        </div>



<script>

    $('.drop').on('click', function () {
        $(this).siblings('.show-drop').slideToggle(300);

    });
    $('.show-drop').on('click', function (){
        $(this).slideToggle(300);
    });

    $('.drop2').on('click', function () {
        $(this).siblings('.show-drop2').slideToggle(300);

    });
    $('.show-drop2').on('click', function (){
        $(this).slideToggle(300);
    });

    $('#range_date').daterangepicker({
        "locale": {
            "format": 'DD/MM/YYYY'
            },
        "alwaysShowCalendars": true,
        "startDate": moment(),
        "endDate": moment(),
        "minDate": moment(),
        "drops": "auto",
            isCustomDate: function(date) {
        if (date) return 'test';
        }
        }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('MM/DD/YYYY') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });

    $('#range_date').on('apply.daterangepicker', function(ev, picker) {
        
      $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    });


    $('#range_date').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('#range_date').on('change', function(){
        
        
        var data = $(this).val();
        var split = data.split(' - ');
        var startDate = split[0];

        var dayStart = startDate.substr(0,2);
        var monthStart = startDate.substr(3,2);
        var yearStart = startDate.substr(6,4);

        var startCorrect = monthStart+"/"+dayStart+"/"+yearStart;
        console.log(startCorrect);



        var endDate = split[1];
        var dayEnd = endDate.substr(0,2);
        var monthEnd = endDate.substr(3,2);
        var yearEnd = endDate.substr(6,4);

        var endCorrect = monthEnd+"/"+dayEnd+"/"+yearEnd;
        console.log(endCorrect);


        var  date1 = new Date(startCorrect);
        var  date2 = new Date(endCorrect);
        var  diffTime = Math.abs(date2 - date1);
        var  diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 

        $.ajax({
            
            "url": "http://localhost:8000/api/price",
            "data": {
                "numberDay": diffDays
            },
            "method": "GET",
            success: function (response) {
                console.log(response);

            }
        });
        $.ajax({
            
            "url": "bookingCheck",
            "data": {
                "start": startCorrect,
                "end":endCorrect,
                "numberDay": diffDays
                
            },
            "method": "GET",
            success: function (response) {
                
                //costruisco oggetto javascript da response json
                let res = JSON.stringify(response);
                let respons = JSON.parse(res);
                console.log(response);
                
                //ciclo la risposta per ottenere id e quantita corrispondenti e le assegno all'id della vista    
               $.each(respons['qty'],function(id,quantity){
                   $('#cat'+id).text('Disponibilita: '+quantity); 
                });
                $('#refresh'+id).reload();
            }
        });
    });

    $(document).ready(function() {
        $('.cat').on('click', function(){
            var id =  $(this).children('.cat-id').val();
            var valueCheckbox = $(this).children('.id-cat');

            if (valueCheckbox.is(':checked')) {
                valueCheckbox.prop('checked',false)
                $(this).children('.check').hide();
                $(this).removeClass('bgcard');
            } else {
                valueCheckbox.prop('checked',true)
                $(this).children('.check').show();
                $(this).addClass('bgcard');

               
            }

            $(this).siblings('.number-drop').toggle(400);
        })
    });
    
</script>
@endsection