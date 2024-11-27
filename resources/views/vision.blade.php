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
        :headerTitle="__('landing.vision')"
        :image="$vision->image"
        :title="$direction=='rtl'?$vision->title_ar:$vision->title_en"
        :description="$direction=='rtl'?$vision->description_ar:$vision->description_en"
    />
@endsection


