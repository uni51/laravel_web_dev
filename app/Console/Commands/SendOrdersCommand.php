<?php

namespace App\Console\Commands;

use App\UseCases\SendOrdersUseCase;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Psr\Log\LoggerInterface;

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

    /** @var LoggerInterface */
    private $logger;

    /**
     * @param SendOrdersUseCase $useCase
     * @param LoggerInterface $logger
     */
    public function __construct(SendOrdersUseCase $useCase, LoggerInterface $logger)
    {
        parent::__construct();

        $this->useCase = $useCase;
        $this->logger = $logger;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // (1) バッチ処理開始ログ
        $this->logger->info(__METHOD__ . ' ' . 'start');

        // 引数dateの値を取得する
        $date = $this->argument('date');
        $targetDate = Carbon::createFromFormat('Ymd', $date);

        // (2) バッチコマンド引数を出力
        $this->logger->info('TargetDate:' . $date);

        $count = $this->useCase->run($targetDate);

        $this->logger->info(__METHOD__ . ' ' . 'done sent_count:' . $count);
    }
}
