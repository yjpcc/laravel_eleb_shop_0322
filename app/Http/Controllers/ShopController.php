<?php

namespace App\Http\Controllers;

use App\Model\Shop;
use App\Model\ShopCategory;
use App\Model\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function index()
    {
        $shops=Shop::paginate(5);
        return view('shop/index', compact('shops'));
    }

    public function show(Shop $shop)
    {
        return view('shop/show', compact('shop'));
    }

    public function create()
    {
        $categorys=ShopCategory::all();
        return view('shop/create',compact('categorys'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:shop_users',
            'email' => 'required|email|unique:shop_users',
            'password'=>'required|confirmed',
            'shop_name'=>'required',
            'shop_category_id'=>'required',
            'shop_img'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
            'captcha' => 'required|captcha',
        ], [
            'name.required' => '名字不能为空',
            'name.unique' => '名字已存在',
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式错误',
            'email.unique' => '邮箱不能重复',
            'password.required'=>'密码不能为空',
            'password.confirmed'=>'两次输入的密码不一致',
            'shop_name.required' => '店铺名称不能为空',
            'shop_category_id.required' => '店铺分类不能为空',
            'shop_img.required' => '店铺图片不能为空',
            'start_send.required' => '起送金额不能为空',
            'send_cost.required' => '配送费不能为空',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '验证码错误',
        ]);

        $data = $request->all();
        $data['status']=0;
        $data['password']=bcrypt($request->password);
        if(!$request->notice){
            $data['notice']='';
        }

        if(!$request->discount){
            $data['discount']='';
        }
        if ($request->shop_img) {
            $result=$request->shop_img->store('public/shop_img');
            if ($result) {
                $data['shop_img'] = url(Storage::url($result));
            }
        }
        DB::beginTransaction();
        try{
            $create=Shop::create($data);
            $data['shop_id']=$create->id;
            ShopUser::create($data);
            DB::commit();
            return redirect()->route('shops.index',[$create->id])->with("success", "注册成功,等待审核中...");
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with("success", "注册失败")->withInput();
        }
    }

//    public function edit(Shop $shop)
//    {
//        //$this->authorize('update',$shop);
//        $categorys=ShopCategory::all();
//        return view('shop.edit', compact('shop','categorys'));
//    }
//
//    public function update(Request $request, Shop $shop)
//    {
//
//        //$this->authorize('update',$shop);
//        $this->validate($request, [
//            'name' => 'required',
//            'email' =>['required',Rule::unique('shop_users')->ignore($shop->shop_user->id)],
//            'password'=>'confirmed',
//            'shop_name'=>'required',
//            'shop_category_id'=>'required',
//            'start_send'=>'required',
//            'send_cost'=>'required',
//            'captcha' => 'required|captcha',
//        ], [
//            'name.required' => '名字不能为空',
//            'email.required' => '邮箱不能为空',
//            'email.unique' => '邮箱不能重复',
//            'password.required'=>'密码不能为空',
//            'password.confirmed'=>'两次输入的密码不一致',
//            'shop_name.required' => '店铺名称不能为空',
//            'shop_category_id.required' => '店铺分类不能为空',
//            'start_send.required' => '起送金额不能为空',
//            'send_cost.required' => '配送费不能为空',
//            'captcha.required' => '验证码不能为空',
//            'captcha.captcha' => '验证码错误',
//        ]);
//
//
//        $shop_data=[
//            'name'=>$request->name,
//            'email'=>$request->email,
//        ];
//        if($request->password){
//            $shop_data['password']=bcrypt($request->password);
//        }
//        $data=[
//            'shop_category_id'=>$request->shop_category_id,
//            'shop_name'=>$request->shop_name,
//            'start_send'=>$request->start_send,
//            'send_cost'=>$request->send_cost,
//        ];
//        if ($request->shop_img) {
//            $result=$request->shop_img->store('public/shop_img');
//            if ($result) {
//                $data['shop_img'] = url(Storage::url($result));
//            }
//        }
//
//        $request->brand?$data['brand']=1:$data['brand']=0;
//
//        $request->on_time?$data['on_time']=1:$data['on_time']=0;
//
//        $request->fengniao?$data['fengniao']=1:$data['fengniao']=0;
//
//        $request->bao?$data['bao']=1:$data['bao']=0;
//
//        $request->piao?$data['piao']=1:$data['piao']=0;
//
//        $request->zhun?$data['zhun']=1:$data['zhun']=0;
//
//        if($request->notice){
//            $data['notice']=$request->notice;
//        }
//
//        if($request->discount){
//            $data['discount']=$request->discount;
//        }
//
//        if($request->shop_rating){
//            $data['shop_rating']=$request->shop_rating;
//        }
//        DB::beginTransaction();
//        try{
//            $shop->update($data);
//            $shop->shop_user->update($shop_data);
//
//            DB::commit();
//            session()->flash("success", "修改成功");
//            return redirect()->route('shops.index');
//        }catch (\Exception $e){
//            DB::rollBack();
//            session()->flash("success", "修改失败");
//            return back()->withInput();
//        }
//    }
//
//    public function destroy(Shop $shop)
//    {
//        //$this->authorize('update',$shop);
//        $shop->delete();
//        session()->flash("success", "删除成功");
//        return redirect()->route('shops.index');
//    }



}
