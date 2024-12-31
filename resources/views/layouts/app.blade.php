@php use App\Models\ContactInfo;use Illuminate\Support\Facades\App; @endphp
    <!DOCTYPE html>
<html
    lang="{{ App::currentLocale() }}"
    dir="{{ App::currentLocale() === 'ar'? 'rtl': 'ltr' }}"
>

<head>
    @filamentPWA
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http/gmpgorg/xfn/11_3604524.html"/>
    <link rel="pingback" href="xmlrpc_php.html"/>
    <title>
        {{  $header_title  ?? config('app.name') }}
    </title>
    <meta name="name" content="{{ $header_title ?? config('app.name') }}">
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="keywords" content="{{ $header_keywords ?? config('app.name') }}">
    <meta name="description" content="{{ $header_description ?? config('app.name') }}">
    <meta name='robots' content='max-image-preview:large'/>
    <link rel='dns-prefetch' href='https/cdnjs.cloudflare_com_4456457.html'/>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/mkhazin/fav.png') }}">

    {{--<link rel="icon" type="image/x-icon" href="{{ asset('uploads/mkhazin/logo900.png') }}">--}}
    <link rel='stylesheet' href='{{ asset('css/landing.css') }}'/>
    <script src="{{ asset('js/landing.js') }}"></script>

    <link rel='stylesheet' id='rkit-offcanvas-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/offcanvas_8323160.css') }}' media='all'/>
    <link rel='stylesheet' id='rkit-navmenu-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/navmenu_1507389.css') }}' media='all'/>
    <link rel='stylesheet' id='rkit-headerinfo-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/headerinfo_2949244.css') }}' media='all'/>
    <link rel='stylesheet' id='navmenu-rkit-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/rkit-navmenu_4718667.css') }}'
          media='all'/>
    <link rel='stylesheet' id='rkit-search-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/search_2097262.css') }}' media='all'/>
    <link rel='stylesheet' id='rkit-sitelogo-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/site_logo_7471213.css') }}' media='all'/>
    <link rel='stylesheet' id='rkit-blog-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/rkit-blog-post_8060961.css') }}'
          media='all'/>
    <link rel='stylesheet' id='rkit-cta-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/cta_65591.css') }}' media='all'/>
    <link rel='stylesheet' id='rkit-blockquote-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/blockquote_2818168.css') }}' media='all'/>
    <link rel='stylesheet' id='rkit-social-share-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/social_share_4325419.css') }}'
          media='all'/>
    <link rel='stylesheet' id='rkit-team-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/rkit_team_8323193.css') }}' media='all'/>
    <link rel='stylesheet' id='rkit-running_text-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/running_text_6553601.css') }}'
          media='all'/>
    <link rel='stylesheet' id='rkit-animated_heading-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/animated_heading_4915235.css') }}'
          media='all'/>
    <link rel='stylesheet' id='rkit-card_slider-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/card_slider_983041.css') }}' media='all'/>
    <link rel='stylesheet' id='rkit-accordion-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/accordion_7471170.css') }}' media='all'/>
    <link rel='stylesheet' id='rkit-testimonial_carousel-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/testimonial_carousel_6422554.css') }}'
          media='all'/>
    <link rel='stylesheet' id='rkit-swiper-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/swiper-bundle.min_2555920.css') }}'
          media='all'/>
    <link rel='stylesheet' id='rkit-tabs-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/tabs_5046281.css') }}' media='all'/>
    <link rel='stylesheet' id='rkit-progress-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/progress-bar_4980813.css') }}'
          media='all'/>
    <link rel='stylesheet' id='counter-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/counter_1114149.css') }}' media='all'/>
    <link rel='stylesheet' id='countdown-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/countdown_6750294.css') }}' media='all'/>
    <link rel='stylesheet' id='pricelist-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/pricelist_8061012.css') }}' media='all'/>
    <link rel='stylesheet' id='image_comparasion-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/widgets/assets/css/image_comparation_5636177.css') }}'
          media='all'/>
    <link rel='stylesheet' id='elementor-icons-rtmicon-css'
          href='{{ asset('plugins/rometheme-for-elementor/assets/css/rtmicons_5963864.css') }}' media='all'/>
    <link rel='stylesheet' id='rkit-widget-style-css'
          href='{{ asset('plugins/rometheme-for-elementor/assets/css/rkit_4522065.css') }}'
          media='all'/>
    <link rel='stylesheet' id='template-kit-export-css'
          href='{{ asset('plugins/template-kit-export/assets/public/template-kit-export-public_3276836.css') }}'
          media='all'/>

    <link rel='stylesheet' id='rtform-text-style-css'
          href='{{ asset('plugins/romethemeform/widgets/assets/css/rtform_text_7995489.css') }}' media='all'/>
    <link rel='stylesheet' id='rform-style-css'
          href='{{ asset('plugins/romethemeform/widgets/assets/css/rform_1310777.css') }}'
          media='all'/>
    <link rel='stylesheet' id='spinner-style-css'
          href='{{ asset('plugins/romethemeform/widgets/assets/css/spinner-loading_3342412.css') }}' media='all'/>
    <link rel='stylesheet' id='rform-btn-style-css'
          href='{{ asset('plugins/romethemeform/widgets/assets/css/rform-button_8061037.css') }}' media='all'/>
    <link rel='stylesheet' id='rform-select-style-css'
          href='{{ asset('plugins/romethemeform/widgets/assets/css/rform-select_6291560.css') }}' media='all'/>
    <link rel='stylesheet' id='rform-radiobutton-style-css'
          href='{{ asset('plugins/romethemeform/widgets/assets/css/rform-radiobutton_4718639.css') }}' media='all'/>
    <link rel='stylesheet' id='rform-checkbox-style-css'
          href='{{ asset('plugins/romethemeform/widgets/assets/css/rform-checkbox_327702.css') }}' media='all'/>
    <link rel='stylesheet' id='intlTelInput-css'
          href='{{ asset('plugins/romethemeform/widgets/assets/css/intlTelInput_458842.css') }}'
          media='all'/>
    <link rel='stylesheet' id='hello-elementor-css' href='{{ asset('themes/hello-elementor/style.min_6815748.css') }}'
          media='all'/>
    <link rel='stylesheet' id='hello-elementor-theme-style-css'
          href='{{ asset('themes/hello-elementor/theme.min_7667743.css') }}'
          media='all'/>
    <link rel='stylesheet' id='hello-elementor-header-footer-css'
          href='{{ asset('themes/hello-elementor/header-footer.min_7274563.css') }}' media='all'/>
    <link rel='stylesheet' id='elementor-frontend-css'
          href='{{ asset('plugins/elementor/assets/css/frontend-lite.min_5505050.css') }}'
          media='all'/>
    <link rel='stylesheet' id='elementor-post-4-css'
          href='{{ asset('uploads/sites/82/elementor/css/post-4_4718631.css') }}'
          media='all'/>
    <link rel='stylesheet' id='swiper-css'
          href='{{ asset('plugins/elementor/assets/lib/swiper/v8/css/swiper.min_3407988.css') }}'
          media='all'/>
    <link rel='stylesheet' id='elementor-post-1222-css'
          href='{{ asset('uploads/sites/82/elementor/css/post-1222_6488116.css') }}'
          media='all'/>
    <link rel='stylesheet' id='elementor-post-1241-css'
          href='{{ asset('uploads/sites/82/elementor/css/post-1241_6684727.css') }}' media='all'/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link rel='stylesheet' id='elementor-icons-rtmicons-css'
          href='{{ asset('plugins/rometheme-for-elementor/assets/css/rtmicons_5963864.css') }}' media='all'/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="{{ asset('plugins/rometheme-for-elementor/widgets/assets/js/offcanvas_65571.js') }}"
            id="rkit-offcanvas-script-js"></script>
    <script src="{{ asset('plugins/rometheme-for-elementor/widgets/assets/js/navmenu_6553675.js') }}"
            id="rkit-navmenu-script-js"></script>
    <script src="{{ asset('js/jquery/jquery.min_2490384.js') }}" id="jquery-core-js"></script>
    <script src="{{ asset('js/jquery/jquery-migrate.min_2621521.js') }}" id="jquery-migrate-js"></script>
    <script src="{{ asset('plugins/rometheme-for-elementor/widgets/assets/js/card_slider_5832791.js') }}"
            id="card-slider-script-js"></script>
    <script src="{{ asset('plugins/rometheme-for-elementor/widgets/assets/js/animated_heading_65641.js') }}"
            id="animated-heading-script-js"></script>
    <script src="{{ asset('plugins/rometheme-for-elementor/widgets/assets/js/accordion_1703978.js') }}"
            id="accordion-script-js"></script>
    <script src="{{ asset('plugins/rometheme-for-elementor/widgets/assets/js/bar_chart_720905.js') }}"
            id="bar_chart-script-js"></script>
    <script src="{{ asset('plugins/rometheme-for-elementor/widgets/assets/js/line_chart_7995399.js') }}"
            id="line_chart-script-js"></script>
    <script src="{{ asset('plugins/rometheme-for-elementor/widgets/assets/js/pie_chart_917505.js') }}"
            id="pie_chart-script-js"></script>
    <script src="{{ asset('plugins/rometheme-for-elementor/widgets/assets/js/swiper-bundle.min_4718719.js') }}"
            id="swiperjs-js"></script>
    <script src="{{ asset('plugins/template-kit-export/assets/public/template-kit-export-public_6422542.js') }}"
            id="template-kit-export-js"></script>
    <link rel="https://api.w.org/" href="{{ asset('wp-json/5898311.js') }}on"/>
    <link rel="alternate" title="JSON" type="application/json" href="{{ asset('wp-json/wp/v2/pages/5767242.js') }}on"/>
    <link rel="EditURI" type="application/rsd+xml" title="RSD" href="xmlrpc_php_6946926.html"/>
    <link rel="alternate" title="oEmbed (JSON)" type="application/json+oembed"
          href="{{ asset('wp-json/oembed/10/262259.js') }}on"/>
    <link rel="alternate" title="oEmbed (XML)" type="text/xml+oembed" href="wp-json/oembed/10/embed_5046363.html"/>
    <meta name="generator"
          content="Elementor 3.23.4; features: e_optimized_css_loading, e_font_icon_svg, additional_custom_breakpoints, e_lazyload; settings: css_print_method-external, google_font-enabled, font_display-swap">
    <!-- Include Font Awesome for the WhatsApp icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel='stylesheet' id='elementor-post-1244-css'
          href='{{ asset('uploads/sites/82/elementor/css/post-1244_6684730.css') }}' media='all'/>
    <!-- Style the button using CSS -->
    <style>
        .floating-btn {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            width: 45px;
            height: 45px;
            padding: 0 !important;
            border: none;
            border-radius: 50% !important;
            cursor: pointer;
            position: fixed;
            bottom: 20px; /* Adjust the position as needed */
            left: 20px; /* Adjust the position as needed */
            background-color: #09974b !important;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.199);
            transition-duration: 0.3s;
            z-index: 1000;
        }

        .floating-btn:hover {
            width: 190px;
            border-radius: 15px !important;
            transition-duration: 0.3s;
        }

        .floating-btn .sign {
            width: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition-duration: 0.3s;
        }

        .floating-btn .sign svg {
            width: 30px;
        }

        .floating-btn .sign svg path {
            fill: white;
        }

        .floating-btn .text {
            position: absolute;
            right: 0%;
            width: 0%;
            opacity: 0;
            color: white;
            font-size: 1.5em;
            font-weight: 600;
            transition-duration: 0.3s;
        }

        .floating-btn:hover .sign {
            width: 30%;
            transition-duration: 0.3s;
            padding-left: 10px;
        }

        .floating-btn:hover .text {
            opacity: 1;
            width: 70%;
            letter-spacing: 0 !important;
            transition-duration: 0.3s;
        }

        .arabic {
            padding-right: 50px !important;
        }

        .floating-btn:active {
            transform: translate(2px, 2px);
        }

    </style>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <meta name="google-site-verification" content="gOAvYgjJkpiE7MXHMfifJ_lGGLHnpJwDBjxU2o4TQI4" />

