<?php
declare(strict_types=1);

namespace App\UseCases;

use Carbon\Carbon;

final class ExportOrdersUseCase
{
    /**
     * @param Carbon $targetDate
     * @return string
     */
    public function run(Carbon $targetDate)
    {
        return $targetDate->format('Y-m-d').'の購入情報';
    }
}