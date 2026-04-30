<?php

namespace App\Console\Commands;

use App\Jobs\SyncBlogJob;
use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RunBlogSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blogs:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Синхронизировать блоги, которые пора обновлять';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $processedCount = 0;
        Blog::where('last_sync_at)', '<=', now())->chunkById(100, function ($blogs) {
            foreach ($blogs as $blog) {
                SyncBlogJob::dispatch($blog);
                $processedCount++;
            }
        });

        $this->info("Запланировано {$processedCount} задач на синхронизацию.");
    }
}
