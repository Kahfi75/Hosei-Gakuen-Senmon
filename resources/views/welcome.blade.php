<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <!-- Link to Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Link to Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-blue-500 to-teal-500">
        <div class="text-center text-white">
            <h1 class="text-5xl font-extrabold mb-8">Selamat Datang di Aplikasi Manajemen Inventaris</h1>
            <p class="text-xl mb-8">Kelola barang inventaris sekolah Anda dengan mudah dan efisien</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <!-- Super User Card -->
                <div class="bg-white text-center p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300">
                    <i class="bi bi-person-circle text-4xl text-blue-500 mb-4"></i>
                    <h5 class="text-2xl font-semibold mb-2">Super User</h5>
                    <p class="text-gray-700 mb-4">Akses penuh untuk mengelola aplikasi.</p>
                    <a href="#" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">Login</a>
                </div>

                <!-- Admin Card -->
                <div class="bg-white text-center p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300">
                    <i class="bi bi-shield-lock text-4xl text-teal-500 mb-4"></i>
                    <h5 class="text-2xl font-semibold mb-2">Admin</h5>
                    <p class="text-gray-700 mb-4">Kelola data dan manajemen barang inventaris.</p>
                    <a href="#" class="bg-teal-500 text-white py-2 px-4 rounded-lg hover:bg-teal-700 transition duration-300">Login</a>
                </div>

                <!-- Operator Card -->
                <div class="bg-white text-center p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300">
                    <i class="bi bi-person-check text-4xl text-green-500 mb-4"></i>
                    <h5 class="text-2xl font-semibold mb-2">Operator</h5>
                    <p class="text-gray-700 mb-4">Melakukan peminjaman dan pengembalian barang.</p>
                    <a href="#" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition duration-300">Login</a>
                </div>
            </div>

            <footer class="mt-12 text-gray-600">
                <p>&copy; 2025 Aplikasi Manajemen Inventaris. Semua hak dilindungi.</p>
            </footer>
        </div>
    </div>

</body>
</html>
