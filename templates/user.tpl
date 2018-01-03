<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/user.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/user.css">
    <title>User - {$user}</title>
</head>

<body>
    <div class="header"> Welcome back, {$user}.</div>
    <div class="tab">
        <ul class="tab-nav">
            <li class="nav" id="nav-setting">Setting</li>
            {if $role=='admin'||$role=='editor'}
            <li class="nav" id="nav-article">Article</li>
            {/if} {if $role=='admin'}
            <li class="nav" id="nav-user">User</li>
            {/if}
            <li class="nav" id="nav-fav">Favorite</li>
        </ul>
        <div class="tab-content">
            <div id="tab-setting">
                <form id="form-pwd" onsubmit="return changePwd();">
                    <input type="password" id="pwd1" placeholder="New Password" onkeyup="checkpwd()">
                    <input type="password" id="pwd2" placeholder="Confirm Password" onkeyup="checkpwd()">
                    <input type="submit" class="submit" value="Change Password">
                </form>
            </div>
            {if $role=='admin'||$role=='editor'}
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
            {/if} {if $role=='admin'}
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
                                    <input type="text" id="username" required>
                                </td>
                                <td class="email">
                                    <input type="email" id="email" required>
                                </td>
                                <td class="role">
                                    <select id="role" required>
                                        <option value="admin">admin</option>
                                        <option value="editor">editor</option>
                                        <option value="reader">reader</option>
                                    </select>
                                </td>
                                <td class="password">
                                    <input type="password" id="password" required>
                                </td>
                                <td>
                                    <input type="submit" class="submit" value="Add New User">
                                </td>
                            </tr>
                        </form>
                    </tfoot>
                </table>
            </div>
            {/if}
            <div id="tab-fav"></div>
        </div>
    </div>
    {if $role=='admin'||$role=='editor'}
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
    {/if}
</body>

</html>