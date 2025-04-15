@php
    $facebook = \App\Models\SocialLink::query()->where('title_en', 'Facebook')->where('is_active', 1)->first();
    $twitter = \App\Models\SocialLink::query()->where('title_en', 'Twitter(X)')->where('is_active', 1)->first();
    $linkedin = \App\Models\SocialLink::query()->where('title_en', 'Linkedin')->where('is_active', 1)->first();
    $youtube = \App\Models\SocialLink::query()->where('title_en', 'Youtube')->where('is_active', 1)->first();
    $instagram = \App\Models\SocialLink::query()->where('title_en', 'Instagram')->where('is_active', 1)->first();
    $snapchat = \App\Models\SocialLink::query()->where('title_en', 'Snapchat')->where('is_active', 1)->first();
    $tiktok = \App\Models\SocialLink::query()->where('title_en', 'TikTok')->where('is_active', 1)->first();
    $whatsChannel = \App\Models\SocialLink::query()->where('title_en', 'Whatsapp Channel')->where('is_active', 1)->first();
    $direction = app()->currentLocale() == 'ar' ? 'rtl' : 'ltr';
@endphp

<header id="masthead" itemscope="itemscope">
    <div data-elementor-type="wp-post" data-elementor-id="1060" class="elementor elementor-1060">
        <div class="elementor-element elementor-element-72ea40c e-flex e-con-boxed e-con e-parent"
             data-element_type="container">
            <div class="e-con-inner">
                <div class="elementor-element elementor-element-7127bdc e-con-inner e-flex e-con e-child">
                    <a href="{{ route('locale.setting', 'en') }}" style="color: black">English</a>
                    <span class="mx-1">|</span>
                    <a href="{{ route('locale.setting', 'ar') }}" style="color: black">العربية</a>
                </div>
                <div class="elementor-element elementor-element-7127bdc e-con-full e-flex e-con e-child"
                     data-element_type="container">
                    <div
                        class="elementor-element elementor-element-8154df2 elementor-shape-rounded elementor-grid-0 e-grid-align-center elementor-widget elementor-widget-social-icons"
                        data-element_type="widget" data-widget_type="social-icons.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-social-icons-wrapper elementor-grid">
                                @if(!empty($facebook))
                                    <span class="elementor-grid-item">
                                        <a href="{{  $facebook->link }}"
                                           class="elementor-icon elementor-social-icon elementor-social-icon-facebook elementor-repeater-item-7629fb3"
                                           target="_blank">
                                            <span class="elementor-screen-only">
                                                {{ $direction == 'rtl' ? $facebook->title_ar : $facebook->title_en }}
                                            </span>
                                            <svg class="e-font-icon-svg e-fab-facebook" viewBox="0 0 512 512"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"></path>
                                                @php
                                                    $comment = '';
                                                    if (\Illuminate\Support\Facades\App::currentLocale() == 'en') {
                                                        if (empty($facebook->comment_en)) {
                                                            if (empty($facebook->comment_ar)) {
                                                                $comment = '';
                                                            }else{
                                                                $comment = $facebook->comment_ar;
                                                            }
                                                        }else {
                                                            $comment = $facebook->comment_en;
                                                        }
                                                    }else{
                                                        if (empty($facebook->comment_ar)) {
                                                            if (empty($facebook->comment_en)) {
                                                                $comment = '';
                                                            }else{
                                                                $comment = $facebook->comment_en;
                                                            }
                                                        }else {
                                                            $comment = $facebook->comment_ar;
                                                        }
                                                    }
                                                @endphp
                                                @if(!empty($comment))
                                                    <title>{{ $comment }}</title>
                                                @endif
                                            </svg>
                                        </a>
                                    </span>
                                @endif
                                @if(!empty($twitter))
                                    <span class="elementor-grid-item">
                                        <a href="{{  $twitter->link }}"
                                           class="elementor-icon elementor-social-icon elementor-social-icon-x-twitter elementor-repeater-item-31c56b8"
                                           target="_blank">
                                            <span class="elementor-screen-only">
                                                {{ $direction == 'rtl' ? $twitter->title_ar : $twitter->title_en }}
                                            </span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                              <path
                                                  d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                                                @php
                                                    $comment = '';
                                                    if (\Illuminate\Support\Facades\App::currentLocale() == 'en') {
                                                        if (empty($twitter->comment_en)) {
                                                            if (empty($twitter->comment_ar)) {
                                                                $comment = '';
                                                            }else{
                                                                $comment = $twitter->comment_ar;
                                                            }
                                                        }else {
                                                            $comment = $twitter->comment_en;
                                                        }
                                                    }else{
                                                        if (empty($twitter->comment_ar)) {
                                                            if (empty($twitter->comment_en)) {
                                                                $comment = '';
                                                            }else{
                                                                $comment = $twitter->comment_en;
                                                            }
                                                        }else {
                                                            $comment = $twitter->comment_ar;
                                                        }
                                                    }
                                                @endphp
                                                @if(!empty($comment))
                                                    <title>{{ $comment }}</title>
                                                @endif
                                            </svg>
                                        </a>
                                    </span>
                                @endif
                                @if(!empty($youtube))
                                    <span class="elementor-grid-item">
                                        <a href="{{  $youtube->link }}"
                                           class="elementor-icon elementor-social-icon elementor-social-icon-youtube elementor-repeater-item-dc60bf3"
                                           target="_blank">
                                            <span class="elementor-screen-only">
                                                {{ $direction == 'rtl' ? $youtube->title_ar : $youtube->title_en }}
                                            </span>
                                            <svg class="e-font-icon-svg e-fab-youtube" viewBox="0 0 576 512"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path>
                                                @php
                                                    $comment = '';
                                                    if (\Illuminate\Support\Facades\App::currentLocale() == 'en') {
                                                        if (empty($youtube->comment_en)) {
                                                            if (empty($youtube->comment_ar)) {
                                                                $comment = '';
                                                            }else{
                                                                $comment = $youtube->comment_ar;
                                                            }
                                                        }else {
                                                            $comment = $youtube->comment_en;
                                                        }
                                                    }else{
                                                        if (empty($youtube->comment_ar)) {
                                                            if (empty($youtube->comment_en)) {
                                                                $comment = '';
                                                            }else{
                                                                $comment = $youtube->comment_en;
                                                            }
                                                        }else {
                                                            $comment = $youtube->comment_ar;
                                                        }
                                                    }
                                                @endphp
                                                @if(!empty($comment))
                                                    <title>{{ $comment }}</title>
                                                @endif
                                            </svg>
                                        </a>
                                    </span>
                                @endif
                                @if(!empty($linkedin))
                                    <span class="elementor-grid-item">
                                        <a href="{{  $linkedin->link }}"
                                           class="elementor-icon elementor-social-icon elementor-social-icon-linkedin elementor-repeater-item-b9b7412"
                                           target="_blank">
                                            <span class="elementor-screen-only">
                                                {{ $direction == 'rtl' ? $linkedin->title_ar : $linkedin->title_en }}
                                            </span>
                                            <svg class="e-font-icon-svg e-fab-linkedin" viewBox="0 0 448 512"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"></path>
                                                @php
                                                    $comment = '';
                                                    if (\Illuminate\Support\Facades\App::currentLocale() == 'en') {
                                                        if (empty($linkedin->comment_en)) {
                                                            if (empty($linkedin->comment_ar)) {
                                                                $comment = '';
                                                            }else{
                                                                $comment = $linkedin->comment_ar;
                                                            }
                                                        }else {
                                                            $comment = $linkedin->comment_en;
                                                        }
                                                    }else{
                                                        if (empty($linkedin->comment_ar)) {
                                                            if (empty($linkedin->comment_en)) {
                                                                $comment = '';
                                                            }else{
                                                                $comment = $linkedin->comment_en;
                                                            }
                                                        }else {
                                                            $comment = $linkedin->comment_ar;
                                                        }
                                                    }
                                                @endphp
                                                @if(!empty($comment))
                                                    <title>{{ $comment }}</title>
                                                @endif
                                            </svg>
                                        </a>
                                    </span>
                                @endif
                                @if(!empty($instagram))
                                    <span class="elementor-grid-item">
                                        <a href="{{  $instagram->link }}"
                                           class="elementor-icon elementor-social-icon elementor-social-icon-instagram elementor-repeater-item-1697c0d"
                                           target="_blank">
                                            <span class="elementor-screen-only">
                                                {{ $direction == 'rtl' ? $instagram->title_ar : $instagram->title_en }}
                                            </span>
                                            <svg class="e-font-icon-svg e-fab-instagram" viewBox="0 0 448 512"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path>
                                                @php
                                                    $comment = '';
                                                    if (\Illuminate\Support\Facades\App::currentLocale() == 'en') {
                                                        if (empty($instagram->comment_en)) {
                                                            if (empty($instagram->comment_ar)) {
                                                                $comment = '';
                                                            }else{
                                                                $comment = $instagram->comment_ar;
                                                            }
                                                        }else {
                                                            $comment = $instagram->comment_en;
                                                        }
                                                    }else{
                                                        if (empty($instagram->comment_ar)) {
                                                            if (empty($instagram->comment_en)) {
                                                                $comment = '';
                                                            }else{
                                                                $comment = $instagram->comment_en;
                                                            }
                                                        }else {
                                                            $comment = $instagram->comment_ar;
                                                        }
                                                    }
                                                @endphp
                                                @if(!empty($comment))
                                                    <title>{{ $comment }}</title>
                                                @endif
                                            </svg>
                                        </a>
                                    </span>
                                @endif
                                @if(!empty($snapchat))
                                    <span class="elementor-grid-item">
                                        <a href="{{  $snapchat->link }}"
                                           class="elementor-icon elementor-social-icon elementor-social-icon-snapchat elementor-repeater-item-1697c0d"
                                           target="_blank">
                                            <span class="elementor-screen-only">
                                                {{ $direction == 'rtl' ? $snapchat->title_ar : $snapchat->title_en }}
                                            </span>
                                            <svg class="e-font-icon-svg e-fab-snapchat"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path
                                                    d="M496.27 378.17c-2.1-6.96-12.17-11.86-12.17-11.86h.01c-.93-.52-1.79-.96-2.51-1.3-16.75-8.11-31.58-17.83-44.09-28.9-10.05-8.88-18.65-18.68-25.57-29.1-8.43-12.71-12.38-23.32-14.1-29.07-.94-3.74-.79-5.23 0-7.18.67-1.63 2.58-3.22 3.52-3.93 5.67-4 14.77-9.9 20.36-13.52 4.84-3.13 9.01-5.84 11.44-7.53 7.87-5.5 13.24-11.1 16.42-17.13 4.12-7.81 4.6-16.41 1.4-24.87-4.32-11.41-14.97-18.22-28.49-18.22-3.02 0-6.1.34-9.18 1.01-7.74 1.68-15.1 4.43-21.26 6.83a.666.666 0 01-.91-.65c.66-15.25 1.38-35.73-.31-55.22-1.52-17.61-5.14-32.45-11.07-45.38-5.96-12.99-13.68-22.62-19.74-29.55-5.79-6.62-15.91-16.35-31.2-25.1-21.53-12.32-46.03-18.56-72.82-18.56-26.72 0-51.2 6.24-72.76 18.56-16.18 9.24-26.53 19.7-31.25 25.1-6.06 6.93-13.79 16.56-19.75 29.55-5.93 12.93-9.55 27.77-11.07 45.38-1.69 19.53-1.01 38.39-.31 55.21.02.49-.46.84-.92.66-6.15-2.4-13.52-5.15-21.25-6.83-3.07-.67-6.16-1.01-9.18-1.01-13.52 0-24.17 6.81-28.49 18.22-3.2 8.46-2.71 17.06 1.4 24.87 3.18 6.03 8.56 11.63 16.42 17.13 2.43 1.69 6.61 4.4 11.44 7.53 5.48 3.55 14.32 9.28 20.01 13.27.7.5 3.09 2.31 3.86 4.18.81 2 .95 3.51-.08 7.48-1.76 5.81-5.72 16.28-14 28.77-6.92 10.42-15.53 20.22-25.58 29.1-12.51 11.07-27.34 20.79-44.09 28.9-.78.38-1.73.86-2.76 1.45v-.01s-9.99 5.12-11.88 11.72c-2.79 9.75 4.63 18.88 12.23 23.78 12.4 8 27.5 12.3 36.26 14.63 2.44.65 4.65 1.24 6.66 1.87 1.26.42 4.41 1.61 5.76 3.34 1.7 2.18 1.9 4.9 2.51 7.94.98 5.13 3.11 11.51 9.46 15.89 6.98 4.83 15.85 5.17 27.08 5.6 11.75.45 26.37 1.01 43.1 6.53 7.75 2.56 14.78 6.88 22.91 11.88 16.99 10.44 38.14 23.43 74.27 23.43 36.15 0 57.44-13.06 74.55-23.56 8.08-4.96 15.06-9.25 22.64-11.75 16.73-5.53 31.35-6.08 43.1-6.53 11.22-.43 20.09-.77 27.08-5.6 6.79-4.69 8.76-11.68 9.64-16.97.48-2.6.81-4.94 2.31-6.86 1.27-1.64 4.18-2.8 5.56-3.27 2.06-.65 4.35-1.27 6.88-1.94 8.76-2.33 19.73-5.11 33.1-12.66 15.98-9.03 17.07-20.24 15.41-25.75z"/>
                                                <path
                                                    d="M474.29 391.99c-21.88 12.07-36.44 10.79-47.75 18.07-9.61 6.18-3.93 19.53-10.91 24.35-8.57 5.93-33.95-.43-66.7 10.4-27.02 8.93-44.27 34.62-92.91 34.62-48.75 0-65.49-25.57-92.91-34.62-32.76-10.82-58.13-4.47-66.71-10.4-6.97-4.82-1.29-18.17-10.9-24.35-11.31-7.28-25.87-6-47.75-18.07-13.94-7.7-6.04-12.46-1.39-14.71 79.28-38.38 91.92-97.64 92.49-102.1.68-5.33 1.44-9.51-4.42-14.93-5.67-5.24-30.8-20.79-37.76-25.65-11.54-8.05-16.62-16.11-12.88-26 2.59-6.83 8.99-9.41 15.74-9.41 2.1 0 4.23.25 6.28.7 12.67 2.75 24.97 9.09 32.08 10.81.97.24 1.84.35 2.61.35 3.78 0 5.12-1.91 4.87-6.25-.81-13.85-2.78-40.86-.6-66.09 3-34.71 14.19-51.92 27.5-67.13 6.39-7.31 36.38-39.01 93.75-39.01 57.52 0 87.36 31.7 93.75 39.01 13.31 15.21 24.5 32.42 27.5 67.13 2.18 25.23.3 52.25-.6 66.09-.29 4.56 1.08 6.25 4.87 6.25.77 0 1.64-.11 2.61-.35 7.11-1.72 19.41-8.06 32.08-10.81 2.05-.45 4.18-.7 6.28-.7 6.74 0 13.15 2.58 15.74 9.41 3.74 9.89-1.34 17.95-12.88 26-6.97 4.86-32.09 20.41-37.76 25.65-5.86 5.42-5.1 9.6-4.42 14.93.57 4.46 13.21 63.72 92.49 102.1 4.65 2.25 12.55 7.01-1.39 14.71zM268.94 4.4h-25.83c-24.4 1.74-46.98 8.47-67.29 20.08-17.18 9.81-28.57 20.78-35.11 28.25-15.7 17.97-30.75 40.52-34.46 83.51-1.06 12.22-1.32 24.73-1.14 36.43-1.06-.27-2.13-.52-3.22-.76-4.11-.89-8.27-1.35-12.36-1.35-19.71 0-36 10.7-42.51 27.91-4.7 12.42-3.93 25.62 2.15 37.17 4.33 8.2 11.23 15.54 21.11 22.43 2.63 1.84 6.71 4.48 11.86 7.83 2.79 1.8 6.86 4.44 10.86 7.08.6.42 2.76 1.99 3.48 3.49.82 1.71.85 3.57-.38 6.97-2.12 4.67-5.14 10.36-9.44 16.65-12.74 18.64-30.97 34.44-54.26 47.05-12.34 6.57-25.16 10.91-30.57 25.62C.61 376.06 0 379.49 0 382.97c.01 8.23 3.5 16.7 10.79 24.19l.01-.02c3.41 3.67 7.7 6.92 13.11 9.91 12.71 7.01 23.51 10.45 32.01 12.81 1.49.44 4.95 1.56 6.46 2.89 3.78 3.3 3.24 8.29 8.29 15.58 3.04 4.54 6.57 7.63 9.46 9.63 10.57 7.31 22.45 7.76 35.03 8.24 11.37.44 24.26.93 38.97 5.79 6.1 2.02 12.43 5.91 19.77 10.42 15.79 9.7 36.82 22.62 70.09 25.19h24.03c33.32-2.58 54.49-15.56 70.39-25.32 7.28-4.47 13.58-8.33 19.5-10.29 14.72-4.86 27.6-5.36 38.97-5.79 12.58-.48 24.45-.93 35.03-8.24 3.32-2.3 7.48-6.03 10.78-11.75 3.62-6.15 3.53-10.49 6.93-13.46 1.39-1.22 4.43-2.27 6.07-2.77 8.57-2.36 19.52-5.8 32.44-12.93 5.73-3.17 10.22-6.62 13.73-10.56l.13-.16c9.72-10.47 12.17-22.74 8.18-33.57-3.56-9.68-10.33-14.86-18.05-19.15a60.28 60.28 0 00-3.87-2.05c-2.31-1.18-4.66-2.34-7-3.56-24.06-12.75-42.84-28.84-55.88-47.91-4.39-6.44-7.46-12.25-9.58-16.98-1.11-3.19-1.06-4.99-.27-6.64.61-1.26 2.22-2.56 3.08-3.2 4.13-2.73 8.41-5.51 11.29-7.37 5.16-3.35 9.23-5.99 11.87-7.83 9.88-6.89 16.78-14.23 21.1-22.43 6.09-11.55 6.86-24.75 2.16-37.17-6.51-17.21-22.8-27.91-42.51-27.91-4.09 0-8.24.46-12.36 1.35-1.09.24-2.16.49-3.22.76.17-11.7-.08-24.21-1.14-36.43-3.71-42.99-18.76-65.54-34.47-83.51-6.54-7.49-17.94-18.47-35.04-28.25-20.29-11.6-42.89-18.34-67.34-20.08z"/>
                                                @php
                                                    $comment = '';
                                                    if (\Illuminate\Support\Facades\App::currentLocale() == 'en') {
                                                        if (empty($snapchat->comment_en)) {
                                                            if (empty($snapchat->comment_ar)) {
                                                                $comment = '';
                                                            }else{
                                                                $comment = $snapchat->comment_ar;
                                                            }
                                                        }else {
                                                            $comment = $snapchat->comment_en;
                                                        }
                                                    }else{
                                                        if (empty($snapchat->comment_ar)) {
                                                            if (empty($snapchat->comment_en)) {
                                                                $comment = '';
                                                            }else{
                                                                $comment = $snapchat->comment_en;
                                                            }
                                                        }else {
                                                            $comment = $snapchat->comment_ar;
                                                        }
                                                    }
                                                @endphp
                                                @if(!empty($comment))
                                                    <title>{{ $comment }}</title>
                                                @endif
                                            </svg>
                                        </a>
                                    </span>
                                @endif
                                @if(!empty($tiktok))
                                    <span class="elementor-grid-item">
                                        <a href="{{  $tiktok->link }}"
                                           class="elementor-icon elementor-social-icon elementor-social-icon-snapchat elementor-repeater-item-1697c0d"
                                           target="_blank">
                                            <span class="elementor-screen-only">
                                                {{ $direction == 'rtl' ? $tiktok->title_ar : $tiktok->title_en }}
                                            </span>
                                            <svg class="svg-tooltip" fill="#000000" width="800px" height="800px"
                                                 viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                                <path
                                                    d="M19.589 6.686a4.793 4.793 0 0 1-3.77-4.245V2h-3.445v13.672a2.896 2.896 0 0 1-5.201 1.743l-.002-.001.002.001a2.895 2.895 0 0 1 3.183-4.51v-3.5a6.329 6.329 0 0 0-5.394 10.692 6.33 6.33 0 0 0 10.857-4.424V8.687a8.182 8.182 0 0 0 4.773 1.526V6.79a4.831 4.831 0 0 1-1.003-.104z"/>
                                                @php
                                                    $comment = '';
                                                    if (\Illuminate\Support\Facades\App::currentLocale() == 'en') {
                                                        if (empty($tiktok->comment_en)) {
                                                            if (empty($tiktok->comment_ar)) {
                                                                $comment = '';
                                                            }else{
                                                                $comment = $tiktok->comment_ar;
                                                            }
                                                        }else {
                                                            $comment = $tiktok->comment_en;
                                                        }
                                                    }else{
                                                        if (empty($tiktok->comment_ar)) {
                                                            if (empty($tiktok->comment_en)) {
                                                                $comment = '';
                                                            }else{
                                                                $comment = $tiktok->comment_en;
                                                            }
                                                        }else {
                                                            $comment = $tiktok->comment_ar;
                                                        }
                                                    }
                                                @endphp
                                                @if(!empty($comment))
                                                    <title>{{ $comment }}</title>
                                                @endif
                                            </svg>
                                        </a>
                                    </span>
                                @endif
                                @if(!empty($whatsChannel))
                                    <span class="elementor-grid-item">
                                        <a href="{{  $whatsChannel->link }}"
                                           class="elementor-icon elementor-social-icon elementor-social-icon-twitch elementor-repeater-item-1697c0d"
                                           target="_blank">
                                            <span class="elementor-screen-only">
                                                {{ $whatsChannel == 'rtl' ? $whatsChannel->title_ar : $whatsChannel->title_en }}
                                            </span>
                                            <svg class="my_tooltip" fill="#000000" height="800px" width="800px"
                                                 version="1.1" id="Icon"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 24 24" enable-background="new 0 0 24 24"
                                                 xml:space="preserve">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M20.5,3.5C18.25,1.25,15.2,0,12,0C5.41,0,0,5.41,0,12c0,2.11,0.65,4.11,1.7,5.92
                                                        L0,24l6.33-1.55C8.08,23.41,10,24,12,24c6.59,0,12-5.41,12-12C24,8.81,22.76,5.76,20.5,3.5z M12,22c-1.78,0-3.48-0.59-5.01-1.49
                                                        l-0.36-0.22l-3.76,0.99l1-3.67l-0.24-0.38C2.64,15.65,2,13.88,2,12C2,6.52,6.52,2,12,2c2.65,0,5.2,1.05,7.08,2.93S22,9.35,22,12
                                                        C22,17.48,17.47,22,12,22z M17.5,14.45c-0.3-0.15-1.77-0.87-2.04-0.97c-0.27-0.1-0.47-0.15-0.67,0.15
                                                        c-0.2,0.3-0.77,0.97-0.95,1.17c-0.17,0.2-0.35,0.22-0.65,0.07c-0.3-0.15-1.26-0.46-2.4-1.48c-0.89-0.79-1.49-1.77-1.66-2.07
                                                        c-0.17-0.3-0.02-0.46,0.13-0.61c0.13-0.13,0.3-0.35,0.45-0.52s0.2-0.3,0.3-0.5c0.1-0.2,0.05-0.37-0.02-0.52
                                                        C9.91,9.02,9.31,7.55,9.06,6.95c-0.24-0.58-0.49-0.5-0.67-0.51C8.22,6.43,8.02,6.43,7.82,6.43S7.3,6.51,7.02,6.8
                                                        C6.75,7.1,5.98,7.83,5.98,9.3c0,1.47,1.07,2.89,1.22,3.09c0.15,0.2,2.11,3.22,5.1,4.51c0.71,0.31,1.27,0.49,1.7,0.63
                                                        c0.72,0.23,1.37,0.2,1.88,0.12c0.57-0.09,1.77-0.72,2.02-1.42c0.25-0.7,0.25-1.3,0.17-1.42C18,14.68,17.8,14.6,17.5,14.45z"/>
                                                @php
                                                    $comment = '';
                                                    if (\Illuminate\Support\Facades\App::currentLocale() == 'en') {
                                                        if (empty($whatsChannel->comment_en)) {
                                                            if (empty($whatsChannel->comment_ar)) {
                                                                $comment = '';
                                                            }else{
                                                                $comment = $whatsChannel->comment_ar;
                                                            }
                                                        }else {
                                                            $comment = $whatsChannel->comment_en;
                                                        }
                                                    }else{
                                                        if (empty($whatsChannel->comment_ar)) {
                                                            if (empty($whatsChannel->comment_en)) {
                                                                $comment = '';
                                                            }else{
                                                                $comment = $whatsChannel->comment_en;
                                                            }
                                                        }else {
                                                            $comment = $whatsChannel->comment_ar;
                                                        }
                                                    }
                                                @endphp
                                                @if(!empty($comment))
                                                    <title>{{ $comment }}</title>
                                                @endif
                                            </svg>
                                        </a>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <nav class="navbar navbar-light bg-light">
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="{{ asset('uploads/mkhazin/logo900.png') }}" width="150" height="150" alt="">
                    </a>
                </nav>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <style>
                    .nav-hover a{
                        text-transform: uppercase;
                        text-decoration: none;

                        display: inline-block;
                        padding: 8px 15px;
                        position: relative;
                    }
                    .nav-hover a:after{
                        background: none repeat scroll 0 0 transparent;
                        bottom: 0;
                        content: "";
                        display: block;
                        height: 2px;
                        left: 50%;
                        position: absolute;
                        background: #df2228;
                        transition: width 0.3s ease 0s, left 0.3s ease 0s;
                        width: 0;
                    }
                    .nav-hover a:hover:after{
                        width: 100%;
                        left: 0;
                    }
                    .active1{
                        background-color: #df2228;
                        border-radius: 5px;
                        color: white !important;
                    }
                </style>

                <div class="collapse navbar-collapse flex justify-center text-center" id="navbarSupportedContent">
                    <ul class="nav-hover-ul navbar-nav mx-auto">
                        <li class="nav-hover nav-item flex">
                            <a class="nav-link {{ request()->segment(1) == null ? 'active active1' : '' }}"
                               href="{{ url('/') }}">
                                {{ __('landing.Home') }}
                            </a>
                        </li>
                        <li class="nav-hover nav-item">
                            <a class="nav-link {{ request()->segment(1) == 'about' ? 'active active1' : '' }}"
                               href="{{ url('about') }}">
                                {{ __('landing.About') }}
                            </a>
                        </li>
                        <li class="nav-hover nav-item">
                            <a class="nav-link {{ request()->segment(1) == 'sections' ? 'active active1' : '' }}"
                               href="{{ url('sections') }}">
                                {{ __('landing.Departments') }}
                            </a>
                        </li>
                        <li class="nav-hover nav-item">
                            <a href="{{ url('estore') }}"
                               class="nav-link {{ request()->segment(1) == 'store' ? 'active active1' : '' }}">
                                {{  __('landing.Store')}}
                            </a>
                        </li>
                        <li class="nav-hover nav-item">
                            <a class="nav-link {{ request()->segment(1) == 'blog' ? 'active active1' : '' }}"
                               href="{{ url('blog') }}">
                                {{ __('landing.Blog') }}
                            </a>
                        </li>
                        <li class="nav-hover nav-item">
                            <a class="nav-link {{ request()->segment(1) == 'branches' ? 'active active1' : '' }}"
                               href="{{ url('branches') }}">
                                {{ __('landing.Branches') }}
                            </a>
                        </li>
                        <li class="nav-hover nav-item">
                            <a class="nav-link {{ request()->segment(1) == 'contact' ? 'active active1' : '' }}"
                               href="{{ url('/contact') }}">
                                {{ __('landing.Contact Us') }}
                            </a>
                        </li>
                    </ul>
                    <a href="{{ url('offers') }}" style="background-color: #e12228"
                       class="btn flex justify-self-center my-2 my-sm-0 text-white"
                       type="button">
                        {{ __('landing.Offers') }}
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>
