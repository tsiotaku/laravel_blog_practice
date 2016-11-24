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

        //使用foreach取的$data->field_type的值再用switch判斷，input、textarea、radio各自有不同處理
        foreach($datas as $key=>$data){
            switch($data->field_type){
                case 'input':
                    $datas[$key]->_html= "<input type='text' class='lg' name='conf_content[]' value='".$data->conf_content."' >";
                break;

                case 'textarea':
                    $datas[$key]->_html= "<textarea type='text' class='lg' name='conf_content[]'>".$data->conf_content."</textarea>";
                break;

                case 'radio':
                    /*radio的值
                    $data->field_type：1|开启,0|关闭
                    $arrStr = 1|开启 ($arr)
                              0|关闭 ($arr)
                    $radioVal= 1
                               开启,
                               0
                               关闭,
                    */
                    $arrStr = explode(',',$data->field_value);
                    $str = '';
                    foreach($arrStr as $arr){
                        $radioVal = explode('|',$arr);
                        $radrioChecked = $data->conf_content==$radioVal[0]? 'checked' : '' ;//判斷變量值是否與radio的值相等，是的話checked當前radio
                        $str.= "<input type='radio' name='conf_content[]' value='".$radioVal[0]."' ".$radrioChecked." >".$radioVal[1];
                        $datas[$key]->_html= $str ;
                    }
                break;
            }
        }

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
            'conf_title' =>'required',
            'conf_name' =>'required',
        ];
        $msg = [
            'conf_title.required' => '標題不能為空',
            'conf_name.required' => '名稱不能為空',
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

    public function changeContent(){
        $input = Input::all();
        foreach($input['conf_id'] as $k=>$v){
            Config::where('conf_id',$v)->update([ 'conf_content' => $input['conf_content'][$k] ]);
        }
        return back()->with('msg','修改成功');
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
