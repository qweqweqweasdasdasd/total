@extends('admin/common/layout')
@section('content')
<article class="page-container">
	<form class="form form-horizontal" id="form-member-add">
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">直播名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="请输入直播名称" id="name" name="name">
			</div>
		</div>
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">直播流：</label>
			<div class="formControls col-xs-8 col-sm-9"><span class="select-box">
                <select class="select" name="stream_id" size="1">
                    @foreach($liveCourse as $v)
                    <option value="{{$v->stream_id}}">{{$v->p_name}}</option>
                    @endforeach
                </select>
                </span>
			</div>
		</div>

        <!-- 上传封面图 -->
            @include('admin/common/upload_live_image',['edit' => 0])
        <!-- 上传封面图 -->
        
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">开始时间：</label>
			<div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="请输入直播名称" id="start_at" name="start_at" readonly="readonly">
			</div>
		</div>

        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">结束时间：</label>
			<div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="请输入直播名称" id="end_at" name="end_at" readonly="readonly">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">编辑：</label>
			<div class="formControls col-xs-8 col-sm-9" id="editor" >
                <p>欢迎使用  -- 富文本编辑器</p>
            </div>
            <input type="hidden" name="desc" value="">
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
    // 开始时间
    jeDate("#start_at",{
        format: "YYYY-MM-DD",
        isinitVal: true,
        ishmsVal: false,
        minDate: '2016-06-16',
        maxDate: '2025-06-16',
        format:"YYYY-MM-DD hh:mm:ss",
        zIndex:100000
    });

    // 结束时间
    jeDate("#end_at",{
        format: "YYYY-MM-DD",
        isinitVal: true,
        ishmsVal: false,
        minDate: '2016-06-16',
        maxDate: '2025-06-16',
        format:"YYYY-MM-DD hh:mm:ss",
        zIndex:100000
    });
</script>
<script>
$('form').on('submit',function(evt){
    evt.preventDefault();
    $('input[name="desc"]').val(editor.txt.html())
    var data = $(this).serialize();

    $.ajax({
        url:'/admin/live/course',
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