@extends('admin/common/layout')
@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> {{$pathInfo['model']}} <span class="c-gray en">&gt;</span> {{$pathInfo['controller']}} <span class="c-gray en">&gt;</span> {{$pathInfo['method']}} <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c"> 日期范围：
		<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
		<input type="text" class="input-text" style="width:250px" placeholder="输入管理员名称" id="" name="">
		<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="live_course_add('添加直播课','/admin/live/course/create','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加直播课</a></span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
	<table class="table table-border table-bordered table-bg mt-20">
		<thead>
			<tr>
				<th scope="col" colspan="9">直播课程</th>
			</tr>
			<tr class="text-c">
				<th width="40">ID</th>
				<th width="150">直播课名</th>
				<th width="100">直播流</th>
				<th width="150">图片</th>
				<th width="150">开始时间</th>
				<th width="150">结束时间</th>
				<th >描述</th>
				<th width="200">直播操作</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
            @foreach($liveCourse as $v)
			<tr class="text-c">
				<td>{{$v->id}}</td>
				<td>{{$v->name}}</td>
				<td>{{$v->stream->p_name}}</td>
				<td>
                    <img src="{{$v->cover_img}}" alt="" width="100px;"> 
                </td>
				<td>{{date('Y-m-d H:i:s',$v->start_at)}}</td>
				<td>{{date('Y-m-d H:i:s',$v->end_at)}}</td>
				<td></td>
				<th width="100">
					<input class="btn btn-secondary-outline radius" type="button" value="开始推流" onclick="show_push('推流地址','/admin/live/course/getpush/{{$v->id}}/{{$v->stream_id}}',800,300)">
					
				</th>
				<td class="td-manage"><a style="text-decoration:none" onClick="admin_stop(this,'10001')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> <a title="编辑" href="javascript:;" onclick="admin_edit('管理员编辑','admin-add.html','1','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
@section('my-js')
<script>
/*直播-添加*/
function live_course_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*直播-编辑*/
function admin_permission_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}

/*直播-获取推流地址*/
function show_push(title,url,id,w,h) {
	layer_show(title,url,w,h);
}
/*直播-删除*/
function admin_permission_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'DELETE',
			url: '/admin/permission/'+id,
			dataType: 'json',
			headers:{
				'X-CSRF-TOKEN':"{{csrf_token()}}"
			},
			success: function(res){
				if(res.code == 1){
					$(obj).parents("tr").remove();
					layer.msg(res.msg,{icon:1,time:1000});
				}
				if(res.code == 0){
					layer.msg(res.msg,{icon:2,time:1000});
				}
			}
		});		
	});
}
</script>
@endsection
