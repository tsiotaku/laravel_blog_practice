@extends('layouts.admin')

@section('content')
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{ url('admin.info') }}">首页</a> &raquo; 網站配置管理
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>編輯網站配置</h3>
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
                <a href="{{ url('admin/config/create') }}"><i class="fa fa-plus"></i>添加網站配置</a>
                <a href="{{ url('admin/config') }}"><i class="fa fa-recycle"></i>全部網站配置</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/config/'.$datas->conf_id)}}" method="post">
            {{method_field('PUT')}}
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>標題：</th>
                    <td>
                        <input type="text" name="conf_title" value="{{$datas->conf_title}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>標題必須填寫</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>名稱：</th>
                    <td>
                        <input type="text" name="conf_name" value="{{$datas->conf_name}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>名稱必須填寫</span>
                    </td>
                </tr>
                <tr>
                    <th>類型：</th>
                    <td>
                        <input type="radio" class="sm" name="field_type" value="input" @if( $datas->field_type=='input') checked @endif onclick="showTr()">input　
                        <input type="radio" class="sm" name="field_type" value="textarea" @if( $datas->field_type=='textarea') checked @endif onclick="showTr()">textarea　
                        <input type="radio" class="sm" name="field_type" value="radio" @if( $datas->field_type=='radio') checked @endif onclick="showTr()">radio
                    </td>
                </tr>
                <tr class="field_value">
                    <th>類型值：</th>
                    <td>
                        <input type="text" class="lg" name="field_value" value="{{$datas->field_value}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i></span>
                    </td>
                </tr>
                <tr>
                    <th>排序：</th>
                    <td>
                        <input type="text" class="sm" name="conf_order" value="{{$datas->conf_order}}">
                    </td>
                </tr>
                <tr>
                    <th>說明：</th>
                    <td>
                        <textarea id="" cols="30" rows="10" name="conf_tips">{{$datas->conf_tips}}</textarea>
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
    <script>
        showTr();
        function showTr(){
            var type = $('input[name=field_type]:checked').val();
            if(type == 'radio'){
                $('.field_value').show();
            }else{
                $('.field_value').hide();
            }
        }
    </script>
@endsection