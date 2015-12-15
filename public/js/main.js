(function(){
	$.ajax ({ // get request to load the contacts from the users file.
	    type: "GET",
	    url:"controllers/load_ads.php",
	    data: {
	    },
	    dataType: "json",
	    success: function(data) {
	    	fillAds(data);
	    }, error: function(data) {
	    	console.log(data);
	    }, done: function(data) {
	    	console.log("done");
	    }
	});
	function fillAds(data) {
		console.log(data);
	}

})();