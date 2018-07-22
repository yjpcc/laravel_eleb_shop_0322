@extends('default')
@section('content')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li><a href="">MenuCategory</a></li>
        <li>Show</li>
    </ol>
    <div class="jumbotron">
            <h1 class="text-center">{{ $activity->title }}</h1>
            <p>活动详情:</p>
            <p>{!! $activity->content !!}</p>
        <span>开始时间:{{ $activity->start_time }}</span><br>
        <span>结束时间:{{ $activity->end_time }}</span>
    </div>

@endsection