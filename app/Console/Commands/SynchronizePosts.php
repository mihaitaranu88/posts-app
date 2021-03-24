<?php

namespace App\Console\Commands;

use App\Jobs\SyncPostsJob;
use Illuminate\Console\Command;
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
     * @return int
     */
    public function handle()
    {
        $this->info('Starting synchronizing posts');

        $ch = curl_init();
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',

        );
        curl_setopt($ch, CURLOPT_URL, 'https://jsonplaceholder.typicode.com/posts');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Timeout in seconds
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);

        $posts = json_decode($response);

        foreach (array_chunk($posts,100) as $posts_group){
            Queue::push(new SyncPostsJob($posts_group));
        }

        $this->info('Posts were added to the queue');
    }
}
