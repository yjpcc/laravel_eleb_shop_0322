<?php

namespace App\Http\Controllers;

use App\Model\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ShopUserController extends Controller
{
    public function editInfo(Request $request,ShopUser $shopuser){
        $this->authorize('update',$shopuser);
        $this->validate($request, [
            'name' =>['required',Rule::unique('shop_users')->ignore($shopuser->id)],
        ], [
            'name.required' => '用户名不能为空',
            'name.unique' => '用户名已存在',
        ]);
        
        $shopuser->update(['name'=>$request->name]);
        return redirect()->route('shops.show',[$shopuser])->with("success", "修改成功");
    }

    public function editPwd(Request $request,ShopUser $shopuser)
    {
        $this->authorize('update',$shopuser);
        $this->validate($request, [
            'oldpassword'=>'required',
            'password'=>'required|confirmed',
        ], [
            'password.required'=>'新密码不能为空',
            'password.confirmed'=>'两次输入的密码不一致',
        ]);

        if (Hash::check($request->oldpassword, $shopuser->password)) {
            $shopuser->update(['password'=>bcrypt($request->password)]);
            return redirect()->route('shops.show',[$shopuser])->with('success','修改成功');
        }else{
            return redirect()->route('shops.show',[$shopuser])->with('danger','旧密码错误')->withInput();
        }
    }
}
