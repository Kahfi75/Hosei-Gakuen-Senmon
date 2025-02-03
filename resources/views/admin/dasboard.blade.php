@extends('layout.admin')

@section('content')
    <main class="flex-1 p-6">
        <!-- Dashboard Content -->
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Dashboard</h1>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <!-- Total Barang -->
            <div class="bg-white p-6 shadow-lg rounded-lg w-full flex flex-col items-center hover:shadow-xl transition-all">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Jumlah Barang</h3>
                <p class="text-3xl font-bold text-indigo-600">150</p>
            </div>

            <!-- Total Peminjaman -->
            <div class="bg-white p-6 shadow-lg rounded-lg w-full flex flex-col items-center hover:shadow-xl transition-all">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Jumlah Peminjaman</h3>
                <p class="text-3xl font-bold text-indigo-600">45</p>
            </div>

            <!-- Total Pengguna -->
            <div class="bg-white p-6 shadow-lg rounded-lg w-full flex flex-col items-center hover:shadow-xl transition-all">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Jumlah Pengguna</h3>
                <p class="text-3xl font-bold text-indigo-600">250</p>
            </div>
        </div>

        <!-- Grafik Peminjaman -->
        <div class="bg-white p-6 shadow-lg rounded-lg mt-6">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">Grafik Peminjaman</h3>
            <canvas id="loanChart" class="h-64 w-full"></canvas>
        </div>
    </main>
@endsection

@push('scripts')
    <!-- Chart.js Script -->
    <script>
        const ctx = document.getElementById('loanChart').getContext('2d');
        const loanChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Jumlah Peminjaman',
                    data: [5, 3, 15, 10, 30, 25],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(75, 192, 192, 1)',
                    pointHoverBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        backgroundColor: '#333',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
