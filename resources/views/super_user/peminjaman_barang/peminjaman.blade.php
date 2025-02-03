<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center">Daftar Peminjaman Barang</h1>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header">Daftar Peminjaman</div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Barang</th>
                            <th>Nama Siswa</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Harus Kembali</th>
                            <th>Status Barang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->peminjamanBarang->barangInventaris->br_nama ?? '-' }}</td>
                            <td>{{ $item->siswa->siswa_nama ?? '-' }}</td>
                            <td>{{ $item->pb_tgl->format('d-m-Y') }}</td>
                            <td>{{ $item->pb_harus_kembali_tgl->format('d-m-Y') }}</td>
                            <td>{{ $item->peminjamanBarang->barangInventaris->br_status ?? 'Belum Ditemukan' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">Form Peminjaman</div>
            <div class="card-body">
                <form action="{{ route('super_user.peminjaman.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="siswa_id">Pilih Siswa</label>
                        <select name="siswa_id" id="siswa_id" class="form-control" required>
                            @foreach ($siswa as $siswaItem)
                            <option value="{{ $siswaItem->siswa_id }}">{{ $siswaItem->siswa_nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="br_kode">Pilih Barang</label>
                        <select name="br_kode" id="br_kode" class="form-control" required>
                            @foreach ($barang as $barangItem)
                            <option value="{{ $barangItem->br_kode }}">{{ $barangItem->br_nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pb_tgl">Tanggal Pinjam</label>
                        <input type="date" name="pb_tgl" id="pb_tgl" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Proses Peminjaman</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
