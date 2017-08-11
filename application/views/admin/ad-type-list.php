<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('admin/header');?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets'); ?>/css/kkpager_blue.css" />
</head>

<body data-type="widgets">
    <script src="<?php echo base_url('assets') ?>/js/theme.js"></script>
    <div class="am-g tpl-g">
        
		<?php $this->load->view('admin/common');?>

        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">广告位列表</div>
                            </div>
                            <div class="widget-body am-fr">

                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a href="javascript:;" class="am-btn am-btn-default am-btn-success" id="add-type-btn"><span class="am-icon-plus"></span> 新增</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                                        <thead>
                                            <tr>
                                                <th>广告位名称</th>
                                                <th>栏目数量</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody id="adlist">
                                        	<?php foreach($type as $item){ ?>
                                        	<tr>
                                        		<td><?php echo $item->type_name; ?></td>
	                                            <td><?php echo $item->countNum; ?></td>
												<td>
												<div class="tpl-table-black-operation">
												<a href="javascript:;" id="edit">
												    <i class="am-icon-pencil"></i> 编辑
												</a>
												<a href="javascript:;" class="tpl-table-black-operation-del">
												    <i class="am-icon-trash"></i> 删除
												</a>
												</div>
												</td>
                                        	</tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="am-u-lg-12 am-cf">
									<!--分页插件-->
                                    <div id="kkpager"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="am-modal am-modal-prompt" tabindex="-1" id="my-prompt">
	  <div class="am-modal-dialog">
	    <div class="am-modal-hd">添加一个广告位</div>
	    <div class="am-modal-bd">
	      	请输入广告栏目的名称，例如（热门游戏）
	      <input type="text" class="am-modal-prompt-input" id="my_add"/>
	    </div>
	    <div class="am-modal-footer">
	      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
	      <span class="am-modal-btn" data-am-modal-confirm>提交</span>
	    </div>
	  </div>
	</div>
 </div>
   
<!-- 公共底部 -->
<?php $this->load->view('admin/bottom');?> 

<script type="text/javascript">
var deleteUrl="<?php echo base_url('manage_ad_type/delete'); ?>";	
var addUrl="<?php echo base_url('manage_ad_type/append'); ?>";	
	$(function() {
	  $('#add-type-btn').on('click', function() {
	    $('#my-prompt').modal({
	      relatedTarget: this,
	      onConfirm: function(e) {
	        //alert('你输入的是：' + e.data || '');
	        if(e.data!==''){
	        	$.post(addUrl,{title:e.data},function(res){
	        		if(res==1){
	        			location.reload();
	        		}else{
	        			alert("添加失败!");
	        		}
	        	},"json");
	        }
	        $("#my_add").val("");
	      },
	      onCancel: function(e) {
	        //alert('取消提交');
	        $("#my_add").val("");
	      }
	    });
	  });
	  
	});
</script>
</body>
</html>