<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('admin/header');?>
</head>

<body data-type="widgets">
    <script src="<?php echo base_url('assets') ?>/js/theme.js"></script>
    <div class="am-g tpl-g">
        <!-- 公共菜单 -->
        <?php $this->load->view('admin/common');?>

        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">

            <div class="container-fluid am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 文章预览 </div>
                    </div>
                </div>
            </div>

            <div class="row-content am-cf">
                <div class="row">
                	<article class="am-article">
					  <div class="am-article-hd">
					    <h1 class="am-article-title"><?php echo $article->title; ?></h1>
					    <p class="am-article-meta"><?php echo $article->author; ?> / <?php echo date("Y-m-d",$article->add_time); ?></p>
					  </div>
					
					    <div>
					    	<?php echo $article->content; ?>
					    </div>
					</article>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- 公共底部 -->
    <?php $this->load->view('admin/bottom');?>
</body>
</html>