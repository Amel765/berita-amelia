@extends('admin.layout')

@section('content')
<div class="card">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Detail Kategori</h2>
        <div>
            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn-warning">Edit</a>
            <a href="{{ route('admin.categories.index') }}" class="btn-primary">Kembali</a>
        </div>
    </div>

    <div class="mb-4">
        <p><strong>ID:</strong> {{ $category->id }}</p>
        <p><strong>Nama:</strong> {{ $category->name }}</p>
        <p><strong>Slug:</strong> {{ $category->slug }}</p>
        <p><strong>Deskripsi:</strong> {{ $category->description ?? '-' }}</p>
        <p><strong>Berita Terkait:</strong> {{ $category->news->count() }}</p>
        <p><strong>Dibuat:</strong> {{ $category->created_at->format('d M Y H:i') }}</p>
        <p><strong>Diupdate:</strong> {{ $category->updated_at->format('d M Y H:i') }}</p>
    </div>

    <div class="flex justify-end">
        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn-warning mr-2">Edit</a>
        <a href="{{ route('admin.categories.index') }}" class="btn-primary">Kembali</a>
    </div>
</div>
@endsection