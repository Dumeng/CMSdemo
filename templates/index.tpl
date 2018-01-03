<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/index.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/index.css">
    <title>Home</title>
</head>

<body>
    <div class="content">
        {if empty($user)}
        <a href="login.php">Log In</a>
        {else}
        <a href="user.php">{$user}'s setting</a>
        {/if}
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
<page>{$totalPage}</page>

</html>