<?php 
	session_start();
	$uid = $_SESSION["userId"];
	$org_id = $_SESSION["org_id"];

	if($_SERVER['REQUEST_METHOD'] == "POST") {

		include('connection.php');

        $edit_id = $_POST['edit_id'];

        $open_bal =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_balance']);

        $query = " UPDATE `opening_balance`  SET `open_bal` = '$open_bal' WHERE `id` = '$edit_id' " ; 

        //prepare the query
        $stmt = $con->prepare($query);
        // execute the query
        $result  = $stmt->execute();

        if($result  == 'true'){
            echo "Record Updated Successfully";
        }
        else{
            echo "Error Occured !!!";
        }
    }

?>