<!DOCTYPE html>
<html>
	<head>
		<title>Voter Registration Form</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/x-icon" href="favicon.png">
		<link rel="stylesheet" href="style.css">
		<script defer src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script defer src="script.js"></script>
	</head>
	<body>
		<div class="wrapper">
			<h1>Voter Registration</h1>
			<div id="status">
				<?php
				$status = $_GET['status'] ?? ''; // get status messages (only if JavaScript is disabled)
				
				if(!empty($status)) {
					echo '<span class="'.$status.'">';
					
					switch($status) {
						case 'error':
							echo 'Something went wrong. Please try again.';
							break;
						case 'failure':
							echo 'All fields are required!';
							break;
						case 'success':
							echo 'Your submission was successful.';
							break;
					}
					
					echo '</span>';
				}
				?>
			</div>
			<form id="registration-form" action="validate.php" method="post">
				<label>Name: <input type="text" name="name" value="<?php echo $_POST['name'] ?? ''; ?>"></label>
				<label>Email: <input type="email" name="email" value="<?php echo $_POST['email'] ?? ''; ?>"></label>
				<label>Date of Birth: <input type="date" name="birthdate" value="<?php echo $_POST['birthdate'] ?? ''; ?>"></label>
				<label>Select a Political Party:
					<select name="political_party">
						<option value="">--</option>
						<option value="democratic">Democratic</option>
						<option value="republican">Republican</option>
						<option value="libertarian">Libertarian</option>
						<option value="green">Green</option>
						<option value="independent">Independent</option>
						<option value="unaffiliated">Unaffiliated</option>
					</select>
				</label>
				<input type="submit" name="submit" value="Submit Registration">
			</form>
		</div>
	</body>
</html>