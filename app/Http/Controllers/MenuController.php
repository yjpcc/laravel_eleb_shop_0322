<?php

namespace App\Http\Controllers;

use App\Model\Menu;
use App\Model\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $menus=Menu::where("shop_id",Auth::user()->shop_id)->paginate(10);
        return view('menu/index', compact('menus'));
    }

    public function show(Menu $menu)
    {
        return view('menu/show', compact('menu'));
    }

    public function create()
    {
        $menucategorys=MenuCategory::where("shop_id",Auth::user()->shop_id)->get();
        return view('menu/create',compact('menucategorys'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'goods_name' => 'required',
            'category_id' => 'required',
            'goods_price' => 'required|min:0',
            'description'=>'required',
            'goods_img'=>'required',
            'captcha' => 'required|captcha',
        ], [
            'goods_name.required' => '名字不能为空',
            'category_id.required' => '分类不能为空',
            'goods_price.required' => '价格不能为空',
            'goods_price.min' => '价格不能小于0',
            'description.required' => '描述不能为空',
            'goods_img.required' => '图片不能为空',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '验证码错误',
        ]);
        $data = $request->all();
        $data['shop_id']=Auth::user()->shop_id;
        if(!$request->tips){
            $data['tips']='';
        }


        Menu::create($data);
        return redirect()->route('menus.index')->with("success", "添加成功");
    }

    public function edit(Menu $menu)
    {
        //$this->authorize('update',$menu);
        $menucategorys=MenuCategory::where("shop_id",Auth::user()->shop_id)->get();
        return view('menu.edit', compact('menu','menucategorys'));
    }

    public function update(Request $request,Menu $menu)
    {

        //$this->authorize('update',$menu);
        $this->validate($request, [
            'goods_name' => 'required',
            'category_id' => 'required',
            'goods_price' => 'required|min:0',
            'description'=>'required',
        ], [
            'goods_name.required' => '名字不能为空',
            'category_id.required' => '分类不能为空',
            'goods_price.required' => '价格不能为空',
            'goods_price.min' => '价格不能小于0',
            'description.required' => '描述不能为空',
        ]);
        $data = $request->all();
        if(!$request->tips){
            $data['tips']='';
        }

        $menu->update($data);
        return redirect()->route('menus.index')->with("success", "修改成功");
    }

    public function destroy(Menu $menu)
    {
        //$this->authorize('update',$menu);
        $menu->delete();
        return redirect()->route('menus.index')->with("success", "删除成功");
    }
}
