<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title>CI测试</title>
</head>
<?php if($err_tip){echo $err_tip;} ?>
<form action="<?php echo base_url('login/formsubmit'); ?>" method="post" accept-charset="utf-8">
<table>
<tr>
<td>用户名</td>
<td><input type="text" name="username"></td>
</tr>
<tr>
<td>密码</td>
<td><input type="password" name="password"></td>
</tr>
<tr>
<td>
<input type="submit" name="submit" value="login">
</td>
<td>
<input type="submit" name="submit" value="register">
</td>
</tr>
</table>
</form>
</html>