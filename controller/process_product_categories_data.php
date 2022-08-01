<?php 
	session_start();
	$uid = $_SESSION["userId"];
	$org_id = $_SESSION["org_id"];

	if($_SERVER['REQUEST_METHOD'] == "POST") {


		include('connection.php');

		//get operation
		$oper = $_POST['oper'];

		if($oper == 'add'){

            $add_name =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_name']);
            $add_sub_of_list =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_sub_of_list']);

            if($_POST['add_sub_of_list'] != null){

                $add_sub_of_list =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_sub_of_list']);

                $sql = " INSERT INTO `productcategories`(`name`, `sub_of`, `created_by`, `is_active`, `org_id`) 
                VALUES ('$add_name','$add_sub_of_list','$uid','1','$org_id') ";
                // prepare the query
                $stmt = $con->prepare($sql);
                // execute the query
                $result = $stmt->execute();
            }

            elseif($_POST['add_sub_of_list'] == null){

                $sql = " INSERT INTO `productcategories`(`name`, `sub_of`, `created_by`, `is_active`, `org_id`) 
                VALUES ('$add_name','0','$uid','1','$org_id') ";
                // prepare the query
                $stmt = $con->prepare($sql);
                // execute the query
                $result = $stmt->execute();
            }
            
			if($result == 'true'){
				echo 'true';
				// echo $stmt->rowCount() . " records Added successfully";
			}
		}

		elseif($oper == 'edit'){
			$edit_id = $_POST['edit_id'];
            
			$edit_name =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_name']);
            $edit_status= preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_status']);

            if($_POST['edit_sub_of_list'] != null){
                $edit_sub_of_list =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_sub_of_list']);

                $query = "UPDATE `productcategories` SET 
                `name`='$edit_name',`sub_of`='$edit_sub_of_list',`is_active`='$edit_status' WHERE `id` = '$edit_id' ";
                // prepare the query
                $stmt = $con->prepare($query);
                // execute the query
                $result  = $stmt->execute();
            }
            else{
                $query = "UPDATE `productcategories` SET 
                `name`='$edit_name', `sub_of`= '$edit_sub_of_list', `is_active`='$edit_status' WHERE `id` = '$edit_id' ";
                // prepare the query
                $stmt = $con->prepare($query);
                // execute the query
                $result  = $stmt->execute();
            }

            if($result  == 'true'){
                echo 'true';
                // echo $stmt->rowCount() . " records Added successfully";
            }
		}
	
	}


?>