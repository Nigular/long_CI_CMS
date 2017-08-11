<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('admin/header');?>
</head>
<body data-type="widgets">
    <script src="<?php echo base_url('assets');?>/js/theme.js"></script>
    <div class="am-g tpl-g">
        <!-- 公共菜单 -->
        <?php $this->load->view('admin/common');?>

        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">
            <div class="container-fluid am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 添加一个广告 <small>Adsense add</small></div>
                    </div>
                </div>
            </div>

            <div class="row-content am-cf">
                <div class="row">

                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">请仔细填写后再提交</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">

                                <form class="am-form tpl-form-border-form tpl-form-border-br" action="<?php echo base_url('manage_adsense/editone'); ?>" method="post" enctype="multipart/form-data">
                                    <div class="am-form-group">
                                        <label for="ad-title" class="am-u-sm-3 am-form-label">广告标题 <span class="tpl-form-line-small-title">Title</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name="title" class="tpl-form-input" id="ad-title" placeholder="请输入标题文字" value="<?php echo $adsense->title; ?>">
                                            <small>请填写标题文字10-30字左右。</small>
                                        </div>
                                    </div>
                                    
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">所属栏目 <span class="tpl-form-line-small-title">Type</span></label>
                                        <div class="am-u-sm-9">
                                            <select data-am-selected="{btnSize: 'sm'}" name="type" style="display: none;">
											  <option value="0">请选择栏目</option>
											  <?php foreach($type as $item){ ?>
								              <option value="<?php echo $item->id; ?>" <?php if($item->id==$adsense->type){ ?>selected<?php } ?> ><?php echo $item->type_name; ?></option>
								              <?php } ?>
											</select>
                                        </div>
                                    </div>
                                    
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">广告简介 <span class="tpl-form-line-small-title">Desc</span></label>
                                        <div class="am-u-sm-9">
                                            <textarea class="" rows="5" name="desc" placeholder="请输入简单描述300字内"><?php echo $adsense->desc; ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">封面图 <span class="tpl-form-line-small-title">Images</span></label>
                                        <div class="am-u-sm-9" style="cursor: pointer;">
                                            <div class="am-form-group am-form-file" >
                                                <div class="tpl-form-file-img">
                                                    <img src="<?php echo base_url('upload/banner/').$adsense->ad_img;?>" alt="" id="preview" style="max-width:100%;"/>
                                                </div>
                                                <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                                	<i class="am-icon-cloud-upload"></i> 添加封面图片</button>
                                                <input id="doc-form-file" type="file" name="upfile" onchange="imgPreview(this)"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">链接 <span class="tpl-form-line-small-title">Url</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name="link" placeholder="填写跳转的链接" value="<?php echo $adsense->url; ?>">
                                            <small>如果不需要跳转，就不要填写。</small>
                                        </div>
                                    </div>
                                    
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">排序 <span class="tpl-form-line-small-title">Sort</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name="sort" placeholder="填写排序数字，数字越大越靠前" value="<?php echo $adsense->sort; ?>">
                                            <small>如果不需要排序，就不用填写。</small>
                                        </div>
                                    </div>

									<input type="hidden" name="edit" value="1"/>
									<input type="hidden" name="aid" value="<?php echo $adsense->id; ?>"/>
                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-sm-push-3">
                                            <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- 公共底部 -->
    <?php $this->load->view('admin/bottom');?>
	<script type="text/javascript">
		function imgPreview(fileDom){
	        //判断是否支持FileReader
	        if (window.FileReader) {
	            var reader = new FileReader();
	        } else {
	            alert("您的设备不支持图片预览功能，如需该功能请升级您的设备！");
	        }
	        //获取文件
	        var file = fileDom.files[0];
	        var imageType = /^image\//;
	        //是否是图片
	        if (!imageType.test(file.type)) {
	            alert("请选择图片！");
	            return;
	        }
	        //读取完成
	        reader.onload = function(e) {
	            //获取图片dom
	            var img = document.getElementById("preview");
	            //图片路径设置为读取的图片
	            img.src = e.target.result;
	        };
	        reader.readAsDataURL(file);
	    }
	    
		$(function() {
			
		});
	</script>
</body>
</html>