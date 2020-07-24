<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");

$sql = "SELECT * FROM job_post";

if(!empty($_GET['jobtype'])) {
	//Add this line if jobtype is not empty.
	$sql = $sql . " WHERE jobtype='$_GET[jobtype]'";
}else{}

$result = $conn->query($sql);
if($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) {

		if(isset($_SESSION['id_user'])) {
			//Check if user already applied to jobpost or not. If applied then don't show apply link.
			$sql1 = "SELECT * FROM get_service WHERE id_user='$_SESSION[id_user]' AND id_jobpost='$row[id_jobpost]'";
			$result1 = $conn->query($sql1);
			if($result1->num_rows > 0) 
			{
				$apply = "<strong>Taken<strong>";
			} else {
				$apply = "<a href='get-service.php?id=".$row['id_jobpost']."'>Get</a>";
			}

				
		$json[] = array(
			0 => $row['jobtitle'],
			1 => $row['description'],
			2 => $row['contact'],
			3 => $row['jobtype'],
			4 => $apply,
			);

		} else {
				$apply = "<a href='get-service.php?id=".$row['id_jobpost']."'>Get</a>";

					
		$json[] = array(
			0 => $row['jobtitle'],
			1 => $row['description'],
			2 => $row['jobtype'],
			3 => $apply,
			);
		}

	
	}
	//you need to format and send data as json object as datatables will only accept that.
	echo json_encode($json);
	
}


