@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="md:col-span-2">
        <article class="bg-white p-8 rounded-xl shadow mb-8">
            <h1 class="text-3xl font-bold mb-6 text-gray-900">{{ $news->title }}</h1>
            
            <div class="flex flex-wrap justify-between items-center mb-6 text-sm text-gray-600 border-b pb-4">
                <div class="flex items-center space-x-2">
                    <span class="font-semibold">{{ $news->user->name ?? 'Admin' }}</span>
                    <span>•</span>
                    <span>{{ $news->published_at->format('d M Y H:i') }}</span>
                </div>
                <a href="{{ route('news.category', $news->category->slug) }}" class="category-link">{{ $news->category->name }}</a>
            </div>
            
            @if($news->image)
                <img src="{{ asset('images/'.$news->image) }}" alt="{{ $news->title }}" class="w-full h-96 object-cover rounded-lg mb-6">
            @else
                <!-- Menyesuaikan gambar berdasarkan kategori -->
                @php
                    $categoryImages = [
                        'politik' => 'politik.jpg',
                        'ekonomi' => 'ekonomi\.jpg',
                        'teknologi' => 'teknologi.jpg',
                        'olahraga' => 'olahraga.jpg'
                    ];
                    $image = $categoryImages[$news->category->slug] ?? 'politik.jpg';
                @endphp
                <img src="{{ asset('images/'.$image) }}" alt="{{ $news->title }}" class="w-full h-96 object-cover rounded-lg mb-6">
            @endif
            
            <div class="prose max-w-none text-gray-700 text-lg leading-relaxed">
                {!! nl2br(e($news->content)) !!}
            </div>
        </article>
        
        <!-- Comments Section -->
        <div class="bg-white p-8 rounded-xl shadow">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Komentar ({{ $news->comments->where('status', 'approved')->count() }})</h2>
            
            <div class="mb-8">
                @forelse($news->comments->where('status', 'approved') as $comment)
                    <div class="comment mb-6 last:mb-0">
                        <div class="flex items-center mb-2">
                            <div class="bg-indigo-100 text-indigo-800 w-10 h-10 rounded-full flex items-center justify-center font-bold mr-3">
                                {{ strtoupper(substr($comment->author_name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $comment->author_name }}</p>
                                <p class="text-sm text-gray-500">{{ $comment->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                        <p class="text-gray-700 pl-13">{{ $comment->content }}</p>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">Belum ada komentar.</p>
                @endforelse
            </div>
            
            <!-- Comment Form -->
            <h3 class="text-xl font-semibold mb-6 text-gray-900">Tambahkan Komentar</h3>
            <form action="{{ route('comments.store', $news->id) }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="author_name" class="block text-gray-700 mb-2 font-medium">Nama</label>
                        <input type="text" name="author_name" id="author_name" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    
                    <div>
                        <label for="author_email" class="block text-gray-700 mb-2 font-medium">Email</label>
                        <input type="email" name="author_email" id="author_email" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label for="content" class="block text-gray-700 mb-2 font-medium">Komentar</label>
                    <textarea name="content" id="content" rows="5" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
                </div>
                
                <button type="submit" class="btn-primary px-6 py-3 rounded-lg">Kirim Komentar</button>
            </form>
        </div>
    </div>
    
    <div class="md:col-span-1">
        <!-- Related News -->
        <div class="bg-white p-6 rounded-xl shadow mb-8">
            <h3 class="section-title">Berita Terkait</h3>
            <div class="space-y-5">
                @forelse($relatedNews as $item)
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-20 h-16">
                            @if($item->image)
                                <img src="{{ asset('images/'.$item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover rounded">
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
                                <img src="{{ asset('images/'.$image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover rounded">
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-medium text-gray-900 line-clamp-2">
                                <a href="{{ route('news.show', $item->slug) }}" class="hover:text-indigo-600 transition-colors">
                                    {{ Str::limit($item->title, 50) }}
                                </a>
                            </h4>
                            <p class="text-sm text-gray-500 mt-1">{{ $item->published_at->format('d M Y') }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">Tidak ada berita terkait.</p>
                @endforelse
            </div>
        </div>
        
        <!-- Categories -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="section-title">Kategori</h3>
            <div class="space-y-3">
                @foreach($categories as $category)
                    <a href="{{ route('news.category', $category->slug) }}" class="block py-3 px-4 hover:bg-indigo-50 rounded-lg transition-colors {{ $category->id == $news->category_id ? 'bg-indigo-50 border-l-4 border-indigo-500' : '' }}">
                        <div class="flex justify-between items-center">
                            <span>{{ $category->name }}</span>
                            <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                {{ $category->news->where('status', 'published')->count() }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection