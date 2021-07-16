<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Firma Contratto</title>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">


    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jSignature/2.1.3/jSignature.min.js" integrity="sha512-lZ7GJNAmaXw7L4bCR5ZgLFu12zSkuxHZGPJdIoAqP6lG+4eoSvwbmKvkyfauz8QyyzHGUGVHyoq/W+3gFHCLjA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  




    <style> 

    </style>



</head>

<body class="bg-dark">

<div class="container-sm">

   <div class="row">

       <div class="col-md-12  mt-5">

           <div class="card" style="max-width">

               <div class="card-header">

                   <h5>Firma per contratto {{$contract->id}}</h5>
                   <h5>Nominativo {{$contract->nome}} {{$contract->cognome}}</h5>

               </div>

               <div class="card-body">

                    @if ($message = Session::get('success'))

                        <div class="alert alert-success  alert-dismissible">

                            <button type="button" class="close" data-dismiss="alert">×</button>

                            <strong>{{ $message }}</strong>

                        </div>

                    @endif

                    <form method="POST" action="{{ route('contractSignatureUpload', $contract->id) }}">

                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="form-group col-md-4 col-12">
                                <label for="nome">Nome</label>
                                <input name="nome" type="text" id="nome" class="form-control" value="{{old("nome") ? old("nome") : $contract->nome}}" >
                                @error('nome')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
            
            
                            <div class="form-group col-md-4 col-12">
                                <label for="cognome">Cognome</label>
                                <input name="cognome" type="text" id="cognome" class="form-control" value="{{old("cognome") ? old("cognome") : $contract->cognome}}" >
                                @error('cognome')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
            
            
                            <div class="form-group col-md-4 col-12">
                                <label for="tel">Telefono</label>
                                <input name="tel" type="number" id="tel" class="form-control" value="39{{old("tel") ? old("tel") : $contract->tel}}" >
                                @error('tel')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
            
            
                            <div class="form-group col-md-4 col-12">
                                <label for="mail">mail</label>
                                <input name="mail" type="mail" id="mail" class="form-control" value="{{old("mail") ? old("mail") : $contract->mail}}" >
                                @error('mail')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
            
                            <div class="form-group col-md-4 col-12">
                                <label for="nato_a">nato_a</label>
                                <input name="nato_a" type="nato_a" id="nato_a" class="form-control" value="{{old("nato_a") ? old("nato_a") : $contract->nato_a}}" >
                                @error('nato_a')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
            
                            <div class="form-group col-md-4 col-12">
                                <label for="nato_il">nato_il</label>
                                <input name="nato_il" type="date" id="nato_il" class="form-control" value="{{old("nato_il") ? old("nato_il") : $contract->nato_il}}" >
                                @error('nato_il')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
            
                            <div class="form-group col-md-4 col-12">
                                <label for="n_documento">n_documento</label>
                                <input name="n_documento" type="number" id="n_documento" class="form-control" value="{{old("n_documento") ? old("n_documento") : $contract->n_documento}}" >
                                @error('n_documento')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
            
                            <div class="form-group col-md-4 col-12">
                                <label for="data_documento">data_documento</label>
                                <input name="data_documento" type="date" id="data_documento" class="form-control" value="{{old("data_documento") ? old("data_documento") : $contract->data_documento}}" >
                                @error('data_documento')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
            
                            <div class="form-group col-md-4 col-12">
                                <label for="ente_documento">ente_documento</label>
                                <input name="ente_documento" type="text" id="ente_documento" class="form-control" value="{{old("ente_documento") ? old("ente_documento") : $contract->ente_documento}}" >
                                @error('ente_documento')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
            
                            <div class="form-group col-md-4 col-12">
                                <label for="residenza_temp">residenza_temp</label>
                                <input name="residenza_temp" type="text" id="residenza_temp" class="form-control" value="{{old("residenza_temp") ? old("residenza_temp") : $contract->residenza_temp}}" >
                                @error('residenza_temp')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
            
            
                            <div class="form-group col-md-4 col-12">
                                <label for="data_inizio">data_inizio</label>
                                <input name="data_inizio" type="date" id="data_inizio" class="form-control" value="{{old("data_inizio") ? old("data_inizio") : $contract->data_inizio}}" >
                                @error('data_inizio')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
            
            
                            <div class="form-group col-md-4 col-12">
                                <label for="data_fine">data_fine</label>
                                <input name="data_fine" type="date" id="data_fine" class="form-control" value="{{old("data_fine") ? old("data_fine") : $contract->data_fine}}" >
                                @error('data_fine')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
            
            
                            <div class="form-group col-md-4 col-12">
                                <label for="comune_residenza">comune_residenza</label>
                                <input name="comune_residenza" type="text" id="comune_residenza" class="form-control" value="{{old("comune_residenza") ? old("comune_residenza") : $contract->comune_residenza}}" >
                                @error('comune_residenza')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
            
                            <div class="form-group col-md-4 col-12">
                                <label for="via_residenza">via_residenza</label>
                                <input name="via_residenza" type="text" id="via_residenza" class="form-control" value="{{old("via_residenza") ? old("via_residenza") : $contract->via_residenza}}" >
                                @error('via_residenza')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">

                                <label class="" for="">Firma:</label>

                                <br/>

                                <div id="sig" ></div>

                                <br/>

                                <button id="clear" class="btn btn-danger btn-sm">Clear</button>

                                <input type="text" id="signature64" name="signed" hidden/>

                            </div>

                            <br/>
                            
                            <button id="save" class="btn btn-success">Save</button>
                        </div>
                    </form>
                        

               </div>

           </div>

       </div>

   </div>

</div>

<script type="text/javascript">
	$('#sig').jSignature()
    
	$('#save').on('click', function() {
	var data = $('#sig').jSignature("getData", "default");
		console.log(data[0]);
		$('#signature64').val(data);
		
	})

    $('#clear').click(function(e) {

        e.preventDefault();

        	$('#sig').jSignature("reset");


        $("#signature64").val('');

    });

</script>

</body>

</html>
