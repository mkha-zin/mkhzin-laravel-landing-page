<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Social Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        .active-card {
            border-width: 2px;
            border-color: #00ff20;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center p-6">

<!-- Top Selected Card -->
<div id="selectedCard"
     class="w-full max-w-4xl bg-white shadow-lg rounded-2xl p-6 mb-10 flex flex-col md:flex-row items-center gap-6 transition-all duration-300">
    <div class="w-full md:w-1/2">
        <h2 id="platformName" class="text-2xl font-bold text-gray-800">Select a Platform</h2>
        <p id="platformDesc" class="text-gray-600 mt-2">Click any of the cards below to see more details.</p>
        <div class="mt-4 flex gap-4">
            <a id="platformLink" href="#"
               class="bg-indigo-600 text-white px-4 py-2 rounded-xl shadow hover:bg-indigo-700 transition">Follow</a>
        </div>
    </div>
    <div class="w-full md:w-1/2">
        <svg id="platformSVG" class="w-full h-48" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <circle cx="100" cy="100" r="80" fill="#4F46E5"/>
            <text x="100" y="115" text-anchor="middle" fill="white" font-size="36" font-family="Arial">?</text>
        </svg>
    </div>
</div>

<!-- Cards Grid -->
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 w-full max-w-4xl">
    <div onclick="selectPlatform(
        'Facebook',
        'Join our Facebook community for latest updates!',
        '#1877F2',
        'https://facebook.com',
        'logo-facebook'
        )"
         class="cursor-pointer bg-white rounded-xl shadow hover:shadow-lg p-4 text-center">
        <i class="ph-bold ph-facebook-logo text-3xl text-[#1877F2]"></i>
        <p class="mt-2 font-semibold text-[#1877F2]">Facebook</p>
    </div>
    <div
        onclick="selectPlatform('Whatsapp', 'Follow us on Whatsapp for stunning visuals.', '#31df16', 'https://wa.com', 'logo-whatsapp')"
        class="cursor-pointer bg-white rounded-xl shadow hover:shadow-lg p-4 text-center">
        <i class="ph-bold ph-whatsapp-logo text-3xl text-[#31df16]"></i>
        <p class="mt-2 font-semibold text-[#31df16]">Whatsapp</p>
    </div>
    <div
        onclick="selectPlatform('Instagram', 'Follow us on Instagram for stunning visuals.', '#E1306C', 'https://instagram.com', 'logo-instagram')"
        class="cursor-pointer bg-white rounded-xl shadow hover:shadow-lg p-4 text-center">
        <i class="ph-bold ph-instagram-logo text-3xl text-[#E1306C]"></i>
        <p class="mt-2 font-semibold text-[#E1306C]">Instagram</p>
    </div>
    <div
        onclick="selectPlatform('Twitter', 'Stay updated with our latest tweets.', '#1DA1F2', 'https://twitter.com', 'logo-twitter')"
        class="cursor-pointer bg-white rounded-xl shadow hover:shadow-lg p-4 text-center">
        <i class="ph-bold ph-twitter-logo text-3xl text-[#1DA1F2]"></i>
        <p class="mt-2 font-semibold text-[#1DA1F2]">Twitter</p>
    </div>
    <div
        onclick="selectPlatform('YouTube', 'Subscribe for videos and updates.', '#FF0000', 'https://youtube.com', 'logo-youtube')"
        class="cursor-pointer bg-white rounded-xl shadow hover:shadow-lg p-4 text-center">
        <i class="ph-bold ph-youtube-logo text-3xl text-[#FF0000]"></i>
        <p class="mt-2 font-semibold text-[#FF0000]">YouTube</p>
    </div>
</div>

<script>
    function selectPlatform(name, desc, color, link, icon) {
        document.getElementById('platformName').textContent = name;
        document.getElementById('platformDesc').textContent = desc;
        document.getElementById('platformLink').href = link;
        document.getElementById('platformLink').textContent = name.includes('Join') ? 'Join' : 'Follow';

        document.getElementById('platformSVG').innerHTML = `
        <circle cx="100" cy="100" r="80" fill="${color}" />
        <text x="100" y="115" text-anchor="middle" fill="white" font-size="36" font-family="Arial">${name.charAt(0)}</text>`;
    }
</script>

</body>
</html>
