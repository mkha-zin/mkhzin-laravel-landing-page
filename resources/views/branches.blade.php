@php
    use App\Models\Header;use Illuminate\Support\Facades\App;
    use Carbon\Carbon
@endphp
@extends('layouts.app')
@section('content')

    @php
        $direction = app()->currentLocale() == 'ar' ? 'rtl' : 'ltr';
        $branchHeader = Header::where('key', 'branches')->first();
    @endphp


    @include('includes.header_image',[
    'title'=>__('landing.Branches'),
    'image' => $branchHeader->image,
    ])

    <div dir="{{$direction}}" data-elementor-type="wp-page" data-elementor-id="1222" class="elementor elementor-1222">
        <div data-elementor-type="wp-post" data-elementor-id="1244" class="elementor elementor-1244">
            <div class="elementor-element elementor-element-46f2bc0 e-flex e-con-boxed e-con e-parent" data-id="46f2bc0"
                 data-element_type="container">

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
                                <button class="btn text-white form-group col-2" type="submit"
                                        style="letter-spacing: 0 !important; border-radius: 5px">{{ __('landing.Search') }}</button>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>

                <style>
                    .card-wrapper {
                        display: flex;
                        flex-wrap: wrap;
                        gap: 20px;
                        justify-content: center;
                    }

                    .card-container {
                        background-color: #fff;
                        border-radius: 10px;
                        overflow: hidden;
                        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
                        display: flex;
                        flex-direction: column;
                        position: relative;
                        height: 460px;
                        width: 100%;
                        max-width: 100%;
                        min-width: 350px;
                        border: 1px solid red;
                    }

                    .card-image {
                        height: 300px;
                        overflow: hidden;
                    }

                    .card-image img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }

                    .card-content {
                        padding: 10px;
                        flex-grow: 1;
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                        align-items: center;
                        text-align: center;
                        margin-top: -50px;
                    }

                    .card-content h4 {
                        margin: 0;
                        font-size: 1.25rem;
                    }

                    .card-content h6 {
                        margin: 5px 0 0;
                        color: #555;
                        font-size: 0.95rem;
                    }

                    .card-buttons {
                        display: flex;
                        position: absolute;
                        bottom: 0;
                        width: 100%;
                    }

                    .card-buttons a {
                        flex: 1;
                        text-align: center;
                        padding: 12px;
                        color: white;
                        text-decoration: none;
                        font-weight: bold;
                    }

                    .card-buttons a:hover {
                        color: white !important;
                    }

                    .card-buttons a:first-child {
                        background-color: #df2228;
                    }

                    .card-buttons a:last-child {
                        background-color: #a72828;
                    }

                    /* Responsive columns */
                    @media (min-width: 992px) {
                        .card-container {
                            flex: 0 0 calc(33.333% - 20px); /* 3 per row */
                        }
                    }

                    @media (min-width: 768px) and (max-width: 991.98px) {
                        .card-container {
                            flex: 0 0 calc(50% - 20px); /* 2 per row */
                        }
                    }

                    @media (max-width: 767.98px) {
                        .card-container {
                            flex: 0 0 100%; /* 1 per row */
                        }
                    }
                </style>

                <div class="e-con-inner">
                    <div class="card-wrapper">
                        @if(!empty($branches))
                            @foreach($branches as $branch)
                                <div class="card-container">
                                    <!-- Image -->
                                    <div class="card-image">
                                        <img src="{{ asset('storage/'.$branch->image) }}" alt="">
                                    </div>

                                    <!-- Info -->
                                    <div class="card-content">
                                        <h4>
                                            {{ $direction == 'rtl' ? $branch->name_ar : $branch->name_en }}
                                        </h4>
                                        <h6>
                                            {{ $direction == 'rtl' ? $branch->city->name_ar : $branch->city->name_en }},
                                            {{ $direction == 'rtl' ? $branch->address_ar : $branch->address_en }}
                                        </h6>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="card-buttons">
                                        <a href="{{ route('branch.offers', $branch->id) }}">{{ __('landing.Offers') }}</a>
                                        <a href="{{ route('branch.details', $branch->id) }}">{{ __('landing.Know More') }}</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


