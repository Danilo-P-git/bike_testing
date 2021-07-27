@extends('layouts.navbar')
@section('content')

<div class="container py-5">
    <div class="row no-gutters">
        <div class="col-8 bg-light shadow">
            <p>{{ $contract->nome}}</p>
            <p>{{ $contract->cognome}}</p>
            <p>{{ $contract->mail}}</p>
            <p>{{ $contract->telefono}}</p>
            <p>{{ $contract->data_inizio}}</p>
            <p>{{ $contract->data_fine}}</p>

            @php
                $conto = count($contract->bike);
            @endphp
            <p>Hai selezionato {{$conto}}  Bike </p>

            @foreach ($contract->bike as $bike )
                <p>
                    {{$bike->nome}} tipologia {{$bike->category->tipo}}
                </p>
            @endforeach

            <p>
                per un totale di {{$contract->costo}} €.
            </p>
        </div>
        <div class="col-4 bg-primary shadow pt-2 text-white ">

            @php
                $ALIAS = 'ALIAS_WEB_00025514'; // Sostituire con il valore fornito da Nexi
                $CHIAVESEGRETA = 'DC0TYLAMY69IOFXKCR7LPFBY4L6DYKCU'; // Sostituire con il valore fornito da Nexi

                $requestUrl = "https://int-ecommerce.nexi.it/ecomm/ecomm/DispatcherServlet";
                $postUrl = "http://localhost:8000/booking/details";
                $merchantServerUrl = "http://localhost:8000/booking/confirm";

                $codTrans = $contract->id;
                $divisa = "EUR";
                // dd($importo);
                $importo = $contract->costo.'00';

                // Calcolo MAC
                $mac = sha1('codTrans=' . $codTrans . 'divisa=' . $divisa . 'importo=' . $importo . $CHIAVESEGRETA);

                // Parametri obbligatori
                $obbligatori = array(
                    'alias' => $ALIAS,
                    'importo' => $importo,
                    'divisa' => $divisa,
                    'codTrans' => $codTrans,
                    'url' => $merchantServerUrl,
                    'url_back' => $merchantServerUrl,
                    'mac' => $mac,   
                );

                // Parametri facoltativi
                $facoltativi = array(
                    'urlPost' => $postUrl,
                );

                $requestParams = array_merge($obbligatori, $facoltativi);

                
            
            @endphp
            <form action="{{$requestUrl}}">
                @foreach ($requestParams as $name => $value) 
                    <input type='hidden' name='{{$name}}' value='{{$value}}' />
                @endforeach
                <button class="btn btn-secondary">Conferma pagamento</button>

            </form>

        </div>
    </div>

</div>



@endsection