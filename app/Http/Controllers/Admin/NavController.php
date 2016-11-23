<?php

namespace App\Http\Controllers\Admin;

use App\Nav;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavController extends Controller
{
    public function index()
    {
        $datas = Nav::all();
        return view('admin.nav.index',compact('datas'));
    }

    public function show(){
        
    }

    public function create()
    {
        return view('admin.nav.add');
    }

    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'nav_name' =>'required',
            'nav_url' => 'required',
        ];
        $msg = [
            'nav_name.required' => '名稱不能為空',
            'nav_url.required' => '網址不能為空',
        ];

        $validator = Validator::make($input,$rules,$msg);

        if($validator->passes()){
            $re = Nav::create($input);
            if($re){
                return redirect('admin/nav')->with('msg','新增成功');
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
        $datas = Nav::find($id);
        return view('admin.nav.edit',compact('datas'));
    }

    public function update(Request $request, $id)
    {
        $input = Input::except('_token','_method'); //使用except()排除_token、_method欄位
        Nav::where('nav_id',$id)->update($input);
        return  redirect('admin/nav')->with('msg','修改成功');
    }

    public function changeOrder(){
        $input = Input::all();
        $nav = Nav::find($input['nav_id']);
        $nav->nav_order = $input['nav_order'];
        $result = $nav->update();
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
            $re = Nav::destroy($id);
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
