<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="{{ asset('fontawesome-free/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <!-- CSS CUSTOM -->
    <link href="{{asset('bootsnav-master/css/animate.css')}}" rel="stylesheet">
    <!-- END -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>PUBG Store</title>
</head>

<body>
    <!-- Navbar -->

    <div class="container">
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-info">
            <a class="navbar-brand btn btn-info" href="{{ route('home') }}">PUBG Store</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav justify-content-end mr-auto">
                    <li class="nav-item active">
                        <a class="btn btn-info btn-block active" href="{{ route('home') }}">Home<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-info btn-block" href="{{ route('products.show') }}">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-info btn-block" href="{{ route('admin.orders.index') }}">Order</a>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="btn btn-info btn-block" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="btn btn-info btn-block" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="btn btn-info btn-block dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item btn btn-info btn-block" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
                <!-- Default dropleft button -->
                <div class="btn-group dropleft">
                    <button type="button" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        Cart
                    </button>
                    <ul class="dropdown-menu">
                        <?php $total = 0 ?>
                        @if(session('cart'))
                        @foreach(session('cart') as $id => $product )

                        <?php $total += $product['price'] * $product['quantity'] ?>
                        <li>
                            <a href="#" class="photo"><img src="{{ asset('/images/'.$product['image_src']) }}" width="50" alt="" /></a>
                            <h6><a href="#">{{ $product['name'] }}</a></h6>
                            <p>{{ $product['quantity'] }}x - <span class="price">Rp.{{ $product['price'] }}</span></p>
                        </li>
                        <li class="total">
                            <span class="pull-right"><strong>Total</strong>: {{ $product['price'] * $product['quantity'] }}</span>
                            <a href="{{ route('carts.index') }}" class="btn btn-default btn-cart">Cart</a>
                        </li>
                        @endforeach
                        @else
                        <h5 class="text-center">Buy Something</h5>
                        @endif
                    </ul>
                </div>
                <form class="form-inline">
                    <span class="badge-pill badge-warning text-light">{{ count(session('cart', [])) }}</span>
                </form>
            </div>
        </nav>
    </div>
    <!-- End Navbar -->

    <!-- Carousel -->
    <!-- <div class="container mt-2">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://assets.jalantikus.com/assets/cache/0/0/userfiles/2018/09/28/wallpaper-anime-keren-pc-large-1-21895.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="http://www.sclance.com/wallpapers/tablet-wallpaper-free/tablet-wallpaper-free_2444684.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://atgbcentral.com/data/out/182/5591795-anime-hd-wallpaper.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div> -->
    <!-- End Carousel -->


    @yield('content')



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @yield('extra-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
</body>

</html>