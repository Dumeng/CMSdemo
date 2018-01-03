<?php
/* Smarty version 3.1.30, created on 2018-01-03 06:00:48
  from "D:\wamp64\www\project\templates\login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a4c71901e9726_50267238',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '57b891f38cca586cc4fe7080c4ff00d1d7e6bb29' => 
    array (
      0 => 'D:\\wamp64\\www\\project\\templates\\login.tpl',
      1 => 1514959243,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a4c71901e9726_50267238 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <?php echo '<script'; ?>
 src="./js/jquery-3.2.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="./js/login.js"><?php echo '</script'; ?>
>
    <link rel="stylesheet" type="text/css" href="./css/login.css">
</head>

<body>
    <div class="tab">
        <div class="tab-nav">
            <h1 id="tab-login">Log In</h1>
            <h1 id="tab-sign">Sign Up</h1>
        </div>
        <div class="tab-content">
            <form id="form-login" onsubmit="return login();">
                <input class="login-username" type="text" name="username" required="required" placeholder="Username or Email">
                <input class="login-password" type="password" name="password" required="required" placeholder="Password">
                <a class="login-submit" onclick="login();">LOG IN</a>
            </form>
            <form id="form-sign" onsubmit="return sign();">
                <input class="sign-username" type="text" required="required" placeholder="Username">
                <input class="sign-email" type="email" required="required" placeholder="Email">
                <input class="sign-password1" type="password" required="required" placeholder="Password" onkeyup="checkpwd();">
                <input class="sign-password2" type="password" required="required" placeholder="Confirm Password" onkeyup="checkpwd();">
                <a class="sign-submit" onclick="sign();">SIGN UP</a>
            </form>
        </div>
    </div>

</body>

</html><?php }
}
