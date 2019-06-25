<!-- 上传视频 -->
<div class="row cl">
    <label class="form-label col-xs-4 col-sm-2">视频：</label>
    <div class="formControls col-xs-8 col-sm-9">
        <input type="text" class="input-text"  id="video">
    </div>
    <label class="form-label col-xs-4 col-sm-2"></label>
    <div class="formControls col-xs-8 col-sm-9" id="shipin"  @if($edit) style="" @else style="display:none;"  @endif>
        <input type="text" class="input-text"  id="video_address" readonly name="video_address" value="@if($lesson){{$lesson->video_address}}@endif">
    </div>
</div>
<!-- 上传视频 -->