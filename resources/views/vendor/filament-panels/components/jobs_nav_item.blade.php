<div x-data="{ open: false }" class="relative inline-block text-right">
    <!-- Toggle Button -->
    <style>
        .jobs-portal-btn {
            height: 36px;
            width: 36px;
            padding: 5px;
            border: 1px solid #e02128;
            border-radius: 8px;
            color: #e02128;
        }

        .jobs-portal-btn:hover {
            background-color: #e02128;
            color: white;
        }

        .mkhzin-menu-item {
            width: 180px;
            color: black;
        }

        .mkhzin-menu-item:hover {
            background-color: #e02128;
            color: white;
            border-radius: 10px;
        }
    </style>
    <button @click="open = !open" class="jobs-portal-btn inline-flex items-center gap-2 font-bold" type="button">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672Zm-7.518-.267A8.25 8.25 0 1 1 20.25 10.5M8.288 14.212A5.25 5.25 0 1 1 17.25 10.5"/>
        </svg>

    </button>

    <!-- Dropdown Menu -->
    <div x-show="open" @click.away="open = false"
         class="absolute right-0 mt-2 rounded-md shadow-lg bg-white dark:bg-gray-800 z-50 transition"
         x-cloak>
        <div class="py-1">
            <!-- First Button - Orange -->
            <a href="{{ route('filament.jobs.pages.dashboard') }}"
               class="mkhzin-menu-item flex items-center justify-between px-4 py-2 text-sm font-semibold">
                {{ __('dashboard.Jobs Portal') }}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" style="width: 30px; height: 30px">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z"/>
                </svg>
            </a>

            <!-- Second Button - Blue -->
            <a href="{{ route('filament.app.pages.dashboard') }}"
               class="mkhzin-menu-item flex items-center justify-between px-4 py-2 text-sm font-semibold">
                {{ __('dashboard.App Panel') }}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" style="width: 30px; height: 30px">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/>
                </svg>
            </a>
        </div>
    </div>
</div>
