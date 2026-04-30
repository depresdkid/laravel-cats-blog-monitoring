<?php

namespace App\Services\BlogApi;

use App\Models\Resource;
use App\Services\BlogApi\Adapters\MockMeowBlogAdapter;
use App\Services\BlogApi\Adapters\MockSuperCuteCatsAdapter;
use App\Services\BlogApi\Interfaces\BlogApiAdapterInterface;
use Exception;

class BlogApiAdapterFactory
{
    public static function create(string $driver): BlogApiAdapterInterface
    {
        return match ($driver) {
            'cute_cats' => new MockSuperCuteCatsAdapter(),
            'meow_blog' => new MockMeowBlogAdapter(),
            default => throw new Exception("Unsupported driver: {$driver}")
        };
    }

    public static function createFromResource(Resource $resource): BlogApiAdapterInterface
    {
        return self::create($resource->driver);
    }
}
