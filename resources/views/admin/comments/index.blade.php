@extends('admin.layout')

@section('content')
<div class="card">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Daftar Komentar</h2>
    </div>

    <div class="overflow-x-auto">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Berita</th>
                    <th>Komentar</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->author_name }}</td>
                    <td>{{ $comment->author_email }}</td>
                    <td>{{ Str::limit($comment->news->title ?? 'Berita tidak ditemukan', 30) }}</td>
                    <td>{{ Str::limit(strip_tags($comment->content), 50) }}</td>
                    <td>
                        <span class="px-2 py-1 text-xs rounded-full 
                            {{ $comment->status == 'approved' ? 'bg-green-100 text-green-800' : 
                               ($comment->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-yellow-800') }}">
                            {{ ucfirst($comment->status) }}
                        </span>
                    </td>
                    <td>{{ $comment->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.comments.show', $comment->id) }}" class="btn-success text-sm">Lihat</a>
                        @if($comment->status !== 'approved')
                            <a href="{{ route('admin.comments.approve', $comment->id) }}" class="btn-primary text-sm">Setujui</a>
                        @endif
                        @if($comment->status !== 'spam')
                            <a href="{{ route('admin.comments.markAsSpam', $comment->id) }}" class="btn-warning text-sm">Spam</a>
                        @endif
                        <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger text-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada komentar ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $comments->links() }}
    </div>
</div>
@endsection