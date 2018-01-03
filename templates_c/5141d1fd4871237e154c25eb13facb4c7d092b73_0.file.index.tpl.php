<?php
/* Smarty version 3.1.30, created on 2018-01-03 04:41:59
  from "D:\wamp64\www\project\templates\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a4c5f17777617_09185104',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5141d1fd4871237e154c25eb13facb4c7d092b73' => 
    array (
      0 => 'D:\\wamp64\\www\\project\\templates\\index.tpl',
      1 => 1514954515,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a4c5f17777617_09185104 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php echo '<script'; ?>
 src="./js/jquery-3.2.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="./js/index.js"><?php echo '</script'; ?>
>
    <link rel="stylesheet" type="text/css" href="./css/index.css">
    <title>Home</title>
</head>

<body>
    <div class="content">
        <?php if (empty($_smarty_tpl->tpl_vars['user']->value)) {?>
        <a href="login.php">Log In</a>
        <?php } else { ?>
        <a href="user.php"><?php echo $_smarty_tpl->tpl_vars['user']->value;?>
's setting</a>
        <?php }?>
        <ul class="article">
            <li class="item">
                <h2 class="title"></h2>
                <p class="text"></p>
            </li>
        </ul>
        <div>
            <a onclick="loadPage(curPage-1);" class="prev">Previous</a>
            <a onclick="loadPage(curPage+1);" class="next">Next</a>
        </div>
    </div>
</body>
<page><?php echo $_smarty_tpl->tpl_vars['totalPage']->value;?>
</page>

</html><?php }
}
