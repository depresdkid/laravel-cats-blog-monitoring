<?php

namespace App\Services\BlogApi\Adapters;

use App\Services\BlogApi\Interfaces\BlogApiAdaptersInterface;

class MockMeowBlogAdapter implements BlogApiAdaptersInterface
{
    public function getBlogMeta(string $identifier): array
    {
        return [
            'name' => 'Meow Blog',
            'rating' => 100,
            'cat_name' => 'Big Floppa',
            'author' => 'Кирилл'
        ];
    }

    public function getPosts(string $identifier): array
    {
        $posts = [];
        for ($i = 0; $i < rand(3, 5); $i++) {
            $posts[] = [
                'identifier' => uniqid(),
                'title' => 'Флоппа ' . rand(1000, 9999),
                'content' => 'Очень большой флоппа...',
                'rating' => rand(30, 100),
                'reactions' => ['🐱' => 15, '❤️' => rand(10, 20), '😻' => 3]
            ];
        }
        return $posts;
    }
}
