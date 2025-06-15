@php
    $lang = App::currentLocale();
    $dir = $lang == 'ar' ? 'rtl' : 'ltr';
@endphp

<!DOCTYPE html>
<html lang="{{ $lang }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('landing.Social Hub') }} | {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <!--Favicon-->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/mkhazin/fav.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Cairo:wght@200..1000&display=swap" rel="stylesheet">


</head>
<body style="font-family: Alexandria, sans-serif" class="bg-gray-50 min-h-screen flex flex-col items-center justify-center p-6">

<div style="color: #bd0000; font-weight: bold" class="w-full max-w-4xl bg-white shadow-md rounded-2xl p-4 mb-6 flex flex-col md:flex-row items-center justify-center">
    <h2>{{ config('app.name') }}</h2>
</div>
<!-- Selected Card -->
<div id="selectedCard" class="w-full max-w-4xl bg-white shadow-lg rounded-2xl p-6 mb-10 flex flex-col md:flex-row items-center justify-center gap-6 transition-all duration-300">
    <div class="w-full md:w-1/2">
        <h2 id="platformName" class="text-2xl font-bold text-gray-800">
            {{ __('landing.Select a Platform') }}
        </h2>
        <p id="platformDesc" class="text-gray-600 mt-2">
            {{ __('landing.Click any of the cards below to see more details.') }}
        </p>
        <div class="mt-4 flex gap-4">
            <a id="platformLink" href="#" target="_blank" class="text-white px-4 py-2 rounded-xl shadow transition"
               style="background-color: #bd0000;">{{ __('landing.Agree') }}</a>
        </div>
    </div>
    <div class="w-full md:w-1/2 flex items-center">
        <svg id="platformSVG" class="w-full h-48" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <circle cx="100" cy="100" r="80" fill="#bd0000" />
            <text x="100" y="115" text-anchor="middle" fill="white" font-size="36" font-family="Arial">?</text>
        </svg>
    </div>
</div>

<!-- Social Cards Grid -->
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 w-full max-w-4xl">
    @foreach ($socialLinks as $social)
        <div
            onclick="selectPlatform(
                    '{{ $lang === 'ar' ? $social->title_ar : $social->title_en }}',
                    '{{ $lang === 'ar' ? $social->comment_ar ?? 'لا يوجد وصف.' : $social->comment_en ?? 'No description available.' }}',
                    '{{ $social->color ?? '#4F46E5' }}',
                    '{{ $social->link }}',
                    'ph-bold ph-{{ strtolower($social->key) }}-logo'
                )"

            class="cursor-pointer rounded-xl shadow hover:shadow-lg p-4 text-center text-white"
            style="background-color: {{ $social->color ?? '#4F46E5' }}"
        >
            <i class="ph-bold ph-{{ strtolower($social->key) }}-logo text-3xl"></i>
            <p class="mt-2 font-semibold">{{ $lang === 'ar' ? $social->title_ar : $social->title_en }}</p>
        </div>
    @endforeach
</div>

<script>
    function selectPlatform(name, desc, color, link, iconClass) {
        document.getElementById('platformName').textContent = name;
        document.getElementById('platformDesc').textContent = desc;
        document.getElementById('platformLink').href = link;
        document.getElementById('platformLink').style.backgroundColor = color;

        document.getElementById('platformSVG').innerHTML = `
            <circle cx="100" cy="100" r="80" fill="${color}" />
            <foreignObject x="60" y="60" width="80" height="80">
                <div xmlns="http://www.w3.org/1999/xhtml" class="${iconClass}" style="color: white; font-size: 80px; display: flex; justify-content: center; align-items: center; height: 80px; width: 80px;"></div>
            </foreignObject>
        `;
    }
</script>

</body>
</html>
