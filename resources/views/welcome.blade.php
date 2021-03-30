<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <title>Star Destiny</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

       
        <!-- Site Metas -->
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">
    
        <!-- Site Icons -->
        <link rel="shortcut icon" href="#" type="image/x-icon" />
        <link rel="apple-touch-icon" href="#" />
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('template/css/bootstrap.min.css')}}" />
        <!-- Pogo Slider CSS -->
        <link rel="stylesheet" href="{{asset('template/css/pogo-slider.min.css')}}" />
        <!-- Site CSS -->
        <link rel="stylesheet" href="{{asset('template/css/style.css')}}" />
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="{{asset('template/css/responsive.css')}}" />
        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{asset('template/css/custom.css')}}" />

        <!-- Styles -->
        {{-- <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style> --}}

        {{-- <style>
            body {
                font-family: 'Nunito';
            }
        </style> --}}
    </head>
    <body class="antialiased" id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">
         <!-- LOADER -->
        <div id="preloader">
            <div class="loader">
                <img src="{{asset('template/images/loader.gif')}}" alt="#" />
            </div>
        </div> 
        <!-- end loader -->
        <!-- END LOADER -->

        <!-- Start header -->
            @include('sections.top')
        <!-- End header -->

         <!-- Start Banner -->
            @include('sections.banner')
        <!-- End Banner -->
        <div class="conteudo">
        <!-- section news -->
            @include('sections.news')
        <!-- end section news -->
        </div>
        <!-- section classe -->
            @include('sections.classe')
        <!-- end section classe -->

        <!-- section evolucao-->
            @include('sections.evolucao')
        <!-- end section evolucao-->

        <!-- section screeshot-->
            @include('sections.screen')
        <!-- end section screeshot-->
       
        <!-- contact_form -->
            @include('sections.contact')
        <!-- end contact_form -->
       
        <!-- Start Footer -->
        @include('sections.footer')
        <!-- End Footer -->
        
        <a href="#" id="scroll-to-top" class="hvr-radial-out"><i class="fa fa-angle-up"></i></a>
                    <!-- ALL JS FILES -->
                <script src="{{asset('template/js/jquery.min.js')}}"></script>
                <script src="{{asset('template/js/popper.min.js')}}"></script>
                <script src="{{asset('template/js/bootstrap.min.js')}}"></script>
                <!-- ALL PLUGINS -->
                <script src="{{asset('template/js/jquery.magnific-popup.min.js')}}"></script>
                <script src="{{asset('template/js/jquery.pogo-slider.min.js')}}"></script>
                <script src="{{asset('template/js/slider-index.js')}}"></script>
                <script src="{{asset('template/js/smoothscroll.js')}}"></script>
                <script src="{{asset('template/js/form-validator.min.js')}}"></script>
                <script src="{{asset('template/js/contact-form-script.js')}}"></script>
                <script src="{{asset('template/js/isotope.min.js')}}"></script>
                <script src="{{asset('template/js/images-loded.min.js')}}"></script>
                <script src="{{asset('template/js/custom.js')}}"></script>
                <script>
                /* counter js */

            (function ($) {
                $.fn.countTo = function (options) {
                    options = options || {};
                    
                    return $(this).each(function () {
                        // set options for current element
                        var settings = $.extend({}, $.fn.countTo.defaults, {
                            from:            $(this).data('from'),
                            to:              $(this).data('to'),
                            speed:           $(this).data('speed'),
                            refreshInterval: $(this).data('refresh-interval'),
                            decimals:        $(this).data('decimals')
                        }, options);
                        
                        // how many times to update the value, and how much to increment the value on each update
                        var loops = Math.ceil(settings.speed / settings.refreshInterval),
                            increment = (settings.to - settings.from) / loops;
                        
                        // references & variables that will change with each update
                        var self = this,
                            $self = $(this),
                            loopCount = 0,
                            value = settings.from,
                            data = $self.data('countTo') || {};
                        
                        $self.data('countTo', data);
                        
                        // if an existing interval can be found, clear it first
                        if (data.interval) {
                            clearInterval(data.interval);
                        }
                        data.interval = setInterval(updateTimer, settings.refreshInterval);
                        
                        // initialize the element with the starting value
                        render(value);
                        
                        function updateTimer() {
                            value += increment;
                            loopCount++;
                            
                            render(value);
                            
                            if (typeof(settings.onUpdate) == 'function') {
                                settings.onUpdate.call(self, value);
                            }
                            
                            if (loopCount >= loops) {
                                // remove the interval
                                $self.removeData('countTo');
                                clearInterval(data.interval);
                                value = settings.to;
                                
                                if (typeof(settings.onComplete) == 'function') {
                                    settings.onComplete.call(self, value);
                                }
                            }
                        }
                        
                        function render(value) {
                            var formattedValue = settings.formatter.call(self, value, settings);
                            $self.html(formattedValue);
                        }
                    });
                };
                
                $.fn.countTo.defaults = {
                    from: 0,               // the number the element should start at
                    to: 0,                 // the number the element should end at
                    speed: 1000,           // how long it should take to count between the target numbers
                    refreshInterval: 100,  // how often the element should be updated
                    decimals: 0,           // the number of decimal places to show
                    formatter: formatter,  // handler for formatting the value before rendering
                    onUpdate: null,        // callback method for every time the element is updated
                    onComplete: null       // callback method for when the element finishes updating
                };
                
                function formatter(value, settings) {
                    return value.toFixed(settings.decimals);
                }
            }(jQuery));

            jQuery(function ($) {
            // custom formatting example
            $('.count-number').data('countToOptions', {
                formatter: function (value, options) {
                return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
                }
            });
            
            // start all the timers
            $('.timer').each(count);  
            
            function count(options) {
                var $this = $(this);
                options = $.extend({}, options || {}, $this.data('countToOptions') || {});
                $this.countTo(options);
            }
            });
                </script>
    </body>
</html>
