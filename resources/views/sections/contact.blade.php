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
                            <h3>Contato</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Banner -->
        <!-- section -->
        <div class="section contact_form">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-sm-12 offset-lg-3">
                        <div class="full">
                            <form class="contact_form_inner" action="#">
                                <fieldset>
                                    <div class="field">
                                        <input type="text" name="name" placeholder="Seu nome" />
                                    </div>
                                    <div class="field">
                                        <input type="email" name="email" placeholder="Email" />
                                    </div>
                                    <div class="field">
                                        <input type="text" name="phone_no" placeholder="Seu telefone" />
                                    </div>
                                    <div class="field">
                                        <textarea placeholder="Menssagem"></textarea>
                                    </div>
                                    <div class="field center">
                                        <button>ENVIAR</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end section -->
     
    </body>
</html>
