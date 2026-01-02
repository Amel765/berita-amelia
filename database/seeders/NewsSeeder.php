<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\News;
use App\Models\Comment;
use App\Models\User;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories if they don't exist
        $categories = [
            ['name' => 'Politik', 'slug' => 'politik', 'description' => 'Berita seputar politik dan pemerintahan'],
            ['name' => 'Ekonomi', 'slug' => 'ekonomi', 'description' => 'Berita seputar ekonomi dan bisnis'],
            ['name' => 'Teknologi', 'slug' => 'teknologi', 'description' => 'Berita seputar teknologi dan inovasi'],
            ['name' => 'Olahraga', 'slug' => 'olahraga', 'description' => 'Berita seputar olahraga dan pertandingan'],
        ];
        
        foreach ($categories as $categoryData) {
            Category::firstOrCreate(
                ['slug' => $categoryData['slug']], 
                $categoryData
            );
        }
        
        // Get user for news author
        $user = User::first();
        
        // Check if news already exists to avoid duplicates
        $existingNews = News::where('slug', 'pemilu-serentak-2024-berjalan-lancar')->first();
        
        if ($existingNews) {
            return; // If sample news exists, don't create again
        }
        
        // Create sample news
        $news = [
            [
                'title' => 'Pemilu Serentak 2024 Berjalan Lancar',
                'slug' => 'pemilu-serentak-2024-berjalan-lancar',
                'content' => 'Pemilihan umum serentak tahun 2024 berjalan dengan aman dan lancar. Partisipasi masyarakat sangat tinggi dalam pesta demokrasi ini.',
                'category_id' => 1,
                'user_id' => $user->id,
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'Pertumbuhan Ekonomi Meningkat',
                'slug' => 'pertumbuhan-ekonomi-meningkat',
                'content' => 'Pertumbuhan ekonomi nasional menunjukkan peningkatan yang signifikan di kuartal ketiga tahun ini. Indikator ekonomi makro menunjukkan arah yang positif.',
                'category_id' => 2,
                'user_id' => $user->id,
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'Inovasi Terbaru di Bidang Teknologi',
                'slug' => 'inovasi-terbaru-di-bidang-teknologi',
                'content' => 'Perusahaan teknologi terkemuka mengumumkan inovasi terbaru dalam bidang kecerdasan buatan. Teknologi ini diharapkan dapat membantu berbagai sektor industri.',
                'category_id' => 3,
                'user_id' => $user->id,
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'Timnas Indonesia Raih Juara Piala Asia',
                'slug' => 'timnas-indonesia-raih-juara-piala-asia',
                'content' => 'Timnas Indonesia berhasil meraih gelar juara Piala Asia setelah mengalahkan tim kuat di final. Kemenangan ini menjadi sejarah baru bagi sepak bola Indonesia.',
                'category_id' => 4,
                'user_id' => $user->id,
                'status' => 'published',
                'published_at' => now(),
            ],
        ];
        
        foreach ($news as $newsData) {
            $createdNews = News::create($newsData);
            
            // Create comments for each news
            Comment::create([
                'news_id' => $createdNews->id,
                'author_name' => 'John Doe',
                'author_email' => 'john@example.com',
                'content' => 'Terima kasih atas informasi yang sangat bermanfaat. Artikel ini memberikan wawasan yang baik tentang topik yang dibahas.',
                'status' => 'approved',
                'user_id' => null,
            ]);
            
            Comment::create([
                'news_id' => $createdNews->id,
                'author_name' => 'Jane Smith',
                'author_email' => 'jane@example.com',
                'content' => 'Saya sangat setuju dengan poin-poin yang disampaikan dalam artikel ini. Semoga ada lebih banyak informasi serupa di masa depan.',
                'status' => 'approved',
                'user_id' => null,
            ]);
        }
    }
}