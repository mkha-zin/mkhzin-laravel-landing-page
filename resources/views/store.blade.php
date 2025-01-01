@php
    $direction = app()->currentLocale() == 'ar' ? 'rtl' : 'ltr';
@endphp

<!doctype html>
<html lang="{{ app()->currentLocale() }}" dir="{{ $direction }}">
<head>
    <title>Mkhazin Store</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Mkhazin e-Store">
    <meta name="keywords" content="Mkhazin, e-Store, Mkhazin Store, Mkhazin E-Store, Mkhazin e-Store">

    <!-- Font -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('store/css/bootstrap.min.css') }}">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="{{ asset('store/css/themify-icons.css') }}">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="{{ asset('store/css/owl.carousel.min.css') }}">
    <!-- Main css -->
    <link href="{{ asset('store/css/style.css') }}" rel="stylesheet">
</head>

<body data-spy="scroll" data-target="#navbar" data-offset="30">

<!-- Nav Menu -->

<div class="nav-menu fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-dark navbar-expand-lg">
                    <a class="navbar-brand" href="">
                        <img src="{{ asset('store/images/logo.png') }}" width="100" class="img-fluid" alt="logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                            aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="navbar-nav {{ $direction == 'rtl' ? 'mr-auto' : 'ml-auto' }}">
                            <li class="nav-item"><a class="nav-link active" href="#home">{{  __('landing.Home') }} <span
                                        class="sr-only">(current)</span></a></li>
                            <li class="nav-item"><a class="nav-link" href="#features">{{ __('landing.features') }}</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#gallery">{{ __('landing.gallery') }}</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#pricing">{{ __('landing.Store') }}</a></li>
                            <li class="nav-item"><a href="#download"
                                                    class="btn btn-outline-light my-3 my-sm-0 ml-lg-3 mr-2">{{ __('landing.Download') }}</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

<!--Hero-->
<header class="bg-gradient" id="home">
    <div class="container mt-5">
        <h1>مرحباً بك في المتجر الإلكتروني</h1>
        <p class="tagline">
            توفر شركة مخازن المملكة العالمية متجراً الكترونياً يسهل على عملائها طلب كل ما يحبون من أماكنهم دون الحاجة
            لتكبد عناء التسوق بالطريقة العادية.
        </p>
    </div>
    <div class="img-holder mt-3"><img src="{{ asset('store/images/iphonex.png') }}" alt="phone" class="img-fluid"></div>
</header>

<!--Brands-->
<div class="client-logos my-5">
    <div class="container text-center">
        <img src="{{ asset('store/images/client-logos.png') }}" alt="client logos" class="img-fluid">
    </div>
</div>

<!--Features-->
<div class="section light-bg" id="features">
    <div class="container">
        <div class="section-title">
            <small>HIGHLIGHTS</small>
            <h3>Features you love</h3>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card features">
                    <div class="card-body">
                        <div class="media">
                            <span class="ti-face-smile gradient-fill ti-3x mr-3"></span>
                            <div class="media-body">
                                <h4 class="card-title">Simple</h4>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer
                                    rutrum, urna eu pellentesque </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card features">
                    <div class="card-body">
                        <div class="media">
                            <span class="ti-settings gradient-fill ti-3x mr-3"></span>
                            <div class="media-body">
                                <h4 class="card-title">Customize</h4>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer
                                    rutrum, urna eu pellentesque </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card features">
                    <div class="card-body">
                        <div class="media">
                            <span class="ti-lock gradient-fill ti-3x mr-3"></span>
                            <div class="media-body">
                                <h4 class="card-title">Secure</h4>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer
                                    rutrum, urna eu pellentesque </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>
<!-- // end .section -->

<!--Discover-->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-6">
                <div class="box-icon">
                    <span class="ti-mobile gradient-fill ti-3x"></span>
                </div>
                <h2>Discover our App</h2>
                <p class="mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Obcaecati vel exercitationem
                    eveniet vero maxime ratione </p>
                <a href="#" class="btn btn-primary">Read more</a>
            </div>
        </div>
        <div class="perspective-phone">
            <img src="{{ asset('store/images/perspective.png') }}" alt="perspective phone" class="img-fluid">
        </div>
    </div>

</div>
<!-- // end .section -->

<!--Steps: How it works-->
<div class="section light-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-8 d-flex align-items-center">
                <ul class="list-unstyled ui-steps">
                    <li class="media">
                        <div class="circle-icon mr-4">1</div>
                        <div class="media-body">
                            <h5>Create an Account</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum, urna eu
                                pellentesque pretium obcaecati vel exercitationem </p>
                        </div>
                    </li>
                    <li class="media my-4">
                        <div class="circle-icon mr-4">2</div>
                        <div class="media-body">
                            <h5>Share with friends</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum, urna eu
                                pellentesque pretium obcaecati vel exercitationem eveniet</p>
                        </div>
                    </li>
                    <li class="media">
                        <div class="circle-icon mr-4">3</div>
                        <div class="media-body">
                            <h5>Enjoy your life</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum, urna eu
                                pellentesque pretium obcaecati vel exercitationem </p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('store/images/iphonex.png') }}" alt="iphone" class="img-fluid">
            </div>

        </div>

    </div>

</div>
<!-- // end .section -->

<!--Gallery-->
<div class="section light-bg" id="gallery">
    <div class="container">
        <div class="section-title">
            <small>GALLERY</small>
            <h3>App Screenshots</h3>
        </div>

        <div class="img-gallery owl-carousel owl-theme">
            <img src="{{ asset('store/images/screen1.jpg') }}" alt="image">
            <img src="{{ asset('store/images/screen2.jpg') }}" alt="image">
            <img src="{{ asset('store/images/screen3.jpg') }}" alt="image">
            <img src="{{ asset('store/images/screen1.jpg') }}" alt="image">
        </div>
    </div>
</div>
<!-- // end .section -->

<!--Faq-->
<div class="section pt-0">
    <div class="container">
        <div class="section-title">
            <small>FAQ</small>
            <h3>Frequently Asked Questions</h3>
        </div>

        <div class="row pt-4">
            <div class="col-md-6">
                <h4 class="mb-3">Can I try before I buy?</h4>
                <p class="light-font mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum, urna
                    eu pellentesque pretium, nisi nisi fermentum enim, et sagittis dolor nulla vel sapien. Vestibulum
                    sit amet mattis ante. </p>
                <h4 class="mb-3">What payment methods do you accept?</h4>
                <p class="light-font mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum, urna
                    eu pellentesque pretium, nisi nisi fermentum enim, et sagittis dolor nulla vel sapien. Vestibulum
                    sit amet mattis ante. </p>

            </div>
            <div class="col-md-6">
                <h4 class="mb-3">Can I change my plan later?</h4>
                <p class="light-font mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum, urna
                    eu pellentesque pretium, nisi nisi fermentum enim, et sagittis dolor nulla vel sapien. Vestibulum
                    sit amet mattis ante. </p>
                <h4 class="mb-3">Do you have a contract?</h4>
                <p class="light-font mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum, urna
                    eu pellentesque pretium, nisi nisi fermentum enim, et sagittis dolor nulla vel sapien. Vestibulum
                    sit amet mattis ante. </p>

            </div>
        </div>
    </div>

</div>
<!-- // end .section -->

<!--Download-->
<div class="section bg-gradient" id="download">
    <div class="container">
        <div class="call-to-action">
            <div class="box-icon"><span class="ti-mobile gradient-fill ti-3x"></span></div>
            <h2>Download Anywhere</h2>
            <p class="tagline">Available for all major mobile and desktop platforms. Rapidiously visualize optimal ROI
                rather than enterprise-wide methods of empowerment. </p>
            <div class="my-4">

                <a href="#" class="btn btn-light"><img src="{{ asset('store/images/appleicon.png') }}" alt="icon"> App
                    Store</a>
                <a href="#" class="btn btn-light"><img src="{{ asset('store/images/playicon.png') }}" alt="icon"> Google
                    play</a>
            </div>
            <p class="text-primary"><small><i>*Works on iOS 10.0.5+, Android Kitkat and above. </i></small></p>
        </div>
    </div>

</div>
<!-- // end .section -->

<!--Contact-->
<div class="light-bg py-5" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <p class="mb-2"><span class="ti-location-pin mr-2"></span> 1485 Pacific St, Brooklyn, NY 11216 USA</p>
                <div class=" d-block d-sm-inline-block">
                    <p class="mb-2">
                        <span class="ti-email mr-2"></span> <a class="mr-4" href="mailto:support@mobileapp.com">support@mobileapp.com</a>
                    </p>
                </div>
                <div class="d-block d-sm-inline-block">
                    <p class="mb-0">
                        <span class="ti-headphone-alt mr-2"></span> <a href="tel:51836362800">518-3636-2800</a>
                    </p>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="social-icons">
                    <a href="#"><span class="ti-facebook"></span></a>
                    <a href="#"><span class="ti-twitter-alt"></span></a>
                    <a href="#"><span class="ti-instagram"></span></a>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- // end .section -->

<footer class="my-5 text-center">
    <!-- Copyright removal is not prohibited! -->
    <p class="mb-2"><small>COPYRIGHT © 2017. ALL RIGHTS RESERVED. MOBAPP TEMPLATE BY <a href="https://colorlib.com">COLORLIB</a></small>
    </p>

    <small>
        <a href="#" class="m-2">PRESS</a>
        <a href="#" class="m-2">TERMS</a>
        <a href="#" class="m-2">PRIVACY</a>
    </small>
</footer>

<!-- jQuery and Bootstrap -->
<script src="{{ asset('store/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('store/js/bootstrap.bundle.min.js') }}"></script>
<!-- Plugins JS -->
<script src="{{ asset('store/js/owl.carousel.min.js') }}"></script>
<!-- Custom JS -->
<script src="{{ asset('store/js/script.js') }}"></script>

</body>
</html>
