//function for the drag and drop field in topdf.php
document.querySelectorAll(".input_file").forEach((inputElement) => {
	const dropZoneElement = inputElement.closest(".input_box");

	dropZoneElement.addEventListener("click", (e) => {
		inputElement.click();
	});

	inputElement.addEventListener("change", (e) => {
		if (inputElement.files.length) {
			updateThumbnail(dropZoneElement, inputElement.files[0]);
		}
	});

	dropZoneElement.addEveFntListener("dragover", (e) => {
		e.preventDefault();
		dropZoneElement.classList.add("input--over");
	});

	["dragleave", "dragend"].forEach((type) => {
		dropZoneElement.addEventListener(type, (e) => {
			dropZoneElement.classList.remove("input--over");
		});
	});

	dropZoneElement.addEventListener("drop", (e) => {
		e.preventDefault();

		if (e.dataTransfer.files.length) {
			inputElement.files = e.dataTransfer.files;
			updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
		}

		dropZoneElement.classList.remove("input--over");
	});
});