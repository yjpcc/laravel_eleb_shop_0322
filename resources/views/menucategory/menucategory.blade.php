@extends('default')
@section('content')
    @include('_errors')

   <div class="col-xs-1">
       <div class="btn-group-vertical" role="group" aria-label="...">
           {{--<a class="btn btn-default" href="{{ route('menucategory',['category'=>'all']) }}" >全部</a>--}}
           @foreach($menucategorys as $menucategory)
           <a class="btn btn-default {{ $menucategory->id==$category->id?'active':'' }}" href="{{ route('menucategory',[$menucategory]) }}" >{{ $menucategory->name }}</a>
           @endforeach
       </div>
   </div>

    <div class="col-xs-11">
        <h1>分类【{{ $category->name }}】下的菜品</h1>
        <p>
        <form class="form-inline" method="get" action="{{ route('menucategory',[$category]) }}">
           　　 <div class="form-group">
                <label class="sr-only" for="exampleInputEmail3">菜品名称</label>
                <input type="text" name="name" class="form-control" placeholder="菜品名称" style="width:280px;" value="{{ $keyword['name']??'' }}">
            </div>
            　
            <div class="form-group">
                <label class="sr-only" for="exampleInputPassword3">菜品价格</label>
                <input type="number" name="minprice" class="form-control"  placeholder="菜品价格" style="width:220px;" value="{{ $keyword['minprice']??'' }}">
            </div>
            -
            <div class="form-group">
                <label class="sr-only" for="exampleInputPassword3">菜品价格</label>
                <input type="number" name="maxprice" class="form-control"  placeholder="菜品价格" style="width:220px;" value="{{ $keyword['maxprice']??'' }}">
            </div>
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
        </form>
        </p>
        <table class="table table-striped table-hover table-bordered table-condensed">
            <tr>
                <th>ID</th>
                <th>菜品图片</th>
                <th>名称</th>
                <th>所属商家</th>
                <th>所属分类</th>
                <th>价格</th>
                <th>月销量</th>
                <th>评分</th>
                <th>评分数量</th>
                <th>满意度</th>
                <th>满意度数量</th>
                <th>操作</th>
            </tr>
            @foreach ($menus as $menu)
                <tr>
                    <td>{{ $menu->id }}</td>
                    <td><img src="{{ $menu->goods_img }}" alt="" width="50"></td>
                    <td>{{ $menu->goods_name }}</td>
                    <td>{{ $menu->shop->shop_name }}</td>
                    <td>{{ $menu->category->name }}</td>
                    <td>{{ $menu->goods_price }}</td>
                    <td>{{ $menu->month_sales }}</td>
                    <td>{{ $menu->rating }}</td>
                    <td>{{ $menu->rating_count }}</td>
                    <td>{{ $menu->satisfy_rate }}</td>
                    <td>{{ $menu->satisfy_count }}</td>
                    <td>
                        <a class="btn btn-success" href="{{ route('menus.show',[$menu]) }}" title="查看"><span class="glyphicon glyphicon-eye-open"></span></a>
                        <a class="btn btn-warning" href="{{ route('menus.edit',[$menu]) }}" title="编辑"><span class="glyphicon glyphicon-pencil"></span></a> <form action="{{ route('menus.destroy',[$menu]) }}" method="post" style="display: inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                        </form></td>
                </tr>
            @endforeach
            <tr>
                <td colspan="12">
                    <a href="{{ route('menus.create') }}" class="btn btn-success btn-block">添加</a>
                </td>
            </tr>
        </table>
        {{--{{ $menus->appends($keyword)->links() }}--}}
    </div>
@endsection