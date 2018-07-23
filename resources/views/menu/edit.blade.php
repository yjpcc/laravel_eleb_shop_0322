@extends("default")
@section("content")
    <ol class="breadcrumb">
        <li>修改菜品</li>
    </ol>
    <h1 class="text-center">修改菜品</h1>
    @include('_errors')
<form class="form-horizontal" method="post" action="{{ route('menus.update',[$menu]) }}" enctype="multipart/form-data">
    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">菜品名称</label>
        <div class="col-sm-10">
            <input type="text" name="goods_name" class="form-control" placeholder="菜品名称" value="{{ $menu->goods_name }}">
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
            <img class="thumbnail img-responsive" id="img" src="{{ $menu->goods_img }}" width="200" />
        </div>
    </div>

    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">价格</label>
        <div class="col-sm-10">
            <input type="text" name="goods_price" class="form-control" placeholder="价格" value="{{ $menu->goods_price }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">提示信息</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="tips" rows="3" placeholder="提示信息">{{ $menu->tips }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">菜品描述</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="description" rows="3" placeholder="菜品描述">{{ $menu->description }}</textarea>
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
@section('js_upload')
    @include('upload')
@stop