<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /*
     * 書籍は1つの著者レコードと紐づく
     */
    public function author()
    {
        return $this->belongsTo('\App\Author');
    }

    /*
     * 書籍は書籍詳細レコードを持つ
     */
    public function detail()
    {
        return $this->hasOne('\App\Bookdetail');
    }
}
