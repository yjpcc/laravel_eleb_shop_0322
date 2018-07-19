@extends('default')
@section('content')
    @include('_errors')
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h2 class="modal-title" id="myModalLabel" style="text-align: center">用户名密码登录</h2>
            </div>
            <div class="modal-body">
                <form action="{{ route('login') }}" method="post">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="手机/邮箱/用户名" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="密码">
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6"><input id="captcha" class="form-control"  name="captcha"  placeholder="请输入验证码"></div>
                            <div class="col-xs-6"><img class="thumbnail captcha"  src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码"></div>
                        </div>
                    </div>


                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" value="1">下次自动登录
                        </label>
                    </div>
                    {{ csrf_field() }}
                    <button class="btn btn-info btn-block" type="submit">登录</button>
                </form>
            </div>

            <div class="modal-footer">
                <a href="" style="float: left">扫码登录 <span class="glyphicon glyphicon-qrcode"></span></a>
                <a href="">立即注册</a>
            </div>
        </div>
    </div>

@endsection