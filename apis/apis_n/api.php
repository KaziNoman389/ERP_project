<?php

	include '../../controller/connection.php';
	/*include 'auth.php';*/
	session_start();
	$uid = $_SESSION["userId"];
	$dept_id = $_SESSION["dept_id"];
	$wloc_id = $_SESSION["wloc_id"];
	$org_id = $_SESSION["org_id"];
	session_write_close();
	$return_data = array();
	
	$req = isset($_POST['req']) ? $_POST['req'] : 0;
	$param = isset($_POST['param']) ? $_POST['param'] : 0;
	$data = isset($_POST['data']) ? $_POST['data'] : 0;
	$field_list = isset($_POST['get']) ? $_POST['get'] : '*';
	$filter = isset($_POST['filter']) ? $_POST['filter'] : '';
	$multi_select = isset($_POST['msel']) ? $_POST['msel'] : 1; 
	$match_id = isset($_POST['match']) ? $_POST['match'] : 0;


	//------------------------------------------------------------------------------------------------
	//-------------------------------------------------req--------------------------------------------
	//------------------------------------------------------------------------------------------------


	switch($req)
	{
		case '1': // Request for depot table
			$table = 'depots';
			break;
        case '2': // Request for region table
            $table = 'regions';
            break;
		case '3': // Request for area table
			$table = 'areas';
			break;
		case '4': // Request for territory table
			$table = 'territories';
			break;
		case '5': // Request for distributor table
			$table = 'distributors';
			break;
		case '6': // Request for emp_list table
			$table = 'emp_list';
			break;
		case '7': // Request for routes table
			$table = 'routes';
			break;
		case '8': // Request for outlets table
			$table = 'outlets';
			break;
		case '9': // Request for opening balance table
			$table = 'opening_balance';
			break;
		case '10': // Request for distri_targets table
			$table = 'distri_targets';
			break;
		case '11': // Request for distri_target_details table
			$table = 'distri_target_details';
			break;
		case '12': // Request for apps table
			$table = 'apps';
			break;
		case '13':  // Request for functions table
			$table = 'functions';
			break;
		case '14':  // Request for permissions table
			$table = 'permissions';
			break;
		case '15':  // Request for productcategories table
			$table = 'productcategories';
			break;
	}


	//------------------------------------------------------------------------------------------------
	//-----------------------------------------------param--------------------------------------------
	//------------------------------------------------------------------------------------------------


	switch($param)
	{
		// ------------------------------------------------------------
		// ------------------ALL Cases for DEPOT TABLE-----------------
		// ------------------------------------------------------------

		case '1': // Request for depot list --> for table view purpose
			$sql = " SELECT depots.*,regions.name AS region_name, regions.org_id AS org_id FROM depots LEFT JOIN regions ON (depots.region = regions.id) WHERE org_id = ".$org_id;
			$return_data = getTableHTML_depots($sql,true);
			break;

		case '2': // Request for depot list --> regions table (name) selection --> [for modal edit purpose]
			$sql = "SELECT *,(SELECT `name` FROM `regions` WHERE id = `depots`.`region`) AS region_name FROM ".$table." WHERE id = ".$data." ORDER BY `code` ASC ";
			$return_data = getTableHTML_depots_SelectedID($sql,true);
			break;
            
        case '3': // [For modal add purpose, modal edit fetch purpose] --> [ Request for region list, Request for depot list, Request for area list] 
            $sql = " SELECT * FROM ".$table." WHERE `is_active` = 1 ";
			$sql .= ($filter!='')? " AND ".$filter : '' ;
			$return_data = getSelectedHTML_lists($sql,$match_id,'',$multi_select,true);
            break;

		// ------------------------------------------------------------
		// -------------------ALL Cases for Area TABLE----------------- 
		// ------------------------------------------------------------
		
		case '4': // Request for area list --> for table view purpose
		$sql = " SELECT areas.*, depots.name AS depot_name, regions.org_id AS org_id FROM areas LEFT JOIN depots ON (areas.depot = depots.id) LEFT JOIN regions ON (depots.region = regions.id) WHERE org_id = ".$org_id;
		$return_data = getTableHTML_areas($sql,true);
		break;

		case '5': // Request for area list --> depots table (name) selection --> [for modal edit purpose]
			$sql = " SELECT *,(SELECT `name` FROM `depots` WHERE id = `areas`.`depot`) AS depot_name, (SELECT id FROM region_wise_distri WHERE depot = `areas`.`depot` GROUP BY region_wise_distri.depot) AS region_id FROM ".$table." WHERE id = ".$data." ORDER BY `code` ASC" ;
			$return_data = getTableHTML_areas_SelectedID($sql,true);
			break;
            
        case '6': // Request for depot list --> depots table (name) selection --> [for modal add purpose]
            $sql = " SELECT * FROM ".$table." WHERE region = ".$data." AND `is_active` = 1 ";
            $return_data = getSelectedHTML_depots($sql,$data,true);
            break;

		// -------------------------------------------------------------------
		// -------------------ALL Cases for Territories TABLE----------------- 
		// -------------------------------------------------------------------
		
		case '7': // Request for territories list --> for table view purpose
			$sql = " SELECT territories.*, areas.name AS area_name, regions.org_id AS org_id FROM ".$table." LEFT JOIN areas ON (territories.area = areas.id) LEFT JOIN depots ON (areas.depot = depots.id) LEFT JOIN regions ON (depots.region = regions.id) WHERE org_id = ".$org_id;
			$return_data = getTableHTML_territories($sql,true);
			break;

		case '8': // Request for territories list --> areas table (name) selection --> [for modal edit purpose]
			$sql = " SELECT *, (SELECT `name` FROM `areas` WHERE id = `territories`.`area`) AS area_name , (SELECT depot FROM region_wise_distri WHERE area = `territories`.`area` GROUP BY region_wise_distri.area) AS depot_id, (SELECT id FROM region_wise_distri WHERE area = `territories`.`area` GROUP BY region_wise_distri.area) AS region_id FROM ".$table." WHERE id = ".$data." ORDER BY `code` ASC ";
			$return_data = getTableHTML_territories_SelectedID($sql,true);
			break;

        case '9': // Request for area list --> areas table (name) selection --> [for modal add & edit purpose]
            $sql = " SELECT * FROM ".$table." WHERE depot = ".$data." AND `is_active` = 1 ";
            $return_data = getSelectedHTML_areas($sql,true);
            break;

		// -------------------------------------------------------------------
		// -------------------ALL Cases for Distributor TABLE----------------- 
		// -------------------------------------------------------------------
		
		case '10': // Request for Distributor list --> for table view purpose
			$sql = " SELECT `distributors`.*, `territories`.`name` As territory_name, `territories`.`id` As territory_id, `areas`.`name` AS area_name, `areas`.`id` AS area_id, `depots`.`name` AS depot_name, `depots`.`id` AS depot_id, `regions`.`name` As region_name , `regions`.`id` AS region_id, `regions`.`org_id` AS org_id FROM ".$table." Left JOIN territories ON (distributors.territory = territories.id) LEFT JOIN areas ON (territories.area = areas.id)  LEFT JOIN depots ON (areas.depot = depots.id) LEFT JOIN regions ON (depots.region = regions.id) WHERE org_id = ".$org_id;
			$return_data = getTableHTML_distributors($sql,true);
			break;

		case '11': // Request for Distributor list --> territories table (name) selection --> [for modal edit purpose]
			$sql = " SELECT `distributors`.*, `territories`.`name` As territory_name, `territories`.`id` As territory_id, `areas`.`name` AS area_name, `areas`.`id` AS area_id, `depots`.`name` AS depot_name, `depots`.`id` AS depot_id, `regions`.`name` AS region_name , `regions`.`id` AS region_id, `regions`.`org_id` AS org_id, distri_trade_license.distributors AS distrib_id , distri_trade_license.tl_image AS tl_image FROM ".$table." Left JOIN distri_trade_license ON (distributors.id = distri_trade_license.distributors )LEFT JOIN territories ON (distributors.territory = territories.id) LEFT JOIN areas ON (territories.area = areas.id) LEFT JOIN depots ON (areas.depot = depots.id) LEFT JOIN regions ON (depots.region = regions.id) WHERE distributors.`id` = ".$data;
			$return_data = getTableHTML_distributors_SelectedID($sql,true);
			break;

        case '12': // Request for territories list --> areas table (name) selection --> [for modal add & edit purpose]
            $sql = " SELECT * FROM ".$table." WHERE area = ".$data." AND is_active = 1 ";
            $return_data = getSelectedHTML_territories($sql,true);
            break;

		case '13': // Request for view for distributor table --> [for view modal only]
			$sql = "SELECT distributors.*, territories.name As territory_name, areas.name AS area_name, depots.name AS depot_name, regions.name As region_name FROM ".$table." Left JOIN territories ON (distributors.territory = territories.id) LEFT JOIN areas ON (territories.area = areas.id)  LEFT JOIN depots ON (areas.depot = depots.id) LEFT JOIN regions ON (depots.region = regions.id) WHERE distributors.id = ".$data;
            $return_data = getTableHTML_Distributors_view($sql,true);
            break;
			
		case '14': // Request for emp_list for distributor table --> [for edit modal]
			$sql = " SELECT emp_list.*, region_wise_distri.id AS reg_id, region_wise_distri.distri AS reg_distri, region_wise_distri.org_id AS reg_org_id, distributors.id AS distri_id FROM ".$table." Left JOIN region_wise_distri ON (emp_list.org_id = region_wise_distri.org_id) LEFT JOIN distributors ON (region_wise_distri.distri = distributors.id) WHERE (emp_list.org_id = region_wise_distri.org_id) AND emp_list.org_id = ".$data." GROUP BY id ";
            $return_data = getSelectedHTML_edit_EMP_List($sql,true);
            break;
		
		case '15': // Request for emp_list for distributor table --> [for add modal]
			$sql = " SELECT emp_list.*, region_wise_distri.id AS reg_id, region_wise_distri.distri AS reg_distri, region_wise_distri.org_id AS reg_org_id, distributors.id AS distri_id FROM ".$table." Left JOIN region_wise_distri ON (emp_list.org_id = region_wise_distri.org_id) LEFT JOIN distributors ON (region_wise_distri.distri = distributors.id) WHERE (emp_list.org_id = region_wise_distri.org_id) AND emp_list.org_id = ".$data." GROUP BY id ";
            $return_data = getSelectedHTML_add_EMP_List($sql,true);
            break;

		case '16': // Request for area list --> areas table (name) selection --> [for modal add purpose]
            $sql = " SELECT areas.*, region_wise_distri.id AS region_id, region_wise_distri.depot AS depot, region_wise_distri.area AS area, region_wise_distri.distri AS distributor, distributors.id AS distri_id, distributors.area_dem AS distri_area FROM ".$table." LEFT JOIN region_wise_distri ON (areas.id = region_wise_distri.area) LEFT JOIN distributors ON (region_wise_distri.distri = distributors.id) WHERE areas.is_active = 1 GROUP BY code ";
			$return_data = getSelectedHTML_dist_areas($sql,true);
            break;

		case '17': // Request for routes list --> areas & routes table (code,name) selection --> [for modal add purpose]
            $sql = " SELECT `routes`.* FROM routes WHERE `routes`.`is_active` = 1 GROUP BY code ";
			$return_data = getSelectedHTML_routes($sql,true);
            break;

		case '18': // Request for area list --> areas table (name) selection --> [for modal edit purpose]
            $sql = " SELECT areas.*, region_wise_distri.id AS region_id, region_wise_distri.depot AS depot, region_wise_distri.area AS area, region_wise_distri.distri AS distributor, distributors.id AS distri_id, distributors.area_dem AS distri_area FROM ".$table." LEFT JOIN region_wise_distri ON (areas.id = region_wise_distri.area) LEFT JOIN distributors ON (region_wise_distri.distri = distributors.id) WHERE distributors.id = ".$data." AND areas.is_active = 1 GROUP BY code ";
			$return_data = getSelectedHTML_dist_edit_areas_list($sql,true);
            break;

		case '19': // Request for routes list --> areas & routes table (code,name) selection --> [for modal add purpose]
			$sql = " SELECT distributors.* FROM ".$table." WHERE id = ".$data." AND is_active = 1 ";
			$return_data = getSelectedHTML_dist_edit_routes_list($sql,true);
			break;

		case '20': // Request for area list --> areas table (code,name) selection --> [for modal view purpose]
			$sql = " SELECT emp_list.* FROM ".$table." WHERE is_active = 1 ";
			$return_data = getSelectedHTML_dist_emp_view_list($sql,true);
			break;

		case '21': // Request for area list --> areas table (code,name) selection --> [for modal view purpose]
			$sql = " SELECT areas.* FROM ".$table." WHERE is_active = 1 ";
			$return_data = getSelectedHTML_dist_area_names($sql,true);
			break;

		case '22': // Request for routes list --> routes table (code,name) selection --> [for modal view purpose]
		$sql = " SELECT routes.* FROM ".$table." WHERE is_active = 1 ";
		$return_data = getSelectedHTML_dist_routes_names($sql,true);
		break;

		// -------------------------------------------------------------------
		// -------------------ALL Cases for Routes TABLE----------------------
		// -------------------------------------------------------------------

		case '23': // Request for routes list --> for table view purpose
			$sql = " SELECT routes.* FROM ".$table." ORDER BY `code` ASC ";
			$return_data = getTableHTML_routes_table($sql,true);
			break;

		case '24': // Request for routes list --> routes table --> [for modal edit purpose]
			$sql = " SELECT routes.* FROM ".$table." WHERE id = ".$data." ORDER BY `code` ASC ";
			$return_data = getTableHTML_routes_SelectedID($sql,true);
			break;


		// --------------------------------------------------------------------
		// -------------------ALL Cases for Outlets TABLE----------------------
		// --------------------------------------------------------------------

		case '25': // Request for outlets list --> for table view purpose
			$sql = " SELECT outlets.* FROM ".$table." ORDER BY `id` ASC ";
			$return_data = getTableHTML_outlets_table($sql,true);
			break;

		case '26': // Request for outlets list --> outlets table --> [for modal edit purpose]
			$sql = " SELECT outlets.* FROM ".$table." WHERE id = ".$data." ORDER BY `id` ASC ";
			$return_data = getTableHTML_outlets_fetch_SelectedID($sql,true);
			break;
		
		case '27': // Request for distributors list --> distributor table (code,name) --> [for modal add purpose]
			$sql = " SELECT distributors.* FROM ".$table." ORDER BY `code` ASC ";
			$return_data = getSelectedHTML_distributor_names($sql,true);
			break;

		case '28': // Request for outlets list --> distributor table (code,name) selection --> [for modal view purpose]
			$sql = " SELECT outlets.*, FROM ".$table." WHERE ORDER BY `name` DESC ";
			$return_data = getTableHTML_outlets_distributors_SelectedID($sql,true);
			break;

		case '29': // Request for outlets list --> distributor table (code,name) selection --> [for modal view purpose]
			$sql = " SELECT distributors.* FROM ".$table;
			$return_data = getSelectedHTML_outlets_distributor_names($sql,true);
			break;
		
		case '30': // Request for view for distributor table --> [for view modal only]
			$sql = " SELECT outlets.* FROM ".$table." WHERE id = ".$data." ORDER BY `name` ASC ";
            $return_data = getTableHTML_outlets_view($sql,true);
            break;

		case '31': // Request for distributors list --> distributors table (code,name) selection --> [for outlets modal edit purpose]
			$sql = " SELECT outlets.id, outlets.distributor, outlets.is_active FROM outlets WHERE id = ".$data;
            $return_data = getSelectedHTML_outlets_edit_distributors_list($sql,true);
            break;

		case '32': // Request for routes list --> routes table (code,name) selection --> [for outlets modal edit purpose]
			$sql = " SELECT outlets.id, outlets.routes, outlets.is_active FROM outlets WHERE id = ".$data;
            $return_data = getSelectedHTML_outlets_edit_routes_list($sql,true);
            break;

		// -------------------------------------------------------------------
		// ----------------ALL Cases for Opening Balance TABLE----------------
		// -------------------------------------------------------------------
			
		case '33': // Request for opening balance list --> for table view purpose
			$sql = " SELECT opening_balance.*, distributors.id AS distri_id, distributors.name AS distri_name FROM ".$table." LEFT JOIN distributors ON(opening_balance.distributor = distributors.id) ORDER BY opening_balance.`id` ";
			$return_data = getTableHTML_open_bal_table($sql,true);
			break;

		// -------------------------------------------------------------------
		// --------------ALL Cases for Distributors Target TABLE--------------
		// -------------------------------------------------------------------

		case '34': // Request for distri_target list --> for table view purpose
			$sql = " SELECT distri_targets.* FROM ".$table." ORDER BY distri_targets.id ASC";
			$return_data = getTableHTML_distri_target_table($sql,true);
			break;

		case '35': // Request for distri_target_details list --> for table edit modal view purpose
			$sql = " SELECT * FROM ".$table." WHERE ";
			$sql .= ($filter!='')? $filter : '';
			$return_data = getTableHTML_distri_target_SelectedID($sql,true);
			break;

		case '36': // Request for depot list --> regions table (name) selection --> [for modal edit purpose]
			$sql = " SELECT * FROM ".$table." WHERE id = ".$data;
			$return_data = getTableHTML_name_SelectedID($sql,true);
			break;

		case '37': // Request for opening balance list --> for table view purpose
			$sql = " SELECT distri_target_details.* FROM ".$table." WHERE distri_target_details.target = ".$data;
			$return_data = getTableHTML_distributors_trade_details_table($sql,true);
			break;

		case '38': // region_list for distri_target_details view modal table select2 region input field
			$sql = " SELECT region_id, region_name FROM ".$table." GROUP BY region_name ";
			$return_data = getTableHTML_Distri_target_details_search_region_names_SelectedID($sql,true);
			break;

		case '39': // region_list search from distri_target_details view modal table
			$sql = " SELECT * FROM ".$table." WHERE ";
			$sql .= ($filter!='')? $filter : '';
			$return_data = getTableHTML_search_region_SelectedID($sql,true);
			break;

		case '40': // depot_list for distri_target_details view modal table select2 depot input field
			$sql = " SELECT depot_id, depot_name FROM ".$table." GROUP BY depot_name ";
			$return_data = getTableHTML_Distri_target_details_search_depot_names_SelectedID($sql,true);
			break;

		case '41': // area_list for distri_target_details view modal table select2 area input field
			$sql = " SELECT area_id, area_name FROM ".$table." GROUP BY area_name ";
			$return_data = getTableHTML_Distri_target_details_search_area_names_SelectedID($sql,true);
			break;

		case '42': // territory_list for distri_target_details view modal table select2 territory input field
			$sql = " SELECT territory, territorry_name FROM ".$table." GROUP BY territorry_name ";
			$return_data = getTableHTML_Distri_target_details_search_territory_names_SelectedID($sql,true);
			break;

		// -------------------------------------------------------------------
		// ----------------- ALL Cases for Apps Target TABLE -----------------
		// -------------------------------------------------------------------

		case '43': // Request for apps list --> for table view purpose
			$sql = " SELECT * FROM ".$table." ORDER BY id ASC ";
			$return_data = getTableHTML_apps_table($sql,true);
			break;

		case '44': // region_list search from distri_target_details view modal table
			$sql = " SELECT * FROM ".$table." WHERE ";
			$sql .= ($filter!='')? $filter : '';
			$return_data = getTableHTML_apps_SelectedID($sql,true);
			break;
			
		case '45': // Request for functions name list --> functions table ( unique names ) --> [for table modal function add purpose]
			$sql = " SELECT DISTINCT `name` FROM ".$table;
			$return_data = getSelectedHTML_function_names($sql,true);
			break;
		
		case '46': // Request for area list --> areas table (code,name) selection --> [for modal view purpose]
			$sql = " SELECT emp_list.* FROM ".$table." WHERE is_active = 1 ";
			$return_data = getSelectedHTML_apps_emp_list($sql,true);
			break;

		case '47': // Request for area list --> areas table (code,name) selection --> [for modal view purpose]
			$sql = " SELECT id, display_name, is_active FROM ".$table." WHERE is_active = 1 ";
			$return_data = getSelectedHTML_apps_list($sql,true);
			break;

		case '48': // Request for area list --> areas table (code,name) selection --> [for modal view purpose]
			$sql = " SELECT `id`, `app`, `name` FROM ".$table." WHERE app = ".$data;
			$return_data = getSelectedHTML_function_filter_names_SelectedID($sql,true);
			break;


		// -------------------------------------------------------------------
		// ------------- ALL Cases for Product Categories TABLE --------------
		// -------------------------------------------------------------------
		
		case '49': // Request for area list --> areas table (code,name) selection --> [for modal view purpose]
			$sql = " SELECT * FROM ".$table." WHERE org_id = ".$org_id;
			$return_data = getSelectedHTML_product_categories_table($sql,true);
			break;
			
		case '50': // Request for main product_categories list --> product_categories modal add purpose
			$sql = " SELECT `id`,`name` FROM ".$table." WHERE `sub_of`= 0 AND org_id = ".$org_id;
			$return_data = getSelectedHTML_main_product_names_add($sql,true);
			break;

		case '51': // product_categories fetch from productcategories for edit
			$sql = " SELECT * FROM ".$table." WHERE id = ".$data;
			$return_data = getTableHTML_product_catergoties_SelectedID($sql,true);
			break;
			
		case '52': // product_categories select2 from productcategories for modal edit
			$sql = " SELECT * FROM ".$table." WHERE sub_of!=0 AND id = ".$data;
			$return_data = getSelectedHTML_main_product_names_edit_selectedID($sql,true);
			break;
			
	}


	//------------------------------------------------------------------------------------------------
	//------------------------------------------param ends--------------------------------------------
	//------------------------------------------------------------------------------------------------
	echo json_encode($return_data);



	//------------------------------------------------------------------------------------------------
	//--------------------------------------functions start-------------------------------------------
	//------------------------------------------------------------------------------------------------


	//---------------------------------------------------------------------------------
	//-----------------------Depot Table Functions start-------------------------------
	//---------------------------------------------------------------------------------

	// Depot_table_view -->[ main purpose is to fetch table data in the depot table ]
	function getTableHTML_depots($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$bHTML = ''; $btns = '';
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$counter = 1;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$bHTML .= ' <tr>
                                <td><p>'.$counter++.'</td>
                                <td><p>'.$row["code"].'</td>
                                <td><p>'.$row["name"].'</td>
                                <td><p>'.$row["definition"].'</td>
                                <td><p>'.$row["address"].'</td>
                                <td><p>'.$row["region_name"].'</td>
                                <td><p>'.($row["is_active"]==0 ? "Out Of Service" : "Active").'</td>
                                <td class="text-end">    
                                    <a class="btn p-0" data-toggle="tooltip" data-placement="bottom" title="Edit" data-id='.$row["id"].' match-org-id='.$row["org_id"].' id="btn_edit">
                                        <i class="fas fa-pencil-alt font-13"></i>
                                    </a>
                                </td>
                            </tr>';
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}

	// Depot_table_modal_edit_view -->[ main purpose is to fetch all the data of the input fields in the modal edit ]
	function getTableHTML_depots_SelectedID($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
	
			$bHTML = ''; 
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$counter = 1;
			$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
			
			$rHTML = $row;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}

	// Depot_table_modal_edit_view -->[ main purpose to find the selected region and display them in select tag in depot table modal edit ]
    function getSelectedHTML_lists($sql, $matchID, $field_name, $multisel = FALSE, $optOnly = FALSE){
		global $con, $filter;
		try
		{
			$multi = ($multisel) ? 'multiple="multiple"' : '';
			$field_name = ($multisel) ? $field_name.'[]' : $field_name;
			$rHTML = '<select class="chosen-select sel2 width-100" '.$multi.' id="'.$field_name.'" name="'.$field_name.'">';
			$rHTML = ($optOnly) ? '' : $rHTML;
			$rHTML .= ($multisel) ? '<option value="-1">-- Select --</option>' : '<option value="0" disabled>-- Select --</option>';
			
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				if($row['id'] == $matchID)
					$rHTML = $rHTML . '<option value="'.$row['id'].'" '."selected".'>'.$row['name'].'</option>';
				else
					$rHTML = $rHTML . '<option value="'.$row['id'].'">'.$row['name'].'</option>';
			}
			$rHTML = ($optOnly) ? $rHTML : $rHTML . '</select>';
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}


	
	//---------------------------------------------------------------------------------
	//-----------------------Area Table Functions start-------------------------------
	//---------------------------------------------------------------------------------
	
	// area_table_view -->[ main purpose is to fetch table data in the area table ]
	function getTableHTML_areas($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$bHTML = ''; 
			$btns = '';
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$counter = 1;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$bHTML .= ' <tr>
                                <td><p>'.$counter++.'</td>
                                <td><p>'.$row["code"].'</td>
                                <td><p>'.$row["name"].'</td>
                                <td><p>'.$row["definition"].'</td>
                                <td><p>'.$row["depot_name"].'</td>
                                <td><p>'.($row["is_active"]==0 ? "Out Of Service" : "Active").'</td>
                                <td class="text-end">
                                    <a class="btn p-0"  data-toggle="tooltip" data-placement="bottom" title="Edit" data-id='.$row["id"].' match-id ='.$row["depot"].' match-org-id='.$row["org_id"].' id="btn_edit">
                                        <i class="fas fa-pencil-alt font-13"></i>
                                    </a>
                                </td>
                            </tr>';
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}

	// area_table_modal_edit_view -->[ main purpose is to fetch all the data of the input fields in the modal edit ]
	function getTableHTML_areas_SelectedID($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
	
			$bHTML = ''; 
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
			$rHTML = $row;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}

	// area_table_modal_edit_view -->[ main purpose to find the selected depot and display them in select tag in area table modal edit ]
    function getSelectedHTML_depots($sql,$data,$bodyOnly=1){
        global $con, $uid, $dept_id, $data;
		try
		{
			$bHTML = '';
			$bHTML .= '<option value="" selected disabled>-- Select --</option>';

			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				// checking [depot table(region column) is equivalent to area table(region id coloumn by sub-query)] is selected
				if($row['region'] == $data){
					$bHTML = $bHTML . '<option value="'.$row['id'].'">'.$row['name'].'</option>';
				}
				else{
					$bHTML = $bHTML . '';
				}
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
    }
	


	//---------------------------------------------------------------------------------------
	//-----------------------Territories Table Functions start-------------------------------
	//---------------------------------------------------------------------------------------
	
	// area_table_view -->[ main purpose is to fetch table data in the area table ]
	function getTableHTML_territories($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$bHTML = ''; $btns = '';
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$counter = 1;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$bHTML .= ' <tr>
                                <td><p>'.$counter++.'</td>
                                <td><p>'.$row["code"].'</td>
                                <td><p>'.$row["name"].'</td>
                                <td><p>'.$row["definition"].'</td>
                                <td><p>'.$row["area_name"].'</td>
                                <td><p>'.($row["is_active"]==0 ? "Out Of Service" : "Active").'</td>
                                <td class="text-end">
                                    <a class="btn p-0"  data-toggle="tooltip" data-placement="bottom" title="Edit" data-id='.$row["id"].' a-id='.$row["area"].' match-org-id='.$row["org_id"].' id="btn_edit">
                                        <i class="fas fa-pencil-alt font-13"></i>
                                    </a>
                                </td>
                            </tr>';
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}

	// area_table_modal_edit_view -->[ main purpose is to fetch all the data of the input fields in the modal edit ]
	function getTableHTML_territories_SelectedID($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
	
			$bHTML = ''; 
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
			
			$rHTML = $row;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}

	// area_table_modal_edit_view -->[ main purpose to find the selected area and display them in select tag in area table modal edit ]
    function getSelectedHTML_areas($sql,$bodyOnly=1){
        global $con, $uid, $dept_id, $data;
		
		try
		{
			$bHTML = '';
			$bHTML .= '<option value="" selected disabled>-- Select --</option>';

			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				// checking [depot table(id column) is equivalent to area table(depot coloumn)] is selected
				// If selected then fetch all the area table (name coloumn)
				if($row['depot'] == $data){
					$bHTML = $bHTML . '<option value="'.$row['id'].'">'.$row['name'].'</option>';
				}
				else{
					$bHTML = $bHTML . '';
				}
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
    }

	
	//----------------------------------------------------------------------------------------
	//-----------------------Distributors Table Functions start-------------------------------
	//----------------------------------------------------------------------------------------
	
	// distributors_table_view -->[ main purpose is to fetch table data in the distributors table ]
	function getTableHTML_distributors($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$bHTML = ''; $btns = '';
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$counter = 1;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$bHTML .= ' <tr>
                                <td><p>'.$counter++.'</td>
                                <td><p>'.$row["code"].'</td>
                                <td><p>'.$row["name"].'</td>
                                <td><p>'.$row["address"].'</td>
								<td><p>'.$row["region_name"].'</td>
								<td><p>'.$row["depot_name"].'</td>
                                <td><p>'.$row["area_name"].'</td>
								<td><p>'.$row["territory_name"].'</td>
                                <td><p>'.($row["is_active"]==0 ? "Out Of Service" : "Active").'</td>
								<td><p>'.($row["is_approve"]==0 ? "No" : "Yes").'</td>
                                <td class="text-end">
									<a class="btn p-0"  data-toggle="tooltip" data-placement="bottom" title="View" data-id='.$row["id"].' id="btn_view">
										<i class="fas fa-eye font-13"></i>
                                    </a>

                                    <a class="btn p-0"  data-toggle="tooltip" data-placement="bottom" title="Edit" data-id='.$row["id"].' t-id='.$row["territory"].' match-org-id='.$row["org_id"].' id="btn_edit">
                                        <i class="fas fa-pencil-alt font-13"></i>
                                    </a>
                                </td>
                            </tr>';
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}

	// distributors_table_modal_edit_view -->[ main purpose is to fetch all the data of the input fields in the modal edit & modal view ]
	function getTableHTML_distributors_SelectedID($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$code = $row['code'];
				$date = $row['date'];
				
				$region_id = $row['region_id'];
				$depot_id = $row['depot_id'];
				$area_id = $row['area_id'];

				$region_name =$row['region_name'];
				$depot_name =$row['depot_name'];
				$area_name =$row['area_name'];
                $territory_name =$row['territory_name'];

                $distri_type = $row['distri_type'];
                $name = $row['name'];
                $address = $row['address'];
                $o_pre_address = $row['o_pre_address'];
                $o_name = $row['o_name'];
                $o_address = $row['o_address'];
                $o_nid = $row['o_nid'];
                $o_mobile = $row['o_mobile'];

                $o_image  =  $row['o_image'];
				$agree_image =$row['agree_image'];
				$approval_image =$row['approval_image'];
				$tl_image = $row['tl_image'];

                $cp_mobile = $row['cp_mobile'];
                $is_active = $row['is_active'];
                $is_approve = $row['is_approve'];
                $tl_number = $row['tl_number'];
                $tl_lastDate = $row['tl_lastDate'];
                $b_name_b_branch = $row['b_name_b_branch'];
                $b_account = $row['b_account'];
                $exist_bus_name1 = $row['exist_bus_name1'];
                $exist_bus_name2 = $row['exist_bus_name2'];
                $exist_start1 = $row['exist_start1'];
                $exist_start2 = $row['exist_start2'];
                $exist_van_puller = $row['exist_van_puller'];
                $exist_ice_van = $row['exist_ice_van'];
                $exist_gd_size = $row['exist_gd_size'];
                $rel_gge = $row['rel_gge'];

                $area_dem = $row['area_dem'];
				$routes = $row['routes'];

				$point_name = $row['point_name'];
                $k_market = $row['k_market'];
                $ice_outlets = $row['ice_outlets'];
                $exist_avg_m_size = $row['exist_avg_m_size'];
				
                $ig_cont = $row['ig_cont'];
                $po_cont = $row['po_cont'];
                $lo_cont = $row['lo_cont'];
                $ka_cont = $row['ka_cont'];
                $bl_cont = $row['bl_cont'];
                $kw_cont = $row['kw_cont'];
				$others_cont = $row['others_cont'];
                $ig_comp = $row['ig_comp'];
                $po_comp = $row['po_comp'];
                $lo_comp = $row['lo_comp'];
                $ka_comp = $row['ka_comp'];
                $bl_comp = $row['bl_comp'];
                $kw_comp = $row['kw_comp'];
				$others_comp = $row['others_comp'];

				// removing last part of comma seperated columns from database
				$m1_sales = explode (",", $row["m1_sales"]);
				$m2_sales = explode (",", $row["m2_sales"]);
				$m3_sales = explode (",", $row["m3_sales"]);
				$m4_sales = explode (",", $row["m4_sales"]);
				$m5_sales = explode (",", $row["m5_sales"]);
				$m6_sales = explode (",", $row["m6_sales"]);
				$m7_sales = explode (",", $row["m7_sales"]);
				// removing last part of comma seperated columns from database
				$m1_inj = explode (",", $row["m1_inj"]);
				$m2_inj = explode (",", $row["m2_inj"]);
				$m3_inj = explode (",", $row["m3_inj"]);
				$m4_inj = explode (",", $row["m4_inj"]);
				$m5_inj = explode (",", $row["m5_inj"]);
				$m6_inj = explode (",", $row["m6_inj"]);
				$m7_inj = explode (",", $row["m7_inj"]);

                $total_inv = $row['total_inv'];
                $num_SDF = $row['num_SDF'];
                $val_SDF = $row['val_SDF'];
                $num_vans = $row['num_vans'];
                $val_vans = $row['val_vans'];
                $init_lifting = $row['init_lifting'];
                $gd_adv = $row['gd_adv'];
                $m_credit = $row['m_credit'];
                $run_capital = $row['run_capital'];
                $transac_type = $row['transac_type'];
                $rsm_recom = $row['rsm_recom'];
                $gm_recom = $row['gm_recom'];

				$rsm = $row['rsm'];
				$asm = $row['asm'];
				$fpr = $row['fpr'];

				$appr_start_date = $row['appr_start_date'];
				$appr_close_date = $row['appr_close_date'];

				$ref =$row['ref'];
			}
			return ['region_id'=>$region_id , 'depot_id'=>$depot_id , 'area_id'=>$area_id, 'code'=>$code, 'date'=> $date, 'region_name'=> $region_name, 'depot_name'=> $depot_name, 'area_name'=> $area_name, 'territory_name'=> $territory_name,'distri_type'=>$distri_type, 'name'=>$name, 'address'=>$address, 'o_pre_address'=>$o_pre_address, 'o_name'=>$o_name, 'o_address'=>$o_address, 'o_nid'=>$o_nid, 'o_mobile'=>$o_mobile, 'o_image'=>$o_image, 'agree_image'=>$agree_image, 'approval_image'=>$approval_image, 'tl_image'=>$tl_image, 'cp_mobile'=>$cp_mobile, 'is_active'=>$is_active, 'is_approve'=>$is_approve,'tl_number'=>$tl_number, 'tl_lastDate'=>$tl_lastDate, 'b_name_b_branch'=>$b_name_b_branch, 'b_account'=>$b_account, 'exist_bus_name1'=>$exist_bus_name1, 'exist_bus_name2'=>$exist_bus_name2, 'exist_start1'=>$exist_start1, 'exist_start2'=>$exist_start2, 'exist_van_puller'=>$exist_van_puller, 'exist_ice_van'=>$exist_ice_van, 'exist_gd_size'=>$exist_gd_size, 'rel_gge'=>$rel_gge, 'area_dem'=>$area_dem, 'point_name'=>$point_name, 'routes'=>$routes, 'k_market'=>$k_market, 'ice_outlets'=>$ice_outlets, 'exist_avg_m_size'=>$exist_avg_m_size, 'ig_cont'=>$ig_cont, 'po_cont'=>$po_cont, 'lo_cont'=>$lo_cont, 'ka_cont'=>$ka_cont, 'bl_cont'=>$bl_cont, 'kw_cont'=>$kw_cont, 'others_cont'=>$others_cont, 'ig_comp'=>$ig_comp, 'po_comp'=>$po_comp, 'lo_comp'=>$lo_comp, 'ka_comp'=>$ka_comp, 'bl_comp'=>$bl_comp, 'kw_comp'=>$kw_comp, 'others_comp'=>$others_comp, 'm1_sales'=>$m1_sales[0],'m2_sales'=>$m2_sales[0],'m3_sales'=>$m3_sales[0],'m4_sales'=>$m4_sales[0],'m5_sales'=>$m5_sales[0],'m6_sales'=>$m6_sales[0],'m7_sales'=>$m7_sales[0],'m1_inj'=>$m1_inj[0],'m2_inj'=>$m2_inj[0],'m3_inj'=>$m3_inj[0],'m4_inj'=>$m4_inj[0],'m5_inj'=>$m5_inj[0],'m6_inj'=>$m6_inj[0],'m7_inj'=>$m7_inj[0], 'total_inv'=>$total_inv, 'num_SDF'=>$num_SDF, 'val_SDF'=>$val_SDF, 'num_vans'=>$num_vans, 'val_vans'=>$val_vans, 'init_lifting'=>$init_lifting, 'gd_adv'=>$gd_adv, 'm_credit'=>$m_credit, 'run_capital'=>$run_capital, 'transac_type'=>$transac_type, 'rsm_recom'=>$rsm_recom, 'gm_recom'=>$gm_recom, 'rsm'=>$rsm, 'asm'=>$asm, 'fpr'=>$fpr, 'appr_start_date'=>$appr_start_date, 'appr_close_date'=>$appr_close_date, 'ref'=>$ref];
		}
		catch (PDOException $e) 
		{
			$e->getMessage();
		}
	}

	// distributors_table_modal_edit_view -->[ main purpose to find the selected territories and display them in select tag in distributors table modal edit ] ---> [ Request for territories list --> areas table (name) selection ]
    function getSelectedHTML_territories($sql,$bodyOnly=1){
        global $con, $uid, $dept_id, $data;
		
		try
		{
			$bHTML = '';
			$bHTML .= '<option value="" selected disabled>-- Select --</option>';

			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				// checking [areas table(id column) is equivalent to territories table(area coloumn)] is selected
				// If selected then fetch all the territory table (name coloumn)
				if($row['area'] == $data){
					$bHTML = $bHTML . '<option value="'.$row['id'].'">'.$row['name'].'</option>';
				}
				else{
					$bHTML = $bHTML . '';
				}
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
    }

	// distributors_table_modal_view -->[ main purpose is to fetch all the data of the input fields in the modal view ]
	function getTableHTML_Distributors_view($sql,$bodyOnly=1){
		global $con, $uid, $dept_id, $data;
			
		for($i=0; $i<=6; $i++) {
			$next_six_months[] =date("M/y", strtotime( date( 'Y-m-01' )." +$i months"));
		}

		$part_ref = ''; $part1_body = ''; $part2_body =''; $part3_body =''; $part4_head =''; $part4_body =''; $part5_head =''; $part5_body =''; $part6_body =''; $part7_textarea =''; $image =''; $area_dem=''; $routes ='';
		$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
		{
			$area_dem = $row['area_dem'];
			$routes = $row['routes'];

			if($row["id"] == $data) {
				$part_ref .= '<label class="view_label">Reference : </label>
							<p class="view_label d-inline-block view">'.$row["ref"].'</p>';
				
				$part1_body .= ' <tr>
								<td style="width: 25%;"><p>B.P. Code :</p></td>
								<td class="text-center view"><p>'.$row['code'].'</p></td>
							</tr>
							<tr>
								<td style="width: 25%;"><p>Date :</p></td>
								<td class="text-center view"><p>'.$row['date'].'</p></td>
							</tr>
							<tr>
								<td style="width: 25%;"><p>Region :</p></td>
								<td class="text-center view"><p>'.$row["region_name"].'</p></td>
							</tr>
							<tr>
								<td style="width: 25%;"><p>Depot :</p></td>
								<td class="text-center view"><p>'.$row["depot_name"].'</p></td>
							</tr>
							<tr>
								<td style="width: 25%;"><p>Area :</p></td>
								<td class="text-center view"><p>'.$row["area_name"].'</p></td>
							</tr>
							<tr>
								<td style="width: 25%;"><p>Territory :</p></td>
								<td class="text-center view"><p>'.$row["territory_name"].'</p></td>
							</tr>
							<tr id="rsm_view">
								
							</tr>
							<tr id="asm_view">
								
							</tr>
							<tr id="fpr_view">
								
							</tr>';

				$part2_body .= '<tr>
									<td style="width: 2%;"><p>1</p></td>
									<td style="width: 30%;"><p>Type of Distributorship :</p></td>
									<td class="text-center view">'.$row["distri_type"].'</td>
								</tr>
								<tr>
									<td style="width: 2%;"><p>2</p></td>
									<td style="width: 30%;"><p>Name of Distributor/Firm :</p></td>
									<td class="text-center view">'.$row["name"].'</td>
								</tr>
								<tr>
									<td style="width: 2%;"><p>3</p></td>
									<td style="width: 30%;"><p>Proprietor Name :</p></td>
									<td class="text-center view">'.$row["o_name"].'</td>
								</tr>
								<tr>
									<td style="width: 2%;"><p>4</p></td>
									<td style="width: 30%;"><p>Proprietor Mobile Number :</p></td>
									<td class="text-center view">'.$row["o_mobile"].'</td>
								</tr>
								<tr>
									<td style="width: 2%;"><p>5</p></td>
									<td style="width: 30%;"><p>Contact Person & Mobile Number :</p></td>
									<td class="text-center view">'.$row["cp_mobile"].'</td>
								</tr>
								<tr>
									<td style="width: 2%;"><p>6</p></td>
									<td style="width: 30%;"><p>Farm Address :</p></td>
									<td class="text-center view">'.$row["address"].'</td>
								</tr>
								<tr>
									<td style="width: 2%;"><p>7</p></td>
									<td style="width: 30%;"><p>Proprietor Permanent Address :</p></td>
									<td class="text-center view">'.$row["o_address"].'</td>
								</tr>
								<tr>
									<td style="width: 2%;"><p>8</p></td>
									<td style="width: 30%;"><p>Proprietor Present Address :</p></td>
									<td class="text-center view">'.$row["o_pre_address"].'</td>
								</tr>
								<tr>
									<td style="width: 2%;"><p>9</p></td>
									<td style="width: 30%;"><p>Proprietor National ID Number :</p></td>
									<td class="text-center view">'.$row["o_nid"].'</td>
								</tr>
								<tr>
									<td style="width: 2%;"><p>10</p></td>
									<td style="width: 30%;"><p>Trade License Number & last date :</p></td>
									<div class="row">
										<div class="col">
											<td class="text-center view" style="width: 34%;">'.$row["tl_number"].'</td>
										</div>
										<div class="col">
											<td class="text-center view" style="width: 34%;">'.$row["tl_lastDate"].'</td>
										</div>
									</div>
								</tr>
								<tr>
									<td style="width: 2%;"><p>11</p></td>
									<td style="width: 30%;"><p>bank name & branch :</p></td>
									<td class="text-center view">'.$row["b_name_b_branch"].'</td>
								</tr>	
								<tr>
									<td style="width: 2%;"><p>12</p></td>
									<td style="width: 30%;"><p>bank account number :</p></td>
									<td class="text-center view">'.$row["b_account"].'</td>
								</tr>
								<tr>
									<td style="width: 2%;"><p>13</p></td>
									<td style="width: 30%;"><p>name of existing business :</p></td>
									<div class="row">
										<div class="col">
											<td class="text-center view" style="width: 34%;">'.$row["exist_bus_name1"].'</td>
										</div>
										<div class="col">
											<td class="text-center view" style="width: 34%;">'.$row["exist_bus_name2"].'</td>
										</div>
									</div>
								</tr>
								<tr>
									<td style="width: 2%;"><p>14</p></td>
									<td style="width: 30%;"><p>existing business starting year :</p></td>
									<div class="row">
										<div class="col">
											<td class="text-center view" style="width: 34%;">'.$row["exist_start1"].'</td>
										</div>
										<div class="col">
											<td class="text-center view" style="width: 34%;">'.$row["exist_start2"].'</td>
										</div>
									</div>
								</tr>
								<tr>
									<td style="width: 2%;"><p>15</p></td>
									<td style="width: 30%;"><p>no. of existing van puller & or DSR :</p></td>
									<td class="text-center view">'.$row["exist_van_puller"].'</td>
								</tr>
								<tr>
									<td style="width: 2%;"><p>16</p></td>
									<td style="width: 30%;"><p>Number of existing ice cream van :</p></td>
									<td class="text-center view">'.$row["exist_ice_van"].'</td>
								</tr>
								<tr>
									<td style="width: 2%;"><p>17</p></td>
									<td style="width: 30%;"><p>existing godown size (SQFT) :</p></td>
									<td class="text-center view">'.$row["exist_gd_size"].'</td>
								</tr>
								<tr>
									<td style="width: 2%;"><p>18</p></td>
									<td style="width: 30%;"><p>relation with golden group entity :</p></td>
									<td class="text-center view">'.$row["rel_gge"].'</td>
								</tr>';

				$part3_body .= '<tr>
									<td style="width: 2.6%;"><p>1</p></td>
									<td style="width: 30%;"><p>Area Demarcation :</p></td>
									<td class="view" id="area_dem"></td>
								</tr>
								<tr>
									<td style="width: 2.6%;"><p>2</p></td>
									<td style="width: 30%;"><p>Point Name :</p></td>
									<td class="view">'.$row["point_name"].'</td>
								</tr>
								<tr>
									<td style="width: 2.6%;"><p>3</p></td>
									<td style="width: 30%;"><p>Routes :</p></td>
									<td class="view" id="route"></td>
								</tr>
								<tr>
									<td style="width: 2.6%;"><p>4</p></td>
									<td style="width: 30%;"><p>Key Markets :</p></td>
									<td class="view">'.$row['k_market'].'</td>
								</tr>
								<tr>
									<td style="width: 2.6%;"><p>5</p></td>
									<td style="width: 30%;"><p>Ice Cream selling outlets territory :</p></td>
									<td class="view">'.$row["ice_outlets"].'</td>
								</tr>
								<tr>
									<td style="width: 2.6%;"><p>6</p></td>
									<td style="width: 30%;"><p>Existing Avg market Size (Tk) : (yearly)</p></td>
									<td class="view">'.$row["exist_avg_m_size"].'</td>
								</tr>';


				$part4_head .='<th colspan="2" style="width: 30%;"></th>
								<th class="text-center">Igloo</th>
								<th class="text-center">Polar</th>
								<th class="text-center">Lovello</th>
								<th class="text-center">Kazi</th>
								<th class="text-center">Bloop</th>
								<th class="text-center">kwality</th>
								<th class="text-center">Others</th>';

				$part4_body .=' <tr>
									<td style="width: 2.5%;"><p>1</p></td>
									<td style="width: 30%;"><p>Existing Market Contribution (taka) :</p></td>
									<td class="text-center view" >'.$row["ig_cont"].'</td>
									<td class="text-center view">'.$row["po_cont"].'</td>
									<td class="text-center view">'.$row["lo_cont"].'</td>
									<td class="text-center view">'.$row["ka_cont"].'</td>
									<td class="text-center view">'.$row["bl_cont"].'</td>
									<td class="text-center view">'.$row["kw_cont"].'</td>
									<td class="text-center view">'.$row["others_cont"].'</td>
								</tr>
								<tr>
									<td style="width: 2.5%;"><p>2</p></td>
									<td style="width: 30%;"><p>D/F Quantity of the competitors :</p></td>
									<td class="text-center view">'.$row["ig_comp"].'</td>
									<td class="text-center view">'.$row["po_comp"].'</td>
									<td class="text-center view">'.$row["lo_comp"].'</td>
									<td class="text-center view">'.$row["ka_comp"].'</td>
									<td class="text-center view">'.$row["bl_comp"].'</td>
									<td class="text-center view">'.$row["kw_comp"].'</td>
									<td class="text-center view">'.$row["others_comp"].'</td>
								</tr>';

				$part5_head .='<th colspan="2" style="width: 30%;"></th>
								<th class="text-center view">'.$next_six_months[0].'</th>
								<th class="text-center view">'.$next_six_months[1].'</th>
								<th class="text-center view">'.$next_six_months[2].'</th>
								<th class="text-center view">'.$next_six_months[3].'</th>
								<th class="text-center view">'.$next_six_months[4].'</th>
								<th class="text-center view">'.$next_six_months[5].'</th>
								<th class="text-center view">'.$next_six_months[6].'</th>';

				// removing last part of comma seperated columns from database
				$m1_sales = explode (",", $row["m1_sales"]);
				$m2_sales = explode (",", $row["m2_sales"]);
				$m3_sales = explode (",", $row["m3_sales"]);
				$m4_sales = explode (",", $row["m4_sales"]);
				$m5_sales = explode (",", $row["m5_sales"]);
				$m6_sales = explode (",", $row["m6_sales"]);
				$m7_sales = explode (",", $row["m7_sales"]);
				// removing last part of comma seperated columns from database
				$m1_inj = explode (",", $row["m1_inj"]);
				$m2_inj = explode (",", $row["m2_inj"]);
				$m3_inj = explode (",", $row["m3_inj"]);
				$m4_inj = explode (",", $row["m4_inj"]);
				$m5_inj = explode (",", $row["m5_inj"]);
				$m6_inj = explode (",", $row["m6_inj"]);
				$m7_inj = explode (",", $row["m7_inj"]);

				$part5_body .='<tr>
									<td style="width: 2.5%;">
										<p>1</p>
									</td>
									<td style="width: 30%;">
										<p>Expected Monthly sales (In Taka) :</p>
									</td>
									<td class="text-center view">'.$m1_sales[0].'</td>
									<td class="text-center view">'.$m2_sales[0].'</td>
									<td class="text-center view">'.$m3_sales[0].'</td>
									<td class="text-center view">'.$m4_sales[0].'</td>
									<td class="text-center view">'.$m5_sales[0].'</td>
									<td class="text-center view">'.$m6_sales[0].'</td>
									<td class="text-center view">'.$m7_sales[0].'</td>
								</tr>
								<tr>
									<td style="width: 2.5%;">
										<p>2</p>
									</td>
									<td style="width: 30%;">
										<p>Expected Number of Freezers Injection :</p>
									</td>
									<td class="text-center view">'.$m1_inj[0].'</td>
									<td class="text-center view">'.$m2_inj[0].'</td>
									<td class="text-center view">'.$m3_inj[0].'</td>
									<td class="text-center view">'.$m4_inj[0].'</td>
									<td class="text-center view">'.$m5_inj[0].'</td>
									<td class="text-center view">'.$m6_inj[0].'</td>
									<td class="text-center view">'.$m7_inj[0].'</td>
								</tr>';

				$part6_body .='<tr>
									<td style="width: 25%;">
										<p>Total Investment (Tk) :</p>
									</td>
									<td class="text-center view" style="width: 25%;">'.$row["total_inv"].'</td>
									<td style="width: 25%;">
										<p>Initial Lifting (in Tk) :</p>
									</td>
									<td class="text-center view" style="width: 25%;">'.$row["init_lifting"].'</td>
								</tr>

								<tr>
									<td style="width: 25%;">
										<p>Number of SDFs :</p>
									</td>
									<td class="text-center view" style="width: 25%;">'.$row["num_SDF"].'</td>
									<td style="width: 25%;">
										<p>Godown Advance (Tk) :</p>
									</td>
									<td class="text-center view" style="width: 25%;">'.$row["gd_adv"].'</td>
								</tr>

								<tr>
									<td style="width: 25%;">
										<p>Value of SDFs (Tk) :</p>
									</td>
									<td class="text-center view" style="width: 25%;">'.$row["val_SDF"].'</td>
									<td style="width: 25%;">
										<p>Market Credit :</p>
									</td>
									<td class="text-center view" style="width: 25%;">'.$row["m_credit"].'</td>
								</tr>

								<tr>
									<td style="width: 25%;">
										<p>Number of Van(s) :</p>
									</td>
									<td class="text-center view" style="width: 25%;">'.$row["num_vans"].'</td>
									<td style="width: 25%;">
										<p>Running Capital :</p>
									</td>
									<td class="text-center view" style="width: 25%;">'.$row["run_capital"].'</td>
								</tr>

								<tr>
									<td style="width: 25%;">
										<p>Value of Vans (Tk) :</p>
									</td>
									<td class="text-center view" style="width: 25%;">'.$row["val_vans"].'</td>
									<td style="width: 25%;">
										<p>Type of Transaction :</p>
									</td>
									<td class="text-center view" style="width: 25%;">'.$row["transac_type"].'</td>
								</tr>';

				$part7_textarea.='<div class="row">
									<label for="add_rsm_recom" style="padding-left: 0px;">
										<h6 id="heading">RSM'."'".'s (or ASM in absence of RSM) Recommendation:</h6>
									</label>
									<textarea class="view">'.$row["rsm_recom"].'</textarea>

									<label for="add_gm_recom" style="padding-left: 0px;">
										<h6 id="heading">GM/DGM/AGM'."'".'s Recommendation:</h6>
									</label>
									<textarea class="view">'.$row["gm_recom"].'</textarea>
								</div>';

				$image .= '<img src="../../assets/uploads/distributors/distributor_image/'.$row['o_image'].'" style="width: 100px; height: 134px;" alt="Distributor Photo">';
			}
		}
		return ['ref'=>$part_ref, 't1'=>$part1_body, 't2'=>$part2_body, 't3'=>$part3_body, 't4h'=>$part4_head, 't4b'=>$part4_body, 't5h'=>$part5_head, 't5b'=>$part5_body, 't6'=>$part6_body, 't7'=>$part7_textarea, 'image'=>$image, 'area_dem'=>$area_dem, 'routes'=>$routes];
	}

	// distributors_table_modal_add modal -->[ main purpose to find the selected org_id and display RSM/ASM/FRP in select tag in Distributor table add modal ]
    function getSelectedHTML_add_EMP_List($sql,$bodyOnly=1){
        global $con, $uid, $dept_id, $data;
		
		try
		{
			$bHTML = '';
			$bHTML .= '<option value="" selected disabled>-- Select --</option>';

			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
			{
				if($row['org_id'] == $data){
					$bHTML = $bHTML . '<option value="'.$row['id'].'" >'.$row['emp_code']." - ".$row['name'].' ('.$row['desig_id'].')</option>';
				}
				else{
					$bHTML = $bHTML . '';
				}
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
    }

	// distributors_table_modal_edit modal -->[ main purpose to find the selected org_id and display RSM/ASM/FRP in select tag in Distributor table edit modal ]
    function getSelectedHTML_edit_EMP_List($sql,$bodyOnly=1){
        global $con, $uid, $dept_id, $data;
		
		try
		{
			$bHTML = '';
			$bHTML .= '<option value="" disabled>-- Select --</option>';

			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
			{
				if($row['org_id'] == $data){
					$bHTML = $bHTML . '<option value="'.$row['id'].'" '."selected".' >'.$row['emp_code']." - ".$row['name'].' ('.$row['desig_id'].')</option>';
				}
				else{
					$bHTML = $bHTML . '';
				}
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
    }

	// distributors_table_modal_edit modal -->[ main purpose to add the routes and display in select2 in Distributor table edit modal ]
	function getSelectedHTML_routes($sql,$bodyOnly=1){
        global $con, $uid, $dept_id, $data;
		
		try
		{
			$bHTML = '';
			$bHTML .= '<option value="" disabled>-- Select --</option>';

			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				// checking [areas table(id column) is equivalent to territories table(area coloumn)] is selected
				// If selected then fetch all the territory table (name coloumn)
				if($row['is_active'] == 1){
					$bHTML = $bHTML . '<option value="'.$row['id'].'" onclick=selected>'.$row['code'].' - '.$row['name'].'</option>';
				}
				else{
					$bHTML = $bHTML . '';
				}
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
    }

	// distributors_table_modal_edit modal -->[ main purpose to edit the routes list and display in select2 in Distributor table edit modal ]
	function getSelectedHTML_dist_edit_routes_list($sql,$bodyOnly=1){
		global $con, $uid, $dept_id, $data;
		try
		{
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			
			if($row['id'] = $data){
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
				{
					$r = $row['routes'];
					$routes = explode(",",$r);
				}

				$bHTML = '';
				$bHTML .= '<option value="" disabled>-- Select --</option>';

				$query = " SELECT routes.* FROM routes WHERE is_active = 1 ";
				//distributors.is_active AS distri_status LEFT JOIN distributors ON (routes.is_active = distributors.is_active) 
				$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				$stmt->execute();

				while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
				{
					// checking [areas table(id column) is equivalent to territories table(area coloumn)] is selected
					// If selected then fetch all the territory table (name coloumn)
					if(in_array($row['id'],$routes)){
						//'.in_array($row['id'],$routes) ?"selected" : "" .'
						$bHTML = $bHTML . '<option value="'.$row['id'].'" '."selected".' >'.$row['code'].' - '.$row['name'].'</option>';
					}
					else{
						$bHTML = $bHTML . '<option value="'.$row['id'].'">'.$row['code'].' - '.$row['name'].'</option>';
					}
				}
				$rHTML = $bHTML;
			}
		}
		catch (PDOException $e)
		{
			$e->getMessage();
		}
		return $rHTML;
	}

	// distributors_table_modal_edit modal -->[ main purpose to add the areas and display in select2 in Distributor table edit modal ]
	function getSelectedHTML_dist_areas($sql,$bodyOnly=1){
		global $con, $filter;
		try
		{
			$bHTML = '';
			$bHTML .= '<option value="" disabled>-- Select --</option>';

			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				// checking [areas table(id column) is equivalent to territories table(area coloumn)] is selected
				// If selected then fetch all the territory table (name coloumn)
				if($row['id'] == $row['area']){
					$bHTML = $bHTML . '<option value="'.$row['id'].'" onclick=selected>'.$row['code'].' - '.$row['name'].'</option>';
				}
				else{
					$bHTML = $bHTML . '';
				}
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}

	// distributors_table_modal_edit modal -->[ main purpose to edit the area list and display in select2 in Distributor table edit modal ]
	function getSelectedHTML_dist_edit_areas_list($sql,$bodyOnly=1){
		global $con, $uid, $dept_id, $data;
		try
		{
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			
			if($row['distributor.id'] = $data){
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
				{
					$areas = $row['distri_area'];
					$distri_area = explode(",",$areas);
				}

				$bHTML = '';
				$bHTML .= '<option value="" disabled>-- Select --</option>';

				$query = "SELECT areas.*, region_wise_distri.id AS region_id, region_wise_distri.depot AS depot, region_wise_distri.area AS area, region_wise_distri.distri AS distributor, distributors.id AS distri_id, distributors.area_dem AS distri_area FROM areas LEFT JOIN region_wise_distri ON (areas.id = region_wise_distri.area) LEFT JOIN distributors ON (region_wise_distri.distri = distributors.id) WHERE areas.is_active = 1 GROUP BY code ";
				$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				$stmt->execute();

				while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
				{
					// checking [areas table(id column) is equivalent to territories table(area coloumn)] is selected
					// If selected then fetch all the territory table (name coloumn)
					if($row['id'] == $row['area']){
						$bHTML = $bHTML . '<option value="'.$row['id'].'" '.(in_array($row['id'],$distri_area) ? "selected" : "").' > 
						'.$row['code'].' - '.$row['name'].'
						
						</option>';
					}
					else{
						$bHTML = $bHTML . '';
					}
				}
				$rHTML = $bHTML;
			}
		}
		catch (PDOException $e)
		{
		$e->getMessage();
		}
		return $rHTML;
	}

	// distributors_table_modal_view modal -->[ main purpose to view the emp_list code, name, designation list and display in select2 in Distributor table view modal ]
	function getSelectedHTML_dist_emp_view_list($sql,$bodyOnly=1){
		global $con, $filter;

			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$code = $row['emp_code'];
				$name = $row['name'];
				$desig = $row['desig'];
			
				$rsm = '<td style="width: 25%;" ><p>RSM :</p></td>
						<td class="text-center view"><p>'.$code.' - '.$name.' ('.$desig.')</p></td>';

				$asm = '<td style="width: 25%;"><p>ASM / Sr. ASM :</p></td>
						<td class="text-center view"><p>'.$code.' - '.$name.' ('.$desig.')</p></td>';
				
				$fpr = '<td style="width: 25%;"><p>FPR :</p></td>
						<td class="text-center view"><p>'.$code.' - '.$name.' ('.$desig.')</p></td>';
				
			}
			return ['rsm'=>$rsm, 'asm'=>$asm, 'fpr'=>$fpr];
	}

	// distributors_table_modal_view modal -->[ main purpose to view the area_list code, name list and display in select2 in Distributor table view modal ]
	function getSelectedHTML_dist_area_names($sql,$bodyOnly=1){
		global $con, $filter, $data;

		$area_dem = '';
		$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt->execute();

		$areas = explode(",",$data);
		// print_r($areas);

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
		{
			if(in_array($row['id'], $areas)){
				$area_dem .= $row['code']. " - " .$row['name'] . ", ";
			}
			else{
				$area_dem = $area_dem . '';
			}
		}
		$a = substr_replace($area_dem ,"",-2);
		return ['a'=>$a];
	}

	// distributors_table_modal_view modal -->[ main purpose to view the area_list code, name list and display in select2 in Distributor table view modal ]
	function getSelectedHTML_dist_routes_names($sql,$bodyOnly=1){
		global $con, $filter, $data;

		$routes = '';
		$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt->execute();

		$rt = explode(",",$data);
		// print_r($rt);

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
		{
			if(in_array($row['id'], $rt)){
				$routes .= $row['code']. " - " .$row['name'] . ", ";
			}
			else{
				$routes .= '';
			}
		}
		$r = substr_replace($routes ,"",-2);
		return ['r'=>$r];
	}


	//----------------------------------------------------------------------------------------
	//-----------------------Routes Table Functions start-------------------------------------
	//----------------------------------------------------------------------------------------


	// Routes_table_view -->[ main purpose is to fetch table data in the routes table ]
	function getTableHTML_routes_table($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$bHTML = '';
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$counter = 1;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$bHTML .= ' <tr>
                                <td><p>'.$counter++.'</td>
                                <td><p>'.$row["code"].'</td>
                                <td><p>'.$row["name"].'</td>
                                <td><p>'.$row["definition"].'</td>
                                <td><p>'.($row["is_active"]==0 ? "Out Of Service" : "Active").'</td>
                                <td class="text-end">    
                                    <a class="btn p-0" data-toggle="tooltip" data-placement="bottom" title="Edit" data-id='.$row["id"].' id="btn_edit">
                                        <i class="fas fa-pencil-alt font-13"></i>
                                    </a>
                                </td>
                            </tr>';
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}

	// Routes_table_modal_edit_view -->[ main purpose is to fetch all the data of the input fields in the modal edit ]
	function getTableHTML_routes_SelectedID($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
			
			$rHTML = $row;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}


	//-----------------------------------------------------------------------------------------
	//-----------------------Outlets Table Functions start-------------------------------------
	//-----------------------------------------------------------------------------------------

	// Routes_table_view -->[ main purpose is to fetch table data in the routes table ]
	function getTableHTML_outlets_table($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$bHTML = '';
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$counter = 1;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$bHTML .= ' <tr>
                                <td><p>'.$counter++.'</td>
                                <td><p>'.$row["name"].'</td>
                                <td><p>'.$row["address"].'</td>
								<td><p>'.$row["owner_name"].'</td>
                                <td><p>'.($row["is_approved"]==0 ? "No" : "Yes").'</td>
                                <td><p>'.($row["is_active"]==0 ? "Out Of Service" : "Active").'</td>
                                <td>
									<a class="btn p-0" data-toggle="tooltip" data-placement="bottom" title="View" data-id='.$row["id"].' id="btn_view">
										<i class="fas fa-eye font-13"></i>
                                    </a>  
                                    <a contentEditable="true" tabindex="0" class="focusable btn p-0" data-toggle="tooltip" data-placement="bottom" title="Edit" data-id='.$row["id"].' id="btn_edit">
                                        <i class="fas fa-pencil-alt font-13"></i>
                                    </a>
                                </td>
                            </tr>';
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}

	// Routes_table_modal_edit_view -->[ main purpose is to fetch all the data of the input fields in the modal edit ]
	function getTableHTML_outlets_fetch_SelectedID($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
			
			$rHTML = $row;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}

	// outlets_table_add_modal -->[ main purpose to add the distributors and display in select2 in Outlets table add modal ]
	function getSelectedHTML_distributor_names($sql,$bodyOnly=1){
        global $con, $uid, $dept_id;
		
		try
		{
			$bHTML = '';
			$bHTML .= '<option value="" disabled>-- Select --</option>';

			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				if($row['is_active'] == 1){
					$bHTML = $bHTML . '<option value="'.$row['id'].'" onclick=selected>'.$row['code'].' - '.$row['name'].'</option>';
				}
				else{
					$bHTML = $bHTML . '';
				}
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
    }

	// distributors_table_modal_edit_view -->[ main purpose is to fetch all the data of the input fields in the modal edit & modal view ]
	function getTableHTML_outlets_distributors_SelectedID($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
                $distributors = $row['distributor'];
				$routes = $row['routes'];
			}
			return ['distributors'=>$distributors , 'routes'=>$routes ];
		}
		catch (PDOException $e) 
		{
			$e->getMessage();
		}
	}

	// distributors_table_modal_view modal -->[ main purpose to view the area_list code, name list and display in select2 in Distributor table view modal ]
	function getSelectedHTML_outlets_distributor_names($sql,$bodyOnly=1){
		global $con, $filter, $data;

		$distributors = '';
		$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt->execute();

		$ds = explode(",",$data);
		// print_r($ds);

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
		{
			if(in_array($row['id'], $ds)){
				$distributors .= $row['code']. " - " .$row['name'] . ", ";
			}
			else{
				$distributors .= '';
			}
		}
		$d = substr_replace($distributors ,"",-2);
		return ['d'=>$d];
	}

	// distributors_table_modal_view -->[ main purpose is to fetch all the data of the input fields in the modal view ]
	function getTableHTML_outlets_view($sql,$bodyOnly=1){
		global $con, $uid, $dept_id, $data;

		$part1_body = ''; $distributor=''; $routes ='';
		$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
		{
			$distributor = $row['distributor']; 
			$routes = $row['routes']; 

			if($row["id"] == $data) {
				$part1_body .= ' <tr>
								<td style="width: 25%;"><p>Name :</p></td>
								<td class=" view"><p>'.$row['name'].'</p></td>
							</tr>
							<tr>
								<td style="width: 25%;"><p>Address :</p></td>
								<td class=" view"><p>'.$row['address'].'</p></td>
							</tr>
							<tr>
								<td style="width: 25%;"><p>Owner Name :</p></td>
								<td class=" view"><p>'.$row["owner_name"].'</p></td>
							</tr>
							<tr>
								<td style="width: 25%;"><p>Owner Contact 1 :</p></td>
								<td class=" view"><p>'.$row["owner_contact_1"].'</p></td>
							</tr>
							<tr>
								<td style="width: 25%;"><p>Owner Contact 2 :</p></td>
								<td class=" view"><p>'.$row["owner_contact_2"].'</p></td>
							</tr>
							<tr>
								<td style="width: 25%;"><p>Business Contact 1 :</p></td>
								<td class=" view"><p>'.$row["business_contact_1"].'</p></td>
							</tr>
							<tr>
								<td style="width: 25%;"><p>Business Contact 2 :</p></td>
								<td class=" view"><p>'.$row["business_contact_2"].'</p></td>
							</tr>
							<tr>
								<td style="width: 25%;"><p>Distributor:</p></td>
								<td class="view" id="distri"></td>
							</tr>
							<tr>
								<td style="width: 25%;"><p>Routes :</p></td>
								<td class="view" id="route"></td>
							</tr>';
			}
			return [ 't1'=>$part1_body, 'ds'=>$distributor, 'rs'=>$routes];
		}
	}

	// outlets_table_modal_edit modal -->[ main purpose to edit the distributors list and display in select2 in outlets table edit modal ]
	function getSelectedHTML_outlets_edit_distributors_list($sql,$bodyOnly=1){
		global $con, $uid, $dept_id, $data;
		try
		{
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			
			if($row['id'] = $data){
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
				{
					$ds = $row['distributor'];
					$distri_arr = explode(",",$ds);
				}

				$bHTML = '';
				$bHTML .= '<option value="" disabled>-- Select --</option>';

				$query = " SELECT distributors.* FROM distributors WHERE is_active = 1 ";
				$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				$stmt->execute();

				while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
				{
					// checking if the distributors table (id === to the id's stored in distri array) from outlets table distributor
					if(in_array($row['id'], $distri_arr)){
						$bHTML = $bHTML . '<option value="'.$row['id'].'" '."selected".' >'.$row['code'].' - '.$row['name'].'</option>';
					}
					else{
						$bHTML = $bHTML . '<option value="'.$row['id'].'">'.$row['code'].' - '.$row['name'].'</option>';
					}
				}
				$rHTML = $bHTML;
			}
		}
		catch (PDOException $e)
		{
			$e->getMessage();
		}
		return $rHTML;
	}

	// outlets_table_modal_edit modal -->[ main purpose to edit the distributors list and display in select2 in outlets table edit modal ]
	function getSelectedHTML_outlets_edit_routes_list($sql,$bodyOnly=1){
		global $con, $uid, $dept_id, $data;
		try
		{
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			
			if($row['id'] = $data){
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
				{
					$r = $row['routes'];
					$route_arr = explode(",",$r);
				}

				$bHTML = '';
				$bHTML .= '<option value="" disabled>-- Select --</option>';

				$query = " SELECT routes.* FROM routes WHERE is_active = 1 ";
				$stmt = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				$stmt->execute();

				while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
				{
					// checking if the routes table (id === to the id's stored in routes array) from outlets table routes
					if(in_array($row['id'], $route_arr)){
						$bHTML = $bHTML . '<option value="'.$row['id'].'" '."selected".' >'.$row['code'].' - '.$row['name'].'</option>';
					}
					else{
						$bHTML = $bHTML . '<option value="'.$row['id'].'">'.$row['code'].' - '.$row['name'].'</option>';
					}
				}
				$rHTML = $bHTML;
			}
		}
		catch (PDOException $e)
		{
			$e->getMessage();
		}
		return $rHTML;
	}

	
	//-----------------------------------------------------------------------------------------
	//-------------------------Opening Balance Table Functions start---------------------------
	//-----------------------------------------------------------------------------------------


	// opening_balance_table_view -->[ main purpose is to fetch table data in the opening_balance table ] 
	// + edit live data =>[edit_balance]
	function getTableHTML_open_bal_table($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$bHTML = '';
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$counter = 1;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$bHTML .= ' <tr>
                                <td><p>'.$counter++.'</td>
								if('.$row["distributor"].' = '.$row["distri_id"].'){
									<td>
										<input type="text" name="edit_distributors[]" id="edit_distributors" value="'.$row["distri_id"].'" hidden>
										<p>'.$row["distri_name"].'</p>
									</td>
								}
                                <td class="text-center">
									<input style="width: 30%;" type="text" name="edit_balance[]" id="edit_balance" placeholder="Edit Balance" data-id= "'.$row['id'].'" value= "'.$row['open_bal'].'" >
									<p style = "display: none;">'.$row["open_bal"].'</p>
								</td>
                            </tr>';
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		return $rHTML;
	}
	
	//-----------------------------------------------------------------------------------------
	//-----------------------Distributors Target Table Functions start ------------------------
	//-----------------------------------------------------------------------------------------

	// distri_target_table_view -->[ main purpose is to fetch table data in the distri_target table ] 
	function getTableHTML_distri_target_table($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$bHTML = '';
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$counter = 1;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$bHTML .= ' <tr>
                                <td><p>'.$counter++.'</p></td>
                                <td><p>'.$row["name"].'</p></td>
                                <td><p>'.$row["eff_from"].'</p></td>
								<td><p>'.$row["eff_till"].'</p></td>
                                <td><p>'.($row["is_active"]==0 ? "Out Of Service" : "Active").'</p></td>
                                <td class="text-center">
									<a class="btn p-0"  data-toggle="tooltip" data-placement="bottom" title="View & Live Edit" data-id='.$row["id"].' id="btn_view">
										<i class="fas fa-eye font-13"></i>
                                    </a>
									<a class="btn p-0"  data-toggle="tooltip" data-placement="bottom" title="Edit" data-id='.$row["id"].' id="btn_edit">
                                        <i class="fas fa-pencil-alt font-13"></i>
                                    </a>
                                </td>
                            </tr>';
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}
	
	// distri_target_table_view_modal -->[ main purpose is to fetch all the data of the input fields in the modal view ]
	function getTableHTML_distri_target_SelectedID($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
			
			$rHTML = $row;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}
	
	// distri_target_table_view_modal -->[ main purpose is to fetch all the data of the input fields in the modal view ]
	function getTableHTML_name_SelectedID($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
	
			$bHTML = ''; 
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$counter = 1;
			$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
			
			$rHTML = $row;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}

	// distri_target_details_table_view -->[ main purpose is to fetch table data in the distri_target_details table ] 
	// + edit live data =>[amount]
	function getTableHTML_distributors_trade_details_table($sql,$bodyOnly=1){
		global $con, $uid, $dept_id, $data;
		try
		{
			$bHTML = '';
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$counter = 1;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$bHTML .= ' <tr>
                                <td><p>'.$counter++.'</td>
								if('.$data.' == '.$row["target"].'){
									<td>
										<input type="text" name="edit_distributors[]" id="edit_distributors" value="'.$row["distri_id"].'" hidden>
										<p>'.$row["distri_name"].'</p>
									</td>
									<td>
										<p>'.$row["region_name"].'</p>
									</td>
									<td>
										<p>'.$row["depot_name"].'</p>
									</td>
									<td>
										<p>'.$row["area_name"].'</p>
									</td>
									<td>
										<p>'.$row["territorry_name"].'</p>
									</td>
								
									<td class="text-center">
										<input style="width: 80%;" type="text" name="edit_amount[]" id="edit_amount" placeholder="Edit Amount" data-id= "'.$row['id'].'" value= "'.$row['amount'].'" >
										<p style = "display: none;">'.$row["amount"].'</p>
									</td>
								}
                            </tr>';
			}
			// if('.$row[""].' = '.$row["target"].'){
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		return $rHTML;
	}
	

	// distri_target_details_table_view_search_region_name -->[ main purpose is to search region names data in the view_distri_target modal table ]
	function getTableHTML_Distri_target_details_search_region_names_SelectedID($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$bHTML = '';
			$bHTML .= '<option value="" selected disabled>-- Filter Regions --</option>';

			// '."selected".'
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$bHTML = $bHTML . '<option value="'.$row['region_id'].'" onclick= '."selected".' >'.$row['region_name'].'</option>';
			}
			$rHTML = $bHTML;
			
		}
		catch (PDOException $e)
		{
			$e->getMessage();
		}
		return $rHTML;
	}


	// search using region_id in view modal table
	function getTableHTML_search_region_SelectedID($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$bHTML = '';
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$counter = 1;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$bHTML .= ' <tr>
                                <td><p>'.$counter++.'</td>
								
									<td>
										<input type="text" name="edit_distributors[]" id="edit_distributors" value="'.$row["distri_id"].'" hidden>
										<p>'.$row["distri_name"].'</p>
									</td>
									<td>
										<p>'.$row["region_name"].'</p>
									</td>
									<td>
										<p>'.$row["depot_name"].'</p>
									</td>
									<td>
										<p>'.$row["area_name"].'</p>
									</td>
									<td>
										<p>'.$row["territorry_name"].'</p>
									</td>
								
									<td class="text-center">
										<input style="width: 80%;" type="text" name="edit_amount[]" id="edit_amount" placeholder="Edit Amount" data-id= "'.$row['id'].'" value= "'.$row['amount'].'" >
										<p style = "display: none;">'.$row["amount"].'</p>
									</td>
								
                            </tr>';
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		return $rHTML;

	}

	// distri_target_details_table_view_search_depot_name -->[ main purpose is to search depot names data in the view_distri_target modal table ]
	function getTableHTML_Distri_target_details_search_depot_names_SelectedID($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$bHTML = '';
			$bHTML .= '<option value="" selected disabled>-- Filter Depots --</option>';

			// '."selected".'
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$bHTML = $bHTML . '<option value="'.$row['depot_id'].'" onclick= '."selected".' >'.$row['depot_name'].'</option>';
			}
			$rHTML = $bHTML;
			
		}
		catch (PDOException $e)
		{
			$e->getMessage();
		}
		return $rHTML;
	}

	// distri_target_details_table_view_search_area_name -->[ main purpose is to search area names data in the view_distri_target modal table ]
	function getTableHTML_Distri_target_details_search_area_names_SelectedID($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$bHTML = '';
			$bHTML .= '<option value="" selected disabled>-- Filter Areas --</option>';

			// '."selected".'
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$bHTML = $bHTML . '<option value="'.$row['area_id'].'" onclick= '."selected".' >'.$row['area_name'].'</option>';
			}
			$rHTML = $bHTML;
			
		}
		catch (PDOException $e)
		{
			$e->getMessage();
		}
		return $rHTML;
	}

	// distri_target_details_table_view_search_territory_name -->[ main purpose is to search territory names data in the view_distri_target modal table ]
	function getTableHTML_Distri_target_details_search_territory_names_SelectedID($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$bHTML = '';
			$bHTML .= '<option value="" selected disabled>-- Filter Territories --</option>';

			// '."selected".'
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$bHTML = $bHTML . '<option value="'.$row['territory'].'" onclick= '."selected".' >'.$row['territorry_name'].'</option>';
			}
			$rHTML = $bHTML;
			
		}
		catch (PDOException $e)
		{
			$e->getMessage();
		}
		return $rHTML;
	}


	//-----------------------------------------------------------------------------------------
	//------------------------------ Apps Table Functions start -------------------------------
	//-----------------------------------------------------------------------------------------


	// apps_table_view -->[ main purpose is to fetch table data in the apps table ] 
	function getTableHTML_apps_table($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$bHTML = '';
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$counter = 1;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$bHTML .= ' <tr>
                                <td><p>'.$counter++.'</p></td>
                                <td><p>'.$row["name"].'</p></td>
                                <td><p>'.$row["display_name"].'</p></td>
								<td><p>'.$row["link"].'</p></td>
                                <td><p>'.($row["is_active"]==0 ? "Out Of Service" : "Active").'</p></td>
                                <td class="text-center">
									<a class="btn p-0" data-toggle="tooltip" data-placement="bottom" title="Edit" data-id='.$row["id"].' id="btn_edit">
										<i class="fas fa-pencil-alt font-13"></i>
									</a>
									<a class="func btn p-0" data-toggle="tooltip" data-placement="bottom" title="App Functions" func-id='.$row["id"].' id="btn_add_func">
										<i class="align-self-center fa fa-plus icon-xs"></i>
									</a>
									<a class="emp btn p-0" data-toggle="tooltip" data-placement="bottom" title="App Permissions" emp-id='.$row["id"].' id="btn_add_emp">
										<i class="align-self-center fa fa-plus icon-xs"></i>
									</a>
                                </td>
                            </tr>';
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}

	// apps_table_modal_edit_view -->[ main purpose is to fetch all the data of the input fields in the modal edit ]
	function getTableHTML_apps_SelectedID($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
			$rHTML = $row;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}

	// apps_table_add_modal -->[ main purpose to add the functions (name) and display in select2 ]
	function getSelectedHTML_function_names($sql,$bodyOnly=1){
        global $con, $uid, $dept_id;
		
		try
		{
			$bHTML = '';
			$bHTML .= '<option value="" disabled> -- Select -- </option>';

			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$bHTML = $bHTML . '<option value="'.$row['name'].'" onclick= '."selected".' >'.$row['name'].'</option>';
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
    }

	// apps_table_modal_view modal -->[ main purpose to view the emp_list code, name, designation list and display in select2 ]
	function getSelectedHTML_apps_emp_list($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		
		try
		{
			$bHTML = '';
			$bHTML .= '<option value="" disabled>-- Select --</option>';

			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$code = $row['emp_code'];
				$name = $row['name'];
				$desig = $row['desig'];
			
				$bHTML = $bHTML . '<option value="'.$row['id'].'" onclick= '."selected".' >'.$code.' - '.$name.' ('.$desig.')</option>';
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}

	// apps_table_modal_view modal -->[ main purpose to view the emp_list code, name, designation list and display in select2 ]
	function getSelectedHTML_apps_list($sql,$bodyOnly=1){
		global $con, $filter;

		try
		{
			$bHTML = '';
			$bHTML .= '<option value="" selected disabled> -- Select -- </option>';

			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$bHTML = $bHTML . '<option value="'.$row['id'].'" onclick= '."selected".' >'.$row['display_name'].'</option>';
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		return $rHTML;
	}

	
	// apps_table_add_modal -->[ main purpose to add the functions(name) for selected app id and display in select2 ]
	function getSelectedHTML_function_filter_names_SelectedID($sql,$bodyOnly=1){
        global $con, $uid, $dept_id, $data;
		
		try
		{
			$bHTML = '';
			$bHTML .= '<option value="" disabled> -- Select -- </option>';

			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				if($row['app'] == $data){
					$bHTML = $bHTML . '<option value="'.$row['id'].'" onclick= '."selected".' >'.$row['name'].'</option>';
				}
				else{
					$bHTML = $bHTML . '';
				}
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
    }

	
	//-----------------------------------------------------------------------------------------
	//------------------------------ Product Category Table Functions start -------------------------------
	//-----------------------------------------------------------------------------------------
	
	// product_categories_table_view -->[ main purpose is to fetch table data in the product_categories table ] 
	function getSelectedHTML_product_categories_table($sql,$bodyOnly=1){
		global $con, $uid, $dept_id, $org_id;
			$bHTML = '';
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			
			$counter = 1;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$sub_of = $row['sub_of'];

				$query = "SELECT * FROM productcategories WHERE id = $sub_of AND org_id = ".$org_id;
				$stmt_1 = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				$stmt_1->execute();
				$row_1 = $stmt_1->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);

				if($sub_of == '0'){
					$name = " --- ";
				}
				else {
					$name = $row_1["name"];		
				}
				
				$bHTML .= '<tr>
							<td><p>'.$counter++.'</p></td>
							<td><p>'.$row["name"].'</p></td>
							<td><p>'.$name.'</p></td>
							<td><p>'.($row["is_active"]==0 ? "Out Of Service" : "Active").'</p></td>
							<td class="text-center">
								<a class="btn p-0" data-toggle="tooltip" data-placement="bottom" title="Edit" data-id='.$row['id'].' id="btn_edit">
									<i class="fas fa-pencil-alt font-13"></i>
								</a>
							</td>
                        </tr>';
		}
		return $bHTML;
	}

	// apps_table_modal_edit_view -->[ main purpose is to fetch all the data of the input fields in the modal edit ]
	function getSelectedHTML_main_product_names_add($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		
		try
		{
			$bHTML = '';
			$bHTML .= '<option value="0" selected>-- Select --</option>';

			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$name = $row['name'];
				$bHTML = $bHTML . '<option value="'.$row['id'].'" onclick= '."selected".' >'.$name.'</option>';
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}

	// apps_table_modal_edit_view -->[ main purpose is to fetch all the data of the input fields in the modal edit ]
	function getTableHTML_product_catergoties_SelectedID($sql,$bodyOnly=1){
		global $con, $uid, $dept_id;
		try
		{
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
			$rHTML = $row;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}
	
	// apps_table_modal_edit_view -->[ main purpose is to fetch all the data of the input fields in the modal edit ]
	function getSelectedHTML_main_product_names_edit_selectedID($sql,$bodyOnly=1){
		global $con, $uid, $dept_id, $org_id;
		
		try
		{
			$stmt = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();

			$bHTML = '';
			$bHTML .= '<option value="0" selected></option>';

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$sub_of = $row['sub_of'];

				$query = "SELECT * FROM productcategories WHERE sub_of = 0 AND  is_active = 1 AND  org_id = ".$org_id;
				$stmt_1 = $con->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				$stmt_1->execute();
				while($row_1 = $stmt_1->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){
					if($sub_of == $row_1['id']) {
						$bHTML = $bHTML . '<option value="'.$row_1['id'].'" selected >'.$row_1['name'].'</option>';
					}
					else{
						$bHTML = $bHTML . '<option value="'.$row_1['id'].'" >'.$row_1['name'].'</option>';
					}
				}
			}
			$rHTML = $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}
	
	//------------------------------------------------------------------------------------------------
	//-------------------------------------- functions end -------------------------------------------
	//------------------------------------------------------------------------------------------------

?>