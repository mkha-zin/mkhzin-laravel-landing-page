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

    <style>
        /* Ensures all cards have the same height */
        .card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        /* Ensures card-body stretches */
        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        /* Ensures description text takes up remaining space */
        .card-body p {
            flex-grow: 1;
        }

        /* Ensures button is always at the bottom */
        .card-body .btn {
            margin-top: auto;
        }

        /* Ensures images have a consistent height */
        .card-img-top {
            height: 200px; /* Adjust height as needed */
            object-fit: cover;
        }
    </style>

    <div dir="{{ $direction }}">
        @include('includes.header_image', ['title' => __('landing.Blog'), 'image' => '$about->image'])

        <section class="py-3 py-md-5 py-xl-8">
            <div class="mx-5">
                <div class="row mx-0 mx-lg-5">
                    <!-- Sidebar -->
                    <div class="col-md-3 mb-3">
                        <div class="list-group">
                            <a href="{{ url('blog') }}" class="list-group-item list-group-item-action {{ request('tag') ? '' : 'active bg-danger text-white' }} {{ $textAlignment }}">
                                {{ __('landing.All Posts') }}
                            </a>
                            @foreach($tags as $tag)
                                <a href="{{ url('blog?tag=' . $tag->id) }}"
                                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center
                                   {{ request('tag') == $tag->id ? 'active bg-danger text-white' : '' }} {{ $textAlignment }}">
                                    {{ app()->getLocale() == 'en' ? $tag->tag_en : $tag->tag_ar }}
                                    <span class="badge bg-danger text-white rounded-pill">{{ $tag->posts_count }}</span>
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
                                            <figure class="card-img-top m-0 overflow-hidden d-flex align-items-center" style="height: auto;">
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
                                                <p class="text-secondary mb-3"
                                                   style="display: -webkit-box; text-align:justify; word-break:keep-all; -webkit-box-orient: vertical; -webkit-line-clamp: 3; color: black; overflow: hidden; text-overflow: ellipsis;">
                                                    {{ app()->getLocale() == 'en' ? $post->article_en : $post->article_ar }}
                                                </p>
                                                <a href="{{ url('blog/' . $post->id) }}" class="btn btn-danger text-white">
                                                    {{ __('landing.Read More') }}
                                                </a>
                                            </div>
                                            <div class="card-footer border border-top-0 bg-light p-4 text-{{ $direction == 'rtl' ? 'end' : 'start' }}">
                                                <ul class="entry-meta list-unstyled d-flex align-items-center m-0">
                                                    <li>
                                                        <a class="fs-7 link-secondary text-decoration-none d-flex align-items-center"
                                                           href="#!">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                 fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
                                                                <path
                                                                    d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                                            </svg>
                                                            <span class="mx-2 fx-7">
                                                        {{ $post->created_at->translatedFormat($lang == 'ar' ? 'd F Y' : 'M d Y') }}
                                                    </span>
                                                        </a>
                                                    </li>
                                                </ul>
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
