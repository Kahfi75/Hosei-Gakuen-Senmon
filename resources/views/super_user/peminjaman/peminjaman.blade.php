<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-center mb-6">Daftar Peminjaman Barang</h1>

        @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="flex justify-end mb-4">
            <button onclick="openModal()" class="bg-blue-500 text-white px-4 py-2 rounded">
                Tambah Peminjaman
            </button>
        </div>

        <div class="bg-white p-4 rounded shadow-md">
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 border">ID Peminjaman</th>
                        <th class="px-4 py-2 border">Nama Siswa</th>
                        <th class="px-4 py-2 border">Barang yang Dipinjam</th>
                        <th class="px-4 py-2 border">Tanggal Peminjaman</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjaman as $item)
                    <tr class="border-b">
                        <td class="px-4 py-2 border">{{ $item->pb_id }}</td>
                        <td class="px-4 py-2 border">{{ $item->siswa->nama_siswa ?? 'Tidak Diketahui' }}</td>
                        <td class="px-4 py-2 border">{{ $item->barang->br_nama ?? 'Tidak Diketahui' }}</td>
                        <td class="px-4 py-2 border">{{ $item->pb_tgl ? $item->pb_tgl->format('d-m-Y') : '-' }}</td>
                        <td class="px-4 py-2 border">{{ $item->pb_stat }}</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('super_user.peminjaman.show', $item->pb_id) }}" class="text-blue-500 hover:underline">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-2 text-center border">Tidak ada data peminjaman</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL FORM -->
    <div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg w-1/3 shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Form Peminjaman Barang</h2>
            <form action="{{ route('super_user.peminjaman.store') }}" method="POST" id="peminjamanForm">
                @csrf

                <div class="mb-4">
                    <label for="siswa_id" class="block text-lg font-medium">Nama Siswa</label>
                    <select name="siswa_id" id="siswa_id" class="w-full p-2 border rounded" required>
                        <option value="">Pilih Siswa</option>
                        @foreach($siswa as $s)
                        <option value="{{ $s->siswa_id }}">{{ $s->nama_siswa }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="br_kode" class="block text-lg font-medium">Barang yang Dipinjam</label>
                    <select name="br_kode" id="br_kode" class="w-full p-2 border rounded" required>
                        <option value="">Pilih Barang</option>
                        @foreach($barang as $item)
                        <option value="{{ $item->br_kode }}">{{ $item->br_nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="pb_tgl" class="block text-lg font-medium">Tanggal Peminjaman</label>
                    <input type="date" name="pb_tgl" id="pb_tgl" class="w-full p-2 border rounded" required>
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Proses</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Open the modal when the button is clicked
        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
        }

        // Close the modal
        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>
</body>

</html>
