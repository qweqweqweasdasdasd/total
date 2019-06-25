@extends('admin/common/layout')
@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> {{$pathInfo['model']}} <span class="c-gray en">&gt;</span> {{$pathInfo['controller']}} <span class="c-gray en">&gt;</span> {{$pathInfo['method']}} <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c"> 
		<form>
			<span class="select-box inline">
				<select name="course_id" class="select" style="width:280px;">
					<option value="" >全部课程</option>
					@foreach($tree as $v)
                    <optgroup label="{{$v->pro_name}}">
                        @foreach($v->course as $vv)
                        <option value="{{$vv->course_id}}" @if($whereData['course_id'] == $vv->course_id) selected @endif>{{$vv->course_name}}</option>
                        @endforeach
                    </optgroup>
                    @endforeach
				</select>
			</span>
			<input type="text" class="input-text" style="width:250px" placeholder="输入课时的名称" id="" name="lesson_name" value="{{$whereData['lesson_name']}}">
			<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜课时</button>
		</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a href="javascript:;" onclick="lesson_add('添加课时','/admin/lesson/create','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加课时</a></span> <span class="r">共有数据：<strong>{{$count}}</strong> 条</span> </div>
	<div class="">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="40">ID</th>
				<th width="100">课时名</th>
				<th width="100">课时封面图</th>
				<th width="100">所属课程</th>
                <th width="100">所属专业</th>
				<th width="150">视频地址</th>
				<th >课时描述</th>
				<th width="80">课时时长</th>
                <th width="130">授课老师</th>
				<th width="130">添加时间</th>
				<th width="80">操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($lessons as $v)
			<tr class="text-c">
				<td>{{$v->lesson_id}}</td>
				<td>{{$v->lesson_name}}</td>
				<td><img src="{{$v->cover_img}}" width="100px;"></td>
				<td>{{$v->course->course_name}}</td>
                <td>{{$v->course->profession->pro_name}}</td>
                <td><input class="btn btn-success-outline radius" type="button" value="视频播放" onclick="play_video('播放视频','/admin/video/play/{{$v->lesson_id}}','4','','510')"></td>
				<td class="text-l">{!! str_limit($v->lesson_desc,'100','......') !!}</td>
				<td>{{$v->lesson_duration}} 分钟</td>
				<td>
					@foreach($v->teacherInfo as $vv)
						{{$vv->teacher_name}} 
					@endforeach
				</td>
				<td>{{$v->created_at->formatLocalized('%A %d %B')}}</td>
				<td class="td-manage">
					<a title="编辑" href="javascript:;" onclick="lesson_edit('编辑','/admin/lesson/{{$v->lesson_id}}/edit','4','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> 
					<a title="删除" href="javascript:;" onclick="lesson_del(this,'{{$v->lesson_id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i>
				</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{ $lessons->links() }}
	</div>
</div>
@endsection
@section('my-js')
<script>
/*课时-播放*/
function play_video(title,url,w,h){
	layer_show(title,url,w,h);
}
/*课时-添加*/
function lesson_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*课时-编辑*/
function lesson_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*用户-删除*/
function lesson_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'DELETE',
			url: '/admin/lesson/'+id,
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