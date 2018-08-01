@extends('default')
@section('content')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li>Order</li>
    </ol>
    <table class="table table-striped table-hover table-bordered table-condensed">
        <tr>
            <th>ID</th>
            <th>订单编号</th>
            <th>收货人电话</th>
            <th>收货人姓名</th>
            <th>创建时间</th>
            <th>价格</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->sn }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->tel }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->total }}</td>
                <td style="font-weight: bold">{{ $order->status() }}</td>
                <td>
                    <a class="btn btn-success" href="{{ route('orders.show',[$order]) }}" title="查看"><span class="glyphicon glyphicon-eye-open"></span></a>
                    @if($order->status==1)
                    <a class="btn btn-warning" href="{{ route('orders.cancel',[$order]) }}" title="取消订单">取消订单</a>
                    <a class="btn btn-info" href="{{ route('orders.send',[$order]) }}" title="发货">发货</a>
                     @endif
                </td>
            </tr>
        @endforeach
    </table>
    {{ $orders->links() }}
@endsection