<?php

namespace App\Http\Controllers;

use App\Model\Menu;
use App\Model\MenuCategory;
use App\Model\Shop;
use App\SphinxClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class MenuCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id=Auth::user()->shop_id;
        $count=MenuCategory::where(['shop_id'=>$id,'is_selected'=>1])->count();
        $num=MenuCategory::where(['shop_id'=>$id])->count();
        if($num>0&&$count==0){
            MenuCategory::where('shop_id',$id)->first()
                ->update(['is_selected'=>1]);
        }
        $menucategorys=MenuCategory::where('shop_id',$id)->paginate(10);

        return view('menucategory/index', compact('menucategorys'));
    }

    public function show(MenuCategory $menucategory)
    {
        return view('menucategory/show', compact('menucategory'));
    }

    public function create()
    {
        return view('menucategory/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description'=>'required',
            'captcha' => 'required|captcha',
        ], [
            'name.required' => '名字不能为空',
            'description.required' => '描述不能为空',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '验证码错误',
        ]);
        $data = $request->all();
        $id=Auth::user()->shop_id;
        if($request->is_selected){
            MenuCategory::where(['shop_id'=>$id,'is_selected'=>1])
                ->update(['is_selected'=>0]);
        }else{
            $data['is_selected']=0;
        }

        $data['type_accumulation']=str_random(16);
        $data['shop_id']=Auth::user()->shop_id;
        MenuCategory::create($data);
        Redis::del('shop');
        return redirect()->route('menucategorys.index')->with("success", "添加成功");
    }

    public function edit(MenuCategory $menucategory)
    {
        //$this->authorize('update',$menucategory);
        return view('menucategory.edit', compact('menucategory'));
    }

    public function update(Request $request,MenuCategory $menucategory)
    {

      //  $this->authorize('update',$menucategory);
        $this->validate($request, [
            'name' => 'required',
            'description'=>'required',
//            'captcha' => 'required|captcha',
        ], [
            'name.required' => '名字不能为空',
            'description.required' => '描述不能为空',
//            'captcha.required' => '验证码不能为空',
//            'captcha.captcha' => '验证码错误',
        ]);
        $data = $request->all();
        if($request->is_selected){
            $id=Auth::user()->shop_id;
            MenuCategory::where(['shop_id'=>$id,'is_selected'=>1])
                ->where('id','<>',$menucategory->id)
                ->update(['is_selected'=>0]);
        }else{
            $data['is_selected']=0;
        }
        $menucategory->update($data);
        Redis::del('shop');
        return redirect()->route('menucategorys.index')->with("success", "修改成功");
    }

    public function destroy(MenuCategory $menucategory)
    {
        //$this->authorize('update',$menucategory);
        if(Menu::where(['category_id'=>$menucategory->id,'shop_id'=>Auth::user()->shop_id])->count()>0){
            session()->flash("success", "该分类有菜品不能删除");
        }else{
            $menucategory->delete();
            session()->flash("success", "删除成功");
            Redis::del('shop');
        }

        return redirect()->route('menucategorys.index');
    }

    public function selected(Request $request,MenuCategory $menucategory){
        $id=Auth::user()->shop_id;
        if($request->is_selected){
            $menucategory->update(['is_selected'=>0]);
            return redirect()->route('menucategorys.index')->with("success", "修改成功");
        }else{
            MenuCategory::where(['shop_id'=>$id,'is_selected'=>1])
                ->update(['is_selected'=>0]);
            $menucategory->update(['is_selected'=>1]);
            return redirect()->route('menucategorys.index')->with("success", "修改成功");
        }
    }

    public function menucategory(Request $request,MenuCategory $menucategory)
    {
        $category=$menucategory;
        $where[]=["shop_id",Auth::user()->shop_id];
        $where[]=['category_id',$menucategory->id];
        //判断是否搜索名称
        $keyword=[];
        if($request->minprice){
            $where[]=['goods_price','>=',$request->minprice];
            $keyword['minprice']=$request->minprice;
        }

        //判断最大价格
        if($request->maxprice){
            $where[]=['goods_price','<=',$request->maxprice];
            $keyword['maxprice']=$request->maxprice;
        }
        if($request->name){
            $cl = new SphinxClient();
            $cl->SetServer ( '127.0.0.1', 9312);
            $cl->SetConnectTimeout ( 10 );
            $cl->SetArrayResult ( true );
            $cl->SetMatchMode ( SPH_MATCH_EXTENDED2);
            $cl->SetLimits(0, 1000);
            $info =$request->name;
            $res = $cl->Query($info, 'menu');
            $menus=[];
            if(array_key_exists('matches',$res)) {

                foreach ($res['matches'] as $v){
                    $id[]=$v['id'];
                }
                    $menus = Menu::where($where)
                        ->whereIn('id',$id)
                        ->paginate(1);
            }
        }else{
            $menus=Menu::where($where)->paginate(10);
        }
            $menucategorys=MenuCategory::where("shop_id",Auth::user()->shop_id)->get();

        return view('menucategory/menucategory',compact('menucategorys','menus','category','keyword'));
    }
}
