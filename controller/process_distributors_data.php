<?php 
	session_start();
	$uid = $_SESSION["userId"];
	$org_id = $_SESSION["org_id"];

	if($_SERVER['REQUEST_METHOD'] == "POST") {

		include('connection.php');

		// get operation
		$oper = $_POST['oper'];

		// add operation
		if($oper == 'add'){

			$add_code =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_code']);
			$add_start_date = preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_start_date']);
			$add_name =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_name']);
			$add_address =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_address']);
			$add_o_name = preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_o_name']);
			$add_o_address = preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_o_address']);
            $add_o_mobile = preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_o_mobile']);
			$add_cp_mobile = preg_replace('/[^A-Za-z0-9. -,]/', '',$_POST['add_cp_mobile']);
			$add_territory_list= preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_territory_list']);
			$add_distri_type= preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['add_distri_type']);
			$add_o_pre_address = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_o_pre_address']);
			$add_o_nid = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_o_nid']);
			$add_tl_number = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_tl_number']);
			$add_tl_lastDate = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_tl_lastDate']);
			$add_b_name_b_branch = preg_replace('/[^A-Za-z0-9. -,]/', '', $_POST['add_b_name_b_branch']);
			$add_b_account = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_b_account']);

			$add_exist_bus_name1 = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_exist_bus_name1']);
			$add_exist_bus_name2 = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_exist_bus_name2']);
			$add_exist_start1 = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_exist_start1']);
			$add_exist_start2 = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_exist_start2']);
			$add_exist_van_puller = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_exist_van_puller']);
			$add_exist_ice_van = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_exist_ice_van']);
			$add_exist_gd_size = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_exist_gd_size']);
			
			$add_rel_gge = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_rel_gge']);

			$area_arr = implode(', ',$_POST['add_area_dem']);
			$add_area_dem = preg_replace('/[^A-Za-z0-9. -,]/', '', $area_arr);

			$add_point_name = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_point_name']);
			$add_k_market = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_k_market']);
			$add_ice_outlets = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_ice_outlets']);
			$add_exist_avg_m_size = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_exist_avg_m_size']);
		
			$add_ig_cont = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_ig_cont']);
			$add_po_cont = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_po_cont']);
			$add_lo_cont = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_lo_cont']);
			$add_ka_cont = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_ka_cont']);
			$add_bl_cont = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_bl_cont']);
			$add_kw_cont = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_kw_cont']);
			$add_others_cont = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_others_cont']);

			$add_ig_comp = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_ig_comp']);
			$add_po_comp = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_po_comp']);
			$add_lo_comp = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_lo_comp']);
			$add_ka_comp = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_ka_comp']);
			$add_bl_comp = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_bl_comp']);
			$add_kw_comp = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_kw_comp']);
			$add_others_comp = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_others_comp']);
			
			// --- for loop for calculating current month and the next six months --- //
			for($i=0; $i<=6; $i++) {
				$next_six_months[] =date("M/y", strtotime( date( 'Y-m-01' )." +$i months"));
			}
			// --- for loop ends --- //

			// --- making sales and months comma seperated --- //
			if( $_POST['add_m1_sales'] == null ){
				$m1_sales = 0;
				$add_m1_sales = $m1_sales ."," . $next_six_months[0];
			}else{
				$m1_sales = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_m1_sales']);
				$add_m1_sales = $m1_sales ."," . $next_six_months[0];
			}

			if( $_POST['add_m2_sales'] == null ){
				$m2_sales = 0;
				$add_m2_sales = $m2_sales ."," . $next_six_months[1];
			}else{
				$m2_sales = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_m2_sales']);
				$add_m2_sales = $m2_sales ."," . $next_six_months[1];
			}

			if( $_POST['add_m3_sales'] == null ){
				$m3_sales = 0;
				$add_m3_sales = $m3_sales ."," . $next_six_months[2];
			}else{
				$m3_sales = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_m3_sales']);
				$add_m3_sales = $m3_sales ."," . $next_six_months[2];
			}

			if( $_POST['add_m4_sales'] == null ){
				$m4_sales = 0;
				$add_m4_sales = $m4_sales ."," . $next_six_months[3];
			}else{
				$m4_sales = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_m4_sales']);
				$add_m4_sales = $m4_sales ."," . $next_six_months[3];
			}

			if( $_POST['add_m5_sales'] == null ){
				$m5_sales = 0;
				$add_m5_sales = $m5_sales ."," . $next_six_months[4];
			}else{
				$m5_sales = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_m5_sales']);
				$add_m5_sales = $m5_sales ."," . $next_six_months[4];
			}

			if( $_POST['add_m6_sales'] == null ){
				$m6_sales = 0;
				$add_m6_sales = $m6_sales ."," . $next_six_months[5];
			}else{
				$m6_sales = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_m6_sales']);
				$add_m6_sales = $m6_sales ."," . $next_six_months[5];
			}

			if( $_POST['add_m7_sales'] == null ){
				$m7_sales = 0;
				$add_m7_sales = $m7_sales ."," . $next_six_months[6];
			}else{
				$m7_sales = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_m7_sales']);
				$add_m7_sales = $m7_sales ."," . $next_six_months[6];
			}	
			// --- making sales and months comma seperated --- //



			// --- making inj and months comma seperated --- //
			if( $_POST['add_m1_inj'] == null ){
				$m1_inj = 0;
				$add_m1_inj = $m1_inj ."," . $next_six_months[0];
			}else{
				$m1_inj = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_m1_inj']);
				$add_m1_inj = $m1_inj ."," . $next_six_months[0];
			}

			if( $_POST['add_m2_inj'] == null ){
				$m2_inj = 0;
				$add_m2_inj = $m2_inj ."," . $next_six_months[1];
			}else{
				$m2_inj = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_m2_inj']);
				$add_m2_inj = $m2_inj ."," . $next_six_months[1];
			}

			if( $_POST['add_m3_inj'] == null ){
				$m3_inj = 0;
				$add_m3_inj = $m3_inj ."," . $next_six_months[2];
			}else{
				$m3_inj = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_m3_inj']);
				$add_m3_inj = $m3_inj ."," . $next_six_months[2];
			}

			if( $_POST['add_m4_inj'] == null ){
				$m4_inj = 0;
				$add_m4_inj = $m4_inj ."," . $next_six_months[3];
			}else{
				$m4_inj = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_m4_inj']);
				$add_m4_inj = $m4_inj ."," . $next_six_months[3];
			}

			if( $_POST['add_m5_inj'] == null ){
				$m5_inj = 0;
				$add_m5_inj = $m5_inj ."," . $next_six_months[4];
			}else{
				$m5_inj = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_m5_inj']);
				$add_m5_inj = $m5_inj ."," . $next_six_months[4];
			}

			if( $_POST['add_m6_inj'] == null ){
				$m6_inj = 0;
				$add_m6_inj = $m6_inj ."," . $next_six_months[5];
			}else{
				$m6_inj = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_m6_inj']);
				$add_m6_inj = $m6_inj ."," . $next_six_months[5];
			}

			if( $_POST['add_m7_inj'] == null ){
				$m7_inj = 0;
				$add_m7_inj = $m7_inj ."," . $next_six_months[6];
			}else{
				$m7_inj = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_m7_inj']);
				$add_m7_inj = $m7_inj ."," . $next_six_months[6];
			}
			// --- making inj and months comma seperated --- //

			$add_total_inv = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_total_inv']);
			$add_num_SDF = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_num_SDF']);
			$add_val_SDF = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_val_SDF']);
			$add_num_vans = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_num_vans']);
			$add_val_vans = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_val_vans']);
			$add_init_lifting = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_init_lifting']);
			$add_gd_adv = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_gd_adv']);
			$add_m_credit = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_m_credit']);
			$add_run_capital = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_run_capital']);
			$add_transac_type = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_transac_type']);
			$add_rsm_recom = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_rsm_recom']);
			$add_gm_recom = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_gm_recom']);
			$add_ref = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_ref']);

			$add_rsm_list = preg_replace('/[^A-Za-z0-9. - ()-]/', '', $_POST['add_rsm_list']);
			$add_asm_list = preg_replace('/[^A-Za-z0-9. - ()-]/', '', $_POST['add_asm_list']);
			$add_fpr_list = preg_replace('/[^A-Za-z0-9. - ()-]/', '', $_POST['add_fpr_list']);

			$add_status = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_status']);
			$add_is_approve = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_is_approve']);

			$add_appr_start_date = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_appr_start_date']);
			$add_appr_close_date = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['add_appr_close_date']);

			$route_arr = implode(', ',$_POST['add_routes']);
			$add_routes = preg_replace('/[^A-Za-z0-9. -,]/', '', $route_arr);
			
			
			// ---------image starts-----------//

			// Proprietor Image
			if(isset($_FILES['add_o_image']['name'])){
				$errors = array();

				$array1 = explode('.', $_FILES['add_o_image']['name']);
				$extension1 = end($array1);
				$add_o_image = uniqid(rand()).'.'.$extension1;
				$file_ext_1 = pathinfo($add_o_image, PATHINFO_EXTENSION);
				$location1 = '../assets/uploads/distributors/distributor_image/'.$add_o_image;

				// add image1
				if(isset($_FILES['add_o_image'])) {
					$maxsize = 512000;
					$allowed_image_extension = array("png", "jpg", "jpeg");

					// Validate image file size
					if(($_FILES["add_o_image"]["size"] > $maxsize) || ($_FILES["add_o_image"]["size"] == 0))  {
						$errors[] = 'File too large. File size must be less than 500 KB.';
					}

					// Validate file input to check if is with valid extension
					if((!in_array($file_ext_1, $allowed_image_extension)) && (!empty($file_ext_1))) {
						$errors[] = 'Invalid file type. Only JPEG, JPG and PNG types are accepted.';
					}
				}

				if(count($errors) === 0) {
					//image upload
					if (isset($_FILES['add_o_image']['name'])) {
						move_uploaded_file($_FILES['add_o_image']['tmp_name'], $location1);
					}
				} else {
					foreach($errors as $error) {
						echo json_encode($error);
					}
					die(); //Ensure no more processing is done
				}
			}


			// Aggrement Image
			if(isset($_FILES['add_agree_image']['name'])){
				$errors = array();

				$array1 = explode('.', $_FILES['add_agree_image']['name']);
				$extension1 = end($array1);
				$add_agree_image = uniqid(rand()).'.'.$extension1;
				$file_ext_2 = pathinfo($add_agree_image, PATHINFO_EXTENSION);
				$location2 = '../assets/uploads/distributors/agreement_image/'.$add_agree_image;

				// add image1
				if(isset($_FILES['add_agree_image'])) {
					$maxsize = 512000;
					$allowed_image_extension = array("png", "jpg", "jpeg");

					// Validate image file size
					if(($_FILES["add_agree_image"]["size"] > $maxsize) || ($_FILES["add_agree_image"]["size"] == 0))  {
						$errors[] = 'File too large. File size must be less than 500 KB.';
					}

					// Validate file input to check if is with valid extension
					if((!in_array($file_ext_2, $allowed_image_extension)) && (!empty($file_ext_2))) {
						$errors[] = 'Invalid file type. Only JPEG, JPG and PNG types are accepted.';
					}
				}

				if(count($errors) === 0) {
					//image upload
					if (isset($_FILES['add_agree_image']['name'])) {
						move_uploaded_file($_FILES['add_agree_image']['tmp_name'], $location2);
					}
				} else {
					foreach($errors as $error) {
						echo json_encode($error);
					}
					die(); //Ensure no more processing is done
				}
			}


			// Approval Imgae
			if(isset($_FILES['add_approval_image']['name'])){
				$errors = array();

				$array1 = explode('.', $_FILES['add_approval_image']['name']);
				$extension1 = end($array1);
				$add_approval_image = uniqid(rand()).'.'.$extension1;
				$file_ext_3 = pathinfo($add_approval_image, PATHINFO_EXTENSION);
				$location3 = '../assets/uploads/distributors/approval_image/'.$add_approval_image;

				// add image1
				if(isset($_FILES['add_approval_image'])) {
					$maxsize = 512000;
					$allowed_image_extension = array("png", "jpg", "jpeg");

					// Validate image file size
					if(($_FILES["add_approval_image"]["size"] > $maxsize) || ($_FILES["add_approval_image"]["size"] == 0))  {
						$errors[] = 'File too large. File size must be less than 500 KB.';
					}

					// Validate file input to check if is with valid extension
					if((!in_array($file_ext_3, $allowed_image_extension)) && (!empty($file_ext_3))) {
						$errors[] = 'Invalid file type. Only JPEG, JPG and PNG types are accepted.';
					}
				}

				if(count($errors) === 0) {
					//image upload
					if (isset($_FILES['add_approval_image']['name'])) {
						move_uploaded_file($_FILES['add_approval_image']['tmp_name'], $location3);
					}
				} else {
					foreach($errors as $error) {
						echo json_encode($error);
					}
					die(); //Ensure no more processing is done
				}
			}


			// Trade License Image
			if(isset($_FILES['add_tl_image']['name'])){
				$errors = array();

				$array1 = explode('.', $_FILES['add_tl_image']['name']);
				$extension1 = end($array1);
				$add_tl_image = uniqid(rand()).'.'.$extension1;
				$file_ext_4 = pathinfo($add_tl_image, PATHINFO_EXTENSION);
				$location4 = '../assets/uploads/distributors/trade_license_image/'.$add_tl_image;

				// add image1
				if(isset($_FILES['add_tl_image'])) {
					$maxsize = 512000;
					$allowed_image_extension = array("png", "jpg", "jpeg");

					// Validate image file size
					if(($_FILES["add_tl_image"]["size"] > $maxsize) || ($_FILES["add_tl_image"]["size"] == 0))  {
						$errors[] = 'File too large. File size must be less than 500 KB.';
					}

					// Validate file input to check if is with valid extension
					if((!in_array($file_ext_4, $allowed_image_extension)) && (!empty($file_ext_4))) {
						$errors[] = 'Invalid file type. Only JPEG, JPG and PNG types are accepted.';
					}
				}

				if(count($errors) === 0) {
					//image upload
					if (isset($_FILES['add_tl_image']['name'])) {
						move_uploaded_file($_FILES['add_tl_image']['tmp_name'], $location4);
					}
				} else {
					foreach($errors as $error) {
						echo json_encode($error);
					}
					die(); //Ensure no more processing is done
				}
			}

			$query = "SELECT id FROM distributors ORDER BY id DESC LIMIT 1";
			$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
			$id = $row['id'];
			$add_distributors = $id + 1;

			$query2 = " INSERT INTO `distri_trade_license`(`distributors`, `tl_image`) VALUES('$add_distributors', '$add_tl_image') ";
			// prepare the query
			$stmt = $con->prepare($query2);
			// execute the query
			$result = $stmt->execute();

			// ---------image ends-----------//

			
		    $sql = "INSERT INTO `distributors`(`code`, `date`, `name`, `address`, `o_pre_address`, `o_name`, `o_address`, `o_nid`, `o_mobile`, `o_image`, `agree_image`, `approval_image`, `cp_mobile`, `territory`, `distri_type`, `created_by`, `is_active`, `is_approve`, `tl_number`, `tl_lastDate`, `b_name_b_branch`, `b_account`, `exist_bus_name1`, `exist_bus_name2`, `exist_start1`, `exist_start2`, `exist_van_puller`, `exist_ice_van`, `exist_gd_size`, `rel_gge`, `area_dem`, `point_name`, `k_market`, `ice_outlets`, `exist_avg_m_size`, `ig_cont`, `po_cont`, `lo_cont`, `ka_cont`, `bl_cont`, `kw_cont`, `others_cont`, `ig_comp`, `po_comp`, `lo_comp`, `ka_comp`, `bl_comp`, `kw_comp`, `others_comp`, `m1_sales`, `m2_sales`, `m3_sales`, `m4_sales`, `m5_sales`, `m6_sales`, `m7_sales`, `m1_inj`, `m2_inj`, `m3_inj`, `m4_inj`, `m5_inj`, `m6_inj`, `m7_inj`, `total_inv`, `num_SDF`, `val_SDF`, `num_vans`, `val_vans`, `init_lifting`, `gd_adv`, `m_credit`, `run_capital`, `transac_type`, `rsm_recom`, `gm_recom`, `ref`, `rsm`, `asm`, `fpr`, `routes`, `appr_start_date`, `appr_close_date`) 
			VALUES ('$add_code', '$add_start_date', '$add_name', '$add_address', '$add_o_pre_address', '$add_o_name', '$add_o_address', '$add_o_nid','$add_o_mobile',  '$add_o_image', '$add_agree_image', '$add_approval_image', '$add_cp_mobile', '$add_territory_list', '$add_distri_type', '$uid', '$add_status', '$add_is_approve','$add_tl_number', '$add_tl_lastDate', '$add_b_name_b_branch', '$add_b_account', '$add_exist_bus_name1', '$add_exist_bus_name2', '$add_exist_start1', '$add_exist_start2', '$add_exist_van_puller', '$add_exist_ice_van', '$add_exist_gd_size', '$add_rel_gge', '$add_area_dem', '$add_point_name', '$add_k_market', '$add_ice_outlets', '$add_exist_avg_m_size', '$add_ig_cont', '$add_po_cont', '$add_lo_cont', '$add_ka_cont', '$add_bl_cont', '$add_kw_cont', '$add_others_cont', '$add_ig_comp', '$add_po_comp', '$add_lo_comp', '$add_ka_comp', '$add_bl_comp', '$add_kw_comp', '$add_others_comp', '$add_m1_sales', '$add_m2_sales', '$add_m3_sales', '$add_m4_sales', '$add_m5_sales', '$add_m6_sales', '$add_m7_sales', '$add_m1_inj', '$add_m2_inj', '$add_m3_inj', '$add_m4_inj', '$add_m5_inj', '$add_m6_inj', '$add_m7_inj', '$add_total_inv', '$add_num_SDF', '$add_val_SDF', '$add_num_vans', '$add_val_vans', '$add_init_lifting', '$add_gd_adv', '$add_m_credit', '$add_run_capital', '$add_transac_type', '$add_rsm_recom', '$add_gm_recom', '$add_ref', '$add_rsm_list', '$add_asm_list', '$add_fpr_list', '$add_routes', '$add_appr_start_date', '$add_appr_close_date')";

			// prepare the query
			$stmt = $con->prepare($sql);
			// execute the query
			$result = $stmt->execute();
			
			// check result
			if($result == true){
				echo 'true';
				// echo $stmt->rowCount() . " records Added successfully";
			}
		}

		// edit operation
		elseif($oper == 'edit'){

			// get edit id 
			$edit_id = $_POST['edit_id'];

			$edit_code =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_code']);
			$edit_start_date = preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_start_date']);
			$edit_name =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_name']);
			$edit_address =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_address']);
			$edit_o_name = preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_o_name']);
			$edit_o_address = preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_o_address']);
            $edit_o_mobile = preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_o_mobile']);
			$edit_cp_mobile = preg_replace('/[^A-Za-z0-9. -,]/', '',$_POST['edit_cp_mobile']);
			$edit_territory_list= preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_territory_list']);
			$edit_distri_type= preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_distri_type']);
			$edit_o_pre_address = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_o_pre_address']);
			$edit_o_nid = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_o_nid']);
			$edit_tl_number = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_tl_number']);
			$edit_tl_lastDate = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_tl_lastDate']);
			$edit_b_name_b_branch = preg_replace('/[^A-Za-z0-9. -,]/', '', $_POST['edit_b_name_b_branch']);
			$edit_b_account = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_b_account']);

			$edit_exist_bus_name1 = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_exist_bus_name1']);
			$edit_exist_bus_name2 = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_exist_bus_name2']);
			$edit_exist_start1 = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_exist_start1']);
			$edit_exist_start2 = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_exist_start2']);
			$edit_exist_van_puller = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_exist_van_puller']);
			$edit_exist_ice_van = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_exist_ice_van']);
			$edit_exist_gd_size = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_exist_gd_size']);
			
			$edit_rel_gge = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_rel_gge']);
			$edit_k_market = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_k_market']);
			$edit_ice_outlets = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_ice_outlets']);
			$edit_exist_avg_m_size = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_exist_avg_m_size']);
		
			$edit_ig_cont = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_ig_cont']);
			$edit_po_cont = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_po_cont']);
			$edit_lo_cont = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_lo_cont']);
			$edit_ka_cont = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_ka_cont']);
			$edit_bl_cont = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_bl_cont']);
			$edit_kw_cont = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_kw_cont']);
			$edit_others_cont = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_others_cont']);

			$edit_ig_comp = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_ig_comp']);
			$edit_po_comp = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_po_comp']);
			$edit_lo_comp = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_lo_comp']);
			$edit_ka_comp = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_ka_comp']);
			$edit_bl_comp = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_bl_comp']);
			$edit_kw_comp = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_kw_comp']);
			$edit_others_comp = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_others_comp']);
			
			// --- for loop for calculating current month and the next six months --- //
			for($i=0; $i<=6; $i++) {
				$next_six_months[] =date("M/y", strtotime( date( 'Y-m-01' )." +$i months"));
			}
			// --- for loop ends --- //

			// --- making sales and months comma seperated  START--- //
			if($_POST['edit_m1_sales'] != null || $_POST['edit_m2_sales'] != null || $_POST['edit_m3_sales'] != null || $_POST['edit_m4_sales'] != null || $_POST['edit_m5_sales'] != null || $_POST['edit_m6_sales'] != null || $_POST['edit_m7_sales'] != null){

				$m1_sales = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_m1_sales']);
				$edit_m1_sales = $m1_sales ."," . $next_six_months[0];

				$m2_sales = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_m2_sales']);
				$edit_m2_sales = $m2_sales ."," . $next_six_months[1];

				$m3_sales = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_m3_sales']);
				$edit_m3_sales = $m3_sales ."," . $next_six_months[2];

				$m4_sales = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_m4_sales']);
				$edit_m4_sales = $m4_sales ."," . $next_six_months[3];

				$m5_sales = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_m5_sales']);
				$edit_m5_sales = $m5_sales ."," . $next_six_months[4];

				$m6_sales = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_m6_sales']);
				$edit_m6_sales = $m6_sales ."," . $next_six_months[5];

				$m7_sales = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_m7_sales']);
				$edit_m7_sales = $m7_sales ."," . $next_six_months[6];

			} else{
				// $m1_sales = explode (",", $_POST["edit_m1_sales"]);
				$edit_m1_sales = $m1_sales[0];

				// $m2_sales = explode (",", $row["m2_sales"]);
				$edit_m2_sales = $m2_sales[0];
				
				// $m3_sales = explode (",", $row["m3_sales"]);
				$edit_m3_sales = $m3_sales[0];
				
				// $m4_sales = explode (",", $row["m4_sales"]);
				$edit_m4_sales = $m4_sales[0];

				// $m5_sales = explode (",", $row["m5_sales"]);
				$edit_m5_sales = $m5_sales[0];

				// $m6_sales = explode (",", $row["m6_sales"]);
				$edit_m6_sales = $m6_sales[0];

				// $m7_sales = explode (",", $row["m7_sales"]);
				$edit_m7_sales = $m7_sales[0];

			}
			// --- making sales and months comma seperated END--- //
			
			// --- making inj and months comma seperated  START --- //
			if($_POST['edit_m1_inj'] != null || $_POST['edit_m2_inj'] != null || $_POST['edit_m3_inj'] != null || $_POST['edit_m4_inj'] != null || $_POST['edit_m5_inj'] != null || $_POST['edit_m6_inj'] != null || $_POST['edit_m7_inj'] != null){

				$m1_inj = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_m1_inj']);
				$edit_m1_inj = $m1_inj ."," . $next_six_months[0];

				$m2_inj = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_m2_inj']);
				$edit_m2_inj = $m2_inj ."," . $next_six_months[1];

				$m3_inj = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_m3_inj']);
				$edit_m3_inj = $m3_inj ."," . $next_six_months[2];

				$m4_inj = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_m4_inj']);
				$edit_m4_inj = $m4_inj ."," . $next_six_months[3];

				$m5_inj = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_m5_inj']);
				$edit_m5_inj = $m5_inj ."," . $next_six_months[4];

				$m6_inj = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_m6_inj']);
				$edit_m6_inj = $m6_inj ."," . $next_six_months[5];

				$m7_inj = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_m7_inj']);
				$edit_m7_inj = $m7_inj ."," . $next_six_months[6];

			} else{
				// $m1_inj = explode (",", $row["m1_inj"]);
				$edit_m1_inj = $m1_inj[0];

				// $m2_inj = explode (",", $row["m2_inj"]);
				$edit_m2_inj = $m2_inj[0];
				
				// $m3_inj = explode (",", $row["m3_inj"]);
				$edit_m3_inj = $m3_inj[0];
				
				// $m4_inj = explode (",", $row["m4_inj"]);
				$edit_m4_inj = $m4_inj[0];

				// $m5_inj = explode (",", $row["m5_inj"]);
				$edit_m5_inj = $m5_inj[0];

				// $m6_inj = explode (",", $row["m6_inj"]);
				$edit_m6_inj = $m6_inj[0];

				// $m7_inj = explode (",", $row["m7_inj"]);
				$edit_m7_inj = $m7_inj[0];

			}
			// --- making inj and months comma seperated END--- //

			$edit_total_inv = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_total_inv']);
			$edit_num_SDF = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_num_SDF']);
			$edit_val_SDF = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_val_SDF']);
			$edit_num_vans = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_num_vans']);
			$edit_val_vans = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_val_vans']);
			$edit_init_lifting = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_init_lifting']);
			$edit_gd_adv = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_gd_adv']);
			$edit_m_credit = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_m_credit']);
			$edit_run_capital = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_run_capital']);
			$edit_transac_type = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_transac_type']);
			$edit_rsm_recom = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_rsm_recom']);
			$edit_gm_recom = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_gm_recom']);

			$edit_appr_start_date = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_appr_start_date']);
			$edit_appr_close_date = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_appr_close_date']);

			$area_arr = implode(', ',$_POST['edit_area_dem']);
			$edit_area_dem = preg_replace('/[^A-Za-z0-9. -,]/', '', $area_arr);

			$route_arr = implode(', ',$_POST['edit_routes']);
			$edit_routes = preg_replace('/[^A-Za-z0-9. -,]/', '', $route_arr);

			$edit_point_name =  preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_point_name']);
			$edit_ref = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_ref']);

			if($_POST['edit_rsm_list'] != null || $_POST['edit_asm_list'] != null || $_POST['edit_fpr_list'] != null) {
				$edit_rsm_list = preg_replace('/[^A-Za-z0-9. - ()-]/', '', $_POST['edit_rsm_list']);
				$edit_asm_list = preg_replace('/[^A-Za-z0-9. - ()-]/', '', $_POST['edit_asm_list']);
				$edit_fpr_list = preg_replace('/[^A-Za-z0-9. - ()-]/', '', $_POST['edit_fpr_list']);
			}
			else {
				$edit_rsm_list = preg_replace('/[^A-Za-z0-9. - ()-]/', '', $_POST['edit_rsm_list']);
				$edit_asm_list = preg_replace('/[^A-Za-z0-9. - ()-]/', '', $_POST['edit_asm_list']);
				$edit_fpr_list = preg_replace('/[^A-Za-z0-9. - ()-]/', '', $_POST['edit_fpr_list']);
			}	
			
			$edit_status = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_status']);
			$edit_is_approve = preg_replace('/[^A-Za-z0-9. -]/', '', $_POST['edit_is_approve']);


			// ---------image starts-----------//

			//all 4 images together
			if( ($_FILES['edit_o_image']['name']) != null && ($_FILES['edit_agree_image']['name']) != null && ($_FILES['edit_approval_image']['name']) != null && ($_FILES['edit_tl_image']['name']) != null) {
				$errors = array();

				$array1 = explode('.', $_FILES['edit_o_image']['name']);
				$extension1 = end($array1);
				$edit_o_image = uniqid(rand()).'.'.$extension1;
				$file_ext_1 = pathinfo($edit_o_image, PATHINFO_EXTENSION);
				$location1 = '../assets/uploads/distributors/distributor_image/'.$edit_o_image;

				$array2 = explode('.', $_FILES['edit_agree_image']['name']);
				$extension2 = end($array2);
				$edit_agree_image = uniqid(rand()).'.'.$extension2;
				$file_ext_2 = pathinfo($edit_agree_image, PATHINFO_EXTENSION);
				$location2 = '../assets/uploads/distributors/agreement_image/'.$edit_agree_image;

				$array3 = explode('.', $_FILES['edit_approval_image']['name']);
				$extension3 = end($array3);
				$edit_approval_image = uniqid(rand()).'.'.$extension3;
				$file_ext_3 = pathinfo($edit_approval_image, PATHINFO_EXTENSION);
				$location3 = '../assets/uploads/distributors/approval_image/'.$edit_approval_image;

				$array4 = explode('.', $_FILES['edit_tl_image']['name']);
				$extension4 = end($array4);
				$edit_tl_image = uniqid(rand()).'.'.$extension4;
				$file_ext_4 = pathinfo($edit_tl_image, PATHINFO_EXTENSION);
				$location4 = '../assets/uploads/distributors/trade_license_image/'.$edit_tl_image;

				// add image1,  add image2, add image3
				if( isset($_FILES['edit_o_image']) && isset($_FILES['edit_agree_image']) && isset($_FILES['edit_approval_image']) && isset($_FILES['edit_tl_image']) ) {
					$maxsize = 512000;
					$allowed_image_extension = array("png", "jpg", "jpeg");

					// Validate image file size
					if( (($_FILES["edit_o_image"]["size"] > $maxsize) || ($_FILES["edit_agree_image"]["size"] > $maxsize) || ($_FILES['edit_approval_image']['size'] > $maxsize) || ($_FILES['edit_tl_image']['size'] > $maxsize)) || (($_FILES["edit_o_image"]["size"] == 0) || ($_FILES["edit_agree_image"]["size"] == 0) || ($_FILES["edit_approval_image"]["size"] == 0) || ($_FILES["edit_tl_image"]["size"] == 0)) ) {
						$errors[] = 'File too large. File size must be less than 500 KB.';
					}

					// Validate file input to check if is with valid extension
					if( (!in_array($file_ext_1, $allowed_image_extension)) && (!empty($file_ext_1)) || 
					(!in_array($file_ext_2, $allowed_image_extension)) && (!empty($file_ext_2)) || 
					(!in_array($file_ext_3, $allowed_image_extension)) && (!empty($file_ext_3)) ||
					(!in_array($file_ext_4, $allowed_image_extension)) && (!empty($file_ext_4)) ) {
						$errors[] = 'Invalid file type. Only JPEG, JPG and PNG types are accepted.';
					}
				}

				if(count($errors) === 0) {
					//image upload
					if ( ( $_FILES['edit_o_image']['name']) && ($_FILES['edit_agree_image']['name']) && ($_FILES['edit_approval_image']['name']) && ($_FILES['edit_tl_image']['name']) ) {
						
						$query = "SELECT o_image, agree_image, approval_image FROM distributors WHERE id = ".$edit_id;
						$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
						// execute the query
						$result  = $stmt->execute();

						while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
						{
							$o_image = $row['o_image'];
							unlink('../assets/uploads/distributors/distributor_image/'.$o_image);
							
							$agree_image = $row['agree_image'];
							unlink('../assets/uploads/distributors/agreement_image/'.$agree_image);
							
							$approval_image = $row['approval_image'];
							unlink('../assets/uploads/distributors/approval_image/'.$approval_image);
							
						}
						move_uploaded_file($_FILES['edit_o_image']['tmp_name'], $location1);
						move_uploaded_file($_FILES['edit_agree_image']['tmp_name'], $location2);
						move_uploaded_file($_FILES['edit_approval_image']['tmp_name'], $location3);

						move_uploaded_file($_FILES['edit_tl_image']['tmp_name'], $location4);
					}
				} else {
					foreach($errors as $error) {
						echo json_encode($error);
					}
					die(); //Ensure no more processing is done
				}

				$query = " UPDATE `distri_trade_license` SET `tl_image`='$edit_tl_image' WHERE `distributors` = '$edit_id' ";
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();

				$query = "UPDATE `distributors` SET 
				`o_image`='$edit_o_image', `agree_image`='$edit_agree_image', `approval_image`='$edit_approval_image' WHERE `id` = '$edit_id' ";
				// echo $query;
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();
			}

			// ================================xxxx====================================

			// o_image, agree_image, approval_image (these 3 combination together) [1,2,3]
			else if( ($_FILES['edit_o_image']['name'] != null) && ($_FILES['edit_agree_image']['name'] != null) && ($_FILES['edit_approval_image']['name'] != null) ){
				$errors = array();

				$array1 = explode('.', $_FILES['edit_o_image']['name']);
				$extension1 = end($array1);
				$edit_o_image = uniqid(rand()).'.'.$extension1;
				$file_ext_1 = pathinfo($edit_o_image, PATHINFO_EXTENSION);
				$location1 = '../assets/uploads/distributors/distributor_image/'.$edit_o_image;

				$array2 = explode('.', $_FILES['edit_agree_image']['name']);
				$extension2 = end($array2);
				$edit_agree_image = uniqid(rand()).'.'.$extension2;
				$file_ext_2 = pathinfo($edit_agree_image, PATHINFO_EXTENSION);
				$location2 = '../assets/uploads/distributors/agreement_image/'.$edit_agree_image;

				$array3 = explode('.', $_FILES['edit_approval_image']['name']);
				$extension3 = end($array3);
				$edit_approval_image = uniqid(rand()).'.'.$extension3;
				$file_ext_3 = pathinfo($edit_approval_image, PATHINFO_EXTENSION);
				$location3 = '../assets/uploads/distributors/approval_image/'.$edit_approval_image;

				// add image1,  add image2, add image3
				if( isset($_FILES['edit_o_image']) && isset($_FILES['edit_agree_image']) && isset($_FILES['edit_approval_image']) ) {
					$maxsize = 512000;
					$allowed_image_extension = array("png", "jpg", "jpeg");

					// Validate image file size
					if( (($_FILES["edit_o_image"]["size"] > $maxsize) || ($_FILES["edit_agree_image"]["size"] > $maxsize) || ($_FILES['edit_approval_image']['size'] > $maxsize)) || (($_FILES["edit_o_image"]["size"] == 0) || ($_FILES["edit_agree_image"]["size"] == 0) || ($_FILES["edit_approval_image"]["size"] == 0)) ) {
						$errors[] = 'File too large. File size must be less than 500 KB.';
					}

					// Validate file input to check if is with valid extension
					if( (!in_array($file_ext_1, $allowed_image_extension)) && (!empty($file_ext_1)) || 
					(!in_array($file_ext_2, $allowed_image_extension)) && (!empty($file_ext_2)) || 
					(!in_array($file_ext_3, $allowed_image_extension)) && (!empty($file_ext_3)) ) {
						$errors[] = 'Invalid file type. Only JPEG, JPG and PNG types are accepted.';
					}
				}

				if(count($errors) === 0) {
					//image upload
					if ( ( $_FILES['edit_o_image']['name']) && ($_FILES['edit_agree_image']['name']) && ($_FILES['edit_approval_image']['name']) ) {
						
						$query = "SELECT o_image, agree_image, approval_image FROM distributors WHERE id = ".$edit_id;
						$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
						// execute the query
						$result  = $stmt->execute();

						while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
						{
							$o_image = $row['o_image'];
							unlink('../assets/uploads/distributors/distributor_image/'.$o_image);
							
							$agree_image = $row['agree_image'];
							unlink('../assets/uploads/distributors/agreement_image/'.$agree_image);
							
							$approval_image = $row['approval_image'];
							unlink('../assets/uploads/distributors/approval_image/'.$approval_image);
							
						}
						move_uploaded_file($_FILES['edit_o_image']['tmp_name'], $location1);
						move_uploaded_file($_FILES['edit_agree_image']['tmp_name'], $location2);
						move_uploaded_file($_FILES['edit_approval_image']['tmp_name'], $location3);
					}
				} else {
					foreach($errors as $error) {
						echo json_encode($error);
					}
					die(); //Ensure no more processing is done
				}

				$query = "UPDATE `distributors` SET 
				`o_image`='$edit_o_image', `agree_image`='$edit_agree_image', `approval_image`='$edit_approval_image' WHERE `id` = '$edit_id' ";
				// echo $query;
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();
			}

			// o_image, approval_image, tl_image (these 3 combination together) [1,3,4]
			else if( ($_FILES['edit_o_image']['name'] != null) && ($_FILES['edit_approval_image']['name'] != null) && ($_FILES['edit_tl_image']['name'] != null) ){
				$errors = array();

				$array1 = explode('.', $_FILES['edit_o_image']['name']);
				$extension1 = end($array1);
				$edit_o_image = uniqid(rand()).'.'.$extension1;
				$file_ext_1 = pathinfo($edit_o_image, PATHINFO_EXTENSION);
				$location1 = '../assets/uploads/distributors/distributor_image/'.$edit_o_image;

				$array3 = explode('.', $_FILES['edit_approval_image']['name']);
				$extension3 = end($array3);
				$edit_approval_image = uniqid(rand()).'.'.$extension3;
				$file_ext_3 = pathinfo($edit_approval_image, PATHINFO_EXTENSION);
				$location3 = '../assets/uploads/distributors/approval_image/'.$edit_approval_image;

				$array4 = explode('.', $_FILES['edit_tl_image']['name']);
				$extension4 = end($array4);
				$edit_tl_image = uniqid(rand()).'.'.$extension4;
				$file_ext_4 = pathinfo($edit_tl_image, PATHINFO_EXTENSION);
				$location4 = '../assets/uploads/distributors/trade_license_image/'.$edit_tl_image;

				// add image1,  add image3, add image4
				if( isset($_FILES['edit_o_image']) && isset($_FILES['edit_approval_image']) && isset($_FILES['edit_tl_image']) ) {
					$maxsize = 512000;
					$allowed_image_extension = array("png", "jpg", "jpeg");

					// Validate image file size
					if( (($_FILES["edit_o_image"]["size"] > $maxsize) || ($_FILES["edit_approval_image"]["size"] > $maxsize) || ($_FILES['edit_tl_image']['size'] > $maxsize)) || (($_FILES["edit_o_image"]["size"] == 0) || ($_FILES["edit_approval_image"]["size"] == 0) || ($_FILES["edit_tl_image"]["size"] == 0)) ) {
						$errors[] = 'File too large. File size must be less than 500 KB.';
					}

					// Validate file input to check if is with valid extension
					if( (!in_array($file_ext_1, $allowed_image_extension)) && (!empty($file_ext_1)) || 
					(!in_array($file_ext_3, $allowed_image_extension)) && (!empty($file_ext_3)) || 
					(!in_array($file_ext_4, $allowed_image_extension)) && (!empty($file_ext_4)) ) {
						$errors[] = 'Invalid file type. Only JPEG, JPG and PNG types are accepted.';
					}
				}

				if(count($errors) === 0) {
					//image upload
					if ( ( $_FILES['edit_o_image']['name']) && ($_FILES['edit_approval_image']['name']) && ($_FILES['edit_tl_image']['name']) ) {
						
						$query = "SELECT o_image, approval_image FROM distributors WHERE id = ".$edit_id;
						$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
						// execute the query
						$result  = $stmt->execute();

						while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
						{
							$o_image = $row['o_image'];
							unlink('../assets/uploads/distributors/distributor_image/'.$o_image);
							
							$approval_image = $row['approval_image'];
							unlink('../assets/uploads/distributors/approval_image/'.$approval_image);
						}
						move_uploaded_file($_FILES['edit_o_image']['tmp_name'], $location1);
						move_uploaded_file($_FILES['edit_approval_image']['tmp_name'], $location3);

						move_uploaded_file($_FILES['edit_tl_image']['tmp_name'], $location4);
					}
				} else {
					foreach($errors as $error) {
						echo json_encode($error);
					}
					die(); //Ensure no more processing is done
				}

				$query = " UPDATE `distri_trade_license` SET `tl_image`='$edit_tl_image' WHERE `distributors` = '$edit_id' ";
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();

				$query = "UPDATE `distributors` SET 
				`o_image`='$edit_o_image', `approval_image`='$edit_approval_image' WHERE `id` = '$edit_id' ";
				// echo $query;
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();
			}

			// o_image, agree_image, tl_image (these 3 combination together) [1,2,4]
			else if( ($_FILES['edit_o_image']['name'] != null) && ($_FILES['edit_agree_image']['name'] != null) && ($_FILES['edit_tl_image']['name'] != null) ){
				$errors = array();

				$array1 = explode('.', $_FILES['edit_o_image']['name']);
				$extension1 = end($array1);
				$edit_o_image = uniqid(rand()).'.'.$extension1;
				$file_ext_1 = pathinfo($edit_o_image, PATHINFO_EXTENSION);
				$location1 = '../assets/uploads/distributors/distributor_image/'.$edit_o_image;

				$array2 = explode('.', $_FILES['edit_agree_image']['name']);
				$extension2 = end($array2);
				$edit_agree_image = uniqid(rand()).'.'.$extension2;
				$file_ext_2 = pathinfo($edit_agree_image, PATHINFO_EXTENSION);
				$location2 = '../assets/uploads/distributors/agreement_image/'.$edit_agree_image;

				$array4 = explode('.', $_FILES['edit_tl_image']['name']);
				$extension4 = end($array4);
				$edit_tl_image = uniqid(rand()).'.'.$extension4;
				$file_ext_4 = pathinfo($edit_tl_image, PATHINFO_EXTENSION);
				$location4 = '../assets/uploads/distributors/trade_license_image/'.$edit_tl_image;

				// add image1,  add image2, add image4
				if( isset($_FILES['edit_o_image']) && isset($_FILES['edit_agree_image']) && isset($_FILES['edit_tl_image']) ) {
					$maxsize = 512000;
					$allowed_image_extension = array("png", "jpg", "jpeg");

					// Validate image file size
					if( (($_FILES["edit_o_image"]["size"] > $maxsize) || ($_FILES["edit_agree_image"]["size"] > $maxsize) || ($_FILES['edit_tl_image']['size'] > $maxsize)) || (($_FILES["edit_o_image"]["size"] == 0) || ($_FILES["edit_agree_image"]["size"] == 0) || ($_FILES["edit_tl_image"]["size"] == 0)) ) {
						$errors[] = 'File too large. File size must be less than 500 KB.';
					}

					// Validate file input to check if is with valid extension
					if( (!in_array($file_ext_1, $allowed_image_extension)) && (!empty($file_ext_1)) || 
					(!in_array($file_ext_2, $allowed_image_extension)) && (!empty($file_ext_2)) || 
					(!in_array($file_ext_4, $allowed_image_extension)) && (!empty($file_ext_4)) ) {
						$errors[] = 'Invalid file type. Only JPEG, JPG and PNG types are accepted.';
					}
				}

				if(count($errors) === 0) {
					//image upload
					if ( ( $_FILES['edit_o_image']['name']) && ($_FILES['edit_agree_image']['name']) && ($_FILES['edit_tl_image']['name']) ) {
						
						$query = "SELECT o_image, agree_image FROM distributors WHERE id = ".$edit_id;
						$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
						// execute the query
						$result  = $stmt->execute();

						while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
						{
							$o_image = $row['o_image'];
							unlink('../assets/uploads/distributors/distributor_image/'.$o_image);
							
							$agree_image = $row['agree_image'];
							unlink('../assets/uploads/distributors/agreement_image/'.$agree_image);		
						}
						move_uploaded_file($_FILES['edit_o_image']['tmp_name'], $location1);
						move_uploaded_file($_FILES['edit_agree_image']['tmp_name'], $location2);

						move_uploaded_file($_FILES['edit_tl_image']['tmp_name'], $location4);
					}
				} else {
					foreach($errors as $error) {
						echo json_encode($error);
					}
					die(); //Ensure no more processing is done
				}

				$query = " UPDATE `distri_trade_license` SET `tl_image`='$edit_tl_image' WHERE `distributors` = '$edit_id' ";
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();

				$query = "UPDATE `distributors` SET 
				`o_image`='$edit_o_image', `agree_image`='$edit_agree_image' WHERE `id` = '$edit_id' ";
				// echo $query;
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();
			}

			// agree_image, approval_image, tl_image (these 3 combination together) [2,3,4]
			else if( ($_FILES['edit_agree_image']['name'] != null) && ($_FILES['edit_approval_image']['name'] != null) && ($_FILES['edit_tl_image']['name'] != null) ){
				$errors = array();

				$array2 = explode('.', $_FILES['edit_agree_image']['name']);
				$extension2 = end($array2);
				$edit_agree_image = uniqid(rand()).'.'.$extension2;
				$file_ext_2 = pathinfo($edit_agree_image, PATHINFO_EXTENSION);
				$location2 = '../assets/uploads/distributors/agreement_image/'.$edit_agree_image;

				$array3 = explode('.', $_FILES['edit_approval_image']['name']);
				$extension3 = end($array3);
				$edit_approval_image = uniqid(rand()).'.'.$extension3;
				$file_ext_3 = pathinfo($edit_approval_image, PATHINFO_EXTENSION);
				$location3 = '../assets/uploads/distributors/approval_image/'.$edit_approval_image;

				$array4 = explode('.', $_FILES['edit_tl_image']['name']);
				$extension4 = end($array4);
				$edit_tl_image = uniqid(rand()).'.'.$extension4;
				$file_ext_4 = pathinfo($edit_tl_image, PATHINFO_EXTENSION);
				$location4 = '../assets/uploads/distributors/trade_license_image/'.$edit_tl_image;

				// add image1,  add image3, add image4
				if( isset($_FILES['edit_agree_image']) && isset($_FILES['edit_approval_image']) && isset($_FILES['edit_tl_image']) ) {
					$maxsize = 512000;
					$allowed_image_extension = array("png", "jpg", "jpeg");

					// Validate image file size
					if( (($_FILES["edit_agree_image"]["size"] > $maxsize) || ($_FILES["edit_approval_image"]["size"] > $maxsize) || ($_FILES['edit_tl_image']['size'] > $maxsize)) || (($_FILES["edit_agree_image"]["size"] == 0) || ($_FILES["edit_approval_image"]["size"] == 0) || ($_FILES["edit_tl_image"]["size"] == 0)) ) {
						$errors[] = 'File too large. File size must be less than 500 KB.';
					}

					// Validate file input to check if is with valid extension
					if( (!in_array($file_ext_2, $allowed_image_extension)) && (!empty($file_ext_2)) || 
					(!in_array($file_ext_3, $allowed_image_extension)) && (!empty($file_ext_3)) || 
					(!in_array($file_ext_4, $allowed_image_extension)) && (!empty($file_ext_4)) ) {
						$errors[] = 'Invalid file type. Only JPEG, JPG and PNG types are accepted.';
					}
				}

				if(count($errors) === 0) {
					//image upload
					if ( ( $_FILES['edit_agree_image']['name']) && ($_FILES['edit_approval_image']['name']) && ($_FILES['edit_tl_image']['name']) ) {
						
						$query = "SELECT agree_image, approval_image FROM distributors WHERE id = ".$edit_id;
						$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
						// execute the query
						$result  = $stmt->execute();

						while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
						{
							$agree_image = $row['agree_image'];
							unlink('../assets/uploads/distributors/agreement_image/'.$agree_image);
							
							$approval_image = $row['approval_image'];
							unlink('../assets/uploads/distributors/approval_image/'.$approval_image);
						}
						move_uploaded_file($_FILES['edit_agree_image']['tmp_name'], $location2);
						move_uploaded_file($_FILES['edit_approval_image']['tmp_name'], $location3);

						move_uploaded_file($_FILES['edit_tl_image']['tmp_name'], $location4);
					}
				} else {
					foreach($errors as $error) {
						echo json_encode($error);
					}
					die(); //Ensure no more processing is done
				}

				$query = " UPDATE `distri_trade_license` SET `tl_image`='$edit_tl_image' WHERE `distributors` = '$edit_id' ";
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();

				$query = "UPDATE `distributors` SET 
				`agree_image`='$edit_agree_image', `approval_image`='$edit_approval_image' WHERE `id` = '$edit_id' ";
				// echo $query;
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();
			}

			// =================================xxxx===================================

			// only o_image and agree_image edit [1,2]
			else if( ($_FILES['edit_o_image']['name']) != null && ($_FILES['edit_agree_image']['name']) != null) {
				$errors = array();

				$array1 = explode('.', $_FILES['edit_o_image']['name']);
				$extension1 = end($array1);
				$edit_o_image = uniqid(rand()).'.'.$extension1;
				$file_ext_1 = pathinfo($edit_o_image, PATHINFO_EXTENSION);
				$location1 = '../assets/uploads/distributors/distributor_image/'.$edit_o_image;

				$array2 = explode('.', $_FILES['edit_agree_image']['name']);
				$extension2 = end($array2);
				$edit_agree_image = uniqid(rand()).'.'.$extension2;
				$file_ext_2 = pathinfo($edit_agree_image, PATHINFO_EXTENSION);
				$location2 = '../assets/uploads/distributors/agreement_image/'.$edit_agree_image;

				// add image1,  add image2
				if(isset($_FILES['edit_o_image']) && isset($_FILES['edit_agree_image'])) {
					$maxsize = 512000;
					$allowed_image_extension = array("png", "jpg", "jpeg");

					// Validate image file size
					if((($_FILES["edit_o_image"]["size"] > $maxsize) || ($_FILES['edit_agree_image']['size'] > $maxsize)) || (($_FILES["edit_o_image"]["size"] == 0) || ($_FILES["edit_agree_image"]["size"] == 0))) {
						$errors[] = 'File too large. File size must be less than 500 KB.';
					}

					// Validate file input to check if is with valid extension
					if((!in_array($file_ext_1, $allowed_image_extension)) && (!empty($file_ext_1)) 
					|| (!in_array($file_ext_2, $allowed_image_extension)) && (!empty($file_ext_2))) {
						$errors[] = 'Invalid file type. Only JPEG, JPG and PNG types are accepted.';
					}
				}

				if(count($errors) === 0) {
					//image upload
					if ( ( $_FILES['edit_o_image']['name']) && ($_FILES['edit_agree_image']['name']) ) {
						
						$query = "SELECT o_image, agree_image FROM distributors WHERE id = ".$edit_id;
						$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
						// execute the query
						$result  = $stmt->execute();

						while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
						{
							$o_image = $row['o_image'];
							unlink('../assets/uploads/distributors/distributor_image/'.$o_image);
							
							$agree_image = $row['agree_image'];
							unlink('../assets/uploads/distributors/agreement_image/'.$agree_image);	
						}
						move_uploaded_file($_FILES['edit_o_image']['tmp_name'], $location1);
						move_uploaded_file($_FILES['edit_agree_image']['tmp_name'], $location2);
					}
				} else {
					foreach($errors as $error) {
						echo json_encode($error);
					}
					die(); //Ensure no more processing is done
				}

				$query = "UPDATE `distributors` SET 
				`o_image`='$edit_o_image', `agree_image`='$edit_agree_image' WHERE `id` = '$edit_id' ";
				// echo $query;
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();
			}

			// only o_image and approval_image edit [1,3]
			else if( ($_FILES['edit_o_image']['name']) != null && ($_FILES['edit_approval_image']['name']) != null) {
				$errors = array();

				$array1 = explode('.', $_FILES['edit_o_image']['name']);
				$extension1 = end($array1);
				$edit_o_image = uniqid(rand()).'.'.$extension1;
				$file_ext_1 = pathinfo($edit_o_image, PATHINFO_EXTENSION);
				$location1 = '../assets/uploads/distributors/distributor_image/'.$edit_o_image;

				$array3 = explode('.', $_FILES['edit_approval_image']['name']);
				$extension3 = end($array3);
				$edit_approval_image = uniqid(rand()).'.'.$extension3;
				$file_ext_3 = pathinfo($edit_approval_image, PATHINFO_EXTENSION);
				$location3 = '../assets/uploads/distributors/approval_image/'.$edit_approval_image;

				// add image1,  add image2
				if(isset($_FILES['edit_o_image']) && isset($_FILES['edit_approval_image'])) {
					$maxsize = 512000;
					$allowed_image_extension = array("png", "jpg", "jpeg");

					// Validate image file size
					if((($_FILES["edit_o_image"]["size"] > $maxsize) || ($_FILES['edit_approval_image']['size'] > $maxsize)) || (($_FILES["edit_o_image"]["size"] == 0) || ($_FILES["edit_approval_image"]["size"] == 0))) {
						$errors[] = 'File too large. File size must be less than 500 KB.';
					}

					// Validate file input to check if is with valid extension
					if((!in_array($file_ext_1, $allowed_image_extension)) && (!empty($file_ext_1)) 
					|| (!in_array($file_ext_3, $allowed_image_extension)) && (!empty($file_ext_3))) {
						$errors[] = 'Invalid file type. Only JPEG, JPG and PNG types are accepted.';
					}
				}

				if(count($errors) === 0) {
					//image upload
					if ( ( $_FILES['edit_o_image']['name']) && ($_FILES['edit_approval_image']['name']) ) {
						
						$query = "SELECT o_image, approval_image FROM distributors WHERE id = ".$edit_id;
						$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
						// execute the query
						$result  = $stmt->execute();

						while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
						{
							$o_image = $row['o_image'];
							unlink('../assets/uploads/distributors/distributor_image/'.$o_image);
							
							$approval_image = $row['approval_image'];
							unlink('../assets/uploads/distributors/approval_image/'.$approval_image);	
						}
						move_uploaded_file($_FILES['edit_o_image']['tmp_name'], $location1);
						move_uploaded_file($_FILES['edit_approval_image']['tmp_name'], $location3);
					}
				} else {
					foreach($errors as $error) {
						echo json_encode($error);
					}
					die(); //Ensure no more processing is done
				}

				$query = "UPDATE `distributors` SET 
				`o_image`='$edit_o_image', `approval_image`='$edit_approval_image' WHERE `id` = '$edit_id' ";
				// echo $query;
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();
			}

			// only o_image and tl_image edit [1,4]
			else if( ($_FILES['edit_o_image']['name'] != null) && ($_FILES['edit_tl_image']['name'] != null) ){
				$errors = array();

				$array1 = explode('.', $_FILES['edit_o_image']['name']);
				$extension1 = end($array1);
				$edit_o_image = uniqid(rand()).'.'.$extension1;
				$file_ext_1 = pathinfo($edit_o_image, PATHINFO_EXTENSION);
				$location1 = '../assets/uploads/distributors/distributor_image/'.$edit_o_image;

				$array4 = explode('.', $_FILES['edit_tl_image']['name']);
				$extension4 = end($array4);
				$edit_tl_image = uniqid(rand()).'.'.$extension4;
				$file_ext_4 = pathinfo($edit_tl_image, PATHINFO_EXTENSION);
				$location4 = '../assets/uploads/distributors/trade_license_image/'.$edit_tl_image;

				// add image1,  add image4
				if( isset($_FILES['edit_o_image']) && isset($_FILES['edit_tl_image']) ) {
					$maxsize = 512000;
					$allowed_image_extension = array("png", "jpg", "jpeg");

					// Validate image file size
					if( (($_FILES["edit_o_image"]["size"] > $maxsize) || ($_FILES['edit_tl_image']['size'] > $maxsize)) || (($_FILES["edit_o_image"]["size"] == 0) || ($_FILES["edit_tl_image"]["size"] == 0)) ) {
						$errors[] = 'File too large. File size must be less than 500 KB.';
					}

					// Validate file input to check if is with valid extension
					if( (!in_array($file_ext_1, $allowed_image_extension)) && (!empty($file_ext_1)) 
					|| (!in_array($file_ext_4, $allowed_image_extension)) && (!empty($file_ext_4)) ) {
						$errors[] = 'Invalid file type. Only JPEG, JPG and PNG types are accepted.';
					}
				}

				if(count($errors) === 0) {
					//image upload
					if ( ( $_FILES['edit_o_image']['name']) && ($_FILES['edit_tl_image']['name']) ) {
						
						$query = "SELECT o_image FROM distributors WHERE id = ".$edit_id;
						$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
						// execute the query
						$result  = $stmt->execute();

						while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
						{
							$o_image = $row['o_image'];
							unlink('../assets/uploads/distributors/distributor_image/'.$o_image);
						}
						move_uploaded_file($_FILES['edit_o_image']['tmp_name'], $location1);

						move_uploaded_file($_FILES['edit_tl_image']['tmp_name'], $location4);
					}
				} else {
					foreach($errors as $error) {
						echo json_encode($error);
					}
					die(); //Ensure no more processing is done
				}

				$query = " UPDATE `distri_trade_license` SET `tl_image`='$edit_tl_image' WHERE `distributors` = '$edit_id' ";
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();

				$query = " UPDATE `distributors` SET 
				`o_image`='$edit_o_image' WHERE `id` = '$edit_id' ";
				// echo $query;
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();
			}

			// only agree_image and approval_image edit [2,3]
			else if( ($_FILES['edit_agree_image']['name'] != null) && ($_FILES['edit_approval_image']['name'] != null) ){
				$errors = array();

				$array2 = explode('.', $_FILES['edit_agree_image']['name']);
				$extension2 = end($array2);
				$edit_agree_image = uniqid(rand()).'.'.$extension2;
				$file_ext_2 = pathinfo($edit_agree_image, PATHINFO_EXTENSION);
				$location2 = '../assets/uploads/distributors/agreement_image/'.$edit_agree_image;

				$array3 = explode('.', $_FILES['edit_approval_image']['name']);
				$extension3 = end($array3);
				$edit_approval_image = uniqid(rand()).'.'.$extension3;
				$file_ext_3 = pathinfo($edit_approval_image, PATHINFO_EXTENSION);
				$location3 = '../assets/uploads/distributors/approval_image/'.$edit_approval_image;

				// add image2,  add image3
				if( isset($_FILES['edit_agree_image']) && isset($_FILES['edit_approval_image']) ) {
					$maxsize = 512000;
					$allowed_image_extension = array("png", "jpg", "jpeg");

					// Validate image file size
					if( (($_FILES["edit_agree_image"]["size"] > $maxsize) || ($_FILES['edit_approval_image']['size'] > $maxsize)) || (($_FILES["edit_agree_image"]["size"] == 0) || ($_FILES["edit_approval_image"]["size"] == 0)) ) {
						$errors[] = 'File too large. File size must be less than 500 KB.';
					}

					// Validate file input to check if is with valid extension
					if( (!in_array($file_ext_2, $allowed_image_extension)) && (!empty($file_ext_2)) 
					|| (!in_array($file_ext_3, $allowed_image_extension)) && (!empty($file_ext_3)) ) {
						$errors[] = 'Invalid file type. Only JPEG, JPG and PNG types are accepted.';
					}
				}

				if(count($errors) === 0) {
					//image upload
					if ( ( $_FILES['edit_agree_image']['name']) && ($_FILES['edit_approval_image']['name']) ) {
						
						$query = "SELECT o_image FROM distributors WHERE id = ".$edit_id;
						$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
						// execute the query
						$result  = $stmt->execute();

						while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
						{
							$agree_image = $row['agree_image'];
							unlink('../assets/uploads/distributors/agreement_image/'.$agree_image);

							$approval_image = $row['approval_image'];
							unlink('../assets/uploads/distributors/approval_image/'.$approval_image);
						}
						move_uploaded_file($_FILES['edit_agree_image']['tmp_name'], $location2);
						move_uploaded_file($_FILES['edit_approval_image']['tmp_name'], $location3);
					}
				} else {
					foreach($errors as $error) {
						echo json_encode($error);
					}
					die(); //Ensure no more processing is done
				}

				$query = " UPDATE `distributors` SET 
				`agree_image`='$edit_agree_image', `approval_image`='$edit_approval_image' WHERE `id` = '$edit_id' ";
				// echo $query;
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();
			}

			// only agree_image and tl_image edit [2,4]
			else if( ($_FILES['edit_agree_image']['name'] != null) && ($_FILES['edit_tl_image']['name'] != null) ){
				$errors = array();

				$array2 = explode('.', $_FILES['edit_agree_image']['name']);
				$extension2 = end($array2);
				$edit_agree_image = uniqid(rand()).'.'.$extension2;
				$file_ext_2 = pathinfo($edit_agree_image, PATHINFO_EXTENSION);
				$location2 = '../assets/uploads/distributors/agreement_image/'.$edit_agree_image;

				$array4 = explode('.', $_FILES['edit_tl_image']['name']);
				$extension4 = end($array4);
				$edit_tl_image = uniqid(rand()).'.'.$extension4;
				$file_ext_4 = pathinfo($edit_tl_image, PATHINFO_EXTENSION);
				$location4 = '../assets/uploads/distributors/trade_license_image/'.$edit_tl_image;

				// add image2,  add image4
				if( isset($_FILES['edit_agree_image']) && isset($_FILES['edit_tl_image']) ) {
					$maxsize = 512000;
					$allowed_image_extension = array("png", "jpg", "jpeg");

					// Validate image file size
					if( (($_FILES["edit_agree_image"]["size"] > $maxsize) || ($_FILES['edit_tl_image']['size'] > $maxsize)) || (($_FILES["edit_agree_image"]["size"] == 0) || ($_FILES["edit_tl_image"]["size"] == 0)) ) {
						$errors[] = 'File too large. File size must be less than 500 KB.';
					}

					// Validate file input to check if is with valid extension
					if( (!in_array($file_ext_2, $allowed_image_extension)) && (!empty($file_ext_2)) 
					|| (!in_array($file_ext_4, $allowed_image_extension)) && (!empty($file_ext_4)) ) {
						$errors[] = 'Invalid file type. Only JPEG, JPG and PNG types are accepted.';
					}
				}

				if(count($errors) === 0) {
					//image upload
					if ( ( $_FILES['edit_agree_image']['name']) && ($_FILES['edit_tl_image']['name']) ) {
						
						$query = "SELECT agree_image FROM distributors WHERE id = ".$edit_id;
						$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
						// execute the query
						$result  = $stmt->execute();

						while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
						{
							$agree_image = $row['agree_image'];
							unlink('../assets/uploads/distributors/agreement_image/'.$agree_image);
						}
						move_uploaded_file($_FILES['edit_agree_image']['tmp_name'], $location2);

						move_uploaded_file($_FILES['edit_tl_image']['tmp_name'], $location4);
					}
				} else {
					foreach($errors as $error) {
						echo json_encode($error);
					}
					die(); //Ensure no more processing is done
				}

				$query = " UPDATE `distri_trade_license` SET `tl_image`='$edit_tl_image' WHERE `distributors` = '$edit_id' ";
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();

				$query = " UPDATE `distributors` SET 
				`agree_image`='$edit_agree_image' WHERE `id` = '$edit_id' ";
				// echo $query;
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();
			}

			// only agree_image and tl_image edit [3,4]
			else if( ($_FILES['edit_approval_image']['name'] != null) && ($_FILES['edit_tl_image']['name'] != null) ){
				$errors = array();

				$array3 = explode('.', $_FILES['edit_approval_image']['name']);
				$extension3 = end($array3);
				$edit_approval_image = uniqid(rand()).'.'.$extension3;
				$file_ext_3 = pathinfo($edit_approval_image, PATHINFO_EXTENSION);
				$location3 = '../assets/uploads/distributors/approval_image/'.$edit_approval_image;

				$array4 = explode('.', $_FILES['edit_tl_image']['name']);
				$extension4 = end($array4);
				$edit_tl_image = uniqid(rand()).'.'.$extension4;
				$file_ext_4 = pathinfo($edit_tl_image, PATHINFO_EXTENSION);
				$location4 = '../assets/uploads/distributors/trade_license_image/'.$edit_tl_image;

				// add image3,  add image4
				if( isset($_FILES['edit_approval_image']) && isset($_FILES['edit_tl_image']) ) {
					$maxsize = 512000;
					$allowed_image_extension = array("png", "jpg", "jpeg");

					// Validate image file size
					if( (($_FILES["edit_approval_image"]["size"] > $maxsize) || ($_FILES['edit_tl_image']['size'] > $maxsize)) || (($_FILES["edit_approval_image"]["size"] == 0) || ($_FILES["edit_tl_image"]["size"] == 0)) ) {
						$errors[] = 'File too large. File size must be less than 500 KB.';
					}

					// Validate file input to check if is with valid extension
					if( (!in_array($file_ext_3, $allowed_image_extension)) && (!empty($file_ext_3)) 
					|| (!in_array($file_ext_4, $allowed_image_extension)) && (!empty($file_ext_4)) ) {
						$errors[] = 'Invalid file type. Only JPEG, JPG and PNG types are accepted.';
					}
				}

				if(count($errors) === 0) {
					//image upload
					if ( ( $_FILES['edit_approval_image']['name']) && ($_FILES['edit_tl_image']['name']) ) {
						
						$query = "SELECT approval_image FROM distributors WHERE id = ".$edit_id;
						$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
						// execute the query
						$result  = $stmt->execute();

						while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
						{
							$approval_image = $row['approval_image'];
							unlink('../assets/uploads/distributors/approval_image/'.$approval_image);
						}
						move_uploaded_file($_FILES['edit_approval_image']['tmp_name'], $location3);

						move_uploaded_file($_FILES['edit_tl_image']['tmp_name'], $location4);
					}
				} else {
					foreach($errors as $error) {
						echo json_encode($error);
					}
					die(); //Ensure no more processing is done
				}

				$query = " UPDATE `distri_trade_license` SET `tl_image`='$edit_tl_image' WHERE `distributors` = '$edit_id' ";
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();

				$query = " UPDATE `distributors` SET 
				`approval_image`='$edit_approval_image' WHERE `id` = '$edit_id' ";
				// echo $query;
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();
			}

			// ===============================xxxx==================================

			// o_image image EDIT
			else if(($_FILES['edit_o_image']['name'] != null)) {
				$errors = array();

				$array1 = explode('.', $_FILES['edit_o_image']['name']);
				$extension1 = end($array1);
				$edit_o_image = uniqid(rand()).'.'.$extension1;
				$file_ext_1 = pathinfo($edit_o_image, PATHINFO_EXTENSION);
				$location1 = '../assets/uploads/distributors/distributor_image/'.$edit_o_image;

				// add image1
				if(isset($_FILES['edit_o_image'])) {
					$maxsize = 512000;
					$allowed_image_extension = array("png", "jpg", "jpeg");

					// Validate image file size
					if(($_FILES["edit_o_image"]["size"] > $maxsize) || ($_FILES["edit_o_image"]["size"] == 0)) {
						$errors[] = 'File too large. File size must be less than 500 KB.';
					}

					// Validate file input to check if is with valid extension
					if((!in_array($file_ext_1, $allowed_image_extension)) && (!empty($file_ext_1))) {
						$errors[] = 'Invalid file type. Only JPEG, JPG and PNG types are accepted.';
					}
				}

				if(count($errors) === 0) {
					$query = "SELECT o_image FROM distributors WHERE id = ".$edit_id;
					$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
					// execute the query
					$result  = $stmt->execute();

					while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
					{
						$o_image = $row['o_image'];
						unlink('../assets/uploads/distributors/distributor_image/'.$o_image);
					}
					//image upload
					move_uploaded_file($_FILES['edit_o_image']['tmp_name'], $location1);
				} 
				else {
					foreach($errors as $error) {
							echo json_encode($error);
					}
					die(); //Ensure no more processing is done
				}
					
				$query = "UPDATE `distributors` SET `o_image`='$edit_o_image' WHERE `id` = '$edit_id' ";
				// echo $query;
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();
			}

			// agree_image EDIT
			else if(($_FILES['edit_agree_image']['name'] != null)){
				$errors = array();
				
				$array2 = explode('.', $_FILES['edit_agree_image']['name']);
				$extension2 = end($array2);
				$edit_agree_image = uniqid(rand()).'.'.$extension2;
				$file_ext_2 = pathinfo($edit_agree_image, PATHINFO_EXTENSION);
				$location2 = '../assets/uploads/distributors/agreement_image/'.$edit_agree_image;

				// add image2
				if(isset($_FILES['edit_agree_image'])) {
					$maxsize = 512000;
					$allowed_image_extension = array("png", "jpg", "jpeg");

					// Validate image file size
					if(($_FILES['edit_agree_image']['size'] > $maxsize ) || ($_FILES["edit_agree_image"]["size"] == 0)) {
						$errors[] = 'File too large. File size must be less than 500 KB.';
					}

					// Validate file input to check if is with valid extension
					if(!in_array($file_ext_2, $allowed_image_extension) && !empty($file_ext_2)) {
						$errors[] = 'Invalid file type. Only JPEG, JPG and PNG types are accepted.';
					}
				}

				if(count($errors) === 0) {
					$query = "SELECT agree_image FROM distributors WHERE id = ".$edit_id;
					$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
					// execute the query
					$result  = $stmt->execute();

					while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
					{
						$agree_image = $row['agree_image'];
						unlink('../assets/uploads/distributors/agreement_image/'.$agree_image);
					}
					//image upload
					move_uploaded_file($_FILES['edit_agree_image']['tmp_name'], $location2);
				} 
				else {
					foreach($errors as $error) {
							echo json_encode($error);
					}
					die(); //Ensure no more processing is done
				}
				
				$query = "UPDATE `distributors` SET `agree_image`='$edit_agree_image' WHERE `id` = '$edit_id' ";
				// echo $query;
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();
			}

			// approval_image EDIT
			else if(($_FILES['edit_approval_image']['name'] != null)){
				$errors = array();

				$array3 = explode('.', $_FILES['edit_approval_image']['name']);
				$extension3 = end($array3);
				$edit_approval_image = uniqid(rand()).'.'.$extension3;
				$file_ext_3 = pathinfo($edit_approval_image, PATHINFO_EXTENSION);
				$location3 = '../assets/uploads/distributors/approval_image/'.$edit_approval_image;

				// add image3
				if(isset($_FILES['edit_approval_image'])) {
					$maxsize = 512000;
					$allowed_image_extension = array("png", "jpg", "jpeg");

					// Validate image file size
					if(($_FILES['edit_approval_image']['size'] > $maxsize) || ($_FILES["edit_approval_image"]["size"] == 0)) {
						$errors[] = 'File too large. File size must be less than 500 KB.';
					}

					// Validate file input to check if is with valid extension
					if(!in_array($file_ext_3, $allowed_image_extension) && !empty($file_ext_3)) {
						$errors[] = 'Invalid file type. Only JPEG, JPG and PNG types are accepted.'; 
					}
				}

				if(count($errors) === 0) {
					$query = " SELECT approval_image FROM distributors WHERE id = ".$edit_id;
					$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
					// execute the query
					$result  = $stmt->execute();

					while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
					{
						$approval_image = $row['approval_image'];
						unlink('../assets/uploads/distributors/approval_image/'.$approval_image);
					}
					//image upload
					move_uploaded_file($_FILES['edit_approval_image']['tmp_name'], $location3);
				} 
				else {
					foreach($errors as $error) {
							echo json_encode($error);
					}
					die(); //Ensure no more processing is done
				}

				$query = "UPDATE `distributors` SET `approval_image`='$edit_approval_image' WHERE `id` = '$edit_id' ";
				// echo $query;
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();
			}

			// tl_image EDIT
			else if(($_FILES['edit_tl_image']['name'] != null)){
				$errors = array();

				$array4 = explode('.', $_FILES['edit_tl_image']['name']);
				$extension4 = end($array4);
				$edit_tl_image = uniqid(rand()).'.'.$extension4;
				$file_ext_4 = pathinfo($edit_tl_image, PATHINFO_EXTENSION);
				$location4 = '../assets/uploads/distributors/trade_license_image/'.$edit_tl_image;

				// add image3
				if(isset($_FILES['edit_tl_image'])) {
					$maxsize = 512000;
					$allowed_image_extension = array("png", "jpg", "jpeg");

					// Validate image file size
					if(($_FILES['edit_tl_image']['size'] > $maxsize) || ($_FILES["edit_tl_image"]["size"] == 0)) {
						$errors[] = 'File too large. File size must be less than 500 KB.';
					}

					// Validate file input to check if is with valid extension
					if(!in_array($file_ext_4, $allowed_image_extension) && !empty($file_ext_4)) {
						$errors[] = 'Invalid file type. Only JPEG, JPG and PNG types are accepted.'; 
					}
				}

				if(count($errors) === 0) {
					if ( ($_FILES['edit_tl_image']['name']) ) {
						//image upload
						move_uploaded_file($_FILES['edit_tl_image']['tmp_name'], $location4);
					}
				} 
				else {
					foreach($errors as $error) {
							echo json_encode($error);
					}
					die(); //Ensure no more processing is done
				}

				$query = " UPDATE `distri_trade_license` SET `tl_image`='$edit_tl_image' WHERE `distributors` = '$edit_id' ";
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();
			}

			// ===============================xxxx===================================

			else {
				$query = "SELECT o_image, agree_image, approval_image FROM distributors WHERE id = ".$edit_id;
				$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				// execute the query
				$result  = $stmt->execute();

				$o_image = ''; $agree_image = ''; $approval_image='';
				while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
				{
					$o_image = $row['o_image'];
					$agree_image = $row['agree_image'];
					$approval_image = $row['approval_image'];
				}
				
				$query = " UPDATE `distributors` SET 
				`o_image`='$o_image', `agree_image`='$agree_image', `approval_image`='$approval_image' WHERE `id` = '$edit_id' ";
				// echo $query;
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();


				$query = "SELECT tl_image FROM distri_trade_license WHERE distributors = ".$edit_id;
				$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				// execute the query
				$result  = $stmt->execute();

				$tl_image = '';
				while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
				{
					$tl_image = $row['tl_image'];
				}

				$query = " UPDATE `distri_trade_license` SET `tl_image`='$tl_image' WHERE `distributors` = '$edit_id' ";
				$stmt = $con->prepare($query);
				// execute the query
				$result  = $stmt->execute();
			}

			// ================================xxxx==================================

			// ---------image ends-----------//

			$query = " UPDATE `distributors` SET 
			`code`='$edit_code',`date`='$edit_start_date', `appr_start_date`='$edit_appr_start_date', `appr_close_date`='$edit_appr_close_date', `name`='$edit_name',`address`='$edit_address',`o_pre_address`='$edit_o_pre_address',`o_name`='$edit_o_name',`o_address`='$edit_o_address',`o_nid`='$edit_o_nid',`o_mobile`='$edit_o_mobile',`cp_mobile`='$edit_cp_mobile', `territory`='$edit_territory_list',`distri_type`='$edit_distri_type',`is_active`='$edit_status',`is_approve`='$edit_is_approve',`tl_number`='$edit_tl_number',`tl_lastDate`='$edit_tl_lastDate',`b_name_b_branch`='$edit_b_name_b_branch',`b_account`='$edit_b_account',`exist_bus_name1`='$edit_exist_bus_name1',`exist_bus_name2`='$edit_exist_bus_name2',`exist_start1`='$edit_exist_start1',`exist_start2`='$edit_exist_start2',`exist_van_puller`='$edit_exist_van_puller', `exist_ice_van`='$edit_exist_ice_van',`exist_gd_size`='$edit_exist_gd_size',`rel_gge`='$edit_rel_gge',`area_dem`='$edit_area_dem', `point_name`='$edit_point_name',`routes`='$edit_routes', `k_market`='$edit_k_market',`ice_outlets`='$edit_ice_outlets',`exist_avg_m_size`='$edit_exist_avg_m_size',`ig_cont`='$edit_ig_cont',`po_cont`='$edit_po_cont',`lo_cont`='$edit_lo_cont',`ka_cont`='$edit_ka_cont',`bl_cont`='$edit_bl_cont',`kw_cont`='$edit_kw_cont', `others_cont`='$edit_others_cont', `ig_comp`='$edit_ig_comp',`po_comp`='$edit_po_comp',`lo_comp`='$edit_lo_comp',`ka_comp`='$edit_ka_comp',`bl_comp`='$edit_bl_comp',`kw_comp`='$edit_kw_comp', `others_comp`='$edit_others_comp', `m1_sales`='$edit_m1_sales',`m2_sales`='$edit_m2_sales',`m3_sales`='$edit_m3_sales',`m4_sales`='$edit_m4_sales',`m5_sales`='$edit_m5_sales',`m6_sales`='$edit_m6_sales',`m7_sales`='$edit_m7_sales',`m1_inj`='$edit_m1_inj',`m2_inj`='$edit_m2_inj',`m3_inj`='$edit_m3_inj',`m4_inj`='$edit_m4_inj',`m5_inj`='$edit_m5_inj',`m6_inj`='$edit_m6_inj',`m7_inj`='$edit_m7_inj',`total_inv`='$edit_total_inv',`num_SDF`='$edit_num_SDF',`val_SDF`='$edit_val_SDF',`num_vans`='$edit_num_vans',`val_vans`='$edit_val_vans',`init_lifting`='$edit_init_lifting',`gd_adv`='$edit_gd_adv',`m_credit`='$edit_m_credit',`run_capital`='$edit_run_capital',`transac_type`='$edit_transac_type',`rsm_recom`='$edit_rsm_recom',`gm_recom`='$edit_gm_recom', `ref`='$edit_ref', `rsm`='$edit_rsm_list', `asm`='$edit_asm_list', `fpr`='$edit_fpr_list' WHERE `id` = '$edit_id' ";

			// echo $query;
			$stmt = $con->prepare($query);

			// execute the query
			$result  = $stmt->execute();

			// check result
			if($result == true){
				echo "true";
				// echo $stmt->rowCount() . " records Added successfully";
			}
		}
	}

?>