</head>

<body
    class="home page-template page-template-elementor_header_footer page page-id-1222 elementor-default elementor-template-full-width elementor-kit-4 elementor-page elementor-page-1222"
    style="font-family: Cairo, sans-serif !important;">
<div id="page">

    <!-- Navbar -->
    @include('layouts.header')
    <!-- /.navbar -->

    @yield('content')

    <!-- footer -->
    @include('layouts.footer')
    <!-- /.footer -->

    <!-- Add the WhatsApp chat button -->
    @php
        $whatsapp = ContactInfo::query()->where('action_id', 2)->first();
    @endphp

    {{--    <a href="https://wa.me/{{ $whatsapp->content }}" target="_blank"
           class="whatsapp-button">
            <i class="fab fa-whatsapp" style="color: #fff;"></i>
        </a>--}}

    <a href="https://wa.me/{{ $whatsapp->content }}" target="_blank">
        <button class="floating-btn">
            <div class="sign">
                <svg class="socialSvg whatsappSvg" viewBox="0 0 16 16">
                    <path
                        d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z">
                    </path>
                </svg>
            </div>
            <div class="text {{ App::currentLocale() === 'ar' ? 'arabic' : '' }}">
                {{  __('landing.Contact Us') }}
            </div>
        </button>
    </a>


    {{--

    /* From Uiverse.io by Gaurang7717 */
<button class="Btn">
  <div class="sign">
    <svg class="socialSvg whatsappSvg" viewBox="0 0 16 16">
      <path
        d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"
      ></path>
    </svg>
  </div>

  <div class="text">Whatsapp</div>
</button>

_________________________________________________________________________
/* From Uiverse.io by Gaurang7717 */
.Btn {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  width: 45px;
  height: 45px;
  border: none;
  border-radius: 50%;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  transition-duration: 0.3s;
  box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.199);
  background-color: #00d757;
}

.sign {
  width: 100%;
  transition-duration: 0.3s;
  display: flex;
  align-items: center;
  justify-content: center;
}

.sign svg {
  width: 25px;
}

.sign svg path {
  fill: white;
}
.text {
  position: absolute;
  right: 0%;
  width: 0%;
  opacity: 0;
  color: white;
  font-size: 1.2em;
  font-weight: 600;
  transition-duration: 0.3s;
}

.Btn:hover {
  width: 150px;
  border-radius: 40px;
  transition-duration: 0.3s;
}

.Btn:hover .sign {
  width: 30%;
  transition-duration: 0.3s;
  padding-left: 10px;
}

.Btn:hover .text {
  opacity: 1;
  width: 70%;
  transition-duration: 0.3s;
  padding-right: 10px;
}
.Btn:active {
  transform: translate(2px, 2px);
}


    --}}

