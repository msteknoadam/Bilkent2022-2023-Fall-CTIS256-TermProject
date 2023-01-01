function adjustInputs() {
	if ($("#firmOption").isSelected()) {
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
