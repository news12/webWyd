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
                            <h3>Classes</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Banner -->
        <!-- section -->
        <div class="section layout_padding">
            <div class="container-fluid">
                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="full">
                            <div class="heading_main text_align_center">
                            <h2><span class="theme_color"></span>Classes</h2>    
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="full services_blog">
                        <img class="img-responsive" src="{{asset('template/images/classe/1.jpg')}}" alt="#" />
                        <h4>TK</h4>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="full services_blog">
                            <img class="img-responsive" src="{{asset('template/images/classe/2.jpg')}}" alt="#" />
                            <h4>FM</h4>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="full services_blog">
                            <img class="img-responsive" src="{{asset('template/images/classe/3.jpg')}}" alt="#" />
                            <h4>BM</h4>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="full services_blog">
                            <img class="img-responsive" src="{{asset('template/images/classe/4.jpg')}}" alt="#" />
                            <h4>HT</h4>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- end section -->
     
    </body>
</html>
