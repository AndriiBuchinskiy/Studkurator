function expand(element) {
	let viewbox = document.getElementById('viewbox');

	while (viewbox.hasChildNodes()) {
		viewbox.removeChild(viewbox.lastChild);
	}

	viewbox.style.display = "block";

	let h2 = document.createElement('h2');
	h2.id = 'close';
	h2.innerHTML = "X";
	h2.onclick = hideBox;

	let img = document.createElement('img');
	img.id = 'inner_image';
	img.src = element.firstChild.src;

	viewbox.appendChild(img);
	viewbox.insertBefore(h2, img);	
}

function hideBox() {
	let viewbox = document.getElementById('viewbox');
	viewbox.style.display = "none";
}