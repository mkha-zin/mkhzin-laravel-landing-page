@php
    use Illuminate\Support\Facades\App;
    use Carbon\Carbon
@endphp
@extends('layouts.app')
@section('content')

    @php
        $direction = app()->currentLocale() == 'ar' ? 'rtl' : 'ltr'
    @endphp


    @include('includes.header_image',['title'=>__('landing.About'), 'image' => $about->image])

    <div dir="{{$direction}}" data-elementor-type="wp-page" data-elementor-id="1222" class="elementor elementor-1222">
        <!-- About Us -->
        <div class="elementor-element elementor-element-5a2cb0dc e-flex e-con-boxed e-con e-parent"
             id="about-us"
             data-element_type="container">
            <div class="e-con-inner">
                <div class="elementor-element elementor-element-5cdbe7a1 e-con-full e-flex e-con e-child"
                     data-element_type="container">
                    @if(!empty($about))
                        <div
                            class="elementor-element elementor-element-3eecd385 e-con-full e-flex elementor-invisible e-con e-child"
                            data-element_type="container" style="width: 100%;"
                            data-settings="{&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;animation_delay&quot;:200}">
                            <div style="width: 100%;"
                                 class="elementor-element elementor-element-5609d2b4 elementor-widget__width-initial elementor-widget-mobile__width-inherit elementor-widget elementor-widget-icon-box"
                                 data-id="5609d2b4" data-element_type="widget" data-widget_type="icon-box.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-icon-box-wrapper">
                                        <div class="elementor-icon-box-content">
                                            <h1 class="elementor-icon-box-description"
                                                style="width: 100%; text-align: {{ $direction == 'rtl' ? 'right' : 'left' }}"
                                                dir="{{ $direction }}">
                                                {{ App::currentLocale() === 'ar' ? $about->title_ar : $about->title_en }}
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="elementor-element elementor-element-4086c309 elementor-widget__width-inherit elementor-widget elementor-widget-text-editor"
                                data-element_type="widget" data-widget_type="text-editor.default">
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
                <div class="elementor-element elementor-element-645bc71d e-con-full e-flex e-con e-child"
                     data-id="645bc71d" data-element_type="container">
                    @if(!empty($aboutCards))
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
                                                        {{  App::currentLocale() === 'ar' ? $aboutCard->title_ar : $aboutCard->title_en }}
                                                    </span>
                                                </h4>
                                                <p class="elementor-icon-box-description">
                                                    {{ App::currentLocale() === 'ar' ? $aboutCard->description_ar : $aboutCard->description_en }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
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
                                        \Filament\Support\Markdown::block($direction == 'rtl' ? $about->second_text_ar : $about->second_text_en )
                                    }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- / About Us -->
    </div>

@endsection


