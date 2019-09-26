<?php

namespace App\Console\Commands;

use App\UseCases\SendOrdersUseCase;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendOrdersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-orders {date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '購入情報を送信する';

    /** @var SendOrdersUseCase */
    private $useCase;

    /**
     * @param SendOrdersUseCase $useCase
     */
    public function __construct(SendOrdersUseCase $useCase)
    {
        parent::__construct();
        $this->useCase = $useCase;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 引数dateの値を取得する
        $date = $this->argument('date');
        $targetDate = Carbon::createFromFormat('Ymd', $date);

        $this->useCase->run($targetDate);

        $this->info('Send Orders');
    }
}
