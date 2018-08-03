<?php

namespace App\Http\Controllers;

use App\Model\Event;
use App\Model\EventMember;
use App\Model\EventPrize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $status=$request->status;
        if($status==1){
            $events=event::where('signup_start','>',date('Y-m-d H:i:s'))
                ->paginate(10);
        }elseif ($status==2){
            $events=event::where('signup_start','<=',date('Y-m-d H:i:s'))
                ->where('signup_end','>=',date('Y-m-d H:i:s'))
                ->paginate(10);
        }elseif($status==3){
            $events=event::where('is_prize',1)
                ->paginate(10);
        }else{
            $events=event::paginate(10);
        }
        return view('event/index', compact('events','status'));
    }

    public function show(Event $event)
    {
        $count=EventMember::where('member_id',Auth::id())
            ->where('events_id',$event->id)
            ->count();
        $signup_sum=EventMember::where('events_id',$event->id)->count();
        $wins=EventPrize::where('member_id','<>',0)->get();
        return view('event/show', compact('event','count','signup_sum','wins'));
    }

    public function signup(Request $request){
        //判断活动是否结束
        $event=Event::where('id',$request->id)
            ->where('signup_end','>',date('Y-m-d H:i:s'))
            ->first();
        if(!$event){
            return back()->with('danger','该抽奖已结束');
        }
        //判断是否开奖
        if($event->is_prize){
            return back()->with('danger','该抽奖已结束');
        }
        //判断报名人数
        $signup_sum=EventMember::where('events_id',$request->id)->count();
        $signup_num=$event->signup_num;
        if ($signup_sum>$signup_num-1){
            return back()->with('danger','报名人数已满');
        }
        //判断是否报名
        $count=EventMember::where('member_id',Auth::id())
            ->where('events_id',$request->id)
            ->count();
        if($count>0){
            return back()->with('danger','该账户已报名');
        }

        EventMember::create(['events_id'=>$request->id,'member_id'=>Auth::id()]);
        return back()->with('success','报名成功');

    }


}
