<?php 
	session_start();
	$uid = $_SESSION["userId"];
	$org_id = $_SESSION["org_id"];

	if($_SERVER['REQUEST_METHOD'] == "POST") {


		include('connection.php');
        //get operation
		// $oper = $_POST['oper'];

        // if($oper == 'edit'){
        
            $edit_id = $_POST['edit_id'];

            // for($i=0; $i<count($_POST['edit_distributors']); $i++) {

            //     $data2['edit_balance'] = $_POST['edit_balance'][$i];
            //     $open_bal =  preg_replace('/[^A-Za-z0-9. -]/', '',$data2['edit_balance']);

                $open_bal =  preg_replace('/[^A-Za-z0-9. -]/', '',$_POST['edit_balance']);

                $query = " UPDATE `opening_balance`  SET `open_bal` = '$open_bal' WHERE `id` = '$edit_id' " ; 

                //prepare the query
                $stmt = $con->prepare($query);
                // execute the query
                $result  = $stmt->execute();
            // }
            if($result  == 'true'){
                    echo 'true';
            }
            // if ($result === TRUE) {
            //     echo "New record created successfully";
            // } else {
            //     echo "Error occured";
            // }
        }
    // }

?>