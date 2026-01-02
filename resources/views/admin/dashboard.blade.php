@extends('admin.layout')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold mb-2">Total Berita</h3>
        <p class="text-3xl font-bold text-blue-600">{{ \App\Models\News::count() }}</p>
    </div>
    
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold mb-2">Total Kategori</h3>
        <p class="text-3xl font-bold text-green-600">{{ \App\Models\Category::count() }}</p>
    </div>
    
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold mb-2">Total Komentar</h3>
        <p class="text-3xl font-bold text-yellow-600">{{ \App\Models\Comment::count() }}</p>
    </div>
</div>

<div class="mt-6 bg-white p-6 rounded shadow">
    <h3 class="text-lg font-semibold mb-4">Berita Terbaru</h3>
    <div class="overflow-x-auto">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @forelse(\App\Models\News::with('category')->orderBy('created_at', 'desc')->limit(5)->get() as $news)
                <tr>
                    <td>{{ $news->id }}</td>
                    <td>{{ Str::limit($news->title, 30) }}</td>
                    <td>{{ $news->category->name ?? 'N/A' }}</td>
                    <td>
                        <span class="px-2 py-1 text-xs rounded-full 
                            {{ $news->status == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($news->status) }}
                        </span>
                    </td>
                    <td>{{ $news->created_at ? $news->created_at->format('d M Y') : '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada berita</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6 bg-white p-6 rounded shadow">
    <h3 class="text-lg font-semibold mb-4">Komentar Terbaru</h3>
    <div class="overflow-x-auto">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Berita</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @forelse(\App\Models\Comment::with('news')->orderBy('created_at', 'desc')->limit(5)->get() as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->author_name }}</td>
                    <td>{{ Str::limit($comment->news->title ?? 'Berita tidak ditemukan', 30) }}</td>
                    <td>
                        <span class="px-2 py-1 text-xs rounded-full 
                            {{ $comment->status == 'approved' ? 'bg-green-100 text-green-800' : 
                               ($comment->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                            {{ ucfirst($comment->status) }}
                        </span>
                    </td>
                    <td>{{ $comment->created_at ? $comment->created_at->format('d M Y') : '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada komentar</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection