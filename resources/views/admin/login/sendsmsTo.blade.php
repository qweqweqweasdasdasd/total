@extends('admin/common/layout')
@section('content')
<link href="{{asset('/admin/static/h-ui.admin/css/H-ui.login.css')}}" rel="stylesheet" type="text/css" />
<div class="loginWraper">
  <div id="loginform" class="loginBox">
    <form class="form form-horizontal" >
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input name="mg_name" type="text" placeholder="管理账号" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe68a;</i></label>
        <div class="formControls col-xs-8">
          <input name="email" type="text" placeholder="管理员邮箱" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input type="submit" class="btn btn-success radius size-L" value="确认发送邮件">
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
@section('my-js')
<script>
	$('form').on('submit',function(evt){
		evt.preventDefault();
		var data = $(this).serialize();
		//ajax
		$.ajax({
			url:'/admin/sendsmsTo',
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
						window.location.href = res.data.href
					}
				}
		})
	})
</script>
@endsection