</div><!-- #page -->
<link rel='stylesheet' id='elementor-post-1060-css'
      href='{{ asset('uploads/sites/82/elementor/css/post-1060_6291516.css') }}'
      media='all'/>
<link rel='stylesheet' id='e-animations-css'
      href='{{ asset('plugins/elementor/assets/lib/animations/animations.min_5111836.css') }}'
      media='all'/>
<link rel='stylesheet' id='elementor-post-863-css'
      href='{{ asset('uploads/sites/82/elementor/css/post-863_7864343.css') }}'
      media='all'/>
<link rel='stylesheet' id='elementor-post-978-css'
      href='{{ asset('uploads/sites/82/elementor/css/post-978_8192026.css') }}'
      media='all'/>
<link rel='stylesheet' id='elementor-post-1061-css'
      href='{{ asset('uploads/sites/82/elementor/css/post-1061_6291517.css') }}'
      media='all'/>
<script src="{{ asset('plugins/rometheme-for-elementor/widgets/assets/js/rkit-navmenu_6881386.js') }}"
        id="navmenu-rkit-script-js"></script>
<script src="{{ asset('plugins/rometheme-for-elementor/widgets/assets/js/social_share_589920.js') }}"
        id="social-share-script-js"></script>
<script src="{{ asset('plugins/rometheme-for-elementor/widgets/assets/js/running_text_2293830.js') }}"
        id="running-text-script-js"></script>
