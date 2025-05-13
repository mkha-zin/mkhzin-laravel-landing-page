@php use App\Models\Header; @endphp
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
            column-gap: 1.5rem;
        }

        @media (max-width: 992px) {
            .masonry {
                column-count: 2;
            }
        }

        @media (max-width: 768px) {
            .masonry {
                column-count: 1;
            }
        }

        .masonry-item {
            break-inside: avoid;
            margin-bottom: 1.5rem;
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
                               class="list-group-item list-group-item-action {{ request('tag') ? '' : 'active bg-danger text-white' }} {{ $textAlignment }}">
                                {{ __('landing.All Posts') }}
                            </a>
                            @foreach($tags as $tag)
                                <a href="{{ url('blog?tag=' . $tag->id) }}"
                                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center
                               {{ request('tag') == $tag->id ? 'active bg-danger text-white' : '' }} {{ $textAlignment }}">
                                    {{ $lang == 'en' ? $tag->tag_en : $tag->tag_ar }}
                                    <span class="badge bg-danger text-white rounded-pill">{{ $tag->posts_count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Blog Posts -->
                    <div class="col-md-10">
                        <div class="masonry">
                            @foreach($posts as $post)
                                <div class="masonry-item">
                                    <article>
                                        <div class="card">
                                            <figure class="card-img-top m-0 overflow-hidden d-flex align-items-center">
                                                <img class="img-fluid" loading="lazy"
                                                     src="{{ asset('storage/' . $post->image) }}" alt="Business">
                                            </figure>
                                            <div class="card-body bg-white p-4 {{ $textAlignment }}">
                                                <div class="entry-header mb-3">
                                                    <a class="link-primary text-decoration-none" href="#!">
                                                        {{ $lang == 'en' ? $post->tag->tag_en : $post->tag->tag_ar }}
                                                    </a>
                                                    <h4 class="card-title">
                                                        <a href="{{ url('blog/' . $post->id) }}"
                                                           class="text-decoration-none">
                                                            {{ $lang == 'en' ? $post->title_en : $post->title_ar }}
                                                        </a>
                                                    </h4>
                                                </div>
                                                <p class="text-secondary mb-3"
                                                   style="display: -webkit-box; text-align:justify; word-break:keep-all; -webkit-box-orient: vertical; -webkit-line-clamp: 3; color: black; overflow: hidden; text-overflow: ellipsis;">
                                                    {{ \Filament\Support\Markdown::inline($lang == 'en' ? $post->article_en : $post->article_ar) }}
                                                </p>
                                                <a href="{{ url('blog/' . $post->id) }}"
                                                   class="btn btn-danger text-white">
                                                    {{ __('landing.Read More') }}
                                                </a>
                                            </div>
                                            <div
                                                class="card-footer border border-top-0 bg-light p-4 text-{{ $direction == 'rtl' ? 'end' : 'start' }}">
                                                <ul class="entry-meta list-unstyled d-flex align-items-center m-0">
                                                    <li>
                                                        <a class="fs-7 link-secondary text-decoration-none d-flex align-items-center"
                                                           href="#!">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                 fill="currentColor" class="bi bi-calendar3"
                                                                 viewBox="0 0 16 16">
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
