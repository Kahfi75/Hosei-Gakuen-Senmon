<!-- <!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            position: fixed;
            padding-top: 20px;
        }

        .sidebar a {
            color: white;
            padding: 10px 20px;
            display: block;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .card-title {
            font-size: 1.25rem;
        }

        .card-text {
            font-size: 2rem;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="fw-bold fs-5 text-center d-block mb-3">Inventaris</a>
        <a href="{{ route('super_user.dashboard') }}"><i class="bi bi-house-door-fill"></i> Dashboard</a>
        <a href="{{ route('super_user.baranginventaris.penerimaan') }}" class="btn btn-primary">Penerimaan Barang</a>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="container mt-4">
            <h2 class="mb-3">Dashboard Inventaris</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Barang</h5>
                            <p class="card-text fs-3">{{ $jumlahBarang }}</p> <!-- Menampilkan jumlah barang -->
                        </div>
                    </div>
                </div>
                <!-- Total Peminjaman Card -->
                <div class="col-md-6">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Peminjaman</h5>
                            <p class="card-text fs-3">{{ $jumlahPeminjaman }}</p> <!-- Menampilkan jumlah peminjaman -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="row">
                <div class="col-md-8">
                    <!-- Menampilkan chart -->
                    {!! $chart->container() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk render chart -->
    {!! $chart->script() !!}

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>