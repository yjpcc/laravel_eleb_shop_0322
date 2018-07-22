@extends('default')
@section('content')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li>Menu</li>
    </ol>
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
                <td><a href="{{ route('menucategory',[$menu->category->id]) }}">{{ $menu->category->name }}</a></td>
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
@endsection