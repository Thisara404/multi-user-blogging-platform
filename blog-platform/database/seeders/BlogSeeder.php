<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories (use firstOrCreate to avoid duplicates)
        $categories = [
            ['name' => 'Technology', 'description' => 'All about tech trends and innovations', 'color' => '#3B82F6'],
            ['name' => 'Lifestyle', 'description' => 'Tips for a better life', 'color' => '#10B981'],
            ['name' => 'Travel', 'description' => 'Explore the world', 'color' => '#F59E0B'],
            ['name' => 'Food', 'description' => 'Delicious recipes and reviews', 'color' => '#EF4444'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category['name']], $category);
        }

        // Create tags (use firstOrCreate to avoid duplicates)
        $tags = [
            'Laravel', 'PHP', 'JavaScript', 'Vue.js', 'React', 'Programming',
            'Tutorial', 'Tips', 'Review', 'Guide', 'News', 'Opinion'
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(['name' => $tag]);
        }

        // Create admin user if doesn't exist
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@blog.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );
        if (!$adminUser->hasRole('admin')) {
            $adminUser->assignRole('admin');
        }

        // Create editor user if doesn't exist
        $editorUser = User::firstOrCreate(
            ['email' => 'editor@blog.com'],
            [
                'name' => 'Editor User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );
        if (!$editorUser->hasRole('editor')) {
            $editorUser->assignRole('editor');
        }

        // Create some sample posts (only if they don't exist)
        if (Post::count() === 0) {
            $posts = [
                [
                    'title' => 'Getting Started with Laravel 10',
                    'excerpt' => 'A comprehensive guide to building web applications with Laravel 10.',
                    'content' => '<p>Laravel 10 brings many exciting features...</p>',
                    'status' => 'published',
                    'published_at' => now(),
                    'author_id' => $adminUser->id,
                    'category_id' => Category::where('name', 'Technology')->first()->id,
                ],
                [
                    'title' => 'The Future of Web Development',
                    'excerpt' => 'Exploring trends and technologies shaping the future.',
                    'content' => '<p>Web development is constantly evolving...</p>',
                    'status' => 'published',
                    'published_at' => now()->subDays(1),
                    'author_id' => $editorUser->id,
                    'category_id' => Category::where('name', 'Technology')->first()->id,
                ],
            ];

            foreach ($posts as $postData) {
                $post = Post::create($postData);

                // Attach some tags
                $tagIds = Tag::whereIn('name', ['Laravel', 'PHP', 'Programming'])->pluck('id');
                $post->tags()->attach($tagIds);
            }
        }
    }
}
