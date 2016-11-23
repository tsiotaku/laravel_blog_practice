@extends('layouts.admin')

@section('content')
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{ url('admin.info') }}">首页</a> &raquo; 編輯導覽列
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>編輯導覽列</h3>
            @if(count($errors) >0 )
                <div class="mark">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{ url('admin/nav/create') }}"><i class="fa fa-plus"></i>添加導覽列</a>
                <a href="{{ url('admin/nav') }}"><i class="fa fa-recycle"></i>全部導覽列</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/nav/'.$datas->nav_id)}}" method="post">
            {{method_field('PUT')}}
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>链接名称/英文：</th>
                    <td>
                        <input type="text" name="nav_name" value="{{$datas->nav_name}}">
                        <input type="text" class="sm" name="nav_alias" value="{{$datas->nav_alias}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>链接名称必须填写</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i> Url：</th>
                    <td>
                        <input type="text" class="lg" name="nav_url" value="{{$datas->nav_url}}">
                    </td>
                </tr>
                <tr>
                    <th>排序：</th>
                    <td>
                        <input type="text" class="sm" name="nav_order" value="{{$datas->nav_order}}">
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
@endsection