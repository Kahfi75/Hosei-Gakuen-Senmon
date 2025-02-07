<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengembalian Barang</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Form Pengembalian Barang</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('super_user.peminjaman.simpanPengembalianBarang') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="barang_id">Pilih Barang</label>
                @if ($barang->isEmpty())
                    <p class="text-danger">Tidak ada barang yang tersedia untuk dikembalikan.</p>
                @else
                    <select name="barang_id" id="barang_id" class="form-control">
                        @foreach ($barang as $barangItem)
                            <option value="{{ $barangItem->br_kode }}">{{ $barangItem->br_nama }}</option>
                        @endforeach
                    </select>
                @endif
            </div>

            <div class="form-group">
                <label for="kembali_tgl">Tanggal Pengembalian</label>
                <input type="date" name="kembali_tgl" id="kembali_tgl" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Kembalikan Barang</button>
        </form>

        <hr>

        <h2>Barang Belum Kembali</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Nama Siswa</th>
                    <th>Tanggal Pinjam</th>
                    <th>Jatuh Tempo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjamanBarang as $peminjaman)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $peminjaman->barangInventaris->br_nama ?? '-' }}</td>
                        <td>{{ $peminjaman->peminjaman->siswa->siswa_nama ?? '-' }}</td>
                        <td>{{ $peminjaman->peminjaman->pb_tgl ?? '-' }}</td>
                        <td>{{ $peminjaman->peminjaman->pb_harus_kembali_tgl ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
