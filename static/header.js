window.onscroll = function () { myFunction(), scrollFunction()};

var header = document.getElementById("header");
var sticky = header.offsetTop;

function myFunction() {
	if (window.pageYOffset > sticky) {
		header.classList.add("sticky");
	} else {
		header.classList.remove("sticky");
	}
}
function scrollFunction() {
	if (document.body.scrollTop > "50%" || document.documentElement.scrollTop > "50%") {
	  header.style.padding = "1px 1px";
	} else {
		header.classList.remove("sticky");
	}
}