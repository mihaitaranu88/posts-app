<?php

namespace App\Console\Commands;

use App\Jobs\SyncPostsJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;

class SynchronizePosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize posts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Starting synchronizing posts');

        $response = Http::get('https://jsonplaceholder.typicode.com/posts');

        $posts = $response->json();

        foreach (array_chunk($posts,100) as $posts_group){
            Queue::push(new SyncPostsJob($posts_group));
        }

        $this->info('Posts were added to the queue');
    }
}
