var accept = document.getElementsByClassName("acceptButton");
var deny = document.getElementsByClassName("denyButton");

for(var i=0 ; i< accept.length; i++){
	accept[i].addEventListener("click", function(e){
		loadRecords(true,e.target);
	});
}
for(var i=0 ; i< deny.length; i++){
	deny[i].addEventListener("click", function(e){
		loadRecords(false,e.target);
	});
}

//Performs AJAX request to load records from intermediate database
function loadRecords(accept, object){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200){
			console.log(xhttp.responseText);
			var toBeDeleted = object.parentNode;
			toBeDeleted.parentNode.removeChild(toBeDeleted);
		}
	}
	
	var splitted = object.parentNode.id.split("_");
	var fileSpecifier = splitted[0];
	var id = splitted[1];
	var params = "id=" + encodeURIComponent(id) + "&accept=" + encodeURIComponent(accept);
	xhttp.open("POST", "php/handle_admin_request_"+fileSpecifier+".php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.setRequestHeader("Content-length", params.length);
	xhttp.setRequestHeader("Connection", "close");
	xhttp.send(params);
}