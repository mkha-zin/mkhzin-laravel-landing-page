@php
    use Illuminate\Support\Facades\App;
    use Carbon\Carbon
@endphp
@extends('layouts.app')
@section('content')

    @php
        $direction = app()->currentLocale() == 'ar' ? 'rtl' : 'ltr'
    @endphp



    <x-subPagesStyle
        :headerTitle="__('landing.Jobs')"
        :image="$job->image"
        :title="$direction=='rtl'?$job->title_ar:$job->title_en"
        :description="$direction=='rtl'?$job->description_ar:$job->description_en"
    />

    <div class="elementor elementor-1222" style="margin-top: -180px;">
        <div class="elementor-element elementor-element-5a2cb0dc e-flex e-con-boxed e-con e-parent">
            <div class="e-con-inner">
                <div dir="{{$direction}}">
                    <div class="elementor-widget-container">
                        <div class="elementor-button-wrapper">
                            <a class="elementor-button elementor-button-link elementor-size-sm elementor-animation-shrink"
                               href="mailto: {{$job->email??''}}">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text"
                                                      style="color:white; letter-spacing: 0 !important;">
                                                    {{  __('landing.apply now') }}
                                                </span>
                                            </span>
                            </a>
                            <a style="margin-top: 10px" class="elementor-button elementor-button-link elementor-size-sm elementor-animation-shrink"
                               href="{{ route('joinus') }}">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text"
                                                      style="color:white; letter-spacing: 0 !important;">
                                                    {{  __('landing.join the team') }}
                                                </span>
                                            </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


