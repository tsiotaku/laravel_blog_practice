<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey='cate_id';
    public $timestamps =false;
    //寫法三 使用$this調用
    public function tree(){
        $categorys = $this->all();
        return $this->getTree($categorys,'cate_name','cate_id','cate_pid');
    }

    /* 寫法二 使用static
        public static function tree(){
        $categorys = Category::all();
        return (new Category)->getTree($categorys,'cate_name','cate_id','cate_pid');
    }
     */

    /* 寫法二 寫法三
     * @param $datas  //Category::all()取得的所有文章資訊
     * @param $file_name  //子分類陣列變數$file_name前面加上'_'頁面上用以增加顯示'├── '符號於子分類前，ex:├── 军事新闻
     * @param $field_id  //文章分類的id
     * @param $field_pid  //子分類屬於哪個主分類pid值為主分類的值
     * @return array
     */
    public function getTree($datas,$file_name,$field_id,$field_pid){
        $arr = array();
        foreach($datas as $k => $v){
            if($v->$field_pid == 0 ){
                $datas[$k]['_'.$file_name] = $datas[$k][$file_name];
                $arr[] =  $datas[$k];
                foreach($datas as $m =>$n){
                    if($n->$field_pid == $v->$field_id){
                        $datas[$m]['_'.$file_name] = '├── '.$datas[$m][$file_name];
                        $arr[] =  $datas[$m];
                    }
                }
            }
        }
        return $arr;
    }
}
