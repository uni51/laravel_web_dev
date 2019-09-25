<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\UseCases\ExportOrdersUseCase;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExportOrdersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:export-orders {date} {--output=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '購入情報を出力する';

    /** @var ExportOrdersUseCase */
    private $useCase;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ExportOrdersUseCase $useCase)
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
        // ① 引数dateの値を取得する
        $date = $this->argument('date');
        // ② $dateの値（文字列）からCarbonインスタンスを生成
        $targetDate = Carbon::createFromFormat('Ymd', $date);

        // ③ ユースケースクラスに日付を渡す
        $tsv = $this->useCase->run($targetDate);

        // (1) outputオプションの値を取得
        $outputFilePath = $this->option('output');

        // (2) nullであれば未指定なので、標準出力に出力
        if (is_null($outputFilePath)) {
            echo $tsv;
            return;
        }
        // (3) ファイルに出力
        file_put_contents($outputFilePath, $tsv);
    }
}
