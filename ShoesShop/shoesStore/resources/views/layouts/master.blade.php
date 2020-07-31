<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop - @yield('title')</title>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

   

    <link href="https://fonts.googleapis.com/css?family=Heebo|Open+Sans+Condensed:300|Oswald|Roboto|Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../resources/assets/css/style.css">

    

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark p-0" style="background-color:#0066cc;">
        <ul class="navbar-nav ml-auto">

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <img src="{{asset(Auth::user()->avatar)}}" height="25px" width="25px" class="rounded float-left" alt="...">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                       
                       <a  class="dropdown-item" href="{{ url('/profile') }}">Profile</a>
                    </div>
                </li>
            @endguest
            <li class="nav-item">
                <a href="{{url('/user_carts')}}" class="nav-link">
                    <i class="fas fa-cart-plus font-weight-bolder"></i>
                    <span class="badge badge-pill badge-light">
                        @if(session()->get('order')!=null)
                            {{count(session()->get('order'))}}
                        @else
                            0
                        @endif
                    </span>
                </a>
            </li>
        </ul>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="logo-text navbar-brand" href="#">X-Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{$title=='Home'?'active':''}}">
                    <a class="nav-link" href="{{url('/')}}">HOME <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{$title=='Men'?'active':''}}">
                    <a class="nav-link" href="{{url('/men')}}">MEN</a>
                </li>
                <li class="nav-item {{$title=='Women'?'active':''}}">
                    <a class="nav-link" href="{{url('/women')}}">WOMEN</a>
                </li>
                <li class="nav-item {{$title=='Kids'?'active':''}}">
                    <a class="nav-link" href="{{url('/kids')}}">KIDS</a>
                </li>

            </ul>
           @guest

            <form class="form-inline  my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
            </form>

            @else
                @if(Auth::user()->isAdmin==1)
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="{{url('/admin')}}" class="nav-link">ORDERS</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/products')}}" class="nav-link">PRODUCTS</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/users')}}" class="nav-link">USERS</a>
                        </li>
                    </ul>
                @endif
            @endguest

        </div>
    </nav>

    @section('promotion')
        @show
    <div class="container col-10 my-5">
        @section('content')
            @show
    </div>
</body>
</html>
