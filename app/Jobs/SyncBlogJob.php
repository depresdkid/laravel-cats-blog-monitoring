<?php

namespace App\Jobs;

use App\Models\Blog;
use App\Services\BlogSyncService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncBlogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Blog $blog
    ) {
    }

    public function handle(BlogSyncService $service): void
    {
        $service->syncBlog($this->blog);
    }

}
