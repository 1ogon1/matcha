function cancelDisabled(id) {
	var elem = document.getElementById(id);

	// alert(id);
	elem.removeAttribute('disabled');
	// elem.setAttribute('disabled', 'disabled');
}