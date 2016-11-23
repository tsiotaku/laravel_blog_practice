<?php

namespace App\Http\Controllers\Admin;

use App\Link;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class LinkController extends Controller
{
    public function index()
    {
        $datas = Link::all();
        return view('admin.link.index',compact('datas'));
    }

    public function show(){
        
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
