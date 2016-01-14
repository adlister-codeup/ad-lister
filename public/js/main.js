"use strict";
(function(){
	var Onpage = 1;
	var amount = 12;
	var morePages;
	var search = "";
	$.ajax ({ // get request to load the ads from the database.
	    type: "POST",
	    url:"load_ads.php",
	    data: {
	    	amount: amount,
	    	search: search
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
		if(length < amount) {
			morePages = false
		}
		else {
			morePages = true;
		}
		var rows = length / 3;
		var dataLocation = 0;
		$("#ads").html("");
		for (var rowplace = 0; rowplace < rows; rowplace++) {
			var row = $('<div class="row">').addClass("rowplace"+rowplace);
			$("#ads").append(row);
			for (var div = 0; div < 3; div++) {
				var divopen = $('<div class="col-md-4 portfolio-item">').addClass("divof"+dataLocation);
				var linkopen = $('<a href="ads.show.php">').attr("href", "ads.show.php?ad="+data[dataLocation].id).addClass("link"+dataLocation);
				var image = $('<img class="img-responsive imagefront" src="http://adlister.dev/img/no_image_available.png" alt="">').attr("src", data[dataLocation].images[0]);
				var h3 = $('<h3></h3').addClass("h3of"+dataLocation);
				var titlelink = $('<a href="ads.show.php"></a>').attr("href", "ads.show.php?ad="+data[dataLocation].id).text(data[dataLocation].title);
				var desc = $('<p></p>').text(data[dataLocation].description.substring(0, 100)+"...");
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
	function nextpage() {
		if (morePages) {
			Onpage = Onpage + 1;
			console.log(Onpage);
			pageChange(Onpage);
			console.log("next");
		}
	}
	function prevpage() {
		if (Onpage > 1) {
			Onpage = Onpage - 1;
			pageChange(Onpage);
			console.log("prev");
		}
	}
	function pageChange(page) {
		$.ajax ({
	    type: "POST",
	    url:"load_ads.php",
	    data: {
	    	page: page,
	    	amount: amount,
	    	search: search
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
	function runsearch()
	{
		if (Onpage != 1)
		{
			Onpage = 1;
		}
		search = document.getElementById("searchfield").value;
		console.log(search);
		pageChange(Onpage);
	}
	document.getElementById("nextbtn").addEventListener("click", nextpage);
	document.getElementById("prevbtn").addEventListener("click", prevpage);
	document.getElementById("searchbtn").addEventListener("click", runsearch);
})();