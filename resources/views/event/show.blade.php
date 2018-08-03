@extends('default')
@section('content')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li><a href="">Event</a></li>
        <li>Show</li>
    </ol>
    @include('_errors')
    <div class="jumbotron">
        <div class="row">
        <div class="col-xs-4">
            <h1 style="color: red">中奖信息</h1>
            <marquee  width="100%" height="300" scrollamount="10" direction="down" behavior="scroll">
                @foreach($wins as $win)
                <p>{{ preg_replace('/(\w{2})\w{6}(\w+)/',"\$1****\$2",$win->member->email) }}</p>
                @endforeach
            </marquee>
        </div>
        <div class="col-xs-8">
            <h1>{{ $event->title }}</h1>
        <p>活动详情:</p>
        <p>{!! $event->content !!}</p>
        <p>奖品:
            @foreach($event->eventprize as $eventprize)
                {{ $eventprize->name }},
            @endforeach
        </p>
        <p>开始时间:{{ $event->signup_start }}</p><br>
        <p>结束时间:{{ $event->signup_end }}</p>
        <p>开奖日期:{{ $event->prize_date }}</p>
        <p>报名人数限制:{{ $event->signup_num }}</p>
        <p>当前报名人数:{{ $signup_sum }}</p>
        <p>是否已开奖:<sapn  class="btn-sm {{ $event->is_prize?'btn-warning':'btn-success' }}">{{ $event->is_prize?'已开奖':'未开奖' }}</sapn></p>
        <p>

        </p>@if($event->is_prize)
            <a class="btn btn-success" href="{{ route('eventprizes.index') }}">查看抽奖结果</a>
        @elseif(strtotime($event->signup_end)<time())
            <span class="btn btn-danger">已结束</span>
        @elseif($count>0)
            <span class="btn btn-info">已报名</span>
        @elseif($event->signup_num==$signup_sum)
            <span class="btn btn-danger">报名人数已满</span>
        @elseif(strtotime($event->signup_start)>time())
            <span class="btn btn-success">未开始</span>
        @else
            <a class="btn btn-success" href="{{ route('events.signup',['id'=>$event->id]) }}">报名</a>
        @endif
         </div>
     </div>
    </div>
@endsection