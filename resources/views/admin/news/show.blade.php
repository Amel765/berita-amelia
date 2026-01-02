@extends('admin.layout')

@section('content')
<div class="card">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Detail Berita</h2>
        <div>
            <a href="{{ route('admin.news.edit', $news->id) }}" class="btn-warning">Edit</a>
            <a href="{{ route('admin.news.index') }}" class="btn-primary">Kembali</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <p><strong>ID:</strong> {{ $news->id }}</p>
            <p><strong>Judul:</strong> {{ $news->title }}</p>
            <p><strong>Kategori:</strong> {{ $news->category->name ?? 'N/A' }}</p>
            <p><strong>Penulis:</strong> {{ $news->user->name ?? 'N/A' }}</p>
            <p><strong>Status:</strong> 
                <span class="px-2 py-1 text-xs rounded-full 
                    {{ $news->status == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ $news->status == 'published' ? 'Published' : 'Draft' }}
                </span>
            </p>
            <p><strong>Dipublikasi:</strong> {{ $news->published_at ? $news->published_at->format('d M Y H:i') : '-' }}</p>
            <p><strong>Dibuat:</strong> {{ $news->created_at ? $news->created_at->format('d M Y H:i') : '-' }}</p>
            <p><strong>Diupdate:</strong> {{ $news->updated_at ? $news->updated_at->format('d M Y H:i') : '-' }}</p>
        </div>
        <div>
            @if($news->image)
                <img src="{{ asset('images/'.$news->image) }}" alt="News Image" class="w-full h-64 object-cover rounded">
            @else
                <p class="text-gray-500 italic">Tidak ada gambar</p>
            @endif
        </div>
    </div>

    <div class="mb-4">
        <strong>Konten:</strong>
        <div class="mt-2 p-4 bg-gray-50 rounded">
            {!! nl2br(e($news->content)) !!}
        </div>
    </div>

    <div class="flex justify-end">
        <a href="{{ route('admin.news.edit', $news->id) }}" class="btn-warning mr-2">Edit</a>
        <a href="{{ route('admin.news.index') }}" class="btn-primary">Kembali</a>
    </div>
</div>
@endsection