<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Daftar Barang Inventaris</title>
    <!-- Link CSS (misalnya Bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Laporan Daftar Barang Inventaris</h2>

    <!-- Form Filter -->
    <form method="GET" action="{{ route('super_user.laporan.barang') }}">
        <div class="row">
            <div class="col-md-4">
                <label for="jns_brg">Jenis Barang</label>
                <select class="form-control" name="jns_brg" id="jns_brg">
                    <option value="">Semua Jenis</option>
                    @foreach($jenisBarangs as $jenisBarang)
                        <option value="{{ $jenisBarang->kode }}" {{ request('jns_brg') == $jenisBarang->kode ? 'selected' : '' }}>
                            {{ $jenisBarang->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="periode">Periode (YYYY-MM)</label>
                <input type="month" class="form-control" name="periode" id="periode" value="{{ request('periode') }}">
            </div>

            <div class="col-md-4">
                <button type="submit" class="btn btn-primary mt-4">Filter</button>
            </div>
        </div>
    </form>

    <!-- Tabel Daftar Barang -->
    @if($barangInventaris->isEmpty())
        <div class="alert alert-warning mt-4">
            {{ $message }}
        </div>
    @else
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Jenis Barang</th>
                    <th>Tanggal Terima</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangInventaris as $barang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $barang->nama }}</td>
                        <td>{{ $barang->jenisBarang->nama }}</td>
                        <td>{{ $barang->br_tgl_terima->format('d-m-Y') }}</td>
                        <td>{{ $barang->jumlah }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<!-- Link JS (misalnya jQuery dan Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
