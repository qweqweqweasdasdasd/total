<!-- 上传封面图 -->
<div class="row cl" >
    <label class="form-label col-xs-4 col-sm-2">封面图：</label>
    <div class="formControls col-xs-8 col-sm-9">
        <input type="text" class="input-text"  id="cover" >
    </div>
    <label class="form-label col-xs-4 col-sm-2"></label>
    <div class="formControls col-xs-8 col-sm-9" id="fengmian" @if($edit) style="" @else style="display:none;"  @endif>
        <input type="text" class="input-text"  id="cover_img" readonly name="cover_img" >
    </div>
</div>
<!-- 上传封面图 -->