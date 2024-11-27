@php
    use Carbon\Carbon
@endphp
@extends('layouts.app')
@section('content')

    @php
        $direction = app()->currentLocale() == 'ar' ? 'rtl' : 'ltr'
    @endphp

    <x-subPagesStyle
        :headerTitle="$direction=='rtl'?$section->title_ar:$section->title_en"
        :image="$section->image"
        :title="$direction=='rtl'?$section->title_ar:$section->title_en"
        :description="$direction=='rtl'?$section->description_ar:$section->description_en"
    />
@endsection


