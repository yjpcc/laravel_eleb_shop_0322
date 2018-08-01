@extends('default')
@section('content')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li><a href="">Order</a></li>
        <li>Order_Show</li>
    </ol>
    <div class="row">
    <div class="col-xs-3">
        <a href="{{ route('orders.day') }}" class="btn btn-info">按天统计</a>
        <a href="{{ route('orders.month') }}"  class="btn btn-info">按月统计</a>
        <a href="{{ route('orders.count') }}"  class="btn btn-info">累计</a>
    </div>

    <div class="col-xs-4" >
            <form action="{{ route('orders.day') }}" method="get">
                <div class="input-group">
                    <input type="date" class="form-control" name="day" value="{{ $day }}">
                    <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
            </span>
                </div>
            </form>
     </div>
    </div>

    <div class="jumbotron row">
        <h1 class="text-center">{{ $day??date('Y-m-d') }}</h1>
        <div class="col-xs-4">

            <h2>订单数</h2>
            <p>总计订单: {{ $orderDay }}</p>
        </div>
        <div class="col-xs-8">
            <h2 class="text-center">菜品销量</h2>
            <table class="table table-striped table-hover table-bordered table-condensed">
                <tr>
                    <th>菜品</th>
                    <th>销量</th>
                </tr>
                @foreach($menus as $key=>$menu)
                    <tr>
                        <td>{{ $menu['goods_name'] }}</td>
                        <td>{{ $menu['count'] }}</td>
                    </tr>
                    @if($key==9)
                        @break
                    @endif
                @endforeach
            </table>
        </div>
    </div>
@endsection