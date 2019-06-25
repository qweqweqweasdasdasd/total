<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<link rel="stylesheet" type="text/css" href="{{asset('/admin/static/h-ui/css/H-ui.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/admin/static/h-ui.admin/css/H-ui.admin.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/admin/lib/Hui-iconfont/1.0.8/iconfont.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/admin/static/h-ui.admin/skin/green/skin.css')}}" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('/admin/static/h-ui.admin/css/style.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/admin/css/page.css')}}" />
<link href="/admin/select/dist/css/component-chosen.css" rel="stylesheet">
<title>{{env('APP_NAME')}}</title>
</head>
<body>
@yield('content')
</body>
</html>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{asset('/admin/lib/jquery/1.9.1/jquery.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('/admin/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('/admin/static/h-ui/js/H-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/admin/static/h-ui.admin/js/H-ui.admin.js')}}"></script> 
<!--/_footer 作为公共模版分离出去-->

<script src="/admin/select/js/chosen.jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>

<!-- 上传uploadify插件 -->
<script src="/admin/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/admin/uploadify/uploadify.css">

<!-- 富文本编辑 -->
<script type="text/javascript" src="https://unpkg.com/wangeditor@3.1.1/release/wangEditor.min.js"></script>
<script type="text/javascript" src="/admin/editor/wang.js"></script>
<!-- 富文本编辑 -->

<!-- 时间选择器 -->
<link rel="stylesheet" type="text/css" href="{{asset('/admin/jedate/skin/jedate.css')}}" />
<script type="text/javascript" src="{{asset('/admin/jedate/dist/jedate.min.js')}}"></script> 
<!-- 时间选择器 -->

<!-- 下拉框插件 -->
<script type="text/javascript" src="{{asset('/admin/myjs/select.js')}}"></script> 
@yield('my-js')
