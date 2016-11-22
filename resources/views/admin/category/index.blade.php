@extends('layouts.admin')

@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{ url('admin/info') }}">首页</a> &raquo; 分類管理
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
    <form action="" method="post">
        <div class="result_wrap">
            <div class="result_title">
                <h3>分類管理</h3>
                @if(session('msg'))
                    <div class="mark">
                        <p style="color:green">{{session('msg')}}</p>
                    </div>
                @endif
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{ url('admin/category/create') }}"><i class="fa fa-plus"></i>添加分類</a>
                    <a href="{{ url('admin/category') }}"><i class="fa fa-recycle"></i>全部分類</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>

                        <th class="tc" width="5%">排序</th>
                        <th class="tc" width="5%">ID</th>
                        <th>分類名稱</th>
                        <th>标题</th>
                        <th>查看次數</th>
                        <th>操作</th>
                    </tr>
                    @foreach($datas as $data)
                    <tr>
                        <td class="tc">
                            <input type="text" onchange="changeOrder(this,'{{ $data->cate_id }}')" value="{{ $data->cate_order }}">
                        </td>
                        <td class="tc">{{ $data->cate_id }}</td>
                        <td>
                            <a href="#">{{ $data->_cate_name }}</a>
                        </td>
                        <td>{{ $data->cate_title }}</td>
                        <td>{{ $data->cate_view }}</td>
                        <td>
                            <a href="{{ url('admin/category/'.$data->cate_id.'/edit') }}">修改</a>
                            <a href="javascript:delCatrgory({{$data->cate_id}})" onclick="">删除</a>

                        </td>
                    </tr>
                    @endforeach
                </table>

{{--<div class="page_nav">
<div>
<a class="first" href="/wysls/index.php/Admin/Tag/index/p/1.html">第一页</a> 
<a class="prev" href="/wysls/index.php/Admin/Tag/index/p/7.html">上一页</a> 
<a class="num" href="/wysls/index.php/Admin/Tag/index/p/6.html">6</a>
<a class="num" href="/wysls/index.php/Admin/Tag/index/p/7.html">7</a>
<span class="current">8</span>
<a class="num" href="/wysls/index.php/Admin/Tag/index/p/9.html">9</a>
<a class="num" href="/wysls/index.php/Admin/Tag/index/p/10.html">10</a> 
<a class="next" href="/wysls/index.php/Admin/Tag/index/p/9.html">下一页</a> 
<a class="end" href="/wysls/index.php/Admin/Tag/index/p/11.html">最后一页</a> 
<span class="rows">11 条记录</span>
</div>
</div>



                <div class="page_list">
                    <ul>
                        <li class="disabled"><a href="#">&laquo;</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->--}}
                <script>
                    function changeOrder(obj,cate_id){
                        var cate_order = $(obj).val();
                        $.post("{{url('admin/cate/changeorder')}}",{'_token':'{{csrf_token()}}','cate_order':cate_order,'cate_id':cate_id}, function (data) {
                            if(data.status == 0){
                                layer.msg(data.msg,{icon:6});
                            }else{
                                layer.msg(data.msg,{icon:5});
                            }

                        });

                    }

                    //删除分类
                    function delCatrgory(cate_id) {
                        layer.confirm('您確定要刪除嗎!?', {
                            btn: ['確定','取消'] //按鈕
                        }, function(){
                            $.post("{{url('admin/category/')}}/"+cate_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                                if(data.status==0){
                                    location.href = location.href; //刪除後自動重整頁面
                                    layer.msg(data.msg, {icon: 6});
                                }else{
                                    layer.msg(data.msg, {icon: 5});
                                }
                            });
//            layer.msg('的确很重要', {icon: 1});
                        }, function(){
                                //點選 取消 做的動作
                        });
                    }
                </script>
@endsection
