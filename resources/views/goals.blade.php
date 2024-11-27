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
        :headerTitle="__('landing.goals')"
        :image="$goals->image"
        :title="$direction=='rtl'?$goals->title_ar:$goals->title_en"
        :description="$direction=='rtl'?$goals->description_ar:$goals->description_en"
    />
@endsection


