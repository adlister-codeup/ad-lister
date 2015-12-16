"use strict";
(function(){
	$.ajax ({ // get request to load the ads from the database.
	    type: "POST",
	    url:"controllers/load_ads.php",
	    data: {
	    	amount: 12
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
		var length = data.length;
		var rows = length / 3;
		var dataLocation = 0;
		for (var rowplace = 0; rowplace < rows; rowplace++) {
			var row = $('<div class="row">').addClass("rowplace"+rowplace);
			$("#ads").append(row);
			for (var div = 0; div < 3; div++) {
				if (data[dataLocation].images[0] == "") {
					data[dataLocation].images[0] = "http://placehold.it/700x400";
				}
				var divopen = $('<div class="col-md-4 portfolio-item">').addClass("divof"+dataLocation);
				var linkopen = $('<a href="ads.show.php">').attr("href", "ads.show.php?ad="+data[dataLocation].id).addClass("link"+dataLocation);
				var image = $('<img class="img-responsive" src="http://placehold.it/700x400" alt="">').attr("src", data[dataLocation].images[0]);
				var h3 = $('<h3></h3').addClass("h3of"+dataLocation);
				var titlelink = $('<a href="ads.show.php"></a>').attr("href", "ads.show.php?ad="+data[dataLocation].id).text(data[dataLocation].title);
				var desc = $('<p></p>').text(data[dataLocation].description);
				$(".rowplace"+rowplace).append(divopen);
				$(".divof"+dataLocation).append(linkopen);
				$(".link"+dataLocation).append(image);
				$(".divof"+dataLocation).append(h3);
				$(".divof"+dataLocation).append(linkopen);
				$(".h3of"+dataLocation).append(titlelink);
				$(".divof"+dataLocation).append(desc);
				dataLocation++;
				if (dataLocation >= length)
				{
					break;
				}
			}
		}
	}
	function pageChange(page) {
		$.ajax ({
	    type: "POST",
	    url:"controllers/load_ads.php",
	    data: {
	    	page: page,
	    	amount: 12
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
	}
})();