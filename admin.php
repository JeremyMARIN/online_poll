<?php

function getListResults() {
	$list = array();

	$fp = fopen("poll_db.csv", "r") or die("Can't open file 'poll_db.csv'...");

	while (!feof($fp)) {
		$line = fgetcsv($fp, 1024);
		$list[] = array("email" => $line[0], "choice" => $line[1]);
	}

	fclose($fp) or die("Can't close file 'list_db.csv'...");

	return $list;
}
function getHistogramResults() {
	$fp = fopen("poll_db.csv", "r") or die("Can't open file 'poll_db.csv'...");

	$results   = array();
	while (!feof($fp)) {
		$line = fgetcsv($fp, 1024);
		$results[] = $line[1]; // only get the choice
	}

	fclose($fp) or die("Can't close file 'list_db.csv'...");

	$n_votes = count($results);
	$counts  = array_count_values($results);

	$percentages = array();
	foreach ($counts as $key => $value) {
		$percentages[$key] = round($value/$n_votes, 2);
	}

	$histogram = array(
		"n_votes"     => $n_votes,
		"counts"      => $counts,
		"percentages" => $percentages
	);

	return $histogram;
}


if (isset($_POST["display"])) {
	if ($_POST["display"] == "list") {
		echo json_encode(getlistResults());
	} elseif ($_POST["display"] == "histogram") {
		echo json_encode(getHistogramResults());
	}
} else {
	echo "Invalid request...";
}

?>