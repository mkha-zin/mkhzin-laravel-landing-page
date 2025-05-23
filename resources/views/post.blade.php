@php
    use Filament\Support\Markdown;use Illuminate\Support\Facades\App;
    use Carbon\Carbon;
@endphp
@extends('layouts.app')

@section('content')

    @php
        $lang = app()->currentLocale();
        $direction = $lang == 'ar' ? 'rtl' : 'ltr';
        $textAlignment = $lang == 'ar' ? 'text-right' : 'text-left';
    @endphp

    <div dir="{{ $direction }}">
        <section class="py-3 py-md-5 py-xl-8">
            <div class="container overflow-hidden">
                @if(!empty($post))
                    <div class="col-12 col-lg-12">
                        <article>
                            <div class="card">
                                <figure class="card-img-top m-0 w-full p-0 overflow-hidden bsb-overlay-hover d-flex
                                    align-items-center">
                                    <img class="img-fluid bsb-scale bsb-hover-scale-up" loading="lazy"
                                         src="{{ asset('storage/' . $post->image) }}" alt="Business">
                                </figure>
                                <div class="card-body bg-white p-4 text-{{ $direction == 'rtl' ? 'end' : 'start' }}">
                                    <div class="entry-header mb-3">
                                        <ul class="entry-meta list-unstyled d-flex mb-2">
                                            <li>
                                                <a class="link-primary text-decoration-none">
                                                    {{ $lang == 'en' ? $post->tag->tag_en : $post->tag->tag_ar }}
                                                </a>
                                            </li>
                                        </ul>
                                        <h2 class="card-title entry-title h4 mb-0 ">
                                            {{ $lang == 'en' ? $post->title_en : $post->title_ar }}
                                        </h2>
                                    </div>
                                    <style>
                                        .markdown-content p {
                                            font-size: 24px;
                                            line-height: 40px;
                                            word-break: keep-all;
                                            text-align: justify;
                                            color: #6c757d; /* text-secondary */
                                            margin-bottom: 1rem;
                                        }
                                    </style>
                                    <div class="card-text entry-summary markdown-content text-secondary mb-3">
                                        {{ $lang == 'en'
                                            ? Markdown::block($post->article_en)
                                            : Markdown::block($post->article_ar)
                                        }}
                                    </div>
                                </div>
                                <div
                                    class="card-footer border border-top-0 bg-light p-4 text-{{ $direction == 'rtl' ? 'end' : 'start' }}">
                                    <ul class="entry-meta list-unstyled d-flex align-items-center m-0">
                                        <li>
                                            <a class="fs-7 link-secondary text-decoration-none d-flex align-items-center">
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
                                        {{--<li>
                                            <span class="px-3">&bull;</span>
                                        </li>
                                        <li>
                                            <a class="link-secondary text-decoration-none d-flex align-items-center"
                                               href="#!">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                     fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                                    <path
                                                        d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125z"/>
                                                </svg>
                                                <span class="mx-2 fx-7">83</span>
                                            </a>
                                        </li>--}}
                                    </ul>
                                </div>
                            </div>
                        </article>
                    </div>
                @endif
            </div>
        </section>

        <section class="py-3 py-md-5 py-xl-8">
            <div class="mx-5">
                <div class="row mx-0 mx-lg-5">
                    <!-- Blog Posts -->
                    <div class="col-md-12">
                        <div class="row gy-4">
                            @foreach($posts as $post)
                                <div class="col-12 col-md-6 col-lg-4 mb-3">
                                    <article>
                                        <div class="card">
                                            <figure class="card-img-top m-0 overflow-hidden d-flex align-items-center"
                                                    style="height: auto;">
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
                                                            {{ app()->getLocale() == 'en' ? $post->title_en : $post->title_ar }}
                                                        </a>
                                                    </h4>
                                                </div>
                                                <p class="text-secondary mb-3"
                                                   style="display: -webkit-box; text-align:justify; word-break:keep-all; -webkit-box-orient: vertical; -webkit-line-clamp: 3; color: black; overflow: hidden; text-overflow: ellipsis;">
                                                    {{ app()->getLocale() == 'en' ? $post->article_en : $post->article_ar }}
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
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                 height="14"
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
