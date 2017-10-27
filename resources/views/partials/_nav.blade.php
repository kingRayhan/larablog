<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li {{ (Request::is('/') ? 'class=active' : '') }}><a href="{{ url('/') }}">Home</a></li>
                <li {{ (Request::is('blog') ? 'class=active' : '') }}><a href="{{ url('/blog') }}">Blog</a></li>
                <li {{ (Request::is('about') ? 'class=active' : '') }}><a href="{{ url('/about') }}">About</a></li>
                <li {{ (Request::is('contact') ? 'class=active' : '') }}><a href="{{ url('contact') }}">Contact</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('posts.index') }}">All Posts</a></li>
                            <li><a href="{{ route('category.index') }}">Categories</a></li>
                            <li><a href="{{ route('posts.create') }}">Add new post</a></li>
                            <li>
                                <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>


@if(Auth::check())
    <div class="container" style="margin-bottom: 35px;">
        <div class="row">
            <div class="col-md-12">

                <div class="btn-group">
                  <a href="{{ route('posts.index') }}" class="btn btn-default">Posts</a>
                  <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('posts.index') }}">All Posts</a></li>
                    <li><a href="{{ route('posts.create') }}">Add new post</a></li>
                  </ul>
                </div>
                

                <a class="btn btn-default" href="{{ route('category.index') }}">categories</a>
                <a class="btn btn-default" href="{{ route('settings.index') }}">settings</a>

            </div>
        </div>
    </div>
    
@endif