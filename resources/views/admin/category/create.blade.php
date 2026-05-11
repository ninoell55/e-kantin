<!-- resources/views/categories/create.blade.php -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori Baru</title>
    <style>
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"] { width: 100%; padding: 8px; box-sizing: border-box; }
        .btn { padding: 10px 15px; background-color: #007BFF; color: white; border: none; cursor: pointer; }
        .text-danger { color: red; font-size: 0.9em; }
    </style>
</head>
<body>

    <h2>Tambah Kategori</h2>

    <!-- Tampilkan pesan sukses jika ada -->
    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.category.store') }}" method="POST">
        <!-- @csrf WAJIB ditambahkan pada form Laravel -->
        @csrf

        <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Contoh: Makanan Berat" required>
            <!-- Menampilkan error validasi jika nama kosong/salah -->
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn">Simpan Data</button>
    </form>

</body>
</html>
