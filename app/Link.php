<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';
    protected $primaryKey='link_id';
    public $timestamps =false;
    protected $guarded=[]; //要排除寫入資料庫的欄位，留空默認所有可寫入
}
