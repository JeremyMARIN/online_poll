function init() {
	var dataContent            = document.getElementById("data");
	var displayListButton      = document.getElementById("display_list");
	var displayHistogramButton = document.getElementById("display_histogram");

	displayListButton.addEventListener("click", function() {
		displayList(dataContent);
	});

	displayHistogramButton.addEventListener("click", function() {
		displayHistogram(dataContent);
	});

	displayList(dataContent);
}

function displayList(dataContent) {
	var xhr = new XMLHttpRequest();
	var params = "display=list";

	xhr.open("POST", "admin.php");
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xhr.addEventListener("readystatechange", function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			processListData(dataContent, xhr.responseText);
		} else if (xhr.readyState == 4) {
			dataContent.innerHTML = "Error " + xhr.status + ".";
		}
	}, false);

	xhr.send(params);
}

function displayHistogram(dataContent) {
	dataContent.innerHTML = "Histogram of votes";
}

function processListData(dataContent, data) {
	var formatedData = ""; // HTML formated data

	data = JSON.parse(data);

	for (var i = 0, length = data.length; i < length; i++) {
		var line = "<tr><td>" + data[i].email + "</td><td>" + data[i].choice + "</td></tr>";
		formatedData += line;
	}

	dataContent.innerHTML = 
		"<table>" +
			"<tr>" + 
				"<th>Email</th>" +
				"<th>Choice</th>" +
			"</tr>" +
			formatedData +
		"</table>"
	;
}