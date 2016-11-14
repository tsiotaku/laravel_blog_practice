<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

require_once 'resources/org/code/Code.class.php'; //引入驗證碼功能
class LoginController extends Controller
{
    public function login()
    {
        if($input = Input::all()){
            $code = new \Code; //產生一個Code物件
            $_code = $code->get(); //使用Code物件中的get()方法得到驗證碼數值
            if($input['code']!=$_code){
                return back()->with('msg','驗證碼錯誤');
            }
            $user = User::first();
            if(  $user->user_name != $input['user_name'] || Crypt::decrypt($user->user_pass) != $input['user_pass']){
                //採用Crypt加密，decrypt解密，encrypt加密
                return back()->with('msg','帳號或是密碼錯誤');
            }
            session(['user' => $user]);
            return redirect('admin/index');
        }
        else{
            return view('admin.login');
        }
    }

    public function code()
    {
        $code = new \Code; //產生一個Code物件
        $code->make(); //使用Code物件中的make()方法產生驗證碼
    }

    public function getcode()
    {
        $code = new \Code; //產生一個Code物件
        echo $code->get(); //使用Code物件中的get()方法得到驗證碼數值
    }
}
