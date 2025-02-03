<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <!-- Add Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Add Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Add Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Custom Transitions */
        .transition-all {
            transition: all 0.3s ease;
        }

        #submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-in-out;
        }

        #submenu.open {
            max-height: 500px;
        }

        /* Adjusted submenu for better visibility */
        #submenu-inventaris,
        #submenu-laporan {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-in-out;
        }

        #submenu-inventaris.open,
        #submenu-laporan.open {
            max-height: 500px;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <nav class="bg-gradient-to-b from-indigo-600 to-indigo-700 w-full md:w-64 text-white flex flex-col h-screen">
            <div class="p-4 text-center text-2xl font-semibold border-b border-indigo-800">
                <span class="text-white">Inventory System</span>
            </div>

            <ul class="flex-1 mt-4 space-y-2">
                <!-- Home -->
                <li class="py-2 px-4 hover:bg-indigo-700 rounded-lg transition-all">
                    <a href="/super-user/dashboard" class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M10 2a8 8 0 100 16 8 8 0 000-16zM8.707 10.293a1 1 0 011.414 0l2 2a1 1 0 11-1.414 1.414L10 12.414l-1.293 1.293a1 1 0 11-1.414-1.414l2-2z" />
                        </svg>
                        <span>Home</span>
                    </a>
                </li>

                <!-- Barang Inventaris -->
                <li class="py-2 px-4 hover:bg-indigo-700 rounded-lg transition-all">
                    <button onclick="toggleSubmenu('submenu-inventaris')" class="flex items-center space-x-2 w-full focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm0 2h12v4H4V5z" />
                        </svg>
                        <span>Barang Inventaris</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-auto" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <ul id="submenu-inventaris" class="ml-6 mt-2 space-y-2">
                        <li class="py-2 px-4 hover:bg-indigo-800 rounded-lg transition-all">
                            <a href="/super-user/daftar-barang">Daftar Barang</a>
                        </li>
                        <li class="py-2 px-4 hover:bg-indigo-800 rounded-lg transition-all">
                            <a href="/super-user/penerimaan-barang">Penerimaan Barang</a>
                        </li>
                    </ul>
                </li>

                <!-- Laporan -->
                <li class="py-2 px-4 hover:bg-indigo-700 rounded-lg transition-all">
                    <button onclick="toggleSubmenu('submenu-laporan')" class="flex items-center space-x-2 w-full focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm4 2h4v2H8V5zM6 7v2h2V7H6zm6 0v2h2V7h-2zm2 4h-2v2h2v-2zm-6 0H6v2h2v-2z" />
                        </svg>
                        <span>Laporan</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-auto" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <ul id="submenu-laporan" class="ml-6 mt-2 space-y-2">
                        <li class="py-2 px-4 hover:bg-indigo-800 rounded-lg transition-all">
                            <a href="/super-user/laporan-barang">Laporan Barang</a>
                        </li>
                        <li class="py-2 px-4 hover:bg-indigo-800 rounded-lg transition-all">
                            <a href="/super-user/laporan-peminjaman">Laporan Peminjaman</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col h-screen overflow-auto">
            <header class="bg-white shadow p-4 flex items-center justify-end space-x-4">
                <div class="flex items-center space-x-4">
                    <button class="text-gray-500 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 17h5l-1.405-1.405a2.032 2.032 0 00-.595-1.395L16 12m-6 5l-4-4 1.405-1.405c.367-.367.911-.53 1.395-.595L12 10" />
                        </svg>
                    </button>
                    <img src="https://via.placeholder.com/40" alt="Profile" class="w-10 h-10 rounded-full">
                </div>
            </header>

            <!-- Content Goes Here -->
            @yield('content')
        </div>
    </div>

    <!-- Add Custom JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        function toggleSubmenu(submenuId) {
            const allSubmenus = document.querySelectorAll("ul[id^='submenu']");

            // Close all other submenus
            allSubmenus.forEach((submenu) => {
                if (submenu.id !== submenuId) {
                    submenu.classList.remove('open');
                }
            });

            // Toggle the selected submenu
            const submenu = document.getElementById(submenuId);
            submenu.classList.toggle('open');
        }
    </script>

    @stack('scripts')
</body>

</html>
