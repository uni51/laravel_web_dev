<?php
declare(strict_types=1);

namespace App\Providers;

use App\Console\Commands\SendOrdersCommand;
use App\UseCases\SendOrdersUseCase;
use App\Services\ExportOrdersService;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Illuminate\Log\Writer;
use Illuminate\Support\ServiceProvider;

class BatchServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        // SendOrdersCommandクラスの生成方法をバインド
        $this->app->bind(SendOrdersCommand::class, function () {
            $useCase = app(SendOrdersUseCase::class);
            /** @var Writer $logger */
            $logger = app('log');
            $logger->useFiles(storage_path() . '/logs/send-orders.log');

            return new SendOrdersCommand($useCase, $logger);
        });

        $this->app->bind(SendOrdersUseCase::class, function () {
            $service = $this->app->make(ExportOrdersService::class);
            // Guzzle用にログ用ミドルウェアを追加
            $guzzle = new Client([
                'handler' => tap(HandlerStack::create(), function (HandlerStack $v) {
                    /** @var Writer $logger */
                    $logger = $this->app->make(Writer::class);

                    $v->push(Middleware::log(
                        $logger->getMonolog(),
                        new MessageFormatter(">>>\n{req_headers}\n<<<\n{res_headers}\n\n{res_body}")
                    ));
                })
            ]);

            return new SendOrdersUseCase($service, $guzzle);
        });
    }
}