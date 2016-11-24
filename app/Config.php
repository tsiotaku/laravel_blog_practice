<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'Config';
    protected $primaryKey='Con_id';
    public $timestamps =false;
    protected $guarded=[]; //要排除寫入資料庫的欄位，留空默認所有可寫入
}
