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
        :headerTitle="__('landing.fleet')"
        :image="$fleet->image"
        :title="$direction=='rtl'?$fleet->title_ar:$fleet->title_en"
        :description="$direction=='rtl'?$fleet->description_ar:$fleet->description_en"
    />
@endsection


