@extends("default")
@section("content")
    <ol class="breadcrumb">
        <li>修改分类</li>
    </ol>
    <h1 class="text-center">修改分类</h1>
    @include('_errors')
<form class="form-horizontal" method="post" action="{{ route('menucategorys.update',[$menucategory]) }}" enctype="multipart/form-data">
    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">分类名</label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="inputTitle1" placeholder="分类名" value="{{ $menucategory->name }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">是否是默认分类</label>
        <div class="col-sm-10">
            <input type="checkbox" name="is_selected" value="1" class="checkbox" {{ $menucategory->is_selected?'checked':'' }}>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">描述</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="description" rows="3" placeholder="描述">{{ $menucategory->description }}</textarea>
        </div>
    </div>

    {{--<div class="form-group">--}}
        {{--<label class="col-sm-2 control-label">验证码</label>--}}
        {{--<div class="col-sm-10">--}}
            {{--<div class="col-sm-3">--}}
                {{--<input id="captcha" class="form-control" name="captcha"  placeholder="请输入验证码">--}}
            {{--</div>--}}
            {{--<div class="col-sm-9">--}}
                {{--<img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary btn-lg btn-block">提交</button>
        </div>
    </div>
</form>
@endsection
