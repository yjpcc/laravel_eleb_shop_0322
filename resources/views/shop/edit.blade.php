@extends("default")
@section("content")
    <ol class="breadcrumb">
        <li>修改商家</li>
    </ol>
    <h1 class="text-center">修改商家</h1>
    @include('_errors')
<form class="form-horizontal" method="post" action="{{ route('shops.update',[$shop]) }}" enctype="multipart/form-data">

    <div class="form-group">
        <label class="col-sm-2 control-label">用户名</label>
        <div class="col-sm-10">
        <input type="text" name="name" class="form-control" placeholder="用户名" value="{{ $shop->shop_user->name }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $shop->shop_user->email }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">旧密码</label>
        <div class="col-sm-10">
            <input type="password" name="oldpassword" class="form-control" placeholder="密码">
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

    <div class="form-group">
        <label class="col-sm-2 control-label">店铺分类</label>
        <div class="col-sm-10">
            <select class="form-control" name="shop_category_id">
                @foreach($categorys as $category)
                    <option value="{{ $category->id }}" {{ $category->id==$shop->shop_category_id?'selected':'' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">店铺名称</label>
        <div class="col-sm-10">
            <input type="text" name="shop_name" class="form-control"  placeholder="店铺名称" value="{{ $shop->shop_name }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">店铺图片</label>
        <div class="col-sm-10">
            <input type="file" name="shop_img">
            <img class="thumbnail img-responsive" src="{{ $shop->shop_img() }}" width="200" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">是否品牌</label>
        <div class="col-sm-10">
            <input type="checkbox" name="brand" value="1" {{ $shop->brand?'checked':'' }} class="checkbox"  >
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">是否准时送达</label>
        <div class="col-sm-10">
            <input type="checkbox" name="on_time" value="1" class="checkbox" {{ $shop->on_time?'checked':'' }}>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">是否蜂鸟配送</label>
        <div class="col-sm-10">
            <input type="checkbox" name="fengniao" value="1" class="checkbox" {{ $shop->fengniao?'checked':'' }}>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">是否保标记</label>
        <div class="col-sm-10">
            <input type="checkbox" name="bao" value="1" class="checkbox" {{ $shop->bao?'checked':'' }}>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">是否票标记</label>
        <div class="col-sm-10">
            <input type="checkbox" name="piao" value="1" class="checkbox" {{ $shop->piao?'checked':'' }}>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">是否准标记</label>
        <div class="col-sm-10">
            <input type="checkbox" name="zhun" value="1" class="checkbox" {{ $shop->zhun?'checked':'' }}>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">起送金额</label>
        <div class="col-sm-10">
            <input type="number" name="start_send" class="form-control"  placeholder="起送金额" value="{{ $shop->start_send }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">配送费</label>
        <div class="col-sm-10">
            <input type="number" name="send_cost" class="form-control"  placeholder="配送费" value="{{ $shop->send_cost }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">店公告</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="notice" rows="3" placeholder="店公告">{{ $shop->notice }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">优惠信息</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="discount" rows="3" placeholder="优惠信息">{{ $shop->discount }}</textarea>
        </div>
    </div>

    {{ csrf_field() }}

    {{ method_field('PATCH') }}
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary btn-lg btn-block">提交</button>
        </div>
    </div>
</form>
@endsection
