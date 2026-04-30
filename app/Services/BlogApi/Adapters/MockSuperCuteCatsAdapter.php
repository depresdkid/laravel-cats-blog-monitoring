<?php

namespace App\Services\BlogApi\Adapters;

use App\Services\BlogApi\Interfaces\BlogApiAdapterInterface;

class MockSuperCuteCatsAdapter implements BlogApiAdapterInterface
{
    public function getBlogMeta(string $identifier): array
    {
        return [
            'identifier' => 'blog_2',
            'rating' => 100,
            'cat_name' => 'Кот Банан',
        ];
    }

    public function getPosts(string $identifier): array
    {
        $posts = [];
        for ($i = 0; $i < rand(3, 5); $i++) {
            $posts[] = [
                'identifier' => uniqid(),
                'title' => 'Кото-пост ' . rand(1, 5),
                'content' => 'Текст поста...',
                'rating' => rand(30, 100),
                'reactions' => ['🐱' => 5, '❤️' => rand(10, 20), '😻' => 3]
            ];
        }
        return $posts;
    }
}
