<?php
require_once 'connection.php';

$error = array();
$res = array();

if (empty($_POST['username'])) {
    $error[] = "Username field is required";
}

if (empty($_POST['password'])) {
    $error[] = "Password field is required";
}
if (empty($_POST['username'])) {
    $error[] = "Enter Correct Username";
}

if (count($error) > 0) {
    $resp['msg'] = $error;
    $resp['status'] = false;
    echo json_encode($resp);
    exit;
}

$statement = $con->prepare("select * from emp_list where hash = :username");
$statement->execute(array(':username' => $_POST['username']));
$row = $statement->fetchAll(PDO::FETCH_ASSOC);
if (count($row) > 0) {
    if ($_POST['password'] != $row[0]['secret']) {
        $error[] = "Password is not valid";
        $resp['msg'] = $error;
        $resp['status'] = false;
        echo json_encode($resp);
        exit;
    }
    session_start();
    $uid = $_SESSION["userId"] = $row[0]["id"];
    $_SESSION["name"] = $row[0]["name"];
    $_SESSION["dept_id"] = $row[0]["dept_id"];
    $_SESSION["dept"] = $row[0]["dept"];
    $_SESSION["org_id"] = $row[0]["org_id"];
    $_SESSION["org"] = $row[0]["org"];
    $_SESSION["emp_code"] = $row[0]["emp_code"];
    $_SESSION["job_title"] = $row[0]["job_title"];
    $_SESSION["desig_id"] = $row[0]["desig_id"];
    $_SESSION["desig"] = $row[0]["desig"];
    $_SESSION["wloc_id"] = $row[0]["wloc_id"];
    $_SESSION["loc"] = $row[0]["loc"];
    $_SESSION["photo"] = $row[0]["photo"];
    $_SESSION["emp_code"] = $row[0]["emp_code"];
    $role = $_SESSION["role"] = $row[0]["role"];
    $_SESSION["photo"] = $row[0]["photo"];


    //sidebar menues
    $query = "SELECT p.`id`, p.`app`, a.name, a.display_name, a.link FROM `permissions` p LEFT JOIN apps a ON a.id = p.app WHERE p.emp_id = $uid OR p.emp_id = 0 GROUP BY p.app";


        $stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
        {
            $memberApps[] = $row;
        }
        if(!empty($memberApps)) {
            $_SESSION["apps"] = $memberApps;
        }



        $query1 = "SELECT p.`id`, p.`emp_id`, p.`app`,a.name, p.`func`, f.code FROM `permissions` p LEFT JOIN apps a ON a.id = p.app LEFT JOIN functions f ON f.id = p.func WHERE p.emp_id = $uid OR p.emp_id = 0 ";


        $stmt1 = $con->prepare($query1, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt1->execute();
        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
        {
            $memberFuncs[] = $row;
        }
        if(!empty($memberFuncs)) {
            $_SESSION["funcs"] = $memberFuncs;
        }



        //insert login history

            date_default_timezone_set("Asia/Dhaka");

            $login_time = date("Y-m-d H:i:s");


            $u_id = $_SESSION["userId"];
            $dept_id = $_SESSION["dept_id"];
            $dept = $_SESSION["dept"];
            $org_id = $_SESSION["org_id"];
            $org = $_SESSION["org"];
            $emp_code = $_SESSION["emp_code"];
            $job_title = $_SESSION["job_title"];
            $desig_id = $_SESSION["desig_id"];
            $desig = $_SESSION["desig"];
            $emp_code = $_SESSION["emp_code"];
            $emp_name = $_SESSION["name"];
            $log_status = 'login';

            $sql= 'INSERT INTO `login_out_action`(log_time,log_status,emp_id,emp_code,emp_name,dept_id,dept,org_id,org,desig_id,desig) VALUES ("'.$login_time.'","'.$log_status.'","'.$u_id.'","'.$emp_code.'","'.$emp_name.'","'.$dept_id.'","'.$dept.'","'.$org_id.'","'.$org.'","'.$desig_id.'","'.$desig.'")';
            $sth = $con->prepare($sql);
            $sth->execute();
            $sal_ref = $con->lastInsertId();


    //.redirect user 

    if($role == 'management'){
        $resp['redirect'] = "views/dashboard/";
    }
    $resp['status'] = true;
    echo json_encode($resp);
    exit;


} else {
    $error[] = "Username does not match";
    $resp['msg'] = $error;
    $resp['status'] = false;
    echo json_encode($resp);
    exit;
}