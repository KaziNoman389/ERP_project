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
			$add_owner_name =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_owner_name']);
			$add_address =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_address']);

            $add_owner_contact_1 =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_owner_contact_1']);
			$add_owner_contact_2 =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_owner_contact_2']);

            $add_business_contact_1 =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_business_contact_1']);
			$add_business_contact_2 =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_business_contact_2']);

            $distributor_arr = implode(', ',$_POST['add_distributors']);
            $add_distributors =  preg_replace('/[^A-Za-z0-9. -,]/', '', $distributor_arr);

            $routes_arr = implode(', ',$_POST['add_routes']);
			$add_routes =  preg_replace('/[^A-Za-z0-9. -,]/', '', $routes_arr);

            $add_approved =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_approved']);
			$add_status =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_status']);


		    $query = " INSERT INTO `outlets`(
                `name`,  `address`, `owner_name`, `owner_contact_1`, `owner_contact_2`, 
                `business_contact_1`, `business_contact_2`, `distributor`, `routes`, 
                `is_approved`, `created_by`, `is_active` ) 
		        VALUES ('$add_name', '$add_address', '$add_owner_name', '$add_owner_contact_1', '$add_owner_contact_2',
                '$add_business_contact_1', '$add_business_contact_2', '$add_distributors', '$add_routes', '$add_approved', 
                '$uid', '1' ) ";

            //prepare the query
            $stmt = $con->prepare($query);
            // execute the query
            $result  = $stmt->execute();

            if($result  == 'true'){
                echo 'true';
            }
		}


		elseif($oper == 'edit'){

            $edit_id = $_POST['edit_id'];

            $edit_name =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_name']);
			$edit_owner_name =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_owner_name']);
			$edit_address =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_address']);

            $edit_owner_contact_1 =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_owner_contact_1']);
			$edit_owner_contact_2 =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_owner_contact_2']);

            $edit_business_contact_1 =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_business_contact_1']);
			$edit_business_contact_2 =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_business_contact_2']);

            $distributor_arr = implode(', ', $_POST['edit_distributors']);
            $edit_distributors =  preg_replace('/[^A-Za-z0-9. -,]/', '', $distributor_arr);

            $routes_arr = implode(', ', $_POST['edit_routes']);
			$edit_routes =  preg_replace('/[^A-Za-z0-9. -,]/', '', $routes_arr);

            $edit_approved =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_approved']);
			$edit_status =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_status']);

		    $query = " UPDATE `outlets` SET `name`='$edit_name',`address`='$edit_address',`owner_name`='$edit_owner_name',`owner_contact_1`='$edit_owner_contact_1',`owner_contact_2`='$edit_owner_contact_2',`business_contact_1`=' $edit_business_contact_1',`business_contact_2`='$edit_business_contact_2',`distributor`=' $edit_distributors',`is_active`='$edit_status',`is_approved`='$edit_approved',`routes`='$edit_routes' WHERE `id`='$edit_id' ";

            //prepare the query
            $stmt = $con->prepare($query);
            // execute the query
            $result = $stmt->execute();

            if($result  == true){
                echo 'true';
            }
		}
		
}