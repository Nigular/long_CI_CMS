<!DOCTYPE html>
<html lang="en">
<head>
	
<?php $this->load->view('admin/header');?>
	
</head>

<body data-type="login">
    <script src="<?php echo base_url("assets"); ?>/js/theme.js"></script>
    <div class="am-g tpl-g">
        <!-- 风格切换 -->
        <div class="tpl-skiner">
            <div class="tpl-skiner-toggle am-icon-cog">
            </div>
            <div class="tpl-skiner-content">
                <div class="tpl-skiner-content-title">
                    	选择主题
                </div>
                <div class="tpl-skiner-content-bar">
                    <span class="skiner-color skiner-white" data-color="theme-white"></span>
                    <span class="skiner-color skiner-black" data-color="theme-black"></span>
                </div>
            </div>
        </div>
        <div class="tpl-login">
            <div class="tpl-login-content">
                <div class="tpl-login-logo">

                </div>
                <?php if($err_tip){ ?>
                <div class="am-form-group am-form-error">
				<label class="am-form-label" for="doc-ipt-error"><?php echo $err_tip; ?></label>
				</div>
				<?php } ?>
                <form class="am-form tpl-form-line-form" action="<?php echo base_url('adminlogin/formsubmit'); ?>" method="post" accept-charset="utf-8">
                    <div class="am-form-group">
                        <input type="text" class="tpl-form-input" name="username" placeholder="请输入账号">

                    </div>

                    <div class="am-form-group">
                        <input type="password" class="tpl-form-input" name="password" placeholder="请输入密码">

                    </div>
                    <div class="am-form-group tpl-login-remember-me">
                        <input id="remember-me" type="checkbox">
                        <label for="remember-me">
       
                        记住密码
                         </label>

                    </div>

                    <div class="am-form-group">
						<input type="hidden" name="submit"  value="login">
                        <button type="submit" class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="http://cdn.bootcss.com/amazeui/2.7.2/js/amazeui.min.js"></script>
    <script src="<?php echo base_url("assets"); ?>/js/app.js"></script>

</body>

</html>