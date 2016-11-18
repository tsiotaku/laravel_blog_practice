<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

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
     * @return $arr

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
     * 文章排序修改
     *
     * @return $data
     */
    public function changeOrder(){
        $input = Input::all();
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $result = $cate->update();
        if($result){
            $data =[
                'status' => '0',
                'msg' => '排序更新成功',
            ];
        }else{
            $data =[
                'status' => '1',
                'msg' => '排序更新失敗',
            ];
        }
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate_data = Category::where('cate_pid' , 0)->get();
        return view('admin.category.add',compact('cate_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$input = Input::all();
        $input = Input::except('_token'); //使用except()排除_token欄位

        $rules = [
            'cate_pid' =>'required',
            'cate_name' => 'required',
            'cate_title' => 'required',
            'cate_order' => 'required',
        ];
        $msg = [
            'cate_pid.required' => '請選擇父級分類',
            'cate_name.required' => '分類名稱不能為空',
            'cate_title.required' => '分類標題不能為空',
            'cate_order.required' => '分類排序不能為空',

        ];
        $validator = Validator::make($input,$rules,$msg);
        //密碼欄位驗證$input為輸入值,$rules為規則,$msg內建訊息為英文，改寫成中文訊息
        if($validator->passes()){
            $re = Category::create($input);
            if($re){
                return redirect('admin/category');
            }else{
                $validator->errors()->add('add_error', '添加失敗');
                return back()->withErrors($validator);
            }
        }else{
            return back()->withErrors($validator);
        }

        return view('admin.pass');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cate_id)
    {
        $field = Category::find($cate_id);
        $cate_data = Category::where('cate_pid' , 0)->get();
        if($field->cate_pid !=0){
        //編輯主分類可能會造成資料錯亂，因此需判斷編輯的是否為主分類，是的話跳轉到首頁避免讓使用者編輯
        return view('admin.category.edit',compact('field','cate_data'));
        }else{
            return redirect('admin/index');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $input = Input::except('_token','_method'); //使用except()排、_methodtoken欄位d $result =
        Category::where('cate_id',$id)->update($input);
        return  redirect('admin/category');
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
