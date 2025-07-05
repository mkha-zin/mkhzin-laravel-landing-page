@php use App\Models\Header;use Filament\Support\Markdown; @endphp
@extends('layouts.app')

@section('content')

    @php
        $lang = app()->currentLocale();
        $direction = $lang == 'ar' ? 'rtl' : 'ltr';
        $textAlignment = $lang == 'ar' ? 'text-right' : 'text-left';
        $newsHeader = Header::where('key', 'news')->first();
    @endphp

    <style>
        .masonry {
            column-count: 3;
            column-gap: 2rem;
            /* Increased gap between columns */
        }

        @media (max-width: 992px) {
            .masonry {
                column-count: 2;
                column-gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .masonry {
                column-count: 1;
                column-gap: 1rem;
            }
        }

        .masonry-item {
            break-inside: avoid;
            margin-bottom: 2rem;
            /* Increased bottom margin */
            border: 1px solid #d30000;
            border-radius: 5px;
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            height: 530px;
            /* Fixed height for all cards */
        }

        .masonry-item .card {
            height: 100%;
            display: flex;
            flex-direction: column;
            /* margin: 0.5rem; */
            /* Add margin inside each card container */
            border-radius: 8px;
        }

        .masonry-item .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .masonry-item .card-body p {
            flex: 1;

        }

        .card-title {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.3;
            height: calc(1.3em * 2);
            /* Fixed height for 2 lines */
        }

        .card-description {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.4;
            height: calc(1.4em * 3);
            /* Fixed height for 3 lines */
        }
    </style>

    <div dir="{{ $direction }}">
        @include('includes.header_image', ['title' => __('landing.News'), 'image' => $newsHeader->image])

        <section class="py-3 py-md-5 py-xl-8">
            <div class="mx-5">
                <div class="row mx-0 mx-lg-5">
                    <!-- Sidebar -->
                    <div class="col-md-2 mb-3">
                        <div class="list-group">
                            <a href="{{ url('blog') }}"
                                class="list-group-item list-group-item-action
                                                                                                                                                {{ request('tag') ? '' : 'active bg-danger text-white' }}
                                                                                                                                                {{ $textAlignment }}">
                                {{ __('landing.All Posts') }}
                            </a>
                            @foreach($tags as $tag)
                                <a href="{{ url('blog?tag=' . $tag->tag_en) }}"
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center
                                                                                                                                                                                                                                           {{ request('tag') == $tag->tag_en ? 'active bg-danger text-white' : '' }} {{ $textAlignment }}">
                                    {{ $lang == 'en' ? $tag->tag_en : $tag->tag_ar }}
                                    <span class="badge bg-danger text-white rounded-pill">{{ $tag->posts_count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <!-- Blog Posts -->
                    <div class="col-md-10">
                        <div class="masonry"> <!-- Add padding to masonry container -->
                            @foreach($posts as $post)
                                <div class="masonry-item">
                                    <article>
                                        <div class="card">
                                            <figure class="card-img-top m-0 overflow-hidden d-flex align-items-center"
                                                style="height: 200px;">
                                                <img class="img-fluid" loading="lazy"
                                                    src="{{ asset('storage/' . $post->image) }}" alt="Business"
                                                    style="width: 100%; height: 100%; object-fit: cover;">
                                            </figure>
                                            <div
                                                class="card-body bg-white p-4 {{ $textAlignment }} d-flex flex-column justify-content-between">
                                                <div>
                                                    <div class="entry-header mb-1">
                                                        <span class="badge text-danger" style="background-color: #ffeeee">
                                                            {{ $lang == 'en' ? $post->tag->tag_en : $post->tag->tag_ar }}
                                                        </span>
                                                        <h4 class="card-title">
                                                            <a href="{{ url('blog/' . $post->id) }}"
                                                                class="text-decoration-none">
                                                                {{ $lang == 'en' ? $post->title_en : $post->title_ar }}
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <p class="text-secondary mb-3 card-description"
                                                        style="text-align:justify; word-break:keep-all; color: black;">
                                                        {{ Markdown::inline($lang == 'en' ? $post->article_en : $post->article_ar) }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <div class="mb-2 text-{{ $direction == 'rtl' ? 'end' : 'start' }}">
                                                        <small class="fs-7 text-muted d-flex align-items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                                                                <path
                                                                    d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                                            </svg>
                                                            <span class="mx-2">
                                                                {{ $post->created_at->translatedFormat($lang == 'ar' ? 'd F Y' : 'M d Y') }}
                                                            </span>
                                                        </small>
                                                    </div>
                                                    <a href="{{ url('blog/' . $post->id) }}"
                                                        class="btn btn-danger text-white w-100">
                                                        {{ __('landing.Read More') }}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-footer border border-top-0 bg-light p-2 d-none">
                                                <ul class="entry-meta list-unstyled d-flex align-items-center m-0">
                                                    <li>
                                                        <a
                                                            class="fs-7 link-secondary text-decoration-none d-flex align-items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                                                                <path
                                                                    d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                                            </svg>
                                                            <span class="mx-2">
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