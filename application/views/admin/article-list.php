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
                                <div class="widget-title  am-cf">文章列表</div>
                            </div>
                            <div class="widget-body  am-fr">

                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a href="<?php echo base_url('manage_article/append'); ?>" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                                    <div class="am-form-group tpl-table-list-select">
                                        <select data-am-selected="{btnSize: 'sm'}" id="seltType">
							              <option value="0">所有类别</option>
							              <?php foreach($category as $item){ ?>
							              <option value="<?php echo $item->id; ?>" <?php if($item->id==$type){ ?>selected<?php } ?> ><?php echo $item->name; ?></option>
							              <?php } ?>
							            </select>
                                    </div>
                                </div>
                                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                        <input type="text" class="am-form-field " id="searchkey">
                                        <span class="am-input-group-btn">
            <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="button" id="search"></button>
          </span>
                                    </div>
                                </div>

                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                        <thead>
                                            <tr>
                                                <th>文章标题</th>
                                                <th>点击数</th>
                                                <th>时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody id="artlist">
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
    </div>
<script type="text/html" id="tmp-list">
	{{each alist as value}}
	<tr class="even gradeC">
		<td><a href="<?php echo base_url('manage_article/detail/'); ?>{{value.id}}" target="_bank">{{value.title}}</a></td>
		<td>{{value.hits}}</td>
		<td>{{value.add_time | totime}}</td>
		<td>
		<div class="tpl-table-black-operation">
		<a href="<?php echo base_url('manage_article/edit/'); ?>{{value.id}}">
		    <i class="am-icon-pencil"></i> 编辑
		</a>
		<a href="javascript:deleteone({{value.id}});" class="tpl-table-black-operation-del">
		    <i class="am-icon-trash"></i> 删除
		</a>
		</div>
		</td>
	</tr>
	{{/each}}
</script>    
    
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
					location.reload();
				}else{
					alert("删除失败");
				}
			},"json");
		};
	}
</script>
<script src="<?php echo base_url('assets'); ?>/js/template.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url('assets'); ?>/js/kkpager.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	var getListUrl="<?php echo base_url('manage_article/getlist'); ?>";
	$(function(){
		template.helper('totime', function(str) {
		    var now = new Date(parseInt(str)*1000);     
	     	var year=now.getFullYear();     
          	var month=now.getMonth()+1;     
          	var date=now.getDate();         
          	return year+"-"+month+"-"+date;
		});
		
		//分页变量(全局)
		var _page=1,_pagesize=2,_type="<?php echo $type ?>";
		
		function getList(){
			$.post(getListUrl,{page:_page,pagesize:_pagesize,type:_type},function(data){
				var html = template('tmp-list', data);
				document.getElementById('artlist').innerHTML = html;
			},"json");
		}
		
		function init(){
			// 首次进入页面，获取所有类别
			$.post(getListUrl,{page:_page,pagesize:_pagesize,type:_type},function(data){
				console.log(data);
				if(data.total==0){
					var html = "暂无数据";
				}else{
					var html = template('tmp-list', data);
				}
				document.getElementById('artlist').innerHTML = html;
				kkpager.generPageHtml({
					pno : 1,
					//总页码
					total : Math.ceil(data.total/_pagesize),
					//总数据条数
					totalRecords : data.total,
					mode : 'click',//默认值是link，可选link或者click
					click : function(n){
						_page=n;
						this.selectPage(n);
						getList(_type);
						return false;
					}
				});
			},"json");
		}
		
		init();
		
		// 选择分类
		$("#seltType").on("change",function(){
			var type = $("#seltType").val();
			location.href="<?php echo base_url('manage_article/type'); ?>/"+type;
		});
		
		//搜索关键字
		$("#search").on("click",function(){
			var skey=$("#searchkey").val();
			location.href="<?php echo base_url('manage_article/search/')?>"+skey;
		})
	});
</script>
</body>
</html>