<?php 
	session_start();
	$uid = $_SESSION["userId"];
	$org_id = $_SESSION["org_id"];

	if($_SERVER['REQUEST_METHOD'] == "POST") {

		include('connection.php');

		// get operation
		$oper = $_POST['oper'];

		// add operation
		if($oper == "add") {

			$add_name =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_name']);
			$add_eff_from = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_eff_from']);
			$add_eff_till = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_eff_till']);
            $add_status = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_status']);

			$sql_1 = " INSERT INTO `distri_targets`(`name`, `eff_from`, `eff_till`, `created_by`, `is_active`) 
			VALUES ('$add_name', '$add_eff_from', '$add_eff_till', '$uid','$add_status') ";
			// prepare the query
			$stmt = $con->prepare($sql_1);
			// execute the query
			$result = $stmt->execute();
			$add_target = $con->lastInsertId();

			

			$sql_2 = " SELECT `distributors`.`id`, `distributors`.`code`, `distributors`.`name`, `distributors`.`address`, `territories`.`id` As territory_id, `territories`.`name` As territory_name, `areas`.`id` AS area_id, `areas`.`name` AS area_name,  `depots`.`id` AS depot_id, `depots`.`name` AS depot_name, `regions`.`id` AS region_id, `regions`.`name` AS region_name ,  `regions`.`org_id` AS org_id FROM `distributors` LEFT JOIN territories ON (distributors.territory = territories.id) LEFT JOIN areas ON (territories.area = areas.id) LEFT JOIN depots ON (areas.depot = depots.id) LEFT JOIN regions ON (depots.region = regions.id) ";
			$stmt = $con->prepare($sql_2, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$rows = $stmt->fetchAll();
			foreach ($rows as $row) {
				$distri_id =  $row['id'];
				$distri_code =  $row['code'];
				$distri_name =  $row['name'];
				$distri_address =  $row['address'];
				$territory_id =  $row['territory_id'];
				$territory_name =  $row['territory_name'];
				$area_id =  $row['area_id'];
				$area_name =  $row['area_name'];
				$depot_id =  $row['depot_id'];
				$depot_name =  $row['depot_name'];
				$region_id =  $row['region_id'];
				$region_name =  $row['region_name'];

				$sql = " INSERT INTO `distri_target_details`(`target`, `distri_id`, `distri_name`, `distri_address`, `distri_code`, `amount`, `created_by`, `is_active`, `territory`, `territorry_name`, `region_id`, `region_name`, `depot_id`, `depot_name`, `area_id`, `area_name`) 
				VALUES ($add_target,'$distri_id','$distri_name','$distri_address','$distri_code ','0','$uid','$add_status','$territory_id','$territory_name','$region_id','$region_name','$depot_id','$depot_name','$area_id','$area_name') ";
				// prepare the query
				$stmt = $con->prepare($sql);
				// execute the query
				$result = $stmt->execute();
			}
			
			// check result
			if($result == 'true'){
				echo 'true';
				// echo $stmt->rowCount() . " records Added successfully";
			}
		}

		elseif($oper == "edit"){
			$edit_id = $_POST['edit_id'];

			$edit_name =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_name']);
			$edit_eff_from =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_eff_from']);
            $edit_eff_till = preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_eff_till']);
            $edit_status = preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_status']);                                         

		    $query = "UPDATE `distri_targets` SET 
                `name`='$edit_name',
                `eff_from`='$edit_eff_from',`eff_till`=' $edit_eff_till',
                `is_active`='$edit_status' WHERE `id` = '$edit_id' ";

			//prepare query
			$stmt = $con->prepare($query);
			// execute the query
			$result  = $stmt->execute();

			if($result  == 'true'){
				echo 'true';
				// echo $stmt->rowCount() . " records Added successfully";
			}
		}

	}

?>