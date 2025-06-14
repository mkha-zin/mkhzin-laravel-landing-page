<!-- Blade Template: resources/views/social-hub.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Social Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center p-6">

<!-- Selected Card -->
<div id="selectedCard" class="w-full max-w-4xl bg-white shadow-lg rounded-2xl p-6 mb-10 flex flex-col md:flex-row items-center justify-center gap-6 transition-all duration-300">
    <div class="w-full md:w-1/2">
        <h2 id="platformName" class="text-2xl font-bold text-gray-800">Select a Platform</h2>
        <p id="platformDesc" class="text-gray-600 mt-2">Click any of the cards below to see more details.</p>
        <div class="mt-4 flex gap-4">
            <a id="platformLink" href="#" class="text-white px-4 py-2 rounded-xl shadow transition" style="background-color: #4F46E5;">Follow</a>
        </div>
    </div>
    <div class="w-full md:w-1/2 flex items-center">
        <svg id="platformSVG" class="w-full h-48" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <circle cx="100" cy="100" r="80" fill="#4F46E5" />
            <text x="100" y="115" text-anchor="middle" fill="white" font-size="36" font-family="Arial">?</text>
        </svg>
    </div>
</div>

<!-- Social Cards Grid -->
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 w-full max-w-4xl">
    @foreach ($socialLinks as $social)
        <div
            onclick="selectPlatform(
                '{{ $social->title_en }}',
                '{{ $social->comment_en ?? 'No description available.' }}',
                '{{ $social->color ?? '#4F46E5' }}',
                '{{ $social->link }}'
            )"
            class="cursor-pointer rounded-xl shadow hover:shadow-lg p-4 text-center text-white"
            style="background-color: {{ $social->color ?? '#4F46E5' }}"
        >
            <i class="ph-bold ph-{{ strtolower($social->key) }}-logo text-3xl"></i>
            <p class="mt-2 font-semibold">{{ $social->title_en }}</p>
        </div>
    @endforeach
</div>

<script>
    function selectPlatform(name, desc, color, link) {
        document.getElementById('platformName').textContent = name;
        document.getElementById('platformDesc').textContent = desc;
        document.getElementById('platformLink').href = link;
        document.getElementById('platformLink').style.backgroundColor = color;
        document.getElementById('platformLink').textContent = name.includes('Join') ? 'Join' : 'Follow';

        document.getElementById('platformSVG').innerHTML = `
            <circle cx=\"100\" cy=\"100\" r=\"80\" fill=\"${color}\" />
            <text x=\"100\" y=\"115\" text-anchor=\"middle\" fill=\"white\" font-size=\"36\" font-family=\"Arial\">${name.charAt(0)}</text>
        `;
    }
</script>

</body>
</html>
