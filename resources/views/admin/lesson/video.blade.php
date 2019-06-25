<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>视频播放</title>
		<style type="text/css">body{margin:50px;padding:50px;font-family:"Microsoft YaHei",YaHei,"微软雅黑",SimHei,"黑体";font-size:14px}</style>
	</head>
	<body>
        <div id="video" style="width: 600px; height: 400px;"></div>
        
		<script type="text/javascript" src="/admin/ckplayer/ckplayer.js"></script>
		<script type="text/javascript">
			var videoObject = {
				container: '#video', //容器的ID或className
                variable: 'player',//播放函数名称
                loop: true, //播放结束是否循环播放
                autoplay: true, //是否自动播放
				poster:'{{$lesson->cover_img}}',    //封面图片
				video: '{{$lesson->video_address}}' //视频
			};
			var player = new ckplayer(videoObject);
		</script>
		<p>本页观看需要在支持h5环境的浏览器上，视频格式需要是h5支持的mp4</p>
	</body>
</html>