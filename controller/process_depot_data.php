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
            $add_address= preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_address']);
            $add_region= preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['region_list']);
            $add_status = $_POST['add_status'];
			$add_sn = mt_rand(8,15);


		    $query = "INSERT INTO `depots`(
		            `code`, 
		            `name`, 
		            `definition`, 
		            `address`,
                    `region`,
                    `created_by`,
		            `is_active`,
					`sn`
		        ) 
		        VALUES (
		            '$add_code',
		            '$add_name',
		            '$add_defination',
                    '$add_address',
                    '$add_region',
		            '$uid',
		            '1',
					'$add_sn'
		        )";



		        $stmt = $con->prepare($query);

				// execute the query
				$result  = $stmt->execute();

				if($result  == true){
				    echo 'true';
			      // echo $stmt->rowCount() . " records Added successfully";
				}

		}


		elseif($oper == 'edit'){
			
            $edit_code =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_code']);
			$edit_name =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_name']);
			$edit_defination =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_defination']);
            $edit_address= preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_address']);
            $edit_region_list= preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_region_list']);                                         
            $edit_status = preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_status']);
            
            $edit_status = $_POST['edit_status'];
			$edit_id = $_POST['edit_id'];


		    $query = "UPDATE `depots` SET 
                `code`='$edit_code',`name`='$edit_name',
                `definition`='$edit_defination',`address`=' $edit_address',
                `region`='$edit_region_list',`is_active`='$edit_status' WHERE `id` = '$edit_id' ";

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