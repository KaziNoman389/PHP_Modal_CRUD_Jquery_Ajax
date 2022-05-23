<?php 

if($_SERVER['REQUEST_METHOD'] == "POST") {

	include('../database.php');
	
    $emp_id = $_POST['edit_emp_id'];

	$name =  $_POST['edit_name'];
	$email =  $_POST['edit_email'];
	$phone =  $_POST['edit_phone'];
	$gender =  $_POST['edit_gender'];
	$birth_date =  $_POST['edit_birth_date'];
	$occupation =  $_POST['edit_occupation'];
	$marital_status =  $_POST['edit_marital_status'];
	$nationality =  $_POST['edit_nationality'];
	$present_address =  $_POST['edit_present_address'];
	$permanent_address =  $_POST['edit_permanent_address'];

	$query = "UPDATE `employee` SET 
        `name`='$name',
        `email`='$email',
        `phone`='$phone',
        `gender`='$gender',
        `birth_date`='$birth_date',
        `occupation`='$occupation',
        `marital_status`='$marital_status',
        `nationality`='$nationality',
        `present_address`='$present_address',
        `permanent_address`='$permanent_address' WHERE `id`='$emp_id' ";

	echo $query;
	$stmt = $connection->prepare($query);

	// execute the query
	$stmt->execute();

	echo $stmt->rowCount() . " records UPDATED successfully";
}

?>