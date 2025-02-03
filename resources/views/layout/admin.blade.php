<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Dashboard</title>
    <!-- Bootstrap & AdminLTE CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .wrapper {
            display: flex;
        }
        
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #222d32;
            color: white;
            padding-top: 20px;
            position: fixed;
        }

        .sidebar .nav-link {
            color: white;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: static;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="p-3 text-center text-white fs-4 fw-bold">Administrator</div>
            <ul class="nav flex-column">
                <li class="nav-item py-2 px-3">
                    <a href="{{ route('super_user.dashboard') }}" class="nav-link text-white">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item py-2 px-3">
                    <a class="nav-link text-white" data-bs-toggle="collapse" href="#submenu-laporan">
                        <i class="fas fa-chart-line"></i> Laporan
                    </a>
                    <div id="submenu-laporan" class="collapse submenu ms-3">
                        <ul class="nav flex-column">
                            <li class="nav-item"><a href="{{ route('super_user.laporan.barang') }}" class="nav-link text-white">Laporan Daftar Barang</a></li>
                            <li class="nav-item"><a href="{{ route('super_user.laporan.pengembalian') }}" class="nav-link text-white">Laporan Pengembalian Barang</a></li>
                            <li class="nav-item"><a href="{{ route('super_user.laporan.status') }}" class="nav-link text-white">Laporan Status Barang</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-header">
                <div class="jumbotron bg-primary text-white p-4 rounded">
                    <h1 class="display-6">Selamat Datang, Administrator!</h1>
                    <p class="lead">Sistem Manajemen Inventaris Barang.</p>
                </div>
            </div>

            <section class="content">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>150</h3>
                                <p>Jumlah Barang</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-box"></i>
                            </div>
                            <a href="#" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53</h3>
                                <p>Barang Tersedia</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <a href="#" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Grafik Barang -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Grafik Barang</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="barangChart"></canvas>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Bootstrap & AdminLTE JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var ctx = document.getElementById('barangChart').getContext('2d');
        var barangChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Laptop', 'Printer', 'Proyektor', 'Meja', 'Kursi'],
                datasets: [{
                    label: 'Jumlah Barang',
                    data: [10, 5, 8, 15, 20],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
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
    