function init() {
	var submitButton = document.getElementById("submit");
	var inputField = document.getElementById("email");

	inputField.addEventListener("input", function() {
		ifValidEmailAddress(inputField, submitButton, checkEmailAddress(inputField.value));
	});
}

function checkEmailAddress(email) {
	var regex = /[^\s@]+@[^\s@]+\.[^\s@]+/;
	return regex.test(email);
}

function ifValidEmailAddress(inputField, submitButton, isValid) {
	var color = "#e0a2a2";
	
	if (isValid)
		color = "#a2e0a2";

	inputField.style.backgroundColor = color;
	submitButton.disabled = !isValid;
}