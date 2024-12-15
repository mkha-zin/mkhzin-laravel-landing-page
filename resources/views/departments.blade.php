@php
    use App\Models\Header;use Illuminate\Support\Facades\App;
    use Carbon\Carbon
@endphp
@extends('layouts.app')
@section('content')

    @php
        $direction = app()->currentLocale() == 'ar' ? 'rtl' : 'ltr';
    @endphp

    <div class="container mt-5 justify-content-center">
        <style>
            .vouchers-logo {
                width: 300px;
                height: auto;
            }

            @media only screen and (max-width: 600px) {
                .vouchers-logo {
                    width: 200px;
                    height: auto;
                }
            }
        </style>

        {{--<div class="row mt-5 justify-content-center">
            <img class="img img-fluid vouchers-logo" src="{{ asset('uploads/mkhazin/logo300.png') }}">
        </div>--}}

        @if($department)
            <h2 class="text-center mb-5">
                {{ $direction == 'rtl' ? $department->title_ar : $department->title_en }}
            </h2>

            <p class="m-1"
               style="font-size: 20px; line-height: 1.5;font-weight: normal; text-align:justify; word-break:keep-all;">
                {{ \Filament\Support\Markdown::inline( $direction == 'rtl' ? $department->description_ar : $department->description_en) }}
            </p>
        @endif
    </div>
    <div data-elementor-type="wp-post" class="elementor elementor-1244" style="margin-top: -60px">
        <div class="elementor-element elementor-element-46f2bc0 e-flex e-con-boxed e-con e-parent"
             data-element_type="container">
            <div class="e-con-inner">
                <div class="elementor-element elementor-element-0797a1f e-con-full e-flex e-con e-child"
                     data-id="0797a1f" data-element_type="container">
                    <div class="elementor-element elementor-element-8ca1759 e-con-full e-flex e-con e-child"
                         data-id="8ca1759" data-element_type="container">
                        <div class="elementor-element elementor-element-5ad687a e-con-full e-flex e-con e-child"
                             data-id="5ad687a" data-element_type="container" style="display: flex; justify-content: center">
                            @if(!empty($branches))
                                @foreach($branches as $branch)
                                    <div
                                        class="elementor-element elementor-element-2114515 e-con-full e-flex e-con e-child"
                                        data-id="2114515" data-element_type="container"
                                        style="border-radius: 15px; width: 300px"
                                        data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                        <div
                                            class="elementor-element elementor-element-f573fca elementor-widget elementor-widget-image"
                                            data-id="f573fca" data-element_type="widget"
                                            data-widget_type="image.default">
                                            <div class="elementor-widget-container">
                                                <img decoding="async" width="1000" height="1000"
                                                     style="width: auto; height: 300px; max-height: 300px; min-height: 300px; border-radius: 15px 15px 0 0; left: 50%; min-width: 100%; "
                                                     src="{{asset('storage/'.$branch->image)}}"
                                                     class="attachment-full size-full wp-image-1471" alt=""
                                                     srcset="{{asset('storage/'.$branch->image)}} 1000w,{{asset('storage/'.$branch->image)}} 300w,{{asset('storage/'.$branch->image)}} 150w,{{asset('storage/'.$branch->image)}} 768w,{{asset('storage/'.$branch->image)}} 800w"
                                                     sizes="(max-width: 1000px) 100vw, 1000px"/>
                                            </div>
                                        </div>
                                        <div
                                            class="elementor-element elementor-element-0540be8 elementor-widget elementor-widget-heading"
                                            data-id="0540be8" data-element_type="widget"
                                            data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h4 class="elementor-heading-title elementor-size-default">
                                                    {{$direction=='rtl'?$branch->name_ar:$branch->name_en}}
                                                </h4>
                                            </div>
                                        </div>
                                        <div
                                            class="elementor-element elementor-element-01b7cb3 elementor-widget elementor-widget-heading"
                                            data-id="01b7cb3" data-element_type="widget"
                                            data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h6 class="elementor-heading-title elementor-size-default">
                                                    {{$direction=='rtl'?$branch->city->name_ar:$branch->city->name_en}}
                                                    ,
                                                    {{$direction=='rtl'?$branch->address_ar:$branch->address_en}}
                                                </h6>
                                            </div>
                                        </div>
                                        <a class="elementor-button elementor-button-link elementor-size-sm elementor-animation-shrink"
                                           href="{{route('branch.offers', $branch->id)}}"
                                           style="border-radius: 0 0 15px 15px;">
                                                    <span class="elementor-button-content-wrapper">
                                                        <span class="elementor-button-text"
                                                              style="color:white; letter-spacing: 0 !important;">
                                                            {{  __('landing.Offers') }}
                                                        </span>
                                                    </span>
                                        </a>
                                    </div>

                                @endforeach

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-5 mx-5 {{ $direction == 'rtl' ? 'text-right' : 'text-left' }}">
        @if($direction == 'rtl' && $department->tags_ar)
            @foreach($department->tags_ar as $tag)
                <h4 class="badge" style="border: 1px solid red">{{$tag}}</h4>
            @endforeach
        @elseif($direction == 'ltr' && $department->tags_en)
            @foreach($department->tags_en as $tag)
                <h3 class="badge" style="font-size: 20px">{{'#' . $tag}}</h3>
            @endforeach
        @endif
    </div>

@endsection

