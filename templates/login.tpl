<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/login.js"></script>
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
                <input class="login-username" type="text" name="username" required placeholder="Username or Email">
                <input class="login-password" type="password" name="password" required placeholder="Password">
                <input type="submit" class="submit" value="LOG IN">
            </form>
            <form id="form-sign" onsubmit="return sign();">
                <input class="sign-username" type="text" required placeholder="Username">
                <input class="sign-email" type="email" required placeholder="Email">
                <input class="sign-password1" type="password" required placeholder="Password" onkeyup="checkpwd();">
                <input class="sign-password2" type="password" required placeholder="Confirm Password" onkeyup="checkpwd();">
                <input type="submit" class="submit" value="SIGN UP">
            </form>
        </div>
    </div>

</body>

</html>