@extends('default')
@section('content')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li>Menu_Category</li>
    </ol>
    <table class="table table-striped table-hover table-bordered table-condensed">
        <tr>
            <th>ID</th>
            <th>分类名</th>
            <th>所属商家</th>
            <th>是否默认分类</th>
            <th>描述</th>
            <th>操作</th>
        </tr>
        @foreach ($menucategorys as $menucategory)
            <tr>
                <td>{{ $menucategory->id }}</td>
                <td><a href="{{ route('menucategory',[$menucategory]) }}">{{ $menucategory->name }}</a></td>
                <td>{{ $menucategory->shop->shop_name }}</td>
                <td>
                    <a href="{{ route('selected',[$menucategory,'selected'=>$menucategory->is_selected]) }}" class="btn-sm {{ $menucategory->is_selected?'btn-success':'btn-warning' }}">{{ $menucategory->is_selected?'是':'否' }}</a></td>
                <td>{{ $menucategory->des }}</td>
                <td>
                    <a class="btn btn-success" href="{{ route('menucategorys.show',[$menucategory]) }}" title="查看"><span class="glyphicon glyphicon-eye-open"></span></a>
                    <a class="btn btn-warning" href="{{ route('menucategorys.edit',[$menucategory]) }}" title="编辑"><span class="glyphicon glyphicon-pencil"></span></a> <form action="{{ route('menucategorys.destroy',[$menucategory]) }}" method="post" style="display: inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                    </form></td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6">
                <a href="{{ route('menucategorys.create') }}" class="btn btn-success btn-block">添加</a>
            </td>
        </tr>
    </table>
@endsection