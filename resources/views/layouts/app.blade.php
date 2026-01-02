<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8fafc;
        }
        .navbar {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            padding: 1rem 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .news-card {
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #e5e7eb;
        }
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-weight: 500;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #4338ca, #6d28d9);
            transform: translateY(-2px);
        }
        .category-link {
            display: inline-block;
            background: linear-gradient(135deg, #c7d2fe, #ddd6fe);
            color: #4f46e5;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            text-decoration: none;
            font-size: 0.875rem;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }
        .category-link:hover {
            background: linear-gradient(135deg, #a5b4fc, #c4b5fd);
            transform: scale(1.05);
        }
        .comment {
            border-left: 4px solid #818cf8;
            padding-left: 1rem;
            margin: 1.5rem 0;
            background-color: #f9fafb;
            padding: 1rem;
            border-radius: 0 0.5rem 0.5rem 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        .main-content {
            padding: 2rem 0;
        }
        .card {
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #1e293b;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 0.5rem;
        }
        .text-gradient {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gray-100">
    <nav class="navbar text-white">
        <div class="container">
            <div class="flex justify-between items-center">
                <div class="flex-shrink-0 flex items-center">
                    <span class="font-bold text-2xl">{{ config('app.name', 'PORTAL BERITA AMELIA') }}</span>
                </div>
                <div class="flex space-x-6 items-center">
                    <a href="{{ route('home') }}" class="text-white hover:text-gray-200 transition-colors duration-300 px-3 py-2 rounded-lg hover:bg-white/10">Beranda</a>
                    <a href="{{ route('news.index') }}" class="text-white hover:text-gray-200 transition-colors duration-300 px-3 py-2 rounded-lg hover:bg-white/10">Berita</a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="text-white hover:text-gray-200 transition-colors duration-300 px-3 py-2 rounded-lg hover:bg-white/10">Admin</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-white hover:text-gray-200 bg-transparent border-none cursor-pointer transition-colors duration-300 px-3 py-2 rounded-lg hover:bg-white/10">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-gray-200 transition-colors duration-300 px-3 py-2 rounded-lg hover:bg-white/10">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 shadow">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 shadow">
                    {{ session('error') }}
                </div>
            @endif
            
            @yield('content')
        </div>
    </main>
</body>
</html>