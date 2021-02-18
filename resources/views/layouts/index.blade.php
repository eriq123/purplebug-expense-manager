<!doctype html>
<html class="fixed sidebar-left-collapsed">
<head>

    <!-- Basic -->
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="Expense Manager" />
    <meta name="author" content="Eriq Mendoza">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    <!-- <link rel="icon" href="{{asset('assets/images/!happy-face.png')}}" type="image"> -->
    
    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.css')}}" /> 
    <link rel="stylesheet" href="{{asset('assets/vendor/fontawesome/css/all.min.css')}}" /> 
    <link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}" /> 

    @yield('css')

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('assets/stylesheets/theme.css')}}" />

    <!-- nanoscroller -->
    <!-- <link rel="stylesheet" href="{{asset('assets/vendor/nanoscroller/nanoscroller.css')}}" /> -->

    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{asset('assets/stylesheets/skins/default.css')}}" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{asset('assets/stylesheets/theme-custom.css')}}">

    <!-- Head Libs -->
    <script src="{{asset('assets/vendor/modernizr/modernizr.js')}}"></script>


</head>

<body>
    <div id="app">
        <section class="body">

            <!-- start header -->
            @include('partials.header')
            <div class="inner-wrapper">

                <!-- start: sidebar -->
                @include('partials.sidebar')
                <!-- end: sidebar -->

                <!-- Main Content -->
                @yield('content')
                
                @yield('modals')

            </div>
        </section>
    </div>
    <!-- Vendor -->
    <script src="{{asset('assets/vendor/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/vendor/nanoscroller/nanoscroller.js')}}"></script> 
    <script src="{{asset('assets/vendor/jquery-placeholder/jquery.placeholder.js')}}"></script>

    <!-- pageloader -->
    <script src="{{asset('assets/javascripts/loadingoverlay.min.js')}}"></script>

  
    <script>

        $(document).ready(function() {
            
        $('.alert').delay(2000).fadeOut('slow');

        // start overlay
        $(document).ajaxStart(function () {
            $.LoadingOverlay("show", {
                image       : "",
                fontawesome : "fa fa-cog fa-spin"
            });
        }).ajaxStop(function () {
            $.LoadingOverlay("hide");
        }); 
        // end loading overlay

        // start ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 
        //end ajax setup

        }); //end ready
    </script>

<!-- Theme Base, Components and Settings -->
<script src="{{asset('assets/javascripts/theme.js')}}"></script>

<!-- Theme Custom -->
<script src="{{asset('assets/javascripts/theme.custom.js')}}"></script>

<!-- Theme Initialization Files -->
<script src="{{asset('assets/javascripts/theme.init.js')}}"></script>

@yield('js')

</body>
</html>

