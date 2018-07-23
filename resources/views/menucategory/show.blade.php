@extends('default')
@section('content')
    @include('_errors')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li><a href="">MenuCategory</a></li>
        <li>Show</li>
    </ol>
    <div class="jumbotron">
            <p>分类名称:　{{ $menucategory->name }}</p>
            <p>所属商家:　　{{ $menucategory->shop->shop_name }}</p>
            <p>是否默认分类: <span class="btn-sm {{ $menucategory->is_selected?'btn-success':'btn-warning' }}">{{ $menucategory->is_selected?'是':'否' }}</span></p>
            <p>分类描述:　{{ $menucategory->description }}</p>
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