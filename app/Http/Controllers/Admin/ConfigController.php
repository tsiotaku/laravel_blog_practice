<?php

namespace App\Http\Controllers\Admin;

use App\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends Controller
{
    public function index()
    {
        $datas = Config::all();
        return view('admin.config.index',compact('datas'));
    }

    public function show(){
        
    }

    public function create()
    {
        return view('admin.config.add');
    }

    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'conf_name' =>'required',
        ];
        $msg = [
            'conf_name.required' => '不能為空',
        ];

        $validator = Validator::make($input,$rules,$msg);

        if($validator->passes()){
            $re = Config::create($input);
            if($re){
                return redirect('admin/config')->with('msg','新增成功');
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
        $datas = Config::find($id);
        return view('admin.config.edit',compact('datas'));
    }

    public function update(Request $request, $id)
    {
        $input = Input::except('_token','_method'); //使用except()排除_token、_method欄位
        Config::where('conf_id',$id)->update($input);
        return  redirect('admin/config')->with('msg','修改成功');
    }

    public function changeOrder(){
        $input = Input::all();
        $config = Config::find($input['conf_id']);
        $config->conf_order = $input['conf_order'];
        $result = $config->update();
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
            $re = Config::destroy($id);
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
