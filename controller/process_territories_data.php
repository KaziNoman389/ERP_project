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
            $add_area= preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['area_list']);
            $add_status = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_status']);


		    $sql = "INSERT INTO `territories`(
		            `code`, 
		            `name`, 
		            `definition`,
                    `area`,
                    `created_by`,
		            `is_active`
		        ) 
		        VALUES (
		            '$add_code',
		            '$add_name',
		            '$add_defination',
                    '$add_area',
		            '$uid',
		            '1'
		        )";

		        $stmt = $con->prepare($sql);

				// execute the query
				$result = $stmt->execute();

				if($result == true){
				    echo 'true';
			      // echo $stmt->rowCount() . " records Added successfully";
				}

		}


		elseif($oper == 'edit'){
			
            $edit_code =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_code']);
			$edit_name =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_name']);
			$edit_defination =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_defination']);
            $edit_area_list= preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_area_list']);                                         
            
            $edit_status = $_POST['edit_status'];
			$edit_id = $_POST['edit_id'];


		    $query = "UPDATE `territories` SET 
                `code`='$edit_code',`name`='$edit_name',`definition`='$edit_defination',
                `area`='$edit_area_list',`is_active`='$edit_status' WHERE `id` = '$edit_id' ";

		    // echo $query;
            $stmt = $con->prepare($query);

            // execute the query
            $result  = $stmt->execute();

            if($result  == true){
                echo 'true';
                // echo $stmt->rowCount() . " records Added successfully";
            }

		}

}


?>