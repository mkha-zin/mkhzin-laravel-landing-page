@php
    $lang = App::currentLocale();
    $dir = $lang == 'ar' ? 'rtl' : 'ltr';
@endphp

    <!DOCTYPE html>
<html lang="{{ $lang }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ __('landing.Social Hub') }} | {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <!--Favicon-->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/mkhazin/fav.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Cairo:wght@200..1000&display=swap"
        rel="stylesheet">
</head>
<body style="font-family: Alexandria, sans-serif"
      class="bg-gray-50 min-h-screen flex flex-col items-center justify-center p-6">

<div style="color: white; background-image: url({{ asset('images/svg/Overlay.svg') }}); font-weight: bold"
     class="w-full max-w-4xl bg-white shadow-md rounded-2xl p-4 mb-6 flex flex-col md:flex-row items-center justify-center">
    <a href="{{ url('/') }}">
        <h2>{{ __('landing.Makhazin SuperMarket') }}</h2>
    </a>
</div>

@if (!empty($socialLink))
    <!-- Selected Card -->
    <div id="selectedCard"
         class="w-full max-w-4xl bg-white shadow-lg rounded-2xl p-6 mb-10 flex flex-col md:flex-row items-center justify-center gap-6 transition-all duration-300">
        <div class="w-full md:w-1/2">
            <h2 id="platformName" class="text-2xl font-bold text-gray-800">
                {{ addslashes($lang === 'ar' ? $socialLink->title_ar : $socialLink->title_en) }}
            </h2>
            <p id="platformDesc" class="text-gray-600 mt-2">
                {{ addslashes($lang === 'ar' ? ($socialLink->comment_ar ?? 'لا يوجد وصف.') : ($socialLink->comment_en ?? 'No description available.')) }}
            </p>
            <div class="mt-4 flex gap-4">
                <a id="platformLink" href="{{ $socialLink->link }}" target="_blank" class="text-white px-4 py-2 rounded-xl shadow transition"
                   style="background-color: {{ $socialLink->color ?? '#bd0000' }};">
                    {{ addslashes(__('landing.Go to') . ' ' . ($lang === 'ar' ? $socialLink->title_ar : $socialLink->title_en)) }}
                </a>
            </div>
        </div>
        <div class="w-full md:w-1/2 flex items-center">
            <svg id="platformSVG" class="w-full h-48" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <circle cx="100" cy="100" r="80" fill="{{ $socialLink->color ?? '#bd0000' }}"/>
                <foreignObject x="60" y="60" width="80" height="80">
                    <div xmlns="http://www.w3.org/1999/xhtml" class="{{ 'ph-bold ph-' . strtolower($socialLink->key) . '-logo'  }}" style="color: {{ strtolower($socialLink->key) === 'snapchat' ? '#000000' : '#ffffff' }}; font-size: 80px;
                display: flex; justify-content: center; align-items: center; height: 80px; width: 80px;"></div>
                </foreignObject>
            </svg>
        </div>
    </div>
@endif

</body>
</html>
