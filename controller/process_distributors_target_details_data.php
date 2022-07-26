<?php 
	session_start();
	$uid = $_SESSION["userId"];
	$org_id = $_SESSION["org_id"];

	if($_SERVER['REQUEST_METHOD'] == "POST") {

		include('connection.php');

        $edit_id = $_POST['edit_id'];

        $edit_amount =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_amount']);

        $query = " UPDATE `distri_target_details`  SET `amount` = '$edit_amount' WHERE `id` = '$edit_id' " ; 

        //prepare the query
        $stmt = $con->prepare($query);
        // execute the query
        $result  = $stmt->execute();

        if($result  == 'true'){
            echo "true";
        }
        else{
            echo "Error Occured !!!";
        }
    }

?>