<?php
namespace Login\Controller;
use Think\Controller;
class LoginController extends Controller {
    // 访问模块的login页面
    public function index(){
        $this->display('login');
    }

    // 跳转到错误页面
    public function error(){
        $this->display('error');
    }

    // 登录前验证密码是否对应相等
    public function vericate($userName,$password){

        //这样实例化可以清楚看到model位置。
        $User = new \Common\Model\UserModel();
        $passwordDb = $User->where("userName='".$userName."'")->getField('password');

        // 调用php的系统函数，验证字符串是否完全相等
        if (strcmp($password,$passwordDb)==0) {
            // 两个字符串相等
            return true;
        }
        else{
            return false;
        }
    }

    // 登录
    public function login()
    {
        $userName = $_POST['userName'];
        $password = $_POST['password'];

        // 调用vericate函数验证密码，若正确返回0表示验证通过
        if ($this->vericate($userName,$password)) {
            echo 0;
        }
        else{
            echo 3;
        }
    }

    // 跳转到应用主界面，并传递用户名
    public function main(){
        $this->assign('userName',$userName);
        $this->display('main');
    }
}