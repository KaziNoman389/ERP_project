<?php 
	session_start();
	$uid = $_SESSION["userId"];
	$org_id = $_SESSION["org_id"];

	if($_SERVER['REQUEST_METHOD'] == "POST") {


		include('connection.php');

		//get operation
		$oper = $_POST['oper'];

		if($oper == 'add'){

			$add_code =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_code']);
			$add_name =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_name']);
			$add_defination =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_defination']);


		    $query = " INSERT INTO `routes`(`code`,  `name`, `definition`,  `created_by`, `is_active`) 
		        VALUES ('$add_code', '$add_name', '$add_defination', '$uid', '1') ";

            //prepare the query
            $stmt = $con->prepare($query);
            // execute the query
            $result  = $stmt->execute();

            if($result  == true){
                echo 'true';
            }
		}


		elseif($oper == 'edit'){

            $edit_id = $_POST['edit_id'];

			$edit_code =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_code']);
			$edit_name =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_name']);
			$edit_defination =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_defination']);
			$edit_status = $_POST['edit_status'];

		    $query = " UPDATE routes SET code = '$edit_code', name = '$edit_name', definition = '$edit_defination', is_active = '$edit_status' WHERE id = '$edit_id' ";

            //prepare the query
            $stmt = $con->prepare($query);
            // execute the query
            $result = $stmt->execute();

            if($result  == true){
                echo 'true';
            }
		}
		
}