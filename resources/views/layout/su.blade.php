<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super User Website</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
    <style>
        /* Sidebar Style */
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

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar-item:hover {
            background-color: #495057;
            cursor: pointer;
        }

        /* Main content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .main-content.collapsed {
            margin-left: 80px;
        }

        /* Dropdown menu for mobile */
        @media (max-width: 768px) {
            .sidebar {
                position: static;
                height: auto;
                width: 100%;
                display: none;
            }

            .sidebar.collapsed {
                display: block;
            }

            .sidebar-item {
                width: 100%;
            }

            .main-content {
                margin-left: 0;
            }
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
                <!-- Sidebar Toggler for Mobile -->
                <li class="nav-item sidebar-item py-2 px-3">
                    <a href="#" class="nav-link text-white" id="sidebarToggle">
                        <i class="bi bi-list"></i> Menu
                    </a>
                </li>

                <!-- Home -->
                <li class="nav-item sidebar-item py-2 px-3">
                    <a href="#" class="nav-link text-white">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>

                <!-- Barang Inventaris -->
                <li class="nav-item sidebar-item py-2 px-3">
                    <a class="nav-link text-white" data-bs-toggle="collapse" href="#submenu-inventaris"
                        aria-expanded="false">
                        <i class="fas fa-box"></i> Barang Inventaris
                    </a>
                    <div id="submenu-inventaris" class="collapse submenu ms-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('super_user.baranginventaris.daftar') }}"
                                    class="nav-link text-white">Daftar Barang</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('super_user.baranginventaris.penerimaan') }}"
                                    class="nav-link text-white">Penerimaan Barang</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Peminjaman Barang -->
                <li class="nav-item sidebar-item py-2 px-3">
                    <a class="nav-link text-white" data-bs-toggle="collapse" href="#submenu-peminjaman"
                        aria-expanded="false">
                        <i class="fas fa-handshake"></i> Peminjaman Barang
                    </a>
                    <div id="submenu-peminjaman" class="collapse submenu ms-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('super_user.peminjaman.index') }}" class="nav-link text-white">Daftar
                                    Peminjaman</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('super_user.peminjaman.returnForm') }}"
                                    class="nav-link text-white">Pengembalian Barang</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('super_user.peminjaman.barangBelumKembali') }}"
                                    class="nav-link text-white">Barang Belum Kembali</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Laporan -->
                <li class="nav-item sidebar-item py-2 px-3">
                    <a class="nav-link text-white" data-bs-toggle="collapse" href="#submenu-laporan"
                        aria-expanded="false">
                        <i class="fas fa-chart-line"></i> Laporan
                    </a>
                    <div id="submenu-laporan" class="collapse submenu ms-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('super_user.laporan.barang') }}" class="nav-link text-white">Laporan
                                    Daftar Barang</a>
                            </li>


                            <li class="nav-item">
                                <a href="#" class="nav-link text-white">Laporan Pengembalian Barang</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link text-white">Laporan Status Barang</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Logout -->
                <li class="nav-item sidebar-item py-2 px-3">
                    <a href="#" class="nav-link text-white">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
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
                <h3>Main Content Area</h3>
                <p>This is where the content of the page will be displayed.</p>
            </div>
        </div>
    </div>

    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>

    <script>
        // Toggle the sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('main-content').classList.toggle('collapsed');
        });
    </script>
</body>

</html>
