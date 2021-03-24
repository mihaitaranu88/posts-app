<?php

namespace App\Console\Commands;

use App\Jobs\SyncUsersJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;

class SynchronizeUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize users';

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
        $this->info('Starting synchronizing users');

        $response = Http::get('https://jsonplaceholder.typicode.com/users');

        $users = $response->json();

        foreach (array_chunk($users,100) as $users_group){
            Queue::push(new SyncUsersJob($users_group));
        }

        $this->info('Users were added to the queue');

    }
}
