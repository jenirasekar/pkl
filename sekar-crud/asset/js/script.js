var accessList = document.getElementsByClassName("access");

for (var access of accessList) {
	if (access.innerHTML == "private") {
		access.parentNode.classList = 'd-none';
	}
}
