@extends('layouts.admin')

@section('content')
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{ url('admin/info') }}">首頁</a> &raquo; <a href="#">文章管理</a>
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
    {{--<div class="search_wrap">
        <form action="" method="post">
            <table class="search_tab">
                <tr>
                    <th width="120">选择分类:</th>
                    <td>
                        <select onchange="javascript:location.href=this.value;">
                            <option value="">全部</option>
                            <option value="http://www.baidu.com">百度</option>
                            <option value="http://www.sina.com">新浪</option>
                        </select>
                    </td>
                    <th width="70">关键字:</th>
                    <td><input type="text" name="keywords" placeholder="关键字"></td>
                    <td><input type="submit" name="sub" value="查询"></td>
                </tr>
            </table>
        </form>
    </div>--}}
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_title">
                <h3>文章列表</h3>
            </div>
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{ url('admin/article/create') }}"><i class="fa fa-plus"></i>添加文章</a>
                    <a href="{{ url('admin/article') }}"><i class="fa fa-recycle"></i>全部文章</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th width="5%" class="tc">編號</th>
                        <th width="5%" class="tc">文章ID</th>
                        <th width="40%">文章標題</th>
                        <th width="10%" class="tc">點擊次數</th>
                        <th width="10%" class="tc">文章作者</th>
                        <th width="20%" class="tc">發佈時間</th>
                        <th width="10%" class="tc">管理操作</th>
                    </tr>
                    @foreach($datas as $key => $data)
                    <tr>
                        <td class="tc">{{ ($key+1) }}</td>
                        <td class="tc">{{ $data->art_id }}</td>
                        <td>
                            <a href="#">{{ $data->art_title }}</a>
                        </td>
                        <td class="tc">{{ $data->art_view }}</td>
                        <td class="tc">{{ $data->art_editor }}</td>
                        <td class="tc">{{date('Y-m-d'), $data->art_time }}</td>
                        <td class="tc">
                            <a href="#">修改</a>
                            <a href="#">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>

                <div class="page_list">
                    {{ $datas->links() }}
                    <style>
                        .result_content ul li span{
                            font-size: 15px;
                            padding:6px 12px;
                        }
                    </style>
                </div>

            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
@endsection