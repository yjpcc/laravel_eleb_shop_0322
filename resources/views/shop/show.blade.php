@extends('default')
@section('content')
    @include('_errors')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li><a href="">Shop</a></li>
        <li>Show</li>
    </ol>
    <div class="jumbotron row">
        <div class="col-xs-4">
            <p>名称：<span class="name">{{ $shop->shop_user->name }}</span></p>
            <p>邮箱：<span class="email">{{ $shop->shop_user->email }}</span></p>
            <p>所属商家：<span class="email">{{ $shop->shop_name }}</span></p>
            <p>店铺图片:</p>
            <p><img src="{{ $shop->shop_img() }}" alt="" width="250"></p>
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
        </div>
        <div class="col-xs-8 info">
            <p>店铺分类：{{ $shop->shop_category->name }}</p>
            <p>店铺名称：{{ $shop->shop_name }}</p>
            <p>店铺评分：{{ $shop->rating }}</p>
            <p>是否品牌:　<span class=" btn-sm {{ $shop->brand?'btn-success glyphicon glyphicon-ok':'btn-danger glyphicon glyphicon-remove' }}"></span></p>
            <p>准时送:　　<span class=" btn-sm {{ $shop->on_time?'btn-success glyphicon glyphicon-ok':'btn-danger glyphicon glyphicon-remove' }}"></span></p>
            <p>蜂鸟配送:　<span class=" btn-sm {{ $shop->fengniao?'btn-success glyphicon glyphicon-ok':'btn-danger glyphicon glyphicon-remove' }}"></span></p>
            <p>保标记:　　<span class=" btn-sm {{ $shop->bao?'btn-success glyphicon glyphicon-ok':'btn-danger glyphicon glyphicon-remove' }}"></span></p>
            <p>票标记:　　<span class=" btn-sm {{ $shop->piao?'btn-success glyphicon glyphicon-ok':'btn-danger glyphicon glyphicon-remove' }}"></span></p>
            <p>准标记:　　<span class=" btn-sm {{ $shop->zhun?'btn-success glyphicon glyphicon-ok':'btn-danger glyphicon glyphicon-remove' }}"></span></p>
            <p>起送金额:　{{ $shop->start_send }}</p>
            <p>配送费:　　{{ $shop->send_cost }}</p>
            <p>店公告:　　{{ $shop->notice }}</p>
            <p>优惠信息:　{{ $shop->discount }}</p>
        </div>


    </div>

    {{--<div class="modal fade" id="pwdModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">--}}
        {{--<div class="modal-dialog modal-sm" role="document">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                    {{--<h4 class="modal-title" id="myModalLabel" style="text-align: center">修改个人密码</h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<form action="{{ route('editPwd',[$user]) }}" method="post">--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="password" name="oldpassword" class="form-control" placeholder="旧密码">--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="password" name="password" class="form-control" placeholder="新密码">--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="password" name="password_confirmation" class="form-control" placeholder="确认密码">--}}
                        {{--</div>--}}
                        {{--{{ csrf_field() }}--}}
                        {{--{{ method_field('PATCH') }}--}}
                        {{--<button class="btn btn-info btn-block">修改</button>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection