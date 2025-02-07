<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peminjaman</title>
    <!-- Link to Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="container mx-auto p-6">
    <!-- Title -->
    <h1 class="text-3xl font-semibold text-center mb-6">Detail Peminjaman Barang</h1>

    <!-- Detail Peminjaman -->
    <div class="bg-gray-100 p-4 rounded mb-6">
        <h2 class="text-2xl font-semibold">ID Peminjaman: {{ $peminjaman->pb_id }}</h2>
        <p><strong>Nama Siswa:</strong> {{ $peminjaman->siswa->nama }}</p>
        <p><strong>Barang:</strong> {{ $peminjaman->barangInventaris->br_nama }}</p>
        <p><strong>Tanggal Peminjaman:</strong> {{ $peminjaman->pb_tgl->format('d-m-Y') }}</p>
        <p><strong>Status:</strong> {{ $peminjaman->pb_stat }}</p>
    </div>

    <a href="{{ route('super_user.peminjaman.index') }}" class="text-blue-500">Kembali ke Daftar Peminjaman</a>
</div>

</body>
</html>
        k