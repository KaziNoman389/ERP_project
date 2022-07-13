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
	
	$req = isset($_POST['req']) ? $_POST['req'] : 2;
	$param = isset($_POST['param']) ? $_POST['param'] : 7;
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
		case '1': // Request for region list
			$table = 'regions';
			break;
	}



	//------------------------------------------------------------------------------------------------
	//-----------------------------------------------param--------------------------------------------
	//------------------------------------------------------------------------------------------------


	switch($param)
	{
		case '1': // Request for region list
			$sql = 'SELECT `id`, `code`, `name`, `definition`, `is_active`, `org_id` FROM `regions` WHERE org_id = '.$org_id.' ORDER BY `code` ASC';
			$return_data = getTableHTML_regions($sql,true);
			break;

		case '2': // Request for region list
			$sql = 'SELECT `id`, `code`, `name`, `definition`, `is_active`, `org_id` FROM `regions` WHERE id = '.$data.' ORDER BY `code` ASC';
			$return_data = getTableHTML_regions_SelectedID($sql,true);
			break;
	}

	//------------------------------------------------------------------------------------------------
	//------------------------------------------param ends--------------------------------------------
	//------------------------------------------------------------------------------------------------
	echo json_encode($return_data);



	//------------------------------------------------------------------------------------------------
	//--------------------------------------functions start-------------------------------------------
	//------------------------------------------------------------------------------------------------


	function getTableHTML_regions($sql,$bodyOnly=1)
	{
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
                                <td><p>'.($row["is_active"]==0 ? "Out Of Service" : "Active").'</td>
                                <td class="text-end">    
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


	function getTableHTML_regions_SelectedID($sql,$bodyOnly=1)
	{
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

?>