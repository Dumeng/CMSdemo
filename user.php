<?php
require('core.php');
include_once('..\libs\Smarty.class.php');
$smarty = new Smarty();

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $response=['error'=>'Unknown Error'];
    $mysqli = connectDB();
    if (array_key_exists('role', $_COOKIE)&&array_key_exists('user', $_COOKIE)) {
        switch ($_POST['method']) {
            case 'password':
                if (array_key_exists('password', $_POST)) {
                    $pwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
                } else {
                    $response['error']='Unknown Request';
                    break;
                }
                $stmt = $mysqli->prepare("UPDATE user SET password=(?) WHERE username = (?)");
                if (array_key_exists('user', $_POST)&&$_COOKIE['role']=='admin') {
                    $stmt->bind_param('ss', $pwd, $_POST['user']);
                } else {
                    $stmt->bind_param('ss', $pwd, $_COOKIE['user']);
                }
                if ($stmt->execute()==true) {
                    $response['error']='success';
                } else {
                    $response['error']=$stmt->error;
                }
                $stmt->close();
                break;
            case 'article':
                if ($_COOKIE['role']=='editor') {
                    $stmt = $mysqli->prepare("SELECT id, title, content FROM msg WHERE writer_uid IN ".
                        "(SELECT uid FROM user WHERE username = (?))");
                    $stmt->bind_param('s', $_COOKIE['user']);
                } else {
                    $stmt = $mysqli->prepare("SELECT id, title, content FROM msg");
                }
                if ($stmt->execute() === true) {
                    $results = $stmt->get_result();
                    if ($results->num_rows > 0) {
                        $response['data']=[];
                        while ($row = $results->fetch_assoc()) {
                            $response['data'][]=array(
                                'title'=>$row['title'],
                                'text'=> $row["content"],
                                'id'=> $row["id"]
                            );
                        }
                        $response['error']='success';
                    } else {
                        $response['error']='No Records!';
                    }
                } else {
                    $response['error']= $mysqli->error;
                }
                $stmt->close();
                break;
            case 'user':
                if ($_COOKIE['role']=='admin') {
                    $stmt = $mysqli->prepare("SELECT uid, username, email, role FROM user");
                    if ($stmt->execute()==true) {
                        $results = $stmt->get_result();
                        if ($results->num_rows > 0) {
                            $response['data']=[];
                            while ($row = $results->fetch_assoc()) {
                                $response['data'][]=array(
                                    'uid'=>$row['uid'],
                                    'username'=> $row["username"],
                                    'email'=> $row["email"],
                                    'role'=>$row['role']
                                );
                            }
                            $response['error']='success';
                        } else {
                            $response['error']='No Records!';
                        }
                    } else {
                        $response['error']=$stmt->error;
                    }
                } else {
                    $response['error']=='No Permission';
                }
                break;
            case 'delete':
                if ($_COOKIE['role']=='admin') {
                    if (!array_key_exists('uid', $_POST)) {
                        $response['error']='Unknown Request';
                        break;
                    }
                    $stmt = $mysqli->prepare("DELETE FROM user WHERE uid = (?)");
                    $stmt->bind_param('s', $_POST['uid']);
                    if ($stmt->execute()==true) {
                        $response['error']='success';
                    } else {
                        $response['error']=$stmt->error;
                    }
                } else {
                    $response['error']=='No Permission';
                }
                break;
            case 'remove':
                if ($_COOKIE['role']=='admin'||$_COOKIE['role']=='editor') {
                    if (!array_key_exists('id', $_POST)) {
                        $response['error']='Unknown Request';
                        break;
                    }
                    if ($_COOKIE['role']=='editor') {
                        $stmt = $mysqli->prepare("DELETE FROM msg WHERE uid IN 
                        (SELECT uid FROM msg WHERE username = (?) ) AND id = (?)");
                        $stmt->bind_param('ss', $_COOKIE['username'], $_POST['id']);
                    } else {
                        $stmt = $mysqli->prepare("DELETE FROM msg WHERE id = (?)");
                        $stmt->bind_param('s', $_POST['id']);
                    }
                    if ($stmt->execute()==true) {
                        $response['error']='success';
                    } else {
                        $response['error']=$stmt->error;
                    }
                } else {
                    $response['error']=='No Permission';
                }
                break;
            case 'save':
                if ($_COOKIE['role']=='admin'||$_COOKIE['role']=='editor') {
                    if (array_key_exists('id', $_POST) &&
                    array_key_exists('title', $_POST) &&
                    array_key_exists('text', $_POST)) {
                        if ($_POST['id']=='0') {
                            $stmt = $mysqli->prepare("SELECT uid FROM user WHERE username=(?)");
                            $stmt->bind_param('s', $_COOKIE['user']);
                            $uid=0;
                            if ($stmt->execute()==true) {
                                $result=$stmt->get_result();
                                if ($result->num_rows>0) {
                                    $uid=$result->fetch_row();
                                    $uid=$uid[0];
                                }
                            } else {
                                $response['error']=$stmt->error;
                                break;
                            }
                            $stmt = $mysqli->prepare("INSERT INTO msg (title, content, writer_uid) VALUE (?, ?, ?)");
                            $stmt->bind_param('sss', $_POST['title'], $_POST['text'], $uid);
                        } else {
                            $stmt = $mysqli->prepare("UPDATE msg SET title=(?), content=(?) WHERE id = (?)");
                            $stmt->bind_param('sss', $_POST['title'], $_POST['text'], $_POST['id']);
                        }
                        if ($stmt->execute()==true) {
                            $response['error']='success';
                        } else {
                            $response['error']=$stmt->error;
                        }
                    } else {
                        $response['error']=='Unknown Request';
                    }
                } else {
                    $response['error']=='No Permission';
                }
                break;
            default:
                $response['error']='Unknown Method';
        }
    } else {
        header('Location: login.php');
        return;
    }
    echo(json_encode($response));
} else {
    if (array_key_exists('user', $_COOKIE)&&array_key_exists('role', $_COOKIE)) {
        $user=$_COOKIE['user'];
        $role=$_COOKIE['role'];
        $smarty->assign('user', $user, true);
        $smarty->assign('role', $role, true);
        $smarty->display('user.tpl');
    } else {
        header('Location: login.php');
    }
}
