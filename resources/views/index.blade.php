@php use Filament\Support\Markdown; @endphp
@extends('layouts.app')
@section('content')

    @php
        $direction = app()->currentLocale() == 'ar' ? 'rtl' : 'ltr'
    @endphp

    <div dir="{{$direction}}" data-elementor-type="wp-page" data-elementor-id="1222" class="elementor elementor-1222">
        <!-- Hero -->
        <div>
            <div class="elementor-element elementor-element-738b7686 e-flex e-con-boxed e-con e-parent"
                 data-element_type="container"
                 style="height: 60vh !important"
                 data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_gallery&quot;:
                 [
                 @if(!empty($heroes[0]))
                     @foreach($heroes as $hero)
                        @if(!$loop->first)
                        {&quot;id&quot;:{{$hero->id}},&quot;url&quot;:&quot;{{ asset('storage/' . $hero->image) }}&quot;},
                        @endif
                     @endforeach
                 {&quot;id&quot;:{{$heroes[0]->id}},&quot;url&quot;:&quot;{{ asset('storage/' . $heroes[0]->image) }}&quot;}
                 @endif
                 ]
                 ,&quot;background_slideshow_ken_burns&quot;:&quot;yes&quot;,&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_duration&quot;:5000,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;,&quot;background_slideshow_transition_duration&quot;:500,&quot;background_slideshow_ken_burns_zoom_direction&quot;:&quot;in&quot;}">
                <div class="e-con-inner">
                    <div
                        class="elementor-element elementor-element-5a2dc1e5 e-con-full e-flex elementor-invisible e-con e-child"
                        data-id="5a2dc1e5" data-element_type="container"
                        data-settings="{&quot;animation&quot;:&quot;fadeInLeft&quot;}">
                        <div
                            class="elementor-element elementor-element-7816eda1 elementor-widget__width-initial elementor-widget elementor-widget-heading"
                            data-element_type="widget" data-widget_type="heading.default">
                            <div dir="{{ $direction }}" style="justify-content: center; flex: auto; text-align: center;"
                                 class="elementor-widget-container">
                                <div class="text-slider">
                                    @if(!empty($heroes))
                                        @foreach($heroes as $hero)
                                            <h1 class="slide {{ $loop->first ? 'active' : '' }} elementor-heading-title elementor-size-default">
                                                {{ \Illuminate\Support\Facades\App::currentLocale() == 'ar' ? $hero->title_ar : $hero->title_en }}
                                            </h1>
                                        @endforeach
                                    @else
                                        <h1 class="elementor-heading-title elementor-size-default">
                                            {{ __('landing.hero_title') }}
                                        </h1>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div
                            class="elementor-element elementor-element-79043c elementor-hidden-desktop elementor-hidden-tablet elementor-widget-divider--view-line elementor-widget elementor-widget-divider"
                            data-id="79043c" data-element_type="widget" data-widget_type="divider.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-divider">
                                    <span class="elementor-divider-separator"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Hero -->

        <!-- Our Values -->
        <div class="elementor-element elementor-element-1d48980a e-flex e-con-boxed e-con e-parent"
             data-element_type="container">
            <div class="e-con-inner" style="justify-content: center; flex: auto; text-align: center;">
                {{-- hero cards --}}
                @if(!empty($ourValues))
                    @foreach($ourValues as $ourValue)
                        <div
                            class="elementor-element elementor-element-756120a2 e-con-full e-flex elementor-invisible e-con e-child"
                            data-element_type="container"
                            style="background-image: url({{asset('storage/'.$ourValue->image)}});"
                            data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;animation&quot;:&quot;fadeInLeft&quot;}">
                            <div
                                class="elementor-element elementor-element-5cad39cb elementor-position-left elementor-vertical-align-middle elementor-view-default elementor-mobile-position-top elementor-widget elementor-widget-icon-box"
                                data-id="5cad39cb" data-element_type="widget" data-widget_type="icon-box.default">
                                <div class="elementor-widget-container"
                                     style="justify-content: center; flex: auto; text-align: center; color: white">

                                    <div class="elementor-icon-box-icon">
                                    <span class="elementor-icon elementor-animation-">
                                        <img src="{{ asset('storage/' . $ourValue->icon) }}"
                                             style="width: 80px; height: auto">
                                    </span>
                                    </div>
                                    <div class="elementor-icon-box-content">
                                        <h3 class="elementor-icon-box-title">
                                            <span style="color: black">
                                                {{ \Illuminate\Support\Facades\App::currentLocale() == 'ar' ? $ourValue->title_ar : $ourValue->title_en }}
                                            </span>

                                        </h3>
                                        <span style="color: black">
                                            {{ \Illuminate\Support\Facades\App::currentLocale() == 'ar' ? $ourValue->description_ar : $ourValue->description_en }}
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
        <!-- / Our Values -->

        <div class="container" style="margin-top: 130px; margin-bottom: -80px">
            <h2 class="main-website-title text-center" style="color: black">
                شركة مخازن المملكة العالمية&reg;
            </h2>
            <nav class="nav nav-pills flex-column flex-sm-row"
                 style=" border-radius: 10px;">
                <a href="{{ url('/departments/super') }}"
                   class="flex-sm-fill text-sm-center nav-link m-1"
                   style="background-color: var(--e-global-color-7cfaca3); text-align: center; color: white; z-index: 200">
                    سوبر ماركت
                </a>
                <a class="flex-sm-fill text-sm-center nav-link m-1"
                   href="{{ route('departments', ['key' => 'hyper']) }}"
                   style="background-color: var(--e-global-color-7cfaca3); text-align: center; color: white; z-index: 200">
                    هايبر ماركت
                </a>
                <a class="flex-sm-fill text-sm-center nav-link m-1"
                   href="{{ url('/departments/wholesale') }}"
                   style="background-color: var(--e-global-color-7cfaca3); text-align: center; color: white; z-index: 200">
                    مخازن الجملة
                </a>
            </nav>
        </div>

        <!-- About Us -->
        <div class="elementor-element elementor-element-5a2cb0dc e-flex e-con-boxed e-con e-parent"
             id="about-us"
             data-element_type="container">
            <div class="e-con-inner">
                <div class="elementor-element elementor-element-5cdbe7a1 e-con-full e-flex e-con e-child"
                     data-id="5cdbe7a1" data-element_type="container"
                     style="{{ $aboutCards->isNotEmpty() ? '' : 'margin-bottom: 20px' }}">
                    @if(!empty($about))
                        <div
                            class="elementor-element elementor-element-3eecd385 e-con-full e-flex elementor-invisible e-con e-child"
                            data-id="3eecd385" data-element_type="container" style="width: 100%;"
                            data-settings="{&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;animation_delay&quot;:200}">
                            <div style="width: 100%;"
                                 class="elementor-element elementor-element-5609d2b4 elementor-widget__width-initial elementor-widget-mobile__width-inherit elementor-widget elementor-widget-icon-box"
                                 data-id="5609d2b4" data-element_type="widget" data-widget_type="icon-box.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-icon-box-wrapper">
                                        <div class="elementor-icon-box-content">
                                            <h3 class="elementor-icon-box-description"
                                                style="width: 100%; text-align: {{ $direction == 'rtl' ? 'right' : 'left' }}"
                                                dir="{{ $direction }}">
                                                {{ \Illuminate\Support\Facades\App::currentLocale() == 'ar' ? $about->title_ar : $about->title_en }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="elementor-element elementor-element-4086c309 elementor-widget__width-inherit elementor-widget elementor-widget-text-editor">
                                <div class="elementor-widget-container">
                                    <h4 style="color: black; line-height: 1.5;font-weight: normal; text-align:justify; word-break:keep-all;">
                                        {{
                                            \Filament\Support\Markdown::block($direction == 'rtl' ? $about->first_text_ar : $about->first_text_en )
                                        }}
                                    </h4>
                                </div>
                            </div>

                        </div>
                    @endif
                </div>
                @if($aboutCards->isNotEmpty())
                    <div class="elementor-element elementor-element-645bc71d e-con-full e-flex e-con e-child"
                         data-id="645bc71d" data-element_type="container">
                        @foreach($aboutCards as $aboutCard)
                            <div
                                class="elementor-element elementor-element-7370b0d7 e-con-full e-flex elementor-invisible e-con e-child"
                                data-id="7370b0d7" data-element_type="container"
                                data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;animation&quot;:&quot;fadeInLeft&quot;,&quot;animation_delay&quot;:400}">
                                <div
                                    class="elementor-element elementor-element-7b76cd5 elementor-view-default elementor-position-top elementor-mobile-position-top elementor-widget elementor-widget-icon-box"
                                    data-id="7b76cd5" data-element_type="widget" data-widget_type="icon-box.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-icon-box-wrapper"
                                             style="justify-content: center; flex: auto; text-align: center;">
                                            <div class="elementor-icon-box-icon">
                                                <span class="elementor-icon elementor-animation-">
                                                    <img src="{{ asset('storage/' . $aboutCard->icon) }}"
                                                         style="width: 80px; height: auto">
                                                </span>
                                            </div>
                                            <div class="elementor-icon-box-content">
                                                <h4 class="elementor-icon-box-title">
                                                    <span>
                                                        {{  \Illuminate\Support\Facades\App::currentLocale() == 'ar' ? $aboutCard->title_ar : $aboutCard->title_en }}
                                                    </span>
                                                </h4>
                                                <p class="elementor-icon-box-description">
                                                    {{ \Illuminate\Support\Facades\App::currentLocale() == 'ar' ? $aboutCard->description_ar : $aboutCard->description_en }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        @if(!empty($about))
            <div class="elementor-element elementor-element-3f10198d e-flex e-con-boxed e-con e-parent"
                 style="background-image: url({{ asset('storage/' . $about->image) }})"
                 data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="e-con-inner">
                    <div
                        class="elementor-element elementor-element-18b834e1 e-con-full e-flex elementor-invisible e-con e-child"
                        data-element_type="container"
                        data-settings="{&quot;animation&quot;:&quot;fadeInRight&quot;,&quot;animation_delay&quot;:200}">
                        <div
                            class="elementor-element elementor-element-2f9546bc elementor-widget__width-inherit elementor-widget elementor-widget-heading"
                            data-id="2f9546bc" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container"
                                 style="justify-content: center; flex: auto; text-align: center; color: white">
                                <h4 class="elementor-heading-title elementor-size-default">
                                    {{
                                        Markdown::block($direction == 'rtl' ? $about->second_text_ar : $about->second_text_en )
                                    }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- / About Us -->

        <!-- Sections -->
        @if(!empty($departments))
            <div id="departments" class="elementor-element elementor-element-130ffc67 e-flex e-con-boxed e-con e-parent"
                 data-element_type="container">
                <div class="e-con-inner">
                    <div class="elementor-element elementor-element-4f0dd16f e-con-full e-flex e-con e-child"
                         data-id="4f0dd16f" data-element_type="container">
                        <div class="elementor-element elementor-element-76860287 e-con-full e-flex e-con e-child"
                             data-id="76860287" data-element_type="container">
                            <div
                                class="elementor-element elementor-element-2152e96d e-con-full e-flex elementor-invisible e-con e-child"
                                data-element_type="container"
                                data-settings="{&quot;animation&quot;:&quot;fadeInLeft&quot;}">
                                <div
                                    class="elementor-element elementor-element-1c3d47e6 elementor-widget elementor-widget-heading"
                                    data-element_type="widget" data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h3 class="elementor-heading-title elementor-size-default"
                                            style="color: white; font-size: 25px;">
                                            {{ __('landing.Departments') }}
                                        </h3></div>
                                </div>
                            </div>
                            <div
                                class="elementor-element elementor-element-2152e96d content-e e-con-full e-flex elementor-invisible e-con e-child"
                                data-element_type="container"
                                data-settings="{&quot;animation&quot;:&quot;fadeInRight&quot;}">
                                <div
                                    class="elementor-element elementor-element-1c3d47e6 elementor-element-1c3d47e6666 elementor-widget elementor-widget-heading"
                                    data-element_type="widget" data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h3 class="elementor-heading-title elementor-size-default"
                                            style="color: white; font-size: 20px;">
                                            <a href="{{ url('sections') }}">
                                                {{ __('landing.All Departments') }}
                                            </a>
                                        </h3></div>
                                </div>
                            </div>
                            <!--______________________________________________________-->
                            <style>
                                .slider-wrapper {
                                    overflow: hidden;
                                    max-width: 1500px !important;
                                    margin: 0 50px 55px;
                                    padding: 30px;
                                }

                                .card-list .card-item {
                                    height: auto;
                                    color: #fff;
                                    user-select: none;
                                    display: flex;
                                    flex-direction: column;
                                    align-items: center;
                                    justify-content: center;
                                    box-shadow: 0px 0px 3.6px rgba(0, 0, 0, 0.056),
                                    0px 0px 10px rgba(0, 0, 0, 0.08),
                                    0px 0px 24.1px rgba(0, 0, 0, 0.104),
                                    0px 0px 80px rgba(0, 0, 0, 0.16);
                                    backdrop-filter: blur(30px);
                                    background: rgba(255, 255, 255, 0.2);
                                }

                                .card-list .card-item .user-image {
                                    width: 150px;
                                    height: 150px;
                                    border-radius: 50%;
                                    margin-bottom: 40px;
                                    border: 3px solid #fff;
                                    padding: 4px;
                                }

                                .card-list .card-item .user-profession {
                                    font-size: 1.15rem;
                                    color: #e3e3e3;
                                    font-weight: 500;
                                    margin: 14px 0 40px;
                                }

                                .card-list .card-item .message-button {
                                    font-size: 1.25rem;
                                    padding: 10px 35px;
                                    color: #030728;
                                    border-radius: 6px;
                                    font-weight: 500;
                                    cursor: pointer;
                                    background: #fff;
                                    border: 1px solid transparent;
                                    transition: 0.2s ease;
                                }

                                .card-list .card-item .message-button:hover {
                                    background: rgba(255, 255, 255, 0.1);
                                    border: 1px solid #fff;
                                    color: #fff;
                                }

                                .slider-wrapper .swiper-pagination-bullet {
                                    background: #fff;
                                    height: 13px;
                                    width: 13px;
                                    opacity: 0.5;
                                }

                                .slider-wrapper .swiper-pagination-bullet-active {
                                    opacity: 1;
                                }

                                .slider-wrapper .swiper-slide-button {
                                    color: black;
                                    margin-top: -55px;
                                    transition: 0.2s ease;
                                }

                                .slider-wrapper .swiper-slide-button:hover {
                                    color: var(--e-global-color-7cfaca3);
                                }

                                @media (max-width: 768px) {
                                    .slider-wrapper {
                                        margin: 0 10px 40px;
                                    }

                                    .slider-wrapper .swiper-slide-button {
                                        display: none;
                                    }
                                }
                            </style>

                            <div class="swiper">
                                <div class="slider-wrapper">
                                    <div class="card-list swiper-wrapper">
                                        @foreach($departments as $department)
                                            <div class="card-item swiper-slide"
                                                 style="width: 300px !important; height: 420px !important;">
                                                <img src="{{ asset('storage/' . $department->image) }}"
                                                     class="card-img-top"
                                                     style="height: 200px"
                                                     alt="{{ $direction == 'ar' ? $department->title_ar : $department->title_en }}">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        {{ $direction == 'rtl' ? $department->title_ar : $department->title_en }}
                                                    </h5>
                                                    <p class="card-text"
                                                       style="display: -webkit-box; text-align:justify; word-break:keep-all; -webkit-box-orient: vertical; -webkit-line-clamp: 4; color: black; overflow: hidden; text-overflow: ellipsis;">
                                                        {{ $direction == 'rtl' ? $department->description_ar : $department->description_en }}
                                                    </p>
                                                    <a
                                                        href="{{url('sections/'.$department->id.'/details')}}"
                                                        style="letter-spacing: 0 !important;">
                                                        @if($direction == 'rtl')
                                                            <i aria-hidden="true"
                                                               class="rkit-icon-readmore rtmicon rtmicon-chevrons-left"></i>
                                                        @elseif($direction == 'ltr')
                                                            <i aria-hidden="true"
                                                               class="rkit-icon-readmore rtmicon rtmicon-chevrons-right"></i>
                                                        @endif
                                                        {{ __('landing.Know More') }}

                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                    <div class="swiper-pagination"></div>
                                    <div class="swiper-slide-button swiper-button-prev"></div>
                                    <div class="swiper-slide-button swiper-button-next"></div>
                                </div>
                            </div>


                            <script>
                                const swiper = new Swiper('.slider-wrapper', {
                                    loop: true,
                                    autoplay: true,
                                    grabCursor: true,
                                    spaceBetween: 30,

                                    // Pagination bullets
                                    pagination: {
                                        el: '.swiper-pagination',
                                        clickable: true,
                                        dynamicBullets: true
                                    },

                                    // Navigation arrows
                                    navigation: {
                                        nextEl: '.swiper-button-next',
                                        prevEl: '.swiper-button-prev',
                                    },

                                    // Responsive breakpoints
                                    breakpoints: {
                                        0: {
                                            slidesPerView: 1
                                        },
                                        768: {
                                            slidesPerView: 2
                                        },
                                        1024: {
                                            slidesPerView: 3
                                        }
                                    }
                                });
                            </script>
                            <!--______________________________________________________-->

                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- / Section -->

        <!-- Our Vision -->
        @if(!empty($vision))
            <div class="elementor-element elementor-element-1ba194d e-flex e-con-boxed e-con e-parent"
                 data-element_type="container" style="top: -100px;">
                <div class="e-con-inner">
                    <!--Texts-->
                    <div
                        class="elementor-element elementor-element-278b821f e-con-full e-flex elementor-invisible e-con e-child"
                        data-element_type="container"
                        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;animation&quot;:&quot;fadeInRight&quot;}">
                        <div
                            class="elementor-element elementor-element-625f9619 elementor-widget elementor-widget-heading"
                            data-id="625f9619" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <h6 class="elementor-heading-title elementor-size-default"
                                    style="color:white; letter-spacing: 0 !important;">
                                    {{ $direction == 'rtl' ? $vision->title_ar : $vision->title_en }}
                                </h6>
                            </div>
                        </div>
                        <div
                            class="elementor-element elementor-element-60021572 elementor-widget elementor-widget-text-editor"
                            data-id="60021572" data-element_type="widget" data-widget_type="text-editor.default">
                            <div class="elementor-widget-container">
                                <p style="display: -webkit-box; text-align:justify; word-break:keep-all; -webkit-box-orient: vertical; -webkit-line-clamp: 5; color: black; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $direction == 'rtl' ? $vision->description_ar : $vision->description_en }}
                                </p>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-7df84b6c e-con-full e-flex e-con e-child"
                             data-id="7df84b6c" data-element_type="container">
                            <div
                                class="elementor-element elementor-element-166453dd elementor-align-left elementor-widget elementor-widget-button"
                                data-id="166453dd" data-element_type="widget" data-widget_type="button.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <a class="elementor-button elementor-button-link elementor-size-sm elementor-animation-shrink"
                                           href="{{url('vision')}}">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text"
                                                      style="color:white; letter-spacing: 0 !important;">
                                                    {{  __('landing.Know More') }}
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--image-->
                    <div class="elementor-element elementor-element-28b00fe3 e-con-full e-flex e-con e-child"
                         data-element_type="container"
                         style="background-image: url({{ asset('storage/' . $vision->image) }});"
                         data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    </div>
                </div>
            </div>
        @endif
        <!-- / Our Vision -->

        <!-- Our Goals -->
        @if(!empty($goals))
            <div class="elementor-element elementor-element-1ba194d e-flex e-con-boxed e-con e-parent"
                 data-element_type="container" style="top: -200px;">
                <div class="e-con-inner">
                    <!--image-->
                    <div class="elementor-element elementor-element-28b00fe3 e-con-full e-flex e-con e-child"
                         data-element_type="container"
                         style="background-image: url({{ asset('storage/' . $goals->image) }});"
                         data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    </div>
                    <!--Texts-->
                    <div
                        class="elementor-element elementor-element-278b821f e-con-full e-flex elementor-invisible e-con e-child"
                        data-element_type="container"
                        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;animation&quot;:&quot;fadeInRight&quot;}">
                        <div
                            class="elementor-element elementor-element-625f9619 elementor-widget elementor-widget-heading"
                            data-id="625f9619" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <h6 class="elementor-heading-title elementor-size-default"
                                    style="color:white; letter-spacing: 0 !important;">
                                    {{ $direction == 'rtl' ? $goals->title_ar : $goals->title_en }}
                                </h6>
                            </div>
                        </div>
                        <div
                            class="elementor-element elementor-element-60021572 elementor-widget elementor-widget-text-editor"
                            data-id="60021572" data-element_type="widget" data-widget_type="text-editor.default">
                            <div class="elementor-widget-container">
                                <p style="display: -webkit-box; text-align:justify; word-break:keep-all; -webkit-box-orient: vertical; -webkit-line-clamp: 5; color: black; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $direction == 'rtl' ? Markdown::block($goals->description_ar) : Markdown::block($goals->description_en) }}
                                </p>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-7df84b6c e-con-full e-flex e-con e-child"
                             data-id="7df84b6c" data-element_type="container">
                            <div
                                class="elementor-element elementor-element-166453dd elementor-align-left elementor-widget elementor-widget-button"
                                data-id="166453dd" data-element_type="widget" data-widget_type="button.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <a class="elementor-button elementor-button-link elementor-size-sm elementor-animation-shrink"
                                           href="{{url('goals')}}">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text"
                                                      style="color:white; letter-spacing: 0 !important;">
                                                    {{  __('landing.Know More') }}
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- / Our Goals -->

        <!-- Storage -->
        @if(!empty($storage))
            <div class="elementor-element elementor-element-3f10198d e-flex e-con-boxed e-con e-parent"
                 style="top: -180px; background-image: url({{ asset('storage/' . $storage->background_image) }});"
                 data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="e-con-inner">
                    <div
                        class="elementor-element elementor-element-18b834e1 e-con-full e-flex elementor-invisible e-con e-child"
                        data-element_type="container"
                        data-settings="{&quot;animation&quot;:&quot;fadeInRight&quot;,&quot;animation_delay&quot;:200}">
                        <div
                            class="elementor-element elementor-element-2f9546bc elementor-widget__width-inherit elementor-widget elementor-widget-heading"
                            data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <h2 class="elementor-heading-title elementor-size-default"
                                    style="text-align: {{ $direction == 'rtl' ? 'right' : 'left' }} !important">
                                    {{ $direction == 'rtl' ? $storage->title_ar : $storage->title_en }}
                                </h2>
                            </div>
                        </div>
                        <div
                            class="elementor-element elementor-element-469ae9c elementor-widget elementor-widget-text-editor"
                            data-element_type="widget" data-widget_type="text-editor.default">
                            <div class="elementor-widget-container"
                                 style="text-align: {{ $direction == 'rtl' ? 'right' : 'left' }} !important">
                                <p>
                                    {{ Markdown::block($direction == 'rtl' ? $storage->description_ar : $storage->description_en) }}
                                </p>
                            </div>
                        </div>
                        <div
                            class="elementor-element elementor-element-7e66f724 elementor-align-left elementor-mobile-align-center elementor-widget elementor-widget-button"
                            data-element_type="widget" data-widget_type="button.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-button-wrapper">
                                    <a class="elementor-button elementor-button-link elementor-size-sm elementor-animation-shrink"
                                       href="{{route('storage')}}">
                                    <span class="elementor-button-content-wrapper">
                                        <span class="elementor-button-text"
                                              style="color: white; letter-spacing: 0 !important;">
                                            {{  __('landing.Know More') }}
                                        </span>
                                    </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="elementor-element elementor-element-f5305a6 e-con-full e-flex elementor-invisible e-con e-child"
                        data-element_type="container"
                        data-settings="{&quot;animation&quot;:&quot;fadeInLeft&quot;}">
                        <div
                            class="elementor-element elementor-element-33cf8859 elementor-widget elementor-widget-image"
                            data-element_type="widget" data-widget_type="image.default">
                            <div class="elementor-widget-container">
                                <img loading="lazy" decoding="async" width="561" height="900"
                                     src="{{ asset('storage/' . $storage->foreground_image) }}"
                                     class="attachment-full size-full wp-image-749" alt=""
                                     srcset="{{ asset('storage/' . $storage->foreground_image) }} 561w,{{ asset('storage/' . $storage->foreground_image) }} 187w"
                                     sizes="(max-width: 561px) 100vw, 561px"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- / Storage -->

        <!-- Fleet -->
        @if(!empty($fleet))
            <div class="container section" style="margin-top: -150px;">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{  asset('storage/' . $fleet->image) }}" alt="Transport Fleet" class="truck-image">
                    </div>
                    <div class="col-md-6 mt-3"
                         style="text-align: {{ $direction == 'rtl' ? 'right' : 'left' }} !important">
                        <h2 style="text-align: {{ $direction == 'rtl' ? 'right' : 'left' }} !important">
                            {{ $direction == 'rtl' ? $fleet->title_ar : $fleet->title_en }}
                        </h2>
                        <p style="display: -webkit-box; text-align:justify; word-break:keep-all; -webkit-box-orient: vertical; -webkit-line-clamp: 5; color: black; overflow: hidden; text-overflow: ellipsis;">
                            {{  Markdown::inline($direction == 'rtl' ? $fleet->description_ar : $fleet->description_en) }}
                        </p>
                        <div
                            class="elementor-element elementor-element-7e66f724 elementor-align-left elementor-mobile-align-center elementor-widget elementor-widget-button"
                            data-element_type="widget" data-widget_type="button.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-button-wrapper">
                                    <a class="elementor-button elementor-button-link elementor-size-sm elementor-animation-shrink"
                                       href="{{url('fleet')}}">
                                    <span class="elementor-button-content-wrapper">
                                        <span class="elementor-button-text"
                                              style="color: white; letter-spacing: 0 !important;">
                                            {{  __('landing.Know More') }}
                                        </span>
                                    </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif
        <!-- /Fleet -->

        <!-- Contact Us Aside -->
        <div id="contact-us" class="elementor-element elementor-element-4019d746 e-flex e-con-boxed e-con e-parent"
             data-element_type="container">
            <div class="e-con-inner">
                <div class="elementor-element elementor-element-7bb17d03 e-con-full e-flex e-con e-child"
                     data-element_type="container">
                    <div class="elementor-element elementor-element-1486b685 e-con-full e-flex e-con e-child"
                         data-element_type="container">
                        <div class="elementor-element elementor-element-4d3ea87b e-con-full e-flex e-con e-child"
                             style="background-image: url({{ $contact_second_image!=null?asset('storage/' . $contact_second_image->image):asset('uploads/mkhazin/tmp/1.jpg') }});"
                             data-element_type="container"
                             data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                        </div>
                        @if(!empty($contactInfos))
                            <div class="elementor-element elementor-element-44550122 e-con-full e-flex e-con e-child"
                                 data-element_type="container"
                                 data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                @foreach($contactInfos as $contactInfo)
                                    <!--Call-->
                                    @if($contactInfo->action_id == 3)
                                        <div
                                            class="elementor-element elementor-element-2272f8d0 elementor-position-left elementor-view-default elementor-mobile-position-top elementor-vertical-align-top elementor-widget elementor-widget-icon-box"
                                            data-element_type="widget" data-widget_type="icon-box.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-icon-box-wrapper">
                                                    <div class="elementor-icon-box-icon"
                                                         style="display: flex; justify-content: center; align-items: center;">
                                                        <span class="elementor-icon elementor-animation-">
                                                            <i aria-hidden="true"
                                                               class="rtmicon rtmicon-classic-phone"></i>
                                                        </span>
                                                    </div>
                                                    <div class="elementor-icon-box-content">
                                                        <h5 class="elementor-icon-box-title"
                                                            style="display: flex; justify-content: center; align-items: center;">
                                                            <span>{{ __('landing.Phone') }}</span>
                                                        </h5>
                                                        <a target="_blank" class="elementor-icon-box-description"
                                                           style="display: flex; justify-content: center; align-items: center;"
                                                           href="tel:{{ $contactInfo->content }}">
                                                            {{ $contactInfo->content }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <!--Email-->
                                    @if($contactInfo->action_id == 1)
                                        <div
                                            class="elementor-element elementor-element-5d7f1b08 elementor-position-left elementor-view-default elementor-mobile-position-top elementor-vertical-align-top elementor-widget elementor-widget-icon-box"
                                            data-element_type="widget" data-widget_type="icon-box.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-icon-box-wrapper">
                                                    <div class="elementor-icon-box-icon"
                                                         style="display: flex; justify-content: center; align-items: center;"><span
                                                            class="elementor-icon elementor-animation-">
                                                                <i aria-hidden="true"
                                                                   class="rtmicon rtmicon-email-spam"></i>
                                                            </span>
                                                    </div>
                                                    <div class="elementor-icon-box-content">
                                                        <h5 class="elementor-icon-box-title"
                                                            style="display: flex; justify-content: center; align-items: center;">
                                                            <span>{{  __('landing.Email') }}</span>
                                                        </h5>
                                                        <a target="_blank" class="elementor-icon-box-description"
                                                           style="display: flex; justify-content: center; align-items: center;"
                                                           href="mailto:{{ $contactInfo->content }}">
                                                            {{ $contactInfo->content }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <!--Website-->
                                    @if($contactInfo->action_id == 4)
                                        <div
                                            class="elementor-element elementor-element-f339c77 elementor-position-left elementor-view-default elementor-mobile-position-top elementor-vertical-align-top elementor-widget elementor-widget-icon-box"
                                            data-element_type="widget" data-widget_type="icon-box.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-icon-box-wrapper">
                                                    <div class="elementor-icon-box-icon"
                                                         style="display: flex; justify-content: center; align-items: center;">
                                                            <span class="elementor-icon elementor-animation-">
                                                                <i aria-hidden="true" class="rtmicon rtmicon-store"></i>
                                                            </span>
                                                    </div>
                                                    <div class="elementor-icon-box-content">
                                                        <h5 class="elementor-icon-box-title"
                                                            style="display: flex; justify-content: center; align-items: center;">
                                                            <span>{{ __('landing.Website') }}</span>
                                                        </h5>
                                                        <a target="_blank" href="{{ $contactInfo->content }}"
                                                           class="elementor-icon-box-description"
                                                           style="display: flex; justify-content: center; align-items: center;">
                                                            {{ $contactInfo->content }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <!--Whatsapp-->
                                    @if($contactInfo->action_id == 2)
                                        <div
                                            class="elementor-element elementor-element-49c24d1e elementor-position-left elementor-view-default elementor-mobile-position-top elementor-vertical-align-top elementor-widget elementor-widget-icon-box"
                                            data-element_type="widget" data-widget_type="icon-box.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-icon-box-wrapper">
                                                    <div class="elementor-icon-box-icon"
                                                         style="display: flex; justify-content: center; align-items: center;">
                                                            <span class="elementor-icon elementor-animation-">
                                                                <i aria-hidden="true"
                                                                   class="rtmicon rtmicon-text-area-form"></i>
                                                            </span>
                                                    </div>
                                                    <div class="elementor-icon-box-content">
                                                        <h5 class="elementor-icon-box-title"
                                                            style="display: flex; justify-content: center; align-items: center;">
                                                            <span>{{ __('landing.Whatsapp') }}</span>
                                                        </h5>
                                                        <a target="_blank"
                                                           href="https://wa.me/{{ $contactInfo->content }}"
                                                           class="elementor-icon-box-description"
                                                           style="display: flex; justify-content: center; align-items: center;">
                                                            {{ $contactInfo->content }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="elementor-element elementor-element-3a8d2fe3 e-con-full e-flex e-con e-child"
                         style="background-image: url({{ $contact_first_image!=null?asset('storage/' . $contact_first_image->image):asset('uploads/mkhazin/tmp/1.jpg') }});"
                         data-element_type="container"
                         data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    </div>
                </div>
                <div
                    class="elementor-element elementor-element-3f1ec870 e-con-full e-flex elementor-invisible e-con e-child"
                    data-id="3f1ec870" data-element_type="container"
                    data-settings="{&quot;animation&quot;:&quot;fadeInRight&quot;}">
                    <div class="elementor-element elementor-element-3738182a elementor-widget elementor-widget-heading"
                         data-id="3738182a" data-element_type="widget" data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h6 class="elementor-heading-title elementor-size-default"
                                style="color: white; letter-spacing: 0 !important;">{{ __('landing.Contact Us') }}</h6>
                        </div>
                    </div>
                    <div
                        class="elementor-element elementor-element-5292ea15 elementor-widget__width-inherit elementor-widget elementor-widget-heading"
                        data-element_type="widget" data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h2 class="elementor-heading-title elementor-size-default">{{ __('landing.Keep in touch') }}</h2>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-4c6beca6 elementor-widget elementor-widget-rform">
                        <div class="elementor-widget-container">
                            <form action="{{ route('save-visitor-msg') }}" method="post">
                                {{  csrf_field() }}
                                <div class="elementor elementor-863">
                                    <div
                                        class="elementor-element elementor-element-2567ec7 e-con-full e-flex e-con e-parent">
                                        <div
                                            class="elementor-element elementor-element-a9dce82 elementor-widget__width-initial elementor-widget">
                                            <div class="elementor-widget-container">
                                                <div class="rform-control ">
                                                    <input name="first_name"
                                                           placeholder="{{ __('landing.First Name') }}"
                                                           class="rform-input"
                                                           type="text" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="elementor-element elementor-element-ef24818 elementor-widget__width-initial elementor-widget">
                                            <div class="elementor-widget-container">
                                                <div class="rform-control ">
                                                    <input name="last_name" placeholder="{{ __('landing.Last Name') }}"
                                                           class="rform-input"
                                                           type="text" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="elementor-element elementor-element-8f97bea elementor-widget__width-initial elementor-widget">
                                            <div class="elementor-widget-container">
                                                <div class="rform-control ">
                                                    <input name="email" placeholder="{{ __('landing.Email') }}"
                                                           class="rform-input"
                                                           type="email" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="elementor-element elementor-element-95a6c30 elementor-widget__width-initial elementor-widget">
                                            <div class="elementor-widget-container">
                                                <div class="rform-control ">
                                                    <input name="phone" placeholder="{{ __('landing.Phone') }}"
                                                           class="rform-input"
                                                           type="text" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-6d54624 elementor-widget">
                                            <div class="elementor-widget-container">
                                                <div class="rform-control ">
                                                    <input name="subject" placeholder="{{ __('landing.Subject') }}"
                                                           class="rform-input"
                                                           type="text" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-3e2d7b7 elementor-widget">
                                            <div class="elementor-widget-container">
                                                <div class="rform-control">
                                                    <textarea name="message" required
                                                              placeholder="{{ __('landing.Message') }}"
                                                              class="rform-input">
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-widget">
                                            <div class="elementor-widget-container">
                                                <div class="rform-button-container">
                                                    <button class="rform-button-submit " type="submit"
                                                            style="color: white; letter-spacing: 0 !important;">
                                                        @if($direction == 'rtl')
                                                            {{  __('landing.Send Message') }}
                                                            <i aria-hidden="true"
                                                               class="rform-btn-icon rtmicon rtmicon-chevrons-left"></i>
                                                        @else
                                                            {{  __('landing.Send Message') }}
                                                            <i aria-hidden="true"
                                                               class="rform-btn-icon rtmicon rtmicon-chevrons-right"></i>
                                                        @endif
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @include('_message')
                    </div>
                </div>
            </div>
        </div>
        <!-- / Contact Us Aside -->

        <!-- Contact Us Form -->
        <div class="elementor-element elementor-element-57ddf455 e-flex e-con-boxed e-con e-parent">
            <div class="e-con-inner">
                <div
                    class="elementor-element elementor-element-10fa2d2b elementor-widget__width-initial elementor-widget elementor-widget-rform">
                    <div class="elementor-widget-container">
                        <form method="post" action="{{  route('subscribe') }}">
                            {{ csrf_field() }}
                            <div class="elementor elementor-978">
                                <div
                                    class="elementor-element elementor-element-91d0ab5 e-con-full e-flex e-con e-parent">
                                    <div
                                        class="elementor-element elementor-element-f31499d elementor-widget__width-initial elementor-widget-mobile__width-inherit elementor-widget elementor-widget-email">
                                        <div class="elementor-widget-container">
                                            <div class="rform-container">
                                                <div class="rform-control ">
                                                    <input name="email" placeholder="Your Email Here"
                                                           class="rform-input" type="email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="subscribe"
                                         class="elementor-element elementor-element-5be759a elementor-widget__width-initial elementor-widget-mobile__width-inherit elementor-widget elementor-widget-rform_button_submit">
                                        <div class="elementor-widget-container">
                                            <div class="rform-button-container">
                                                <button class="rform-button-submit rform-btn-fullwidth" type="submit"
                                                        id="rform-button-submit"
                                                        style="color: white; letter-spacing: 0 !important;">
                                                    @if($direction == 'rtl')
                                                        {{  __('landing.Subscribe Now') }}
                                                        <i aria-hidden="true"
                                                           class="rform-btn-icon rtmicon rtmicon-chevrons-left"></i>
                                                    @else
                                                        {{  __('landing.Subscribe Now') }}
                                                        <i aria-hidden="true"
                                                           class="rform-btn-icon rtmicon rtmicon-chevrons-right"></i>
                                                    @endif
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div
                    class="elementor-element elementor-element-598eeff8 elementor-widget__width-initial elementor-invisible elementor-widget elementor-widget-heading"
                    data-id="598eeff8" data-element_type="widget"
                    data-settings="{&quot;_animation&quot;:&quot;fadeInLeft&quot;}" data-widget_type="heading.default">
                    <div class="elementor-widget-container">
                        <h3 class="elementor-heading-title elementor-size-default">
                            {{ __('landing.Subscribe to our Newsletter') }}
                        </h3></div>
                </div>
            </div>
        </div>
        <!-- / Contact Us Form -->
    </div>

@endsection
