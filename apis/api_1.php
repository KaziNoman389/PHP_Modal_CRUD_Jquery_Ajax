<?php

	include '../database.php';

	$return_data = array();
	
	$req = isset($_POST['req']) ? $_POST['req'] : 0;
	$param = isset($_POST['param']) ? $_POST['param'] : 0;
	$data = isset($_POST['data']) ? $_POST['data'] : 0;

	
	//request
	switch($req)
	{
		case '1': // Request for emp list
			$table = 'employee';
			break;
		default:
			$table = '';
	}


	//paramater 
	switch($param)
	{
		case '1': // 1-SELECT EmP list in table
			$sql = 'SELECT * FROM '.$table.' WHERE status = 1 ORDER BY id DESC';

			// $sql .= ($data!='0')? ' AND '.$data : '' ;
			// $return_data = ($data!='0')? $return_data = getHTML_empModalview($sql,true) : $return_data = getHTML_empTable($sql,true);

			$return_data = getHTML_empTable($sql,true);
			break;

		case '2': // 2-SELECT specific emp list in modal
			$sql = 'SELECT * FROM '.$table.' WHERE  '.$data;
			$return_data = getHTML_empModalview($sql,true);
			break;

		case '3': // 3-SELECT specific emp list in modal
			$sql = 'SELECT * FROM '.$table.' WHERE  '.$data;
			$return_data = getHTML_empModaledit($sql,true);
			break;
	}
	echo json_encode($return_data);




	//For Table View Function
	function getHTML_empTable($sql)
	{
		global $connection;
		
		try
		{
			$bHTML = '';
			$stmt = $connection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$c = 1;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
			{
				$bHTML .= '
					<tr>
						<th scope="row"> ' .$c++. ' </th> 
						<td> '.$row['name'].' </td> 
						<td> '.$row['email'].' </td> 
						<td> '.$row['phone'].' </td> 
						<td> '.$row['gender'].' </td> 
						<td> '.$row['birth_date'].' </td>
						<td> '.$row['occupation'].' </td> 
						<td> '.$row['marital_status'].' </td> 
						<td> '.$row['nationality'].' </td> 
						<td> '.$row['present_address'].' </td> 
						<td> '.$row['permanent_address'].' </td> 
						<td>
							<button type="button" class="btn btn-primary btn-md mb-2 d-grid gap-2 mb-2" id="view_id" data-id='.$row["id"].'>View</button>
							<button type="button" class="btn btn-warning btn-md mb-2 d-grid gap-2 mb-2" id="edit_id" name="update" data-id='.$row["id"].'>Edit</button>
							<a  type="button" class="btn btn-danger btn-md d-grid gap-2 mb-2" id="delele_id" name="delete" data-id='.$row["id"].' value="Delete">Delete</a>
						</td>
					</tr>
				';
			}		
			$rHTML =  $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		return $rHTML;
	}


	//For View Modal Function
	function getHTML_empModalview($sql)
	{
		global $connection;
		try
		{
			$bHTML = '';
			$stmt = $connection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
			{
				$bHTML .= '
					<div class="row">
						<div class="col-md-12"> '.$row['name'].' </div> 
						<div class="col-md-12"> '.$row['email'].' </div> 
						<div class="col-md-12"> '.$row['phone'].' </div> 
						<div class="col-md-12"> '.$row['gender'].' </div> 
						<div class="col-md-12"> '.$row['birth_date'].' </div>
						<div class="col-md-12"> '.$row['occupation'].' </div> 
						<div class="col-md-12"> '.$row['marital_status'].' </div> 
						<div class="col-md-12"> '.$row['nationality'].' </div> 
						<div class="col-md-12"> '.$row['present_address'].' </div> 
						<div class="col-md-12"> '.$row['permanent_address'].' </div>
					</div>  
					';
			}
			$rHTML =  $bHTML;
		}
		catch (PDOException $e) 
		{
			$rHTML = $e->getMessage();
		}
		
		return $rHTML;
	}

	//For Edit Modal function
	function getHTML_empModaledit($sql)
	{
		global $connection;
		try
		{
			$stmt = $connection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$rData = $stmt->fetchall(PDO::FETCH_ASSOC); 
		}
		catch (PDOException $e) 
		{
			$rData = $e->getMessage();
		}
		
		return $rData;
	}