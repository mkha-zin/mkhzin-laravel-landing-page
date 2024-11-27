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
        :headerTitle="__('landing.storage')"
        :image="$storage->background_image"
        :title="$direction=='rtl'?$storage->title_ar:$storage->title_en"
        :description="$direction=='rtl'?$storage->description_ar:$storage->description_en"
    />

@endsection


