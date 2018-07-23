@extends("default")
@section("content")
    <ol class="breadcrumb">
        <li>添加商家</li>
    </ol>
    <h1 class="text-center">商家账号</h1>
    @include('_errors')
<form class="form-horizontal" method="post" action="{{ route('shops.store') }}" enctype="multipart/form-data">

    <div class="form-group">
        <label class="col-sm-2 control-label">用户名</label>
        <div class="col-sm-10">
        <input type="text" name="name" class="form-control" placeholder="用户名" value="{{ old('name') }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">密码</label>
        <div class="col-sm-10">
        <input type="password" name="password" class="form-control" placeholder="密码">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">确认密码</label>
        <div class="col-sm-10">
        <input type="password" name="password_confirmation" class="form-control" placeholder="确认密码">
        </div>
    </div>

    <h1 class="text-center">商家信息</h1>
    <div class="form-group">
        <label class="col-sm-2 control-label">店铺分类</label>
        <div class="col-sm-10">
            <select class="form-control" name="shop_category_id">
                @foreach($categorys as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">店铺名称</label>
        <div class="col-sm-10">
            <input type="text" name="shop_name" class="form-control"  placeholder="店铺名称" value="{{ old('name') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">店铺图片</label>
        <div class="col-sm-10">
            <input type="hidden" id="img_url" name="shop_img">
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
            <img id="img" alt="">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">是否品牌</label>
        <div class="col-sm-10">
            <input type="checkbox" name="brand" value="1" class="checkbox">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">是否准时送达</label>
        <div class="col-sm-10">
            <input type="checkbox" name="on_time" value="1" class="checkbox">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">是否蜂鸟配送</label>
        <div class="col-sm-10">
            <input type="checkbox" name="fengniao" value="1" class="checkbox">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">是否保标记</label>
        <div class="col-sm-10">
            <input type="checkbox" name="bao" value="1" class="checkbox">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">是否票标记</label>
        <div class="col-sm-10">
            <input type="checkbox" name="piao" value="1" class="checkbox">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">是否准标记</label>
        <div class="col-sm-10">
            <input type="checkbox" name="zhun" value="1" class="checkbox">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">起送金额</label>
        <div class="col-sm-10">
            <input type="number" name="start_send" class="form-control"  placeholder="起送金额" value="{{ old('start_send') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">配送费</label>
        <div class="col-sm-10">
            <input type="number" name="send_cost" class="form-control"  placeholder="配送费" value="{{ old('send_cost') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">店公告</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="notice" rows="3" placeholder="店公告">{{ old('notice') }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">优惠信息</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="discount" rows="3" placeholder="优惠信息">{{ old('discount') }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">验证码</label>
        <div class="col-sm-10">
            <div class="col-sm-3">
             <input id="captcha" class="form-control" name="captcha"  placeholder="请输入验证码">
            </div>
            <div class="col-sm-9">
                <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
            </div>
        </div>
    </div>


    {{ csrf_field() }}
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary btn-lg btn-block">提交</button>
        </div>
    </div>
</form>
@endsection
@section('js_upload')
    @include('upload')
@stop