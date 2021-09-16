<!doctype html>
{{-- @dd(session()) --}}
@if (session()->has('lang'))
    @php
        $lang = session()->get('lang')
    @endphp
@else 
    @php
        $lang = "it"
    @endphp
@endif
<html lang="{{$lang}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

</head>
<body>
    <div id="userBooking">
        <nav class="navbar navbar-expand-lg navbar-light bg-light container py-4">
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
              <a class="navbar-brand" href="#">
                  <img src="https://www.etnabiketribe.it/wp-content/uploads/2019/03/cropped-EtnaBikeTribe.png" alt="" width="150" height="55 ">
              </a>
              <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item px-2 py-2 font-weight-light" style="font-size: 16px">
                  <a class="nav-link" href="https://www.etnabiketribe.it/escursioni-full-day/">{{__('payment.nav.escursioni')}} </a>
                </li>
                <li class="nav-item px-2 py-2 font-weight-light" style="font-size: 16px">
                    <a class="nav-link" href="https://www.etnabiketribe.it/downhill/"> {{__('payment.nav.gravity')}}</a>
                </li>
                <li class="nav-item px-2 py-2 font-weight-light" style="font-size: 16px">
                    <a class="nav-link" href="https://www.etnabiketribe.it/sicilia-cicloturismo/">{{__('payment.nav.ciclo')}} </a>
                </li>
                <li class="nav-item px-2 py-2 font-weight-light" style="font-size: 16px">
                    <a class="nav-link" href="https://www.etnabiketribe.it/centro-nazionale-etna/">{{__('payment.nav.mtb')}} </a>
                </li>

                <li class="nav-item px-2 py-2 font-weight-light" style="font-size: 16px">
                  <a class="nav-link" href="https://www.etnabiketribe.it" >{{__('payment.nav.noleggio')}}</a>
                </li>
                <li class="nav-item px-2 py-2 font-weight-light" style="font-size: 16px">
                    <a class="nav-link" href="https://www.etnabiketribe.it/contatti/" >{{__('payment.nav.contatti')}}</a>
                </li>
                <li class="nav-item px-2 py-2 ">
                    <a class="nav-link" href="{{ route('langChange', 'en') }}" >
                        <img src="{{asset('storage/icons/england.png')}}" alt="Bandiera inghilterra" width="20px" height="15px">
                    </a>
                </li>
                <li class="nav-item px-2 py-2 ">
                    <a class="nav-link" href="{{ route('langChange', 'it') }}" >
                        <img src="{{asset('storage/icons/italy.png')}}" alt="Bandiera inghilterra" width="20px" height="15px">
                    </a>
                </li>
              </ul>
             
            </div>
          </nav>
          <main class="pb-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
