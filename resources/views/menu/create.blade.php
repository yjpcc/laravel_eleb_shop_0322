@extends("default")
@section("content")
    <ol class="breadcrumb">
        <li>添加菜品</li>
    </ol>
    <h1 class="text-center">添加菜品</h1>
    @include('_errors')
<form class="form-horizontal" method="post" action="{{ route('menus.store') }}" enctype="multipart/form-data">
    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">菜品名称</label>
        <div class="col-sm-10">
            <input type="text" name="goods_name" class="form-control" placeholder="菜品名称" value="{{ old('goods_name') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">菜品分类</label>
        <div class="col-sm-10">
            <select class="form-control" name="category_id">
                @foreach($menucategorys as $menucategory)
                    <option value="{{ $menucategory->id }}">{{ $menucategory->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">菜品图片</label>
        <div class="col-sm-10">
            <input type="hidden" id="img_url" name="goods_img">
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
            <img id="img" alt="">
        </div>
    </div>

    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">价格</label>
        <div class="col-sm-10">
            <input type="text" name="goods_price" class="form-control" placeholder="价格" value="{{ old('goods_price') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">提示信息</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="tips" rows="3" placeholder="提示信息">{{ old('tips') }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">菜品描述</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="description" rows="3" placeholder="菜品描述">{{ old('description') }}</textarea>
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