<?php
require('core.php');
include_once('..\libs\Smarty.class.php');
$smarty = new Smarty();

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $usr = $_POST['username'];
    $pwd = $_POST['password'];
    $response = 'Unkonwn Error';

    if (empty($usr)||empty($pwd)) {
        $response = 'Submit error!';
        echo($response);
        return;
    }

    $mysqli = connectDB();

    if (preg_match('/(\w+)@(\w+).(\w+)/', $usr)) {
        $stmt = $mysqli->prepare("SELECT username, password, role FROM user WHERE email = (?)");
    } else {
        $stmt = $mysqli->prepare("SELECT username, password, role FROM user WHERE username = (?)");
    }

    $stmt->bind_param('s', $usr);
    if ($stmt->execute() === true) {
        $results = $stmt->get_result();
        if ($results->num_rows > 0) {
            $result=$results->fetch_row();
            if (password_verify($pwd, $result[1])) {
                setcookie('user', $result[0], time()+3000);
                setcookie('role', $result[2], time()+3000);
                $response='success';
            } else {
                $response='Password is Incorrect!';
            }
        } else {
            $response='Username or Email is Incorrect!';
        }
    } else {
        $response=('Error: ' . $mysqli->error);
    }
    $stmt->close();
    $mysqli->close();
    echo($response);
} else {
    if (!empty($_COOKIE['user'])) {
        header("Location: index.php");
    } else {
        $smarty->display('login.tpl');
    }
}
