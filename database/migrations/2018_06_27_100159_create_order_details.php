<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetails extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->string('order_code', 32);
            $table->integer('detail_no');
            $table->string('item_name', 100);
            $table->integer('item_price');
            $table->integer('quantity');
            $table->integer('subtotal_price');

            // PK設定（「DUMMY_NAME」を設定しないと、マイグレーションで失敗する）
            $table->primary(['order_code', 'detail_no'], 'DUMMY_NAME');

            $table->index('order_code');
            /** @noinspection PhpUndefinedMethodInspection */
            $table->foreign('order_code')->references('order_code')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_details');
    }
}
