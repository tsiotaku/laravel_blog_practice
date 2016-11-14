<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
require_once 'resources/org/code/Code.class.php'; //引入驗證碼功能
class IndexController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function login()
    {
        if($input = Input::all()){
            $code = new \Code; //產生一個Code物件
            $_code = $code->get(); //使用Code物件中的get()方法得到驗證碼數值
            if($input['code']!=$_code){
                return back()->with('msg','驗證碼錯誤');
                //echo "錯誤";
            }else{
                echo "正確";
            }
        }
        else{
            return view('admin.login');
        }
    }
}
