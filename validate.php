<?php
require_once 'database.php';

function validateData($data) {
	$conn = db_connect();
	
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(empty($data['name']) || empty($data['email']) || empty($data['birthdate']) || empty($data['political_party'])) {
			return '<span class="failure">All fields are required!</span>';
		}
		
		try {
			$query = $conn->prepare('INSERT INTO submissions (name, email, birthdate, political_party) VALUES (:name, :email, :birthdate, :political_party)');
			$query->execute(array('name'=>$data['name'], 'email'=>$data['email'], 'birthdate'=>$data['birthdate'], 'political_party'=>$data['political_party']));
			
			return '<span class="success">Your submission was successful.</span>';
		} catch(PDOException $e) {
			logError($e);
		}
	} else {
		return '<span class="error">Something went wrong. Please try again.</span>';
	}
}

$response = validateData($_POST);

if(isset($_GET['ajax']) && (bool)$_GET['ajax'] === true) { // check whether JavaScript, and by extension Ajax, is enabled
	echo $response;
} else { // do some extra things if JS is disabled
	if(strpos($response, 'error') !== false)
		$status = 'error';
	elseif(strpos($response, 'failure') !== false)
		$status = 'failure';
	elseif(strpos($response, 'success') !== false)
		$status = 'success';

	header('Location: /?status='.$status);
	exit;
}