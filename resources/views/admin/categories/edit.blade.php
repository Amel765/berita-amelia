@extends('admin.layout')

@section('content')
<div class="card">
    <h2 class="text-xl font-semibold mb-4">Edit Kategori</h2>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nama Kategori</label>
            <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded" value="{{ old('name', $category->name) }}" required>
            @error('name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Deskripsi</label>
            <textarea name="description" id="description" rows="4" class="w-full p-2 border border-gray-300 rounded">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex items-center justify-end">
            <a href="{{ route('admin.categories.index') }}" class="btn-warning mr-2">Batal</a>
            <button type="submit" class="btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection