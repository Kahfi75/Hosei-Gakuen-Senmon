<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super User Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #343a40;
            color: white;
            transition: all 0.3s ease;
        }

        .sidebar-item:hover {
            background-color: #007bff;
            cursor: pointer;
        }

        .submenu {
            display: none;
        }

        .submenu.show {
            display: block;
        }

        .sidebar-item:hover {
            background-color: #495057;
            color: white;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>

<body class="bg-light">

    <div class="d-flex">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar">
            <div class="p-3 text-center text-white fs-4 fw-bold">
                Inventory
            </div>
            <ul class="nav flex-column">
                <li class="nav-item sidebar-item py-2 px-3">
                    <a href="#" class="nav-link text-white">
                        <i class="bi bi-house-door"></i> Home
                    </a>
                </li>
                <li class="nav-item sidebar-item py-2 px-3">
                    <a class="nav-link text-white" data-bs-toggle="collapse" href="#submenu-inventaris" aria-expanded="false">
                        <i class="bi bi-box"></i> Barang Inventaris
                    </a>
                    <div id="submenu-inventaris" class="collapse submenu ms-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link text-white">Daftar Barang</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link text-white">Penerimaan Barang</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div id="main-content" class="main-content">
            <header class="mb-4">
                <div>
                    <h1>Super User Dashboard</h1>
                    <p>Inventory School Management</p>
                </div>
            </header>
            <div class="p-4 bg-white rounded shadow-sm">
                <h3>Daftar Barang yang Diterima</h3>
                <!-- Table for Barang Inventaris -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Nama Kategori</th>
                            <th>User</th>
                            <th>Tanggal Terima</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $item)
                            <tr>
                                <td>{{ $item->br_kode }}</td>
                                <td>{{ $item->br_nama }}</td>
                                <td>{{ $item->jenis_barang->jns_brg_nama ?? 'Tidak Ada Kategori' }}</td>
                                <td>{{ optional($item->user)->name ?? 'Tidak Ada Data' }}</td>
                                <td>{{ $item->br_tgl_terima }}</td>
                                <td>{{ $item->br_status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
