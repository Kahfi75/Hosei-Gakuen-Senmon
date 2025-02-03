    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penerimaan Barang Inventaris</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Penerimaan Barang Inventaris</h2>

        <?php if(session('success')): ?>
            <div class="alert alert-success">{{ session('success') }}</div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger">{{ session('error') }}</div>
        <?php endif; ?>

        <form action="{{ route('super_user.baranginventaris.store') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Jenis Barang</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value="">-- Pilih Jenis Barang --</option>
                    <?php foreach($jenisBarang as $jenis): ?>
                        <option value="{{ $jenis->jns_brg_kode }}">{{ $jenis->jns_brg_nama }}</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Tambah Barang</button>
        </form>

        <hr>

        <h3>Daftar Barang Inventaris</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jenis Barang</th>
                    <th>Tanggal Terima</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($penerimaan as $barang): ?>
                <tr>
                    <td>{{ $barang->br_kode }}</td>
                    <td>{{ $barang->br_nama }}</td>
                    <td>{{ $barang->jenisBarang->jns_brg_nama ?? '-' }}</td>
                    <td>{{ $barang->br_tgl_terima }}</td>
                    <td>{{ $barang->br_status }}</td>
                    <td>
                        <form action="{{ route('super_user.baranginventaris.destroy', $barang->br_kode) }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
