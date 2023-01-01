function adjustInputs() {
	if ($("#firmOption:selected").length != 0) {
		$("#firmInputs").show();
		$("#nameInput").hide();
	} else {
		$("#firmInputs").hide();
		$("#nameInput").show();
	}
}

$(function () {
	adjustInputs();
	$("#typeSelector").change(function () {
		adjustInputs();
	});
});
