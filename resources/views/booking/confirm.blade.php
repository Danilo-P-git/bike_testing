@extends('layouts.navbar')
@section('content')

<div class="container py-5">
    <div class="row ms-5 ps-5">
        <div class="col-8 bg-light shadow">
            <h3 class="mt-3">Nome: <span style="color: red">{{ $contract->nome}}</span></h3><hr>
            <h3>Cognome: <span style="color: red">{{ $contract->cognome}}</span></h3><hr>
            <h3>Email: <span style="color: red">{{ $contract->mail}}</span></h3><hr>
            <h3>Numero di Telefono: <span style="color: red">{{ $contract->tel}}</span></h3><hr>
            <h3>Data inizio contratto: <span style="color: red">{{Carbon\Carbon::createFromFormat('Y-m-d', $contract->data_inizio)->format('d-m-Y')}}</span></h3><hr>
            <h3>Data fine contratto: <span style="color: red">{{carbon\Carbon::createFromFormat('Y-m-d', $contract->data_fine)->format('d-m-Y')}}</span></h3><hr>
            @php
                $startDate = $contract->data_inizio;
                $endDate = $contract->data_fine;
                $carbonStart = \carbon\Carbon::parse($startDate);
                $carbonEnd = \carbon\Carbon::parse($endDate);
                $differenza = $carbonEnd->diffInDays($carbonStart)
            @endphp
            <h3>Totale giorni: <span style="color: red">{{ $differenza}}</span></h3><hr>

            @php
                $conto = count($contract->bike);
            @endphp
            <h3>Hai selezionato {{$conto}}  Bike </h3>

            @foreach ($contract->bike as $bike )
                <h3 style="color: red">
                    {{$bike->nome}} tipologia {{$bike->category->tipo}}
                </h3>
            @endforeach

            <h3><hr>
                per un totale di <br>
                <span style="color: red">{{$contract->costo}} €.</span><hr>
            </h3>
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
                <button class="btn btn-secondary text-center w-100" style="height: 200px;width: 200px;">Conferma pagamento</button>

            </form>

        </div>
    </div>

</div>



@endsection