<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      
    </head>
    <body class="antialiased">
        <!-- Start header -->
        <header class="top-header">
        <div class="header_top">
                    
            <div class="container">
                <div class="row">
                    <div class="logo_section">
                        <a class="navbar-brand" href="{{ url('/') }}"><img src="{{asset('template/images/united_logo.png')}}" alt="image"></a>
                    </div>
                    <div class="site_information">
                        <ul>
                            @if (Route::has('login'))
                                    
                                @auth
                                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                                 @else
                                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>
                    
                                         @if (Route::has('register'))
                                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                                        @endif
                                @endif
                                   
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
                
        </div>
        <div class="header_bottom">
            <div class="container">
                <div class="col-sm-12">
                    <div class="menu_orange_section">
                        <nav class="navbar header-nav navbar-expand-lg"> 
                            <div class="menu_section">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-wd" aria-controls="navbar-wd" aria-expanded="false" aria-label="Toggle navigation">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                                <div class="collapse navbar-collapse justify-content-end" id="navbar-wd">
                                    <ul class="navbar-nav">
                                        <li><a class="nav-link btn-top active" href="{{ url('/') }}">Home</a></li>
                                        <li><a class="nav-link btn-top" href="{{ url('/classe') }}">Classe</a></li>
                                        <li><a class="nav-link btn-top" href="{{ url('/evolucao') }}">Evolução</a></li>
                                        <li><a class="nav-link btn-top" href="{{ url('/screen') }}">ScreenShot</a></li>
                                        <li><a class="nav-link btn-top" href="{{ url('/contact') }}">Fale Conosco</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
                
        </header>
        <!-- End header -->
    </body>
</html>
