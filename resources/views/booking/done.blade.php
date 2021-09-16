@extends('layouts.navbar')
@section('content')

<?php 

$esito=$_REQUEST['esito'];
        $codiceTrans=$_REQUEST['codTrans'];
        $codAut=$_REQUEST['codAut'];
        $message=$_REQUEST['messaggio'];
        // Nel caso in cui non ci siano errori gestisco il parametro esito
        if ($esito == 'OK') {
            $esito= 'La transazione è avvenuta con successo, codice autorizzazione: '. $codAut;
        } else {
            $esito= 'La transazione ' . $codiceTrans . " è stata rifiutata, descrizione errore: " . $message;
        }

?>
<div class="container">
    <div class="row text-center">
        <div class="col-12 col-md-12">
            <h1><span>{{$esito}}</span></h1>
        </div>
    </div>
</div><br><br>

<div class="container">
    <div class="row">
        <div class="col-12 bg-light shadow">
            <h2 class="d-flex justify-content-center pt-5">Riepilogo contratto</h2><br><hr style="box-shadow:-2px 6px 7px 0px #000000">
        </div>
        <?php 
                foreach ($dettagliContratto as $c=>$values) {
                    foreach ($values as $key => $val) {
                        $nomeContratto=$val->nome;
                    $cognomeContratto=$val->cognome;
                    $startContratto=$val->data_inizio;
                    $endContratto=$val->data_fine;
                    $costoContratto=$val->costo;
                    $teleContratto=$val->tel;
                    }
                    
                }
        ?>
        <div class="col-12 col-md-6 bg-light shadow">
            <h2 class="d-flex justify-content-center">Dati Anagrafici</h2><br>
            <h3 class="ml-5">Nome: <span style="color: red">{{$val->nome}}</h3></span><br><br><br>
            <h3 class="ml-5">Cognome: <span style="color: red">{{$val->cognome}}</h3></span><br><br><br>
            <h3 class="ml-5">Telefono: <span style="color: red">{{$val->tel}}</h3></span><br><br><br>
            <h3 class="ml-5">Data inizio contratto:<span style="color: red">{{$val->data_inizio}}</h3></span><br><br><br>
            <h3 class="ml-5">Data fine contratto: <span style="color: red">{{$val->data_fine}}</h3></span><br><br><br><br><hr>
            <h3 class="ml-5">Totale Pagato: <span style="color: red;font-size:3rem;">{{$val->costo}} €</h3></span><br><br><br><hr>
        </div>
        <!--PROVA CAROSELLO-->
        
        <div id="carouselExampleCaptions" class="col-12 col-md-6 bg-light shadow carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0"></li>
  </ol>
  <h2 class="d-flex justify-content-center">Dati Bici</h2><br>
  <div class="carousel-inner"><br><br>
    @foreach ($contract as $k=>$v)
    <?php
             foreach ($v as $ke => $values) {
                $bikeName=$values->name;
                $bikeTaglia=$values->taglia;
                 $imageBike=DB::table('categories')->where('id','=', $values->category_id)->select('cover_image')->get();
                 
                 $path=explode("/", $imageBike);
                 $pathImage=($path[1].$path[2]);
                 $pathclean=explode('"',$pathImage);
                 $pathFinal=$pathclean[0];
                 
                 $nameCat=DB::table('categories')->where('id','=', $values->category_id)->select('tipo')->get();
                 $nameCateg=explode(":",$nameCat);
                 $nameClean=explode("}",$nameCateg[1]);
                 $nameClean2=explode('"',$nameClean[0]);
                 $nameFinal=$nameClean2[1];
                }
                ?>
    <div class="mt-5 carousel-item {{$k == 0 ? 'active' : '' }}">
      <img src="{{asset('storage/images/'.$pathFinal)}}" class="d-block w-100" alt="...">
      <div class="carousel-caption"></div><br><br><br><br>
        <h3>Nome: <span style="color: red">{{$bikeName}}</span></h3>
        <h3>Taglia: <span style="color: red">{{$bikeTaglia}}</span></h3>
        <h3>Taglia: <span style="color: red">{{$nameFinal}}</span></h3>
      </div>
    
    @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev"><i class="fas fa-arrow-circle-left" style="color: rgba(255, 0, 0, 0.514);font-size:60px;margin-left:0.65rem;">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
</i></a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next"><i class="fas fa-arrow-circle-right" style="color: rgba(255, 0, 0, 0.514);font-size:60px;margin-left:0.5rem;">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
</i></a>
</div>

        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="{{route('bookingSelect')}}"><button class="btn btn-success">Torna alla selezione</button></a>
            </div>
        </div>
    </div>
</div> 

            






@endsection