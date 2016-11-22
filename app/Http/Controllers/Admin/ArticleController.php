<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index(){
        $datas = Article::orderBy('art_id','desc')->paginate(10);
        return view('admin.article.index',compact('datas'));
    }
    public function create(){

        $cate_data = (new Category)->tree();
        return view('admin.article.add',compact('cate_data'));
    }

    public function store(Request $request)
    {
        //$input = Input::all();
        $input = Input::except('_token','file_upload'); //使用except()排除_token驗證csrf欄位，略縮圖尚未做先忽略圖片上傳file_upload欄位
        $input['art_time'] = time();

        $rules = [
            'cate_id' =>'required',
            'art_title' => 'required',
            'art_content' => 'required',
        ];
        $msg = [
            'cate_id.required' => '請選擇文章分類',
            'art_title.required' => '文章標題不能為空',
            'art_content.required' => '文章內容不能為空',
        ];
        $validator = Validator::make($input,$rules,$msg);
        //密碼欄位驗證$input為輸入值,$rules為規則,$msg內建訊息為英文，改寫成中文訊息

        if($validator->passes()){
            $re = Article::create($input);
            if($re){
                return redirect('admin/article')->with('msg','新增成功');
            }else{
                $validator->errors()->add('add_error', '添加失敗');
                return back()->withErrors($validator);
            }
        }else{
            return back()->withInput()->withErrors($validator); //>withInput()跳轉回去保留Input欄位的值
        }

    }

    public function edit($art_id)
    {
        $field = Article::find($art_id);
        $cate_data = (new Category)->tree();
        return view('admin.article.edit',compact('field','cate_data'));
    }

    public function update($id)
    {
        $input = Input::except('_token','_method','file_upload');
        Article::where('art_id',$id)->update($input);
        return redirect('admin/article')->with('msg','修改成功');
    }
}
