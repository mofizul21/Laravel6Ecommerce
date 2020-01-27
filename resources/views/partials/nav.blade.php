<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{URL::to('/')}}">TPN Mobile</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{Route::is('index') ? 'active':''}}"><a class="nav-link" href="{{route('index')}}">Home</a></li>
                <li class="nav-item {{Route::is('contact') ? 'active':''}}"><a class="nav-link" href="{{route('contact')}}">Contact</a></li>
                <li class="nav-item {{Route::is('products') ? 'active':''}}"><a class="nav-link" href="{{route('products')}}">Products</a></li>

                <li class="nav-item mr-2">__</li>

                <form class="form-inline my-2 my-lg-0" action="{{route('search')}}" method="GET">
                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i
                            class="fas fa-search"></i></button>
                </form>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('carts') }}">
                        <button class="btn btn-danger">
                            Cart
                            <span class="badge badge-warning" id="totalItems">{{App\Cart::totalItems()}}</span>
                        </button>
                    </a>
                </li>
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> 
                        <img src="{{App\Helpers\ImageHelper::getUserImage(Auth::user()->id)}}" alt="Avatar" class="img rounded-circle" height="40">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a href="{{ route('user.dashboard') }}" class="dropdown-item">Dashboard</a>
                        
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>                        

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div> <!-- end .container -->
</nav> <!-- end nav -->