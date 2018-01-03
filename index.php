<?php
require('core.php');
include_once('..\libs\Smarty.class.php');
$smarty = new Smarty();
$rowInPage = 2;

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $page = $_POST['page'];
    $response = array();
    if ($page<=0) {
        echo($response);
    }

    $mysqli = connectDB();

    $sql = 'SELECT title,content FROM msg LIMIT ' . ($page-1)*$rowInPage . ',' . $rowInPage;
    $result = $mysqli->query($sql);
            
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $response[]=array('title'=>$row['title'],'text'=> $row["content"]);
        }
    }
    echo(json_encode($response));
} else {
    $user='';
    if (array_key_exists('user', $_COOKIE)) {
        $user=$_COOKIE['user'];
    }
    $mysqli = connectDB();
    $stmt = $mysqli->prepare("SELECT COUNT(*) nrecord FROM msg");
    
    if ($stmt->execute() === true) {
        $result = $stmt->get_result()->fetch_assoc();
        $totalPage=ceil($result['nrecord']/$rowInPage);
    }

    $smarty->assign('user', $user, true);
    $smarty->assign('totalPage', $totalPage, true);
    $smarty->display('index.tpl');
}
