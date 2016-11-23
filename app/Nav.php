<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    protected $table = 'navs';
    protected $primaryKey='nav_id';
    public $timestamps =false;
    protected $guarded=[]; //要排除寫入資料庫的欄位，留空默認所有可寫入
}
