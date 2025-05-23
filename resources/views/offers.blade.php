@php
    use App\Models\Header;use Illuminate\Support\Facades\App;
    use Carbon\Carbon
@endphp
@extends('layouts.app')
@section('content')

    @php
        $lang = App::currentLocale();
        $direction = $lang == 'ar' ? 'rtl' : 'ltr';
        $offersHeader = Header::where('key', 'offers')->first();
    @endphp


    @include('includes.header_image',[
    'title'=>__('landing.offers_title'),
    'image' => $offersHeader->image
    ])

    <div dir="{{$direction}}" data-elementor-type="wp-page" data-elementor-id="1222" class="elementor elementor-1222">
        @if($offers->isNotEmpty())
            @php
                $now = Carbon::now();
                $availableOffers = $offers->filter(fn($offer) => Carbon::parse($offer->end_date)->gte($now));
                $expiredOffers = $offers->filter(fn($offer) => Carbon::parse($offer->end_date)->lt($now));
            @endphp
            @if($availableOffers->isNotEmpty())
                <div class="elementor-element elementor-element-130ffc67 e-flex e-con-boxed e-con e-parent"
                     data-element_type="container">

                    @if(Request::segment(1) == 'offers' )
                        )
                        <div class="container mt-5" style="margin-bottom: -100px;">
                            <!-- form start -->
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row"
                                         style="display: flex; justify-content: center; align-items: center; text-align: center">
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
                                        <button class="btn text-white form-group col-2 rounded" type="submit"
                                                style="letter-spacing: 0 !important;">{{ __('landing.Search') }}</button>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                    @elseif(Request::segment(1) == 'branch' )
                        <h2 class="text-center mt-5" style="margin-bottom: -60px !important;">
                            {{$lang=='ar'?'عروض ' . trim($offers[0]->branch->name_ar):trim($offers[0]->branch->name_en) . '\'s offers'}}
                        </h2>
                    @endif

                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-76860287 e-con-full e-flex e-con e-child"
                             data-id="76860287" data-element_type="container">
                            <div
                                class="elementor-element elementor-element-21105bf4 elementor-widget__width-inherit elementor-widget elementor-widget-rkit-blog-post"
                                data-id="21105bf4" data-element_type="widget" data-widget_type="rkit-blog-post.default">
                                <div class="elementor-widget-container">
                                    <div class="rkit-blog">
                                        @foreach($availableOffers as $offer)
                                            <div class="rkit-blog-card" style="border-radius: 10px">
                                                <div class="rkit-image-container">
                                                    <a class="rkit-image-link" style="overflow: hidden;">
                                                        <img decoding="async" class="rkit-blog-img"
                                                             style="border-radius: 10px 10px 0 0"
                                                             src="{{  asset('storage/' . $offer->image)}}">
                                                    </a>

                                                </div>
                                                <div class="rkit-blog-body ">
                                                    <div class="rkit-metadata">
                                                        <div class="rkit-metadata-item">
                                                            <i aria-hidden="true"
                                                               class="rkit-meta-icon rtmicon rtmicon-home mx-1"></i>
                                                            <a rel="author">
                                                                {{$lang=='ar'?$offer->branch->name_ar:$offer->branch->name_en}}
                                                                ,
                                                                {{$lang=='ar'?$offer->branch->city->name_ar:$offer->branch->city->name_en}}
                                                            </a>
                                                        </div>
                                                        <div class="rkit-metadata-item">
                                                            <i aria-hidden="true"
                                                               class="rkit-meta-icon rtmicon rtmicon-calendar mx-1"></i>
                                                            <span>
                                                                {{__('landing.end offer') . ' ' . Carbon::parse($offer->end_date)->translatedFormat($lang == 'ar' ? 'd F Y' : 'M d Y') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="rkit-blog-title-container">
                                                        <h3 class="rkit-blog-title"
                                                            style="text-align: {{ $direction == 'rtl' ? 'right' : 'left' }}">
                                                            {{$direction=='rtl'?$offer->name_ar:$offer->name_en}}
                                                        </h3>
                                                    </div>
                                                    <div class="rkit-blog-content">
                                                        <p class="rkit-blog-paragraph"
                                                           style="text-align: {{ $direction == 'rtl' ? 'right' : 'left' }}">
                                                            {{$direction=='rtl'?$offer->description_ar:$offer->description_en}}&hellip;
                                                        </p>
                                                    </div>
                                                    <div class="rkit-readmore-div" dir="{{ $direction }}">
                                                        <a class="rkit-readmore-btn" type="button"
                                                           href="{{ url('/view-pdf/' . $offer->id) }}"
                                                           target="_blank" style="letter-spacing: 0 !important;">
                                                            @if($direction == 'rtl')
                                                                <i aria-hidden="true"
                                                                   class="rkit-icon-readmore rtmicon rtmicon-chevrons-left"></i>
                                                            @elseif($direction == 'ltr')
                                                                <i aria-hidden="true"
                                                                   class="rkit-icon-readmore rtmicon rtmicon-chevrons-right"></i>
                                                            @endif
                                                            {{__('landing.brows offers')}}
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
            @else
                <div class="elementor-element elementor-element-130ffc67 e-flex e-con-boxed e-con e-parent"
                     data-element_type="container">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-76860287 e-con-full e-flex e-con e-child"
                             data-id="76860287" data-element_type="container">
                            <div
                                class="elementor-element elementor-element-21105bf4 elementor-widget__width-inherit elementor-widget elementor-widget-rkit-blog-post"
                                data-id="21105bf4" data-element_type="widget" data-widget_type="rkit-blog-post.default">
                                <div class="elementor-widget-container" style="display: flex; justify-content: center ">
                                    <h4 style="text-align: center">
                                        {{__('landing.No Offers Found')}}
                                        <br>
                                        {{__('landing.Soon Offers')}}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if($expiredOffers->isNotEmpty())
                <div class="elementor-element elementor-element-130ffc67 e-flex e-con-boxed e-con e-parent"
                     data-element_type="container">

                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-76860287 e-con-full e-flex e-con e-child"
                             data-id="76860287" data-element_type="container">
                            <h2 class="text-{{ $direction == 'rtl' ? 'right' : 'left' }} mb-4">
                                {{ __('landing.Previous offers') }}
                            </h2>

                            <div
                                class="elementor-element elementor-element-21105bf4 elementor-widget__width-inherit elementor-widget elementor-widget-rkit-blog-post"
                                data-id="21105bf4" data-element_type="widget" data-widget_type="rkit-blog-post.default">
                                <div class="elementor-widget-container">
                                    <div class="rkit-blog">
                                        @foreach($expiredOffers as $offer)
                                            <div class="rkit-blog-card" style="border-radius: 10px">
                                                <div class="rkit-image-container">
                                                    <a class="rkit-image-link" style="overflow: hidden;">
                                                        <img decoding="async" class="rkit-blog-img"
                                                             style="border-radius: 10px 10px 0 0"
                                                             src="{{  asset('storage/' . $offer->image)}}">
                                                    </a>
                                                </div>
                                                <div class="rkit-blog-body ">
                                                    <div class="rkit-metadata">
                                                        <div class="rkit-metadata-item">
                                                            <i aria-hidden="true"
                                                               class="rkit-meta-icon rtmicon rtmicon-home mx-1"></i>
                                                            <a rel="author">
                                                                {{$lang=='ar'?$offer->branch->name_ar:$offer->branch->name_en}}
                                                                ,
                                                                {{$lang=='ar'?$offer->branch->city->name_ar:$offer->branch->city->name_en}}
                                                            </a>
                                                        </div>
                                                        <div class="rkit-metadata-item">
                                                            <i aria-hidden="true"
                                                               class="rkit-meta-icon rtmicon rtmicon-calendar mx-1"></i>
                                                            <span>
                                                                {{__('landing.end offer') . ' ' . Carbon::parse($offer->end_date)->translatedFormat($lang == 'ar' ? 'd F Y' : 'M d Y')}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="rkit-blog-title-container">
                                                        <h3 class="rkit-blog-title"
                                                            style="text-align: {{ $direction == 'rtl' ? 'right' : 'left' }}">
                                                            {{$direction=='rtl'?$offer->name_ar:$offer->name_en}}
                                                        </h3>
                                                    </div>
                                                    <div class="rkit-blog-content">
                                                        <p class="rkit-blog-paragraph"
                                                           style="text-align: {{ $direction == 'rtl' ? 'right' : 'left' }}">
                                                            {{$direction=='rtl'?$offer->description_ar:$offer->description_en}}&hellip;
                                                        </p>
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
            @endif
        @endif
    </div>

@endsection

