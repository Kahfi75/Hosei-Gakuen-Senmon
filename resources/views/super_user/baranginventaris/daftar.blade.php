<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang Inventaris</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
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
            <h2 class="mb-3">Daftar Barang Inventaris</h2>

            <!-- Form Pencarian -->
            <form method="GET" action="{{ route('super_user.baranginventaris.index') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari barang..."
                        value="{{ $search }}">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>

            <!-- Button Kembali -->
            <a href="{{ route('super_user.dashboard') }}" class="btn btn-secondary mb-3">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </a>

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tanggal Terima</th>
                            <th>Tanggal Entry</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangInventaris as $barang)
                        <tr>
                            <td>{{ $barang->br_kode }}</td>
                            <td>{{ $barang->br_nama }}</td>
                            <td>{{ $barang->jenisBarang->jns_brg_nama ?? 'Tidak ada kategori' }}</td>
                            <td>{{ $barang->br_status }}</td>
                            <td>{{ \Carbon\Carbon::parse($barang->br_tgl_terima)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($barang->br_tgl_entry)->format('d-m-Y') }}</td>

                            <td>
                                <a href="{{ route('super_user.baranginventaris.edit', $barang->br_kode) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('super_user.baranginventaris.destroy', $barang->br_kode) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginasi -->
            {{ $barangInventaris->links() }}
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
