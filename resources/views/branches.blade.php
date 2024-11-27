@php
    use Illuminate\Support\Facades\App;
    use Carbon\Carbon
@endphp
@extends('layouts.app')
@section('content')

    @php
        $direction = app()->currentLocale() == 'ar' ? 'rtl' : 'ltr'
    @endphp


    @include('includes.header_image',['title'=>__('landing.Branches'), 'image' => '../uploads/mkhazin/tmp/header_image.png'])

    <div dir="{{$direction}}" data-elementor-type="wp-page" data-elementor-id="1222" class="elementor elementor-1222">
        <div data-elementor-type="wp-post" data-elementor-id="1244" class="elementor elementor-1244">
            <div class="elementor-element elementor-element-46f2bc0 e-flex e-con-boxed e-con e-parent" data-id="46f2bc0"
                 data-element_type="container">

                <div class="container mt-5" style="margin-bottom: -100px;">
                    <!-- form start -->
                    <form method="get" action="">
                        <div class="card-body">
                            <div class="row" style="display: flex; justify-content: center; align-items: center; text-align: center">
                                <div class="form-group col-5">
                                    <select name="city">
                                        <option value="all">{{ __('landing.All Cities') }}</option>
                                        @foreach($cities as $citiy)
                                            <option
                                                {{ (Request::get('city') == $citiy->id)? 'selected' : '' }} value="{{ $citiy->id }}">
                                                {{ $direction == 'rtl' ? $citiy->name_ar : $citiy->name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn text-white form-group col-2" type="submit" style="letter-spacing: 0 !important;">{{ __('landing.Search') }}</button>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>

                <div class="e-con-inner">
                    <div class="elementor-element elementor-element-0797a1f e-con-full e-flex e-con e-child"
                         data-id="0797a1f" data-element_type="container">
                        <div class="elementor-element elementor-element-8ca1759 e-con-full e-flex e-con e-child"
                             data-id="8ca1759" data-element_type="container">
                            <div class="elementor-element elementor-element-5ad687a e-con-full e-flex e-con e-child"
                                 data-id="5ad687a" data-element_type="container">
                                @if(!empty($branches))
                                    @foreach($branches as $branch)
                                        <div
                                            class="elementor-element elementor-element-2114515 e-con-full e-flex e-con e-child"
                                            data-id="2114515" data-element_type="container"
                                            data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                            <div
                                                class="elementor-element elementor-element-f573fca elementor-widget elementor-widget-image"
                                                data-id="f573fca" data-element_type="widget"
                                                data-widget_type="image.default">
                                                <div class="elementor-widget-container">
                                                    <img decoding="async" width="1000" height="1000"
                                                         style="width: auto; height: 300px; max-height: 300px; min-height: 300px;"
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
                                               href="{{route('branch.offers', $branch->id)}}">
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


    </div>
@endsection


