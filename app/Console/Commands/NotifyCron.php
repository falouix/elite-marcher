<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NotifyCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cdf:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scheduled jod for Notification Module';

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
        \Log::info("Cron Notify is working fine!");

        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */
        return 0;
    }
}
