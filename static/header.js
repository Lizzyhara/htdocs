window.onscroll = function () { myFunction() };

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
	if (document.body.scrollTop > 1150 || document.documentElement.scrollTop > 1150) {
	  header.style.padding = "10px 10px";
	} else {
	  header.style.padding = "50px 10px";
	}
}