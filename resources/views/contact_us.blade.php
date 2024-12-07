@php
    use App\Models\Header;use Illuminate\Support\Facades\App;
    use Carbon\Carbon
@endphp
@extends('layouts.app')
@section('content')

    @php
        $direction = app()->currentLocale() == 'ar' ? 'rtl' : 'ltr';
        $contaceUsHeader = Header::where('key', 'contact-us')->first();
    @endphp


    @include('includes.header_image',['title'=>__('landing.Contact Us'), 'image' => $contaceUsHeader->image ])

    <div dir="{{$direction}}" data-elementor-type="wp-page" data-elementor-id="1222" class="elementor elementor-1222">
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
                                                           class="elementor-icon-box-description">
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
                                                           class="elementor-icon-box-description">
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
                                                        style="color : white; letter-spacing: 0 !important;">
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


