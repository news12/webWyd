<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      
    </head>
    <body class="antialiased">
        <!-- Start Banner -->
        <div class="section inner_page_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="banner_title">
                            <h3>ScreenShot</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Banner -->
        <!-- section -->
        <div class="section layout_padding">
            <div class="container">
        
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="full news_blog">
                           <img class="img-responsive" src="{{asset('template/images/screen/2.bmp')}}" alt="#" />
                           <div class="overlay"><a class="main_bt transparent" href="#">View</a></div>
                           <div class="blog_details">
                             <h3>Tela Inicial</h3>
                             <p>Nova interface de tela inicial do servidor star Destiny.</p>
                           </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="full news_blog">
                            <img class="img-responsive" src="{{asset('template/images/screen/1.bmp')}}" alt="#" />
                            <div class="overlay"><a class="main_bt transparent" href="#">View</a></div>
                           <div class="blog_details">
                             <h3>Login</h3>
                             <p>Nova Interface de login do servidor star Destiny.</p>
                           </div>
                        </div>
                    </div>
                    
                 </div>
            </div>
        </div>
        <!-- end section -->
     
    </body>
</html>
