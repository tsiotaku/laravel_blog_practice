<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';
    protected $primaryKey='art_id';
    public $timestamps =false;
    protected $guarded=[]; //要排除寫入資料庫的欄位，留空默認所有可寫入

}
