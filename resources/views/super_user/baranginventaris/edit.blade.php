<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang Inventaris</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Barang Inventaris</h2>

        <!-- Form untuk Edit Barang -->
        <form action="{{ route('super_user.baranginventaris.edit', $barang->br_kode) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $barang->br_nama) }}" required>
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    @foreach($jenisBarang as $jenis)
                        <option value="{{ $jenis->jns_brg_kode }}" {{ $barang->jns_brg_kode == $jenis->jns_brg_kode ? 'selected' : '' }}>
                            {{ $jenis->jns_brg_nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Ada" {{ $barang->br_status == 'Ada' ? 'selected' : '' }}>Ada</option>
                    <option value="Rusak" {{ $barang->br_status == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                    <option value="Hilang" {{ $barang->br_status == 'Hilang' ? 'selected' : '' }}>Hilang</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('super_user.baranginventaris.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
