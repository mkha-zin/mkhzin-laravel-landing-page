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

                <div class="e-con-inner">
                    <div class="elementor-element elementor-element-0797a1f e-con-full e-flex e-con e-child"
                         data-id="0797a1f" data-element_type="container">
                        <div class="elementor-element elementor-element-8ca1759 e-con-full e-flex e-con e-child"
                             data-id="8ca1759" data-element_type="container">
                            <div class="elementor-element elementor-element-5ad687a e-con-full e-flex e-con e-child"
                                 data-id="5ad687a" data-element_type="container">
                                @if(!empty($branches))
                                    @foreach($branches as $branch)
                                        <div class="card-container"
                                             style="position: relative; border-radius: 10px; overflow: hidden; width: 32%;
                                             height: 500px; display: flex; flex-direction: column; justify-content:
                                             space-between; border: 1px solid #ccc;">
                                            <!-- Image -->
                                            <div style="height: 300px; overflow: hidden;">
                                                <img decoding="async"
                                                     src="{{ asset('storage/'.$branch->image) }}"
                                                     alt=""
                                                     style="width: 100%; height: 100%; object-fit: cover;">
                                            </div>

                                            <!-- Info Section -->
                                            <div style="padding: 10px; flex-grow: 1;">
                                                <h4 style="margin: 0; font-size: 1.25rem;">
                                                    {{ $direction == 'rtl' ? $branch->name_ar : $branch->name_en }}
                                                </h4>
                                                <h6 style="margin: 5px 0 0 0; color: #555;">
                                                    {{ $direction == 'rtl' ? $branch->city->name_ar : $branch->city->name_en }},
                                                    {{ $direction == 'rtl' ? $branch->address_ar : $branch->address_en }}
                                                </h6>
                                            </div>

                                            <!-- Button Section -->
                                            <div style="display: flex; flex-direction: row; width: 100%; position: absolute;
                                            bottom: 0; left: 0;">
                                                <a href="{{ route('branch.offers', $branch->id) }}"
                                                   style="flex: 1; text-align: center; background-color: #df2228;
                                                   padding: 12px; color: white; text-decoration: none; border-right: 1px solid #fff;">
                                                    {{ __('landing.Offers') }}
                                                </a>
                                                <a href="{{ route('branch.details', $branch->id) }}"
                                                   style="flex: 1; text-align: center; background-color: #a72828;
                                                   padding: 12px; color: white; text-decoration: none;">
                                                    {{ __('landing.Know More') }}
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


