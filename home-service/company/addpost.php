<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("../db.php");

//if user Actually clicked Add Post Button
if(isset($_POST)) {

	// New way using prepared statements. This is safe from SQL INJECTION. Should consider to update to this method when many people are using this method.



	$stmt = $conn->prepare("INSERT INTO job_post(id_company, jobtitle, description, contact, jobtype) VALUES (?,?, ?, ?, ?)");

	$stmt->bind_param("issss", $_SESSION['id_user'], $jobtitle, $description, $contact, $jobtype);

	$jobtitle = mysqli_real_escape_string($conn, $_POST['jobtitle']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$contact = mysqli_real_escape_string($conn, $_POST['contact']);
	$jobtype = mysqli_real_escape_string($conn, $_POST['jobtype']);


	if($stmt->execute()) {
		//If data Inserted successfully then redirect to dashboard
		$_SESSION['jobPostSuccess'] = true;
		header("Location: dashboard.php");
		exit();
	} else {
		//If data failed to insert then show that error. Note: This condition should not come unless we as a developer make mistake or someone tries to hack their way in and mess up :D
		echo "Error";
	}

	$stmt->close();


	$conn->close();

} else {
	//redirect them back to dashboard page if they didn't click Add Post button
	header("Location: dashboard.php");
	exit();
}