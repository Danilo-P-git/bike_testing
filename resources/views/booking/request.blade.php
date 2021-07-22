@extends('layouts.navbar')
@section('content')

<div id="jumbotron" class="container-fluid">
    <div class="row parallax mb-5">
        <div class="col-auto m-auto jumbo-title">
            <h2 class="py-2">{{__('payment.page.title')}}</h2>
            <h4>{{__('payment.page.subtitle')}}</h4>
        </div>
    </div>
    


        <div class="container">
            <div class="row no-gutters">

                    {{-- seleziona --}}
                <div class="col-sm-8 col-12 bg-light shadow pt-2 pl-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-12">
                                <h3>
                                    {{__('payment.page.date')}}
                                </h3>
                                <div class="pt-2">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="range-date" name="range-date" placeholder="inserisci un dato">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 ">
                                <div class="row d-flex  flex-wrap">
                                    @foreach ($category as $cat)

                                    <div class="col pb-5 ">

                                        <div class="card cat m-auto position-relative " id="cat{{$cat->id}}" >
                                            <p class="check position-absolute" style="display: none"><i class="fa fa-check" aria-hidden="true"></i></p>

                                            <input class="cat-id" type="number" value="{{$cat->id}}" hidden>
                                            <input class="id-cat" type="checkbox" name="category[]" id="category" value="{{$cat->id}}" hidden>
                                            <img class="card-img-top p-3" src="{{asset('storage/'.$cat->cover_image)}}" alt="">
                                            <div class="card-body">
                                                <h3 class="card-title">{{$cat->tipo}}</h3>

                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                                
                            </div>
                        </div>

                </div>

                {{-- dati e richiedi disponibilità --}}
                    <div class="col-sm-4 col-12 bg-primary shadow pt-2">
                        
                    </div>
            </div>

        </div>



<script>

    $('#range-date').daterangepicker({
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
    console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });

    $('#range-date').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    });


    $('#range-date').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $(document).ready(function() {
        $('.cat').on('click', function(){
            var id =  $(this).children('.cat-id').val();
            var valueCheckbox = $(this).children('.id-cat');

            if (valueCheckbox.is(':checked')) {
                valueCheckbox.prop('checked',false)
                $(this).children('.check').hide();
            } else {
                valueCheckbox.prop('checked',true)
                $(this).children('.check').show();

            }

        })
    });
</script>
@endsection