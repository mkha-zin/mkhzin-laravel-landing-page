@props(['title' => 'Services','image'=>''])

<div id="page">
    <div data-elementor-type="wp-post" data-elementor-id="1241" class="elementor elementor-1241">
        <div class="elementor-element elementor-element-1efcc8b e-flex e-con-boxed e-con e-parent" data-id="1efcc8b"
             data-element_type="container" style="background-image: url({{asset('storage/'.$image)}})"
             data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">

            <div class="e-con-inner">
                <div class="elementor-element elementor-element-006d1ef elementor-widget elementor-widget-heading"
                     data-id="006d1ef" data-element_type="widget" data-widget_type="heading.default">
                    <div class="elementor-widget-container">

                        <h1 class="elementor-heading-title elementor-size-default">{{$title}}</h1></div>
                </div>
                <div class="elementor-element elementor-element-4f7b64a elementor-widget elementor-widget-text-editor"
                     data-id="4f7b64a" data-element_type="widget" data-widget_type="text-editor.default">
                    <div class="elementor-widget-container">

                        <p><a href="#">{{ __('landing.Home') }}</a> /
                            {{ request()->segment(1) == 'sections' && request()->segment(3) == 'details' ? __('landing.Departments') . ' / ' . $title : $title }}
                        </p></div>
                </div>
            </div>
        </div>
    </div>


</div>



