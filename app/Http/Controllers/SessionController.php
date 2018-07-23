<?php

namespace App\Http\Controllers;

use App\Model\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth', [
//            'except' => ['logout']
//        ]);
//
//        $this->middleware('guest', [
//            'only' => ['login','store']
//        ]);
    }


    public function login(){
        return view('session/login');
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
            'captcha' => 'required|captcha',
        ],[
            'name.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '验证码错误',
        ]);
        $user=DB::table('shop_users')->where('name',$request->name)->get();
        $shop_id=$user[0]->shop_id;
        $status=DB::table('shops')->where('id',$shop_id)->get()[0]->status;
        if($status!=1){
            return back()->with('danger','该账号商家被禁用')->withInput();
        }
        if(Auth::attempt(['name'=>$request->name,'password'=>$request->password,'status'=>1],$request->remember)){
//            if(Auth::user()->shop->status){
                return redirect()->route('shops.show',[Auth::user()->shop->id])->with('success','登录成功');
//            }else{
//                return redirect()->route('logout')->with('danger','用户名或密码错误')->withInput();
//            }
        }else{
            return back()->with('danger','用户名或密码错误')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        echo json_encode(['success'=>'success']);
        //return redirect()->route('login')->with('warning','注销成功');
    }
}
