<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Post;
use App\Models\Resource;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resource1 = Resource::create([
            'name' => 'Cute Cats Blogs Resource',
            'driver' => 'cute_cats',
        ]);

        $resource2 = Resource::create([
            'name' => 'Meow Blogs Resources',
            'driver' => 'meow_blog',
        ]);

        $blog1 = Blog::create([
            'resource_id' => $resource1->id,
            'identifier' => 'blog_1',
            'cat_name' => 'Максвел',
            'rating' => 5.5,
            'check_interval' => 18000,
            'last_sync_at' => null,
        ]);

        $blog2 = Blog::create([
            'resource_id' => $resource2->id,
            'identifier' => 'blog_2',
            'cat_name' => 'Башмак',
            'rating' => 10,
            'check_interval' => 21600,
            'last_sync_at' => now()->subHours(7),
        ]);

        Post::create([
            'blog_id' => $blog1->id,
            'identifier' => 'post_1',
            'title' => 'Первый пост',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            'rating' => 4.2,
            'reactions' => ['🐱' => 1, '❤️' => 5, '😻' => 10],
        ]);

        Post::create([
            'blog_id' => $blog1->id,
            'identifier' => 'post_2',
            'title' => 'Второй пост',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            'rating' => 4.8,
            'reactions' => ['🐱' => 2, '❤️' => 3, '😻' => 1],
        ]);

        Post::create([
            'blog_id' => $blog2->id,
            'identifier' => 'post_a',
            'title' => 'Блог 2 Пост 1',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            'rating' => 4.9,
            'reactions' => ['🐱' => 7, '❤️' => 3,],
        ]);
    }
}
