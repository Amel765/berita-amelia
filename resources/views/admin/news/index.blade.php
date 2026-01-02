@extends('admin.layout')

@section('content')
<div class="card">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Daftar Berita</h2>
        <a href="{{ route('admin.news.create') }}" class="btn-primary">Tambah Berita</a>
    </div>

    <div class="overflow-x-auto">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Dipublikasi</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($news as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ Str::limit($item->title, 50) }}</td>
                    <td>{{ $item->category->name ?? 'N/A' }}</td>
                    <td>
                        <span class="px-2 py-1 text-xs rounded-full 
                            {{ $item->status == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $item->status == 'published' ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td>{{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}</td>
                    <td>{{ $item->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.news.show', $item->id) }}" class="btn-success text-sm">Lihat</a>
                        <a href="{{ route('admin.news.edit', $item->id) }}" class="btn-warning text-sm">Edit</a>
                        <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger text-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada berita ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $news->links() }}
    </div>
</div>
@endsection