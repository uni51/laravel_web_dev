<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendOrdersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '購入情報を送信する';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('Send Orders');
    }
}
