<?php

namespace App\Services\BlogProviders\Interfaces;

interface BlogProviderInterface
{
    /** TODO Сделать возвращаемый данные в формате DTO */
    /**
     * Получить мета-информацию блога
     *
     * @return array ['name' => '', 'rating' => 0, 'cat_name' => '', 'author' => '']
     */
    public function getBlogMeta(string $identifier): array;

    /**
     * Получить посты блога
     *
     * @return array [['identifier' => '', 'title' => '', 'content' => '', 'rating' => 0, 'reactions' => []], ...]
     */
    public function getPosts(string $identifier): array;
}
