<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use SoftDeletes; // 論理削除用に追加する

    /*
     * 著者は複数の書籍レコードを持つ
     */
    public function books()
    {
        return $this->hasMany('\App\Book');
    }
}
