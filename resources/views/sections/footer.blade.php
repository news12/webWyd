<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   
        <!-- Start Footer -->
        <footer class="footer-box">
            <div class="container">
                <div class="row">
                <div class="col-md-12 white_fonts">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="full">
                                    <img class="img-responsive" src="{{asset('template/images/logo.png')}}" alt="#" />
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="full">
                                    <h3>Quick Links</h3>
                                </div>
                                <div class="full">
                                    <ul class="menu_footer">
                                        <li><a href="{{ url('/') }}">> Home</a></li>
                                        <li><a href="{{ url('/classe') }}">> Classe</a></li>
                                        <li><a href="{{ url('/evolucao') }}">> Evolução</a></li>
                                        <li><a href="{{ url('/screen') }}">> ScreenShot</a></li>
                                        <li><a href="{{ url('/contact') }}">> Contato</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="full">
                                    <div class="footer_blog full white_fonts">
                                <h3>Newsletter</h3>
                                <p>Indisponível no momento</p>
                                <div class="newsletter_form">
                                    <form action="{{ url('/') }}">
                                    <input type="email" placeholder="Seu Email" name="#" required="">
                                    <button>Submit</button>
                                    </form>
                                </div>
                            </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="full">
                                    <div class="footer_blog full white_fonts">
                                <h3>Contatos</h3>
                                <ul class="full">
                                <li><img src="{{asset('template/images/i5.png')}}"><span>Brasil<br>Espirito Santo</span></li>
                                <li><img src="{{asset('template/images/i6.png')}}"><span>stardestitny@gmail.com</span></li>
                                <li><img src="{{asset('template/images/i7.png')}}"><span>+55(27)998816739</span></li>
                                </ul>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->
        <div class="footer_bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p class="crp">© Copyrights 2021 newssuporte@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
     
   
</html>
