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
            <form action="{{ route('orders.month') }}" method="get">
                <div class="input-group">
                    <div class="row">
                    <div class="col-xs-5">
                        <select class="form-control" name="year">
                            <option value="2018" {{ $year==2018?'selected':'' }}>2018年</option>
                            <option value="2017" {{ $year==2017?'selected':'' }}>2017年</option>
                        </select>
                    </div>
                    <div class="col-xs-5">
                        <select class="form-control" name="month">
                            @for($i=1;$i<=12;$i++)
                        <option value="{{ $i }}" {{ $i==date('m')?'selected':'' }}{{ $month==$i?'selected':'' }}>{{ $i }}月</option>
                             @endfor
                        </select>
                    </div>
                    </div>
                    <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
            </span>
                </div>
            </form>
     </div>
    </div>

    <div class="jumbotron row">
        <h1 class="text-center">{{ $year??date('Y') }}年{{ $month??date('m') }}月</h1>
        <div class="col-xs-4">

            <h2>订单数</h2>
            <p>总计订单: {{ $orderMonth }}</p>
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