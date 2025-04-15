@php use App\Models\Header; @endphp
@extends('layouts.app')
@section('content')

    @php
        $direction = app()->currentLocale() == 'ar' ? 'rtl' : 'ltr';
        $sectionHeader = Header::where('key', 'sections')->first();
    @endphp

    @include('includes.header_image',[
    'title'=> __('landing.Departments'),
    'image'=> $sectionHeader->image,
    ])

    <div dir="{{$direction}}" data-elementor-type="wp-page" data-elementor-id="1222" class="elementor elementor-1222">
        @if(!empty($departments))
            <div id="departments" class="elementor-element elementor-element-130ffc67 e-flex e-con-boxed e-con e-parent"
                 data-element_type="container">
                <div class="e-con-inner">
                    <div class="elementor-element elementor-element-4f0dd16f e-con-full e-flex e-con e-child"
                         data-id="4f0dd16f" data-element_type="container">
                        <div class="elementor-element elementor-element-76860287 e-con-full e-flex e-con e-child"
                             data-id="76860287" data-element_type="container">
                            <div
                                class="elementor-element elementor-element-21105bf4 elementor-widget__width-inherit elementor-widget elementor-widget-rkit-blog-post"
                                data-element_type="widget" data-widget_type="rkit-blog-post.default">
                                <div class="elementor-widget-container">
                                    <div class="rkit-blog">
                                        @foreach($departments as $department)
                                            <div class="rkit-blog-card  elementor-animation-"
                                                 style="border-radius: 10px;">
                                                <div class="rkit-image-container">
                                                    <a class="rkit-image-link" style="overflow: hidden;" href="#">
                                                        <img decoding="async" class="rkit-blog-img" style="border-radius: 10px 10px 0 0;"
                                                             src="{{ asset('storage/' . $department->image) }}">
                                                    </a>
                                                </div>
                                                <div class="rkit-blog-body ">
                                                    <div class="rkit-blog-title-container"
                                                         style="text-align: {{ $direction == 'rtl' ? 'right' : 'left' }} !important;">
                                                        <a class="rkit-blog-title" href="#">
                                                            {{ $direction == 'rtl' ? $department->title_ar : $department->title_en }}
                                                        </a>
                                                    </div>
                                                    <div class="rkit-blog-content">
                                                        <p class="rkit-blog-paragraph"
                                                           style="display: -webkit-box; text-align:justify; word-break:keep-all; -webkit-box-orient: vertical; -webkit-line-clamp: 4; color: black; overflow: hidden; text-overflow: ellipsis;">
                                                            {{  $direction == 'rtl' ? $department->description_ar : $department->description_en }}
                                                        </p>
                                                    </div>
                                                    <div class="rkit-readmore-div"
                                                         style="justify-content: {{  $direction == 'rtl' ? 'right' : 'left' }}; text-align: {{ $direction == 'rtl' ? 'right' : 'left' }} !important; display: flex">
                                                        <a class="rkit-readmore-btn" type="button"
                                                           href="{{ url('sections/' . $department->id . '/details') }}"
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
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif
    </div>

@endsection

