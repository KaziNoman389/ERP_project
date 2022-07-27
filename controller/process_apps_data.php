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
            $add_d_name =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_d_name']);
			$add_link =  $_POST['add_link'];
            $add_status= preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_status']);

			$sql = " INSERT INTO `apps`(`name`, `display_name`, `link`, `is_active`, `created_by`) VALUES ('$add_name','$add_d_name','$add_link','1','$uid') ";
		
            // prepare the query
			$stmt = $con->prepare($sql);
			// execute the query
			$result = $stmt->execute();

			if($result == 'true'){
				echo 'true';
				// echo $stmt->rowCount() . " records Added successfully";
			}
		}

		elseif($oper == 'edit'){
			$edit_id = $_POST['edit_id'];
            
			$edit_name =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_name']);
            $edit_d_name =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_d_name']);
			$edit_link =  $_POST['edit_link'];
            $edit_status= preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_status']);

			$query = "UPDATE `apps` SET 
                `name`='$edit_name',`display_name`='$edit_d_name',`link`='$edit_link',
                `is_active`='$edit_status' WHERE `id` = '$edit_id' ";

		    // prepare the query
            $stmt = $con->prepare($query);
            // execute the query
            $result  = $stmt->execute();

            if($result  == 'true'){
                echo 'true';
                // echo $stmt->rowCount() . " records Added successfully";
            }
		}

		elseif($oper == 'add_function'){
			$add_func_id = preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_func_id']);
			
				
			for($i=0; $i<count($_POST['add_func']); $i++) {

				$data1['add_func'] = $_POST['add_func'][$i];
				$add_func =  preg_replace('/[^A-Za-z0-9. -]/', '',$data1['add_func']);

				$sql = " SELECT DISTINCT `code`,`name` FROM functions GROUP BY `name` ";
				// prepare the query
				$stmt = $con->prepare($sql);
				// execute the query
				$result = $stmt->execute();

				while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){
					if($add_func == $row['name']){

						$add_code = $row['code'];

						$query = " INSERT INTO `functions`(`app`, `name`, `code`, `created_by`, `is_active`) 
						VALUES ('$add_func_id','$add_func','$add_code','$uid','1') ";

						//prepare the query
						$stmt = $con->prepare($query);
						// execute the query
						$result  = $stmt->execute();
					}
				}
			}

            if($result  == 'true'){
                echo 'true';
                // echo $stmt->rowCount() . " records Added successfully";
            }
		}

		elseif($oper == 'add_emp'){
			$add_app_id = preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_app_id']);
			$e_list = $_POST['add_emp_list'];
			$f_list = $_POST['add_func_list'];

			$emp_arr_length = count($e_list);
			for($i = 0; $i < $emp_arr_length; $i++) {
				$add_emp_list =  preg_replace('/[^A-Za-z0-9. -]/', '', $e_list[$i]);

				$func_arr_length = count($f_list);
				for($j = 0; $j < $func_arr_length; $j++) {
					$add_func_list =  preg_replace('/[^A-Za-z0-9. -]/', '', $f_list[$j]);

					$query = " INSERT INTO `permissions`(`emp_id`, `app`, `func`, `is_active`, `created_by`) 
					VALUES ('$add_emp_list','$add_app_id','$add_func_list','1','$uid') ";
					//prepare the query
					$stmt = $con->prepare($query);
					// execute the query
					$result  = $stmt->execute();
				}
			}
			if($result  == 'true'){
					echo 'true';
					// echo $stmt->rowCount() . " records Added successfully";
			}
		}
	
	}


?>