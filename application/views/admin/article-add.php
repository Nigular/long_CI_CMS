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
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 添加文章 <small>Article add</small></div>
                    </div>
                </div>
            </div>

            <div class="row-content am-cf">
                <div class="row">

                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">全部字段为必填</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">

                                <form class="am-form tpl-form-border-form tpl-form-border-br" action="<?php echo base_url('manage_article/addone'); ?>" method="post">
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">标题 <span class="tpl-form-line-small-title">Title</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name="title" class="tpl-form-input" id="user-name" placeholder="请输入标题文字">
                                            <small>请填写标题文字10-30字左右。</small>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-email" class="am-u-sm-3 am-form-label">发布时间 <span class="tpl-form-line-small-title">Time</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name="add_time" class="am-form-field tpl-form-no-bg" placeholder="发布时间" data-am-datepicker="" readonly>
                                            <small>发布时间为必填</small>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-phone" class="am-u-sm-3 am-form-label">作者 <span class="tpl-form-line-small-title">Author</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name="author" id="user-weibo" placeholder="填写发布者信息">
                                            <div></div>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-weibo" class="am-u-sm-3 am-form-label">所属栏目 <span class="tpl-form-line-small-title">Type</span></label>
                                        <div class="am-u-sm-9">
                                            <select data-am-selected="{btnSize: 'sm'}" name="type" style="display: none;">
											  <option value="0">请选择栏目</option>
											  <?php foreach($category as $item){ ?>
								              <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
								              <?php } ?>
											</select>
                                        </div>
                                        
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-intro" class="am-u-sm-3 am-form-label">文章内容</label>
                                        <div class="am-u-sm-9">
                                            <!--<textarea class="" rows="10" id="user-intro" placeholder="请输入文章内容"></textarea>-->
                                            <textarea class="am-validate" name="myue" id="myue" required></textarea>
                                            
                                        </div>
                                    </div>
									<input type="hidden" name="add" value="1"/>
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
	<script src="<?php echo base_url('ueditor'); ?>/ueditor.config.js"></script>
	<script src="<?php echo base_url('ueditor'); ?>/ueditor.all.js"></script>
	<script type="text/javascript">
		$(function() {
		  var editor = UE.getEditor('myue');
		})
	</script>
</body>
</html>