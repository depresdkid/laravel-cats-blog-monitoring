<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\Notification;
use App\Services\BlogApi\BlogApiAdapterFactory;
use Illuminate\Support\Facades\DB;


final class BlogSyncService
{
    public function __construct(
        private BlogApiAdapterFactory $factory
    ) {
    }

    public function syncBlog(Blog $blog): void
    {
        $provider = $this->factory->createFromResource($blog->resource);

        $meta = $provider->getBlogMeta($blog->identifier);
        $posts = collect($provider->getPosts($blog->identifier));

        DB::transaction(function () use ($blog, $meta, $posts) {
            $blog->update([
                'cat_name' => $meta['cat_name'],
                'rating' => $meta['rating'],
                'last_sync_at' => now(),
            ]);

            $existingPostsIds = $blog->posts()->pluck('id', 'identifier')->toArray();
            $newPosts = $posts->filter(fn($post) => !in_array($post['identifier'], $existingPostsIds));

            $blog->posts()->upsert(
                $posts->map(fn($post) => [
                    'blog_id' => $blog->id,
                    'identifier' => $post['identifier'],
                    'title' => $post['title'],
                    'content' => $post['content'],
                    'rating' => $post['rating'],
                    'reactions' => json_encode($post['reactions']),
                ])->toArray(),
                ['blog_id', 'identifier'],
                ['title', 'content', 'rating', 'reactions']
            );

            $blog->posts()->whereNotIn('identifier', $posts->pluck('id', 'identifier'))->delete();

            if ($newPosts->isNotEmpty()) {
                Notification::create([
                    'blog_id' => $blog->id,
                    'sync_date' => now(),
                    'report' => $newPosts->map(fn($post) => [
                        'title' => $post['title'],
                        'rating' => $post['rating'],
                    ])->toArray(),
                ]);
            }
        });
    }
}

