@extends('default')
@section('content')
    @include('_errors')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li><a href="">Menu</a></li>
        <li>Show</li>
    </ol>
    <div class="jumbotron row">
        <div class="col-xs-5">
            <p>菜品名称:　{{ $menu->goods_name }}</p>
            <p>所属商家:　{{ $menu->shop->shop_name }}</p>
            <p>所属分类:　{{ $menu->category->name }}</p>
            <p>菜品价格:　{{ $menu->goods_price }} $</p>
            <p>菜品图片:</p>
            <p><img src="{{ $menu->goods_img }}" alt="" width="250"></p>
            <p>提示信息:　{{ $menu->tips }}</p>
            <p>菜品描述:　{{ $menu->description }}</p>
        </div>
        <div class="col-xs-7">
            <h2>月销量: <span style="color:red;">{{ $menu->month_sales }}</span></h2>
            <p>评分:　　　　{{ $menu->rating }}</p>
            <p>评分数量:　　{{ $menu->rating_count }}</p>
            <p>满意度评分:　{{ $menu->satisfy_rate }}</p>
            <p>满意度数量:　{{ $menu->satisfy_count }}</p>
        </div>
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