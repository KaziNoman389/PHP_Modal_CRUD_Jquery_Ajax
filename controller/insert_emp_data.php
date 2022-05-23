<?php 

if($_SERVER['REQUEST_METHOD'] == "POST") {

	include('../database.php');

	$name =  $_POST['name'];
	$email =  $_POST['email'];
	$phone =  $_POST['phone'];
	$gender =  $_POST['gender'];
	$birth_date =  $_POST['birth_date'];
	$occupation =  $_POST['occupation'];
	$marital_status =  $_POST['marital_status'];
	$nationality =  $_POST['nationality'];
	$present_address =  $_POST['present_address'];
	$permanent_address =  $_POST['permanent_address'];

	$query = "INSERT INTO `employee`(
		`name`, 
		`email`, 
		`phone`, 
		`gender`, 
		`birth_date`, 
		`occupation`, 
		`marital_status`, 
		`nationality`, 
		`present_address`, 
		`permanent_address`
	) 
	VALUES (
		'$name',
		'$email',
		'$phone',
		'$gender',
		'$birth_date',
		'$occupation',
		'$marital_status',
		'$nationality',
		'$present_address',
		'$permanent_address'
	)";

	$stmt = $connection->prepare($query);

	// execute the query
	$stmt->execute();

	echo $stmt->rowCount() . " records Inserted successfully";
	

}


?>