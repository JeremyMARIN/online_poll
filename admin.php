<?php

function getPollResults() {
	$poll = array();

	$fp = fopen("poll_db.csv", "r") or die("Can't open file 'poll_db.csv'...");

	while (!feof($fp)) {
		$line = fgetcsv($fp, 1024);
		$poll[] = array("email" => $line[0], "choice" => $line[1]);
	}

	fclose($fp) or die("Can't close file 'poll_db.csv'...");

	return $poll;
}


if (isset($_POST["display"])) {
	if ($_POST["display"] == "list") {
		echo json_encode(getPollResults());
	}
} else {
	echo "Invalid request...";
}

?>