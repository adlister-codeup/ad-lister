"use strict";
(function(){

	$('#postbtn').click( function(event) {
	   event.preventDefault();
	   window.location = "ads.create.php";
	});

	$('#loginbtn').click( function(event) {
	   event.preventDefault();
	   window.location = "auth.login.php";
	});

	$('#homebtn').click( function(event) {
	   event.preventDefault();
	   window.location = "index.php";
	});

	$('#logoutbtn').click( function(event) {
	   event.preventDefault();
	   window.location = "auth.logout.php";
	});

	$('#editprofilebtn').click( function(event) {
	   event.preventDefault();
	   window.location = "users.edit.php";
	});

	$('#signupbtn').click( function(event) {
	   event.preventDefault();
	   window.location = "users.create.php";
	});


})();