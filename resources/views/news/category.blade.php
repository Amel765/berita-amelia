@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="md:col-span-2">
        <h1 class="text-3xl font-bold mb-8 text-gradient">Berita dalam Kategori: {{ $category->name }}</h1>
        
        @forelse($news as $item)
            <div class="news-card">
                @if($item->image)
                    <img src="{{ asset('images/'.$item->image) }}" alt="{{ $item->title }}" class="w-full h-56 object-cover rounded-lg mb-4">
                @else
                    <!-- Menyesuaikan gambar berdasarkan kategori -->
                    @php
                        $categoryImages = [
                            'politik' => 'politik.jpg',
                            'ekonomi' => 'ekonomi\.jpg',
                            'teknologi' => 'teknologi.jpg',
                            'olahraga' => 'olahraga.jpg'
                        ];
                        $image = $categoryImages[$item->category->slug] ?? 'politik.jpg';
                    @endphp
                    <img src="{{ asset('images/'.$image) }}" alt="{{ $item->title }}" class="w-full h-56 object-cover rounded-lg mb-4">
                @endif
                <h2 class="text-2xl font-bold mb-3"><a href="{{ route('news.show', $item->slug) }}" class="text-blue-600 hover:underline hover:text-indigo-700 transition-colors">{{ $item->title }}</a></h2>
                <p class="text-gray-700 mb-4">{{ Str::limit(strip_tags($item->content), 150) }}</p>
                <div class="flex justify-between items-center text-sm text-gray-600">
                    <span class="flex items-center">
                        <span class="font-semibold">{{ $item->user->name ?? 'Admin' }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}</span>
                    </span>
                    <a href="{{ route('news.category', $item->category->slug) }}" class="category-link">{{ $item->category->name }}</a>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <h3 class="text-xl font-medium text-gray-600">Belum ada berita dalam kategori ini.</h3>
                <p class="text-gray-500 mt-2">Silakan pilih kategori lain atau kembali lagi nanti.</p>
            </div>
        @endforelse
        
        <div class="mt-8">
            {{ $news->links() }}
        </div>
    </div>
    
    <div class="md:col-span-1">
        <div class="bg-white p-6 rounded-xl shadow mb-8">
            <h3 class="section-title">Kategori</h3>
            <div class="space-y-3">
                @foreach($categories as $cat)
                    <a href="{{ route('news.category', $cat->slug) }}" class="block py-3 px-4 hover:bg-indigo-50 rounded-lg transition-colors {{ $cat->id == $category->id ? 'bg-indigo-50 border-l-4 border-indigo-500' : '' }}">
                        <div class="flex justify-between items-center">
                            <span>{{ $cat->name }}</span>
                            <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                {{ $cat->news->where('status', 'published')->count() }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection