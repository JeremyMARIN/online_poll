<?php

$available_choices = array('a', 'b', 'c', 'd', 'e');

function checkSubmission($email, $choice) {
	global $available_choices;

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "'" . $email . "'' is not a valid email address...<br />";
		return false;
	}
	if (!in_array($choice, $available_choices)) {
		echo "'" . $choice . "'' is not a valid choice...<br />";
		return false;
	}

	return true;
}

function checkUniqueEmailAddress($email) {
	$fp = fopen("poll_db.csv", "r") or die("Can't open file 'poll_db.csv'...");

	while (!feof($fp)) {
		$line = fgetcsv($fp, 1024);
		if ($line[0] == $email)
			return false;
	}

	fclose($fp) or die("Can't close file 'poll_db.csv'...");

	return true;
}

function saveVote($email, $choice) {
	$fp = fopen("poll_db.csv", "a") or die("Can't open file 'poll_db.csv'...");

	$line = array($email, $choice);
	fputcsv($fp, $line);

	fclose($fp) or die("Can't close file 'poll_db.csv'...");

	return true;
}

?>