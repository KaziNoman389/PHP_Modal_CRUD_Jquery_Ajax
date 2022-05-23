<?php 

if($_SERVER['REQUEST_METHOD'] == "POST") {

	include('../database.php');
        $emp_id = preg_replace('/\s+/', '', $_POST['req_id']);

        $query = "UPDATE `employee` SET `status`= 0  WHERE id = '$emp_id' ";;

        // echo $query;
        $stmt = $connection->prepare($query);

        // execute the query
        $stmt->execute();

        echo $stmt->rowCount() . " records UPDATED successfully";

}

?>