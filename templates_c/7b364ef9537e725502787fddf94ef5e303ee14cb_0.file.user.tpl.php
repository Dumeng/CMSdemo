<?php
/* Smarty version 3.1.30, created on 2018-01-03 07:09:47
  from "D:\wamp64\www\project\templates\user.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a4c81bb4c1165_41536770',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7b364ef9537e725502787fddf94ef5e303ee14cb' => 
    array (
      0 => 'D:\\wamp64\\www\\project\\templates\\user.tpl',
      1 => 1514963380,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a4c81bb4c1165_41536770 (Smarty_Internal_Template $_smarty_tpl) {
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
 src="./js/user.js"><?php echo '</script'; ?>
>
    <link rel="stylesheet" type="text/css" href="./css/user.css">
    <title>User - <?php echo $_smarty_tpl->tpl_vars['user']->value;?>
</title>
</head>

<body>
    <div class="header"> Welcome back, <?php echo $_smarty_tpl->tpl_vars['user']->value;?>
.</div>
    <div class="tab">
        <ul class="tab-nav">
            <li class="nav" id="nav-setting">Setting</li>
            <?php if ($_smarty_tpl->tpl_vars['role']->value == 'admin' || $_smarty_tpl->tpl_vars['role']->value == 'editor') {?>
            <li class="nav" id="nav-article">Article</li>
            <?php }?> <?php if ($_smarty_tpl->tpl_vars['role']->value == 'admin') {?>
            <li class="nav" id="nav-user">User</li>
            <?php }?>
            <li class="nav" id="nav-fav">Favorite</li>
        </ul>
        <div class="tab-content">
            <div id="tab-setting">
                <form id="form-pwd" onsubmit="return changePwd();">
                    <input type="password" id="pwd1" placeholder="New Password" onkeyup="checkpwd()">
                    <input type="password" id="pwd2" placeholder="Confirm Password" onkeyup="checkpwd()">
                    <a onclick="getElementById('form-pwd').submit();">Change Password</a>
                </form>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['role']->value == 'admin' || $_smarty_tpl->tpl_vars['role']->value == 'editor') {?>
            <div id="tab-article">
                <a class="text-new">New Article</a>
                <ul class="article-list">
                    <li class="article">
                        <h2 class="title"></h2>
                        <p class="text"></p>
                        <a class="text-edit">Edit</a>
                        <a class="text-remove">Delete</a>
                    </li>
                </ul>
            </div>
            <?php }?> <?php if ($_smarty_tpl->tpl_vars['role']->value == 'admin') {?>
            <div id="tab-user">
                <table>
                    <thead>
                        <tr>
                            <th>UID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Password</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="uid"></td>
                            <td class="username"></td>
                            <td class="email"></td>
                            <td class="role"></td>
                            <td>
                                <a class="pwd-modify">MODIFY</a>
                            </td>
                            <td>
                                <a class="usr-delete">DELETE!</a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <form onsubmit="return addUser();">
                            <tr>
                                <td class="uid"></td>
                                <td class="username">
                                    <input type="text" id="username" required="required">
                                </td>
                                <td class="email">
                                    <input type="email" id="email" required="required">
                                </td>
                                <td class="role">
                                    <select id="role" required="required">
                                        <option value="admin">admin</option>
                                        <option value="editor">editor</option>
                                        <option value="reader">reader</option>
                                    </select>
                                </td>
                                <td class="password">
                                    <input type="password" id="password" required="required">
                                </td>
                                <td>
                                    <a onclick="addUser();" class="add-user">Add New User</a>
                                </td>
                            </tr>
                        </form>
                    </tfoot>
                </table>
            </div>
            <?php }?>
            <div id="tab-fav"></div>
        </div>
    </div>
    <?php if ($_smarty_tpl->tpl_vars['role']->value == 'admin' || $_smarty_tpl->tpl_vars['role']->value == 'editor') {?>
    <div class="editor-bg">
        <div class="editor-model">
            <form action="" class="editor">
                <input type="text" class="editor-title">
                <hr>
                <textarea class="editor-text"></textarea>
                <a onclick="save();">Save</a>
                <a onclick="closeEditor();">Cancel</a>
            </form>
        </div>
    </div>
    <?php }?>
</body>

</html><?php }
}
