@extends('admin/common/layout')
@section('content')
<article class="page-container">
	<form class="form form-horizontal" id="form-member-add">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">课程：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <select id="optgroup" class="form-control form-control-chosen" name="course_id">
                    @foreach($tree as $v)
                    <optgroup label="{{$v->pro_name}}">
                        @foreach($v->course as $vv)
                        <option value="{{$vv->course_id}}">{{$vv->course_name}}</option>
                        @endforeach
                    </optgroup>
                    @endforeach
                </select> 
            </div>
		</div>
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">老师：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<select id="multiple" class="form-control form-control-chosen" data-placeholder="请选择老师" multiple  name="teacher_ids[]">
					@foreach($teachers as $v)
					<option value="{{$v->teacher_id}}">{{$v->teacher_name}}</option>
					@endforeach
				</select>
			</div>
		</div>
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">课时名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="请输入课时名称" id="lesson_name" name="lesson_name">
			</div>
		</div>
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">课时时长：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="number" step="1" class="input-text" value="" placeholder="输入课时时长" id="lesson_duration" name="lesson_duration" style="width:150px">
			</div>
		</div>

        <!-- 上传封面图 -->
		@include('admin/common/upload_image',['edit' => 0])
		<!-- 上传封面图 -->

        <!-- 上传视频 -->
        @include('admin/common/upload_video',['edit' => 0])
        <!-- 上传视频 -->
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">编辑：</label>
			<div class="formControls col-xs-8 col-sm-9" id="editor" >
                <p>欢迎使用  -- 富文本编辑器</p>
            </div>
            <input type="hidden" name="lesson_desc" value="">
		</div>
        
		<div class="row cl ">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>
@endsection
@section('my-js')
<script>
$('form').on('submit',function(evt){
    evt.preventDefault();
    $('input[name="lesson_desc"]').val(editor.txt.html())
    var data = $(this).serialize();

    $.ajax({
        url:'/admin/lesson',
        data:data,
        dataType:'json',
        type:'post',
        headers:{
            'X-CSRF-TOKEN':"{{csrf_token()}}"
        },
        success:function(res){
            if(res.code == 422){
                layer.msg(res.msg)
            }
            if(res.code == 0){
                layer.msg(res.msg)
            }
            if(res.code == 1){
                layer.alert(res.msg,function(){
					parent.self.location = parent.self.location;
				})
            }
        }
    })
});
</script>
<script type="text/javascript">
    <?php $timestamp = time();?>
    $(function() {
        $('#video').uploadify({
            'formData'     : {
                'timestamp' : '<?php echo $timestamp;?>',
                '_token'     : '{{csrf_token()}}'
            },
			'buttonText':"上传视频",
			'fileObjName':'video',
			'progressData': 'percentage',	
            'swf'      : '/admin/uploadify/uploadify.swf',
            'uploader' : '/admin/upload/video',
			'fileTypeExts' : '*.mp4',			//上传视频格式
			'fileSizeLimit' : '10MB',			//上传视频10m
            'onUploadSuccess' : function(file,data,response){
				var video = JSON.parse(data);
				if(data.success = true){
					$('#shipin').show();
					$('input[id="video_address"]').val(video.filename);
				}
				console.log(file.name+'-'+response+'-'+data);
            }
        });
    });
</script>
<script type="text/javascript">
    <?php $timestamp = time();?>
    $(function() {
        $('#cover').uploadify({
            'formData'     : {
                'timestamp' : '<?php echo $timestamp;?>',
                '_token'     : '{{csrf_token()}}'
            },
			'buttonText':"上传封面图",
			'fileObjName':'cover',
			'progressData': 'speed',
            'swf'      : '/admin/uploadify/uploadify.swf',
            'uploader' : '/admin/upload/image',
			'fileTypeExts' : '*.jpg;*.png;*.jpeg;*.gif',			//上传图片格式
			'fileSizeLimit' : '1024KB',						//上传图片1m
            'onUploadSuccess' : function(file,data,response){
				var video = JSON.parse(data);
				if(data.success = true){
					$('#fengmian').show();
					$('input[id="cover_img"]').val(video.filename);
				}
				console.log(file.name+'-'+response+'-'+data);
            }
        });
    });
</script>
@endsection