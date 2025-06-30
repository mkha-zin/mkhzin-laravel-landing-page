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

<!-- Social Cards Grid -->
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 w-full max-w-4xl">
    @foreach ($socialLinks as $index => $social)
        <a href="{{ $social->link }}" target="_blank"
           style="background-color: {{ $social->color ?? '#4F46E5' }}; color: {{ strtolower($social->key) === 'snapchat' ? '#000000' : '#ffffff' }}"
           class="cursor-pointer rounded-xl shadow hover:shadow-lg p-4 text-center transition-all duration-300 transform">
            <div class="h-full text-center">
                <i class="ph-bold ph-{{ strtolower($social->key) }}-logo text-4xl"></i>
                <p class="mt-2 font-semibold">{{ $lang === 'ar' ? $social->title_ar : $social->title_en }}</p>
                <p class="mt-1 text-sm">{{ $lang === 'ar' ? $social->comment_ar : $social->comment_en }}</p>
            </div>
        </a>
    @endforeach
</div>
</body>
</html>
