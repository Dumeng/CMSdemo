<?php
require('core.php');
include_once('..\libs\Smarty.class.php');
$smarty = new Smarty();

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $repsonse='Unknown Error';
    try {
        $usr = $_POST['username'];
        $pwd = $_POST['password'];
        $eml = $_POST['email'];
        $role='reader';
        if (array_key_exists('role', $_POST)) {
            if ($_COOKIE['role']=='admin') {
                $role = $_POST['role'];
            }
        }
    } catch (Exception $e) {
        $repsonse=$e->getMessage();
        echo($repsonse);
        return;
    }
    

    if (empty($usr)||empty($pwd)||empty($eml)) {
        $repsonse='Illegal Submit';
    } else {
        $mysqli = connectDB();

        $stmt = $mysqli->prepare("INSERT INTO user (username, email, password, role) VALUES (?, ?, ?, ?)");
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $stmt->bind_param('ssss', $usr, $eml, $pwd, $role);
    
        if ($stmt->execute() === true) {
            $repsonse='success';
        } else {
            $repsonse='Error: ' . $mysqli->error;
        }
        $stmt->close();
        $mysqli->close();
    }

    echo($repsonse);
}
