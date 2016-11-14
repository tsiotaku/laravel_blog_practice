<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

require_once 'resources/org/code/Code.class.php'; //引入驗證碼功能
class LoginController extends Controller
{
    public function login()
    {
        return view('admin.login');
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
