@php
    use Illuminate\Support\Facades\App;
    use Carbon\Carbon;
@endphp
@extends('layouts.app')

@section('content')

    @php
        $lang = app()->currentLocale();
        $direction = $lang == 'ar' ? 'rtl' : 'ltr';
        $textAlignment = $lang == 'ar' ? 'text-right' : 'text-left'; // For aligning text
    @endphp

    <div dir="{{ $direction }}">
        @include('includes.header_image', ['title' => __('landing.Blog'), 'image' => '$about->image'])

        <section class="py-3 py-md-5 py-xl-8">
            <div class="mx-5">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-md-3">
                        <div class="list-group">
                            <a href="{{ url('blog') }}" class="list-group-item list-group-item-action {{ request('tag') ? '' : 'active' }} {{ $textAlignment }}">
                                {{ __('landing.All Posts') }}
                            </a>
                            @foreach($tags as $tag)
                                <a href="{{ url('blog?tag=' . $tag->id) }}"
                                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center
                                   {{ request('tag') == $tag->id ? 'active' : '' }} {{ $textAlignment }}">
                                    {{ app()->getLocale() == 'en' ? $tag->tag_en : $tag->tag_ar }}
                                    <span class="badge bg-primary rounded-pill">{{ $tag->posts_count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Blog Posts -->
                    <div class="col-md-9">
                        <div class="row gy-4">
                            @foreach($posts as $post)
                                <div class="col-12 col-lg-6">
                                    <article>
                                        <div class="card">
                                            <figure class="card-img-top m-0 overflow-hidden d-flex align-items-center" style="height: 400px;">
                                                <img class="img-fluid" loading="lazy" src="{{ asset('storage/' . $post->image) }}" alt="Business">
                                            </figure>
                                            <div class="card-body bg-white p-4 {{ $textAlignment }}">
                                                <div class="entry-header mb-3">
                                                    <a class="link-primary text-decoration-none" href="#!">
                                                        {{ $lang == 'en' ? $post->tag->tag_en : $post->tag->tag_ar }}
                                                    </a>
                                                    <h4 class="card-title">
                                                        <a href="{{ url('blog/' . $post->id) }}" class="text-decoration-none">
                                                            {{ app()->getLocale() == 'en' ? $post->title_en : $post->title_ar }}
                                                        </a>
                                                    </h4>
                                                </div>
                                                <p class="text-secondary mb-3" style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
                                                    {{ app()->getLocale() == 'en' ? $post->article_en : $post->article_ar }}
                                                </p>
                                                <a href="{{ url('blog/' . $post->id) }}" class="btn btn-danger">
                                                    {{ __('landing.Read More') }}
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
