<?php

use Faker\Generator as Faker;

$factory->define(App\Bookdetail::class, function (Faker $faker) {
    $now = \Carbon\Carbon::now();
    return [
        'isbn' => $faker->isbn13,
        'published_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'price' => $faker->randomNumber(4),
        'created_at' => $now,
        'updated_at' => $now
    ];
});

/**
 * 書籍では取り扱いませんでしたが、書籍（Book）テーブルへのデータ投入についても記載します。
 * name（書籍名）はfakerのrealTextメソッドを利用してランダムな文字列を、
 * author_id と publisher_id には、登録済みの著者IDおよび出版社IDを各モデルクラスからランダムに取得して入れています。
 */
$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'name' => $faker->realText(10, 1),
        'author_id' => \App\Author::get()->random()->id,
        'publisher_id' => \App\Publisher::get()->random()->id
    ];
});