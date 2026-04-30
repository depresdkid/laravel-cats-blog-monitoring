<?php

namespace App\Console\Commands;

use App\Jobs\SyncBlogJob;
use App\Models\Blog;
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

        Blog::where(function ($query) {
            $query->whereNull('last_sync_at')
                ->orWhereRaw("datetime(last_sync_at, '+' || check_interval || ' seconds') <= datetime('now')");
        })->chunkById(100, function ($blogs) use (&$processedCount) {
            foreach ($blogs as $blog) {
                SyncBlogJob::dispatch($blog);
                $processedCount++;
            }
        });

        $this->info("Запланировано {$processedCount} задач на синхронизацию.");
    }
}
