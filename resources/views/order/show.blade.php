@extends('default')
@section('content')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li><a href="">Order</a></li>
        <li>Order_Show</li>
    </ol>
    <h1 class="text-center">订单详情</h1>
    <div class="jumbotron row">
        <div class="col-xs-4">
            <p>订单编号：{{ $order->sn }}</p>
            <p>收货人姓名：{{ $order->name }}</p>
            <p>收货人电话：{{ $order->tel }}</p>
            <p>详细地址：{{ $order->province.$order->city.$order->county.$order->address }}</p>
            <p>价格：{{ $order->total }}</p>
            <p>状态：{{ $order->status() }}</p>
            <p>创建时间：{{ $order->created_at }}</p>
        </div>
        <div class="col-xs-8 info">
            @foreach($goods as $good)
           <div class="col-xs-4">
               <p><img src="{{ $good->goods_img }}" width="160"></p>
               <p>商品名: {{ $good->goods_name }}</p>
               <p>商品价格: {{ $good->goods_price }}</p>
               <p>数量: {{ $good->amount }}</p>
           </div>
           @endforeach
        </div>
    </div>
@endsection