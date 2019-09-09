<?php
// 厳格な型検査モードの指定構文
declare(strict_types=1);

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * 書籍では取り扱いませんでしたが、書籍（Book）テーブルへのデータ投入についても記載します。
         * 下記のコードでBookテーブルに50レコード投入します。
         */
        for ($i = 1; $i <= 50; $i++) {
            factory(\App\Book::class)->create(['bookdetail_id' => $i]);
        }
    }
}
