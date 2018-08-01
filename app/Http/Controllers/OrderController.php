<?php

namespace App\Http\Controllers;


use App\Model\Menu;
use App\Model\Order;
use App\Model\OrderGood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders=Order::where('shop_id',Auth::user()->shop_id)->paginate(10);
        return view('order/index',compact('orders'));
    }

    public function show(Order $order)
    {
        $goods=OrderGood::where('order_id',$order->id)->get();
        return view('order/show',compact('order','goods'));
    }

    public function send(Order $order){
        $order->update(['status'=>2]);
        $goods=OrderGood::where('order_id',$order->id)->get();
        foreach ($goods as $good){
            $menu=Menu::find($good->goods_id);
            $menu->update(['month_sales'=>$good->amount]);
        }
        return redirect()->route('orders.index')->with('success','订单:'.$order->sn.' 发货成功');
    }

    public function cancel(Order $order)
    {
        $order->update(['status'=>-1]);
        return redirect()->route('orders.index')->with('success','订单:'.$order->sn.' 取消成功');
    }

    public function count(){
        //累计
        $data['orderCount']=Order::where('shop_id',Auth::user()->shop_id)
            ->count();
        //- 菜品销量统计[按日统计,按月统计,累计]（每日、每月、总计）
        $goods=Menu::where('shop_id',Auth::user()->shop_id)->get(['id','goods_name']);
        $menus=[];
        foreach ($goods as $good){
            $menu['goods_name']=$good->goods_name;
            $menu['count']=DB::table('order_goods')
                ->where('goods_id',$good->id)
                ->sum('amount');
            $menus[]=$menu;
        }
        usort($menus,function ($a,$b){
            return -($a['count']<=>$b['count']);
        });
        $data['menus']=$menus;
        return view('order/count',$data);
    }

    public function day(Request $request){
        //- 订单量统计[按日统计,按月统计,累计]（每日、每月、总计）
        $day=[['created_at','>=', date('Y-m-d H:i:s',strtotime(date('Y-m-d')))]];
        if($request->day){
            $day=[['created_at','>=',$request->day],['created_at','<',date('Y-m-d H:i:s',strtotime($request->day)+3600*24)]];
        }
        $data['orderDay']=Order::where('shop_id',Auth::user()->shop_id)
            ->where($day)
            ->count();

        //- 菜品销量统计[按日统计,按月统计,累计]（每日、每月、总计）
        $goods=Menu::where('shop_id',Auth::user()->shop_id)->get(['id','goods_name']);
        $menus=[];
        foreach ($goods as $good){
            $menu['goods_name']=$good->goods_name;
            $menu['count']=DB::table('order_goods')
                ->where('goods_id',$good->id)
                ->where($day)
                ->sum('amount');
            $menus[]=$menu;
        }
        usort($menus,function ($a,$b){
            return -($a['count']<=>$b['count']);
        });
        $data['menus']=$menus;
        $data['day']=$request->day;
        return view('order/order_day',$data);
    }

    public function month(Request $request){
        //- 订单量统计[按日统计,按月统计,累计]（每日、每月、总计）
        $date=$request->year.'-'.$request->month;
        $month=[['created_at','>=', date('Y-m-d H:i:s',strtotime(date('Y-m')))]];
        if($request->month){
            $month=[['created_at','>=',date('Y-m-d H:i:s',strtotime($date))],['created_at','<',date('Y-m-d H:i:s',strtotime('+1 month',strtotime($date)))]];
        }
        $data['orderMonth']=Order::where('shop_id',Auth::user()->shop_id)
            ->where($month)
            ->count();

        //- 菜品销量统计[按日统计,按月统计,累计]（每日、每月、总计）
        $goods=Menu::where('shop_id',Auth::user()->shop_id)->get(['id','goods_name']);
        $menus=[];
        foreach ($goods as $good){
            $menu['goods_name']=$good->goods_name;
            $menu['count']=DB::table('order_goods')
                ->where('goods_id',$good->id)
                ->where($month)
                ->sum('amount');
            $menus[]=$menu;
        }
        usort($menus,function ($a,$b){
            return -($a['count']<=>$b['count']);
        });
        $data['menus']=$menus;
        $data['month']=$request->month;
        $data['year']=$request->year;
        return view('order/order_month',$data);
    }
}
