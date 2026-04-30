<?php

namespace App\Services\BlogApi\Adapters;

use App\Services\BlogApi\Interfaces\BlogApiAdaptersInterface;

class MockSuperCuteCatsAdapter implements BlogApiAdaptersInterface
{
    public function getBlogMeta(string $identifier): array
    {
        return [
            'name' => 'Блок Super Cute котят',
            'rating' => 100,
            'cat_name' => 'Кот Банан',
            'author' => 'Александер'
        ];
    }

    public function getPosts(string $identifier): array
    {
        $posts = [];
        for ($i = 0; $i < rand(3, 12); $i++) {
            $posts[] = [
                'identifier' => uniqid(),
                'title' => 'Кото-пост ' . rand(1000, 9999),
                'content' => 'Текст поста...',
                'rating' => rand(30, 100),
                'reactions' => ['🐱' => 5, '❤️' => rand(10, 20), '😻' => 3]
            ];
        }
        return $posts;
    }
}
