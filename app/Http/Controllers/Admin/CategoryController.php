<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /*寫法一
       $categorys = Category::all();
        $datas = $this->getTree($categorys,'cate_name','cate_id','cate_pid');*/

        /*寫法二 使用Category::tree()，model需使用static function
        $categorys = Category::tree();*/

        //寫法三 使用(new Category)->tree()，model不用使用static function，在function直接使用$this調用
        $categorys = (new Category)->tree();
        return view('admin.category.index')->with('datas',$categorys);
    }

    /*寫法一
     * @param $datas  //Category::all()取得的所有文章資訊
     * @param $file_name  //子分類陣列變數$file_name前面加上'_'頁面上用以增加顯示'├── '符號於子分類前，ex:├── 军事新闻
     * @param $field_id  //文章分類的id
     * @param $field_pid  //子分類屬於哪個主分類pid值為主分類的值
     * @return array

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
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
