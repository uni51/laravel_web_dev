<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookdetail extends Model
{
    /**
     * 書籍詳細は1つの書籍レコードと紐づく
     */
    public function book()
    {
        return $this->belongsTo('\App\Book');
    }
}
