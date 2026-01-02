@extends('admin.layout')

@section('content')
<div class="card">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Detail Komentar</h2>
        <a href="{{ route('admin.comments.index') }}" class="btn-primary">Kembali</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <p><strong>ID:</strong> {{ $comment->id }}</p>
            <p><strong>Nama:</strong> {{ $comment->author_name }}</p>
            <p><strong>Email:</strong> {{ $comment->author_email }}</p>
            <p><strong>Berita:</strong> {{ $comment->news->title ?? 'Berita tidak ditemukan' }}</p>
            <p><strong>Status:</strong> 
                <span class="px-2 py-1 text-xs rounded-full 
                    {{ $comment->status == 'approved' ? 'bg-green-100 text-green-800' : 
                       ($comment->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                    {{ ucfirst($comment->status) }}
                </span>
            </p>
            <p><strong>Dibuat:</strong> {{ $comment->created_at->format('d M Y H:i') }}</p>
            <p><strong>Diupdate:</strong> {{ $comment->updated_at->format('d M Y H:i') }}</p>
        </div>
        <div>
            <p><strong>Penulis Terdaftar:</strong> {{ $comment->user ? $comment->user->name : 'Tidak' }}</p>
        </div>
    </div>

    <div class="mb-4">
        <strong>Komentar:</strong>
        <div class="mt-2 p-4 bg-gray-50 rounded">
            {!! nl2br(e($comment->content)) !!}
        </div>
    </div>

    <div class="flex justify-between">
        @if($comment->status !== 'approved')
            <a href="{{ route('admin.comments.approve', $comment->id) }}" class="btn-primary">Setujui Komentar</a>
        @endif
        
        @if($comment->status !== 'spam')
            <a href="{{ route('admin.comments.markAsSpam', $comment->id) }}" class="btn-warning">Tandai sebagai Spam</a>
        @endif
        
        <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')">Hapus Komentar</button>
        </form>
    </div>
</div>
@endsection