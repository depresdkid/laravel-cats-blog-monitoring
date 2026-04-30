<?php

namespace App\Services\BlogApi\Adapters;

use App\Services\BlogApi\Interfaces\BlogApiAdapterInterface;

class MockMeowBlogAdapter implements BlogApiAdapterInterface
{
    public function getBlogMeta(string $identifier): array
    {
        return [
            'identifier' => 'blog_1',
            'rating' => 100,
            'cat_name' => 'Big Floppa',
        ];
    }

    public function getPosts(string $identifier): array
    {
        $posts = [];
        for ($i = 0; $i < rand(3, 5); $i++) {
            $posts[] = [
                'identifier' => uniqid(),
                'title' => 'Флоппа ' . rand(1, 5),
                'content' => 'Очень большой флоппа...',
                'rating' => rand(30, 100),
                'reactions' => ['🐱' => 15, '❤️' => rand(10, 20), '😻' => 3]
            ];
        }
        return $posts;
    }
}
