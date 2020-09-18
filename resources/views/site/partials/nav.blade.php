<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">{{ config('settings.site_title') }}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="{{ route('shop') }}" class="nav-link">Shop</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                    @foreach ($categories as $category)
                        @if ($category->id != 1)
                            <a class="dropdown-item" href="{{ route('shop.category', $category->id) }}">{{ $category->name }}</a>
                        @endif
                    @endforeach
                </div>
            </li>
            <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">About</a></li>
            <li class="nav-item"><a href="{{ route('blog') }}" class="nav-link">Blog</a></li>
            <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
            <li class="nav-item cta cta-colored"><a href="cart.html" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>
            <li class="nav-item"><a href="{{ route('wishlist') }}" class="nav-link"><span class="ion-ios-heart"></span><sup>{{ count($wishlist) }}</sup></a></li>
            @if (Route::has('login'))
                @auth
                    <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link">Dashboard</a></li>
                @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                    @if (Route::has('register'))
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                    @endif
                @endauth
            @endif
        </ul>
      </div>
    </div>
</nav>
