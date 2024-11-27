@props(['headerTitle','image','title','description'])

@php
    $direction = app()->currentLocale() == 'ar' ? 'rtl' : 'ltr'
@endphp

@include('includes.header_image',[
'title'=>$headerTitle,
'image'=>$image,
])
{{--<div class="container">

</div>--}}
<div dir="{{$direction}}" data-elementor-type="wp-page" data-elementor-id="1222" class="elementor elementor-1222">
    <div class="elementor-element elementor-element-5a2cb0dc e-flex e-con-boxed e-con e-parent"
         id="about-us"
         data-element_type="container">
        <div class="e-con-inner">
            <h3 style="color: red;">
                {{$title}}
            </h3>
            <h4 style="color: black;font-weight: normal; line-height: 1.5;">
                {{\Filament\Support\Markdown::block($description)}}
            </h4>

        </div>
    </div>
</div>
