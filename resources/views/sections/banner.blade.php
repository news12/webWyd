<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      
    </head>
    <body class="antialiased">
        <!-- Start Banner -->
        <div class="ulockd-home-slider">
            <div class="container-fluid">
                <div class="row">
                    <div class="pogoSlider" id="js-main-slider">
                        <div class="pogoSlider-slide" style="background-image:url({{asset('template/images/slide1.png')}});">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="slide_text white_fonts">
                                            <h3>Beta Teste<br><strong>Breve...</strong></h3>
                                            <br>
                                            <a class="start_exchange_bt" href="index.php">Ver...</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pogoSlider-slide" style="background-image:url({{asset('template/images/slide2.png')}});">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="slide_text white_fonts">
                                            <h3>Venda seu item<br><strong>Leilão</strong></h3>
                                            <br>
                                            <a class="start_exchange_bt" href="exchange.html">Ver...</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- .pogoSlider -->
                </div>
            </div>
        </div>
        <!-- End Banner -->
    </body>
</html>
