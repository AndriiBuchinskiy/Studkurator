function deleteComment(comment_id, article_id, a) {
	let ajaxRequest;

	try {
		ajaxRequest = new XMLHttpRequest();
	}
	catch (e) {
		try {
			ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch (e) {
			alert("Unable to perform request to server!");
			return false;
		}
	}

	ajaxRequest.onreadystatechange = function () {
		if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
			document.getElementById("comments").innerHTML = ajaxRequest.responseText;
		}
	}

	let query = "?id=" + comment_id + "&article_id=" + article_id + "&a=" + a;

	ajaxRequest.open("GET", "layout/delete_comment.php" + query, true);
	ajaxRequest.send();
}

function addComment(article_id, author_id, author_login, a) {
	let ajaxRequest;

	try {
		ajaxRequest = new XMLHttpRequest();
	}
	catch (e) {
		try {
			ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch (e) {
			alert("Unable to perform request to server!");
			return false;
		}
	}

	ajaxRequest.onreadystatechange = function () {
		if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
			document.getElementById("comments").innerHTML = ajaxRequest.responseText;
		}
	}

	let text = document.getElementById("comment_field").value;
	let query = "?article_id=" + article_id + "&author_id=" + author_id + "&author_login=" + author_login + "&text=" + text + "&a=" + a;
	
	ajaxRequest.open("GET", "layout/add_comment.php" + query, true);
	ajaxRequest.send();
}

function editComment(id) {
	let ajaxRequest;

	try {
		ajaxRequest = new XMLHttpRequest();
	}
	catch (e) {
		try {
			ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch (e) {
			alert("Unable to perform request to server!");
			return false;
		}
	}

	ajaxRequest.onreadystatechange = function () {
		if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
			document.getElementById(id).innerHTML = ajaxRequest.responseText;
		}
	}

	let text = document.getElementById(id).value;
	let query = "?id=" + id + "&text=" + text;
	
	ajaxRequest.open("GET", "layout/edit_comment.php" + query, true);
	ajaxRequest.send();
}


	

function goToPage(page, admin, amount) {
	let ajaxRequest;

	try {
		ajaxRequest = new XMLHttpRequest();
	}
	catch (e) {
		try {
			ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch (e) {
			alert("Unable to perform request to server!");
			return false;
		}
	}

	ajaxRequest.onreadystatechange = function () {
		if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
			document.getElementById("recipes_list").innerHTML = ajaxRequest.responseText;
		}
	}

	let query = "?page=" + page + "&admin=" + admin + "&amount=" + amount;

	ajaxRequest.open("GET", "layout/pagination.php" + query, true);
	ajaxRequest.send();
}