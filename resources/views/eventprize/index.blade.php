@extends('default')
@section('content')
            <ol class="breadcrumb">
                <li><a href="">Home</a></li>
                <li>EventPrize</li>
            </ol>
    <table class="table table-striped table-hover table-bordered table-condensed">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>奖品名称</th>
            <th>奖品详情</th>
            <th>中奖商家</th>
        </tr>
        @foreach ($eventprizes as $eventprize)
            <tr>
                <td>{{ $eventprize->id }}</td>
                <td>{{ $eventprize->event->title }}</td>
                <td>{{ $eventprize->name }}</td>
                <td>{!! $eventprize->description !!}</td>
                <td>{{ $eventprize->member_id?$eventprize->member->email:'无' }}</td>
            </tr>
        @endforeach

    </table>
    {{ $eventprizes->links() }}
@endsection