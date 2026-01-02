@extends('admin.layout')

@section('content')
<div class="card">
    <h2 class="text-xl font-semibold mb-4">Tambah Berita Baru</h2>

    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Judul Berita</label>
            <input type="text" name="title" id="title" class="w-full p-2 border border-gray-300 rounded" value="{{ old('title') }}" required>
            @error('title')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-gray-700">Kategori</label>
            <select name="category_id" id="category_id" class="w-full p-2 border border-gray-300 rounded" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="content" class="block text-gray-700">Konten</label>
            <textarea name="content" id="content" rows="10" class="w-full p-2 border border-gray-300 rounded" required>{{ old('content') }}</textarea>
            @error('content')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700">Gambar</label>
            <input type="file" name="image" id="image" class="w-full p-2 border border-gray-300 rounded">
            @error('image')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="status" class="block text-gray-700">Status</label>
            <select name="status" id="status" class="w-full p-2 border border-gray-300 rounded" required>
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
            </select>
            @error('status')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex items-center justify-end">
            <a href="{{ route('admin.news.index') }}" class="btn-warning mr-2">Batal</a>
            <button type="submit" class="btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection