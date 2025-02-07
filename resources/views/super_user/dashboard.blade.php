<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Super User</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            display: flex;
        }
        #sidebar {
            width: 250px;
            height: 100vh;
            background: #343a40;
            color: white;
            position: fixed;
            padding: 15px;
            overflow-y: auto;
        }
        #content {
            margin-left: 250px;
            width: 100%;
            padding: 20px;
        }
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
                transition: all 0.3s;
            }
            #content {
                margin-left: 0;
            }
            #sidebar.active {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div id="sidebar">
        <h4>Super User</h4>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="#" class="nav-link text-white">HOME</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">BARANG INVENTARIS</a>
                <ul class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('super_user.baranginventaris.index') }}">Daftar Barang</a>
                    <li><a class="dropdown-item" href="{{ route('super_user.baranginventaris.penerimaan') }}">Penerimaan Barang</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">PEMINJAMAN BARANG</a>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('super_user.peminjaman.index') }}">Daftar Peminjaman</a></li>
                    <li><a class="dropdown-item" href="#">Pengembalian Barang</a></li>
                    <li><a class="dropdown-item" href="#">Barang Belum Kembali</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">LAPORAN</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Laporan Daftar Barang</a></li>
                    <li><a class="dropdown-item" href="#">Laporan Pengembalian Barang</a></li>
                    <li><a class="dropdown-item" href="#">Laporan Status Barang</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">REFERENSI</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Jenis Barang</a></li>
                    <li><a class="dropdown-item" href="#">Daftar Pengguna</a></li>
                </ul>
            </li>
        </ul>
    </div>
    
    <!-- Main Content -->
    <div id="content">
        <button class="btn btn-dark d-md-none mb-3" id="sidebarToggle">☰ Menu</button>
        <div class="container">
            <h2 class="mb-4">Dashboard Super User</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Barang</h5>
                            <p class="card-text fs-3">{{ $jumlahBarang }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Peminjaman</h5>
                            <p class="card-text fs-3">{{ $jumlahPeminjaman }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grafik Peminjaman Per Bulan</h5>
                    <canvas id="peminjamanChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
    
    <script>
        var ctx = document.getElementById('peminjamanChart').getContext('2d');
        var peminjamanChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jumlah Peminjaman',
                    data: @json(array_values($dataGrafik)),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