<script src="{{ asset('plugins/rometheme-for-elementor/widgets/assets/js/testimonial_carousel_3670080.js') }}"
        id="rkit-testimonial_carousel-js"></script>
<script src="{{ asset('plugins/rometheme-for-elementor/widgets/assets/js/tabs_2818159.js') }}"
        id="rkit-tabs-script-js"></script>
<script src="{{ asset('plugins/rometheme-for-elementor/widgets/assets/js/progress_2293886.js') }}"
        id="progress-script-js"></script>
<script src="{{ asset('plugins/rometheme-for-elementor/widgets/assets/js/counter_8192073.js') }}"
        id="rkit-counter-script-js"></script>
<script src="{{ asset('plugins/rometheme-for-elementor/widgets/assets/js/countdown_917567.js') }}"
        id="rkit-countdown-script-js"></script>
<script src="{{ asset('plugins/rometheme-for-elementor/widgets/assets/js/image_comparation_589838.js') }}"
        id="rkit-image_comparasion-script-js"></script>
<script src="{{ asset('themes/hello-elementor/assets/js/hello-frontend.min_1703968.js') }}"
        id="hello-theme-frontend-js"></script>
<script src="{{ asset('plugins/elementor/assets/lib/jquery-numerator/jquery-numerator.min_7733355.js') }}"
        id="jquery-numerator-js"></script>
<script src="{{ asset('plugins/elementor/assets/js/webpack.runtime.min_131136.js') }}"
        id="elementor-webpack-runtime-js"></script>
<script src="{{ asset('plugins/elementor/assets/js/frontend-modules.min_7209053.js') }}"
        id="elementor-frontend-modules-js"></script>
<script src="{{ asset('plugins/elementor/assets/lib/waypoints/waypoints.min_1572864.js') }}"
        id="elementor-waypoints-js"></script>
<script src="{{ asset('js/jquery/ui/core.min_983076.js') }}" id="jquery-ui-core-js"></script>

<script src="{{ asset('plugins/elementor/assets/js/frontend.min_3932235.js') }}" id="elementor-frontend-js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

{{--<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>--}}

</body>
</html>
