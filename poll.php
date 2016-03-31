<?php
include("include/helpers.php");
?>

<html>
	<head>
		<title>Thank you</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
	<body>
		<header id="header">
			<div class="panel round">
				<h2 class="text-centered">Thank for your participation</h2>
			</div>
		</header>

		<div id="content">
			<div class="panel round">
				<div class="text-centered">
					<?php
					if (isset($_POST["email"]) && isset($_POST["choice"]) && checkSubmission($_POST["email"], $_POST["choice"])) {
						$email = $_POST["email"];
						$choice = $_POST["choice"];

						if (checkUniqueEmailAddress($email)) {
							if (saveVote($email, $choice)) {
								echo "Your vote has been saved!<br /><br /><br />";
								echo "These are the information you submitted:</br /><br />";
								echo "Email:<br /><strong>" . $email . "</strong><br /><br />";
								echo "Choice:<br /><strong>" . $choice . "</strong><br />";
							}
						} else {
							echo "Sorry... You can vote only once!";
						}
					} else
						echo "Invalid request...";
					?>
				</div>

				<br /><br /><br />

				<div class="text-centered">
					<a href="index.html"><button class="round" type="button">Go back</button></a>
				</div>
			</div>
		</div>
	</body>
</html>