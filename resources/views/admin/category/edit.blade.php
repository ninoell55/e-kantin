<h2>Edit Kategori</h2>

<form action="{{ route('admin.category.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT') <div class="form-group">
        <label>Nama Kategori</label>
        <input type="text" name="name" value="{{ old('name', $category->name) }}" required>
        @error('name')
            <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">Update Kategori</button>
    <a href="{{ route('admin.category.index') }}">Batal</a>
</form>
