<?php

namespace App\Http\Controllers\Admin;

use App\Link;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinkController extends Controller
{
    public function index()
    {
        $datas = Link::all();
        return view('admin.link.index',compact('datas'));
    }

    public function show(){
        
    }

    public function create()
    {
        return view('admin.link.add');
    }

    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'link_name' =>'required',
            'link_url' => 'required',
        ];
        $msg = [
            'link_name.required' => '名稱不能為空',
            'link_url.required' => '網址不能為空',
        ];

        $validator = Validator::make($input,$rules,$msg);

        if($validator->passes()){
            $re = Link::create($input);
            if($re){
                return redirect('admin/link')->with('msg','新增成功');
            }else{
                $validator->errors()->add('add_error', '添加失敗');
                return back()->withErrors($validator);
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    public function edit($id)
    {
        $datas = Link::find($id);
        return view('admin.link.edit',compact('datas'));
    }

    public function update(Request $request, $id)
    {
        $input = Input::except('_token','_method'); //使用except()排除_token、_method欄位
        Link::where('link_id',$id)->update($input);
        return  redirect('admin/link')->with('msg','修改成功');
    }

    public function changeOrder(){
        $input = Input::all();
        $link = Link::find($input['link_id']);
        $link->link_order = $input['link_order'];
        $result = $link->update();
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

    public function destroy($id)
    {
            $re = Link::destroy($id);
            if($re ==1){
                $data =[
                    'status' => '0',
                    'msg' => '刪除成功',
                ];
            }else{
                $data =[
                    'status' => '1',
                    'msg' => '刪除失敗',
                ];
            }
        return $data;
    }

}
