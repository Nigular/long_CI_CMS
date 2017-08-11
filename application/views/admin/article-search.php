<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('admin/header');?>
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
                                <div class="widget-title  am-cf">文章搜索结果</div>
                            </div>
                            <div class="widget-body  am-fr">


                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                        <thead>
                                            <tr>
                                                <th>文章标题</th>
                                                <th>作者</th>
                                                <th>时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody id="artlist">
                                        	<?php foreach($alist as $item){ ?>
                                        	<tr class="even gradeC">
												<td><a href="<?php echo base_url('manage_article/detail/'.$item->id); ?>" target="_blank"><?php echo $item->title; ?></a></td>
												<td><?php echo $item->author; ?></td>
												<td><?php echo $item->add_time; ?></td>
												<td>
												<div class="tpl-table-black-operation">
												<a href="<?php echo base_url('manage_article/edit/'.$item->id); ?>">
												    <i class="am-icon-pencil"></i> 编辑
												</a>
												<a href="javascript:deleteone(<?php echo $item->id; ?>);" class="tpl-table-black-operation-del">
												    <i class="am-icon-trash"></i> 删除
												</a>
												</div>
												</td>
											</tr>
											<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
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
	var deleteUrl="<?php echo base_url('manage_article/delete'); ?>";
	//删除一篇文章
	function deleteone(aid){
		if(confirm("确定要删除这篇文章吗?")){
			$.post(deleteUrl,{aid:aid},function(data){
				if(data==1){
					alert("删除成功");
				}else{
					alert("删除失败");
				}
			},"json");
		};
	}
</script>
</body>
</html>