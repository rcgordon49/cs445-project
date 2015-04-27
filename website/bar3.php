<!--<div class="container">-->
	<!-- <div class="row">     -->
		<!-- <div class="col-md-12" id="bar"> -->
			<form method="POST" action="results.php" class="input-group" id="adv-search">         
				<input type="text" id="search" class="form-control" name="search" placeholder="Search term...">

				<div class="input-group-btn">
					<div class="btn-group" role="group">
						<div class="search-panel">
							<button type="button" class="btn btn-default dropdown-toggle btn-bar" data-toggle="dropdown" id="filter">
								<span name="query_type" id="search_concept">Title</span> <span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li class="dropdown-header">Movies</li>
									<li value="title"><a href="#title"  value="title" placeholder="Enter a movie title... Ex: Life">Title</a></li>
									<li value="genre"><a href="#genre" value="genre" placeholder="Enter a movie genre... Ex: Horror">Genre</a></li>
									<li value="year"><a href="#year" value="year" placeholder="Enter movie years... Ex: 2000-2014">Year</a></li>
								<li class="divider"></li>
								<li class="dropdown-header">People</li>
									<li value="professional"><a href="#professional" value="professional" placeholder="Enter a professional's name... Ex: Brad, Pitt">Professional</a></li>
									<li value = "user"><a href="#user" value="user" placeholder="Enter a user's email address... Ex: aabram21274@xyz.net">User</a></li>
							</ul>
						</div>
						<input type="hidden" name="query_type" value="title" id="search_param">

						<div class="dropdown dropdown-lg">
							<button type="button" class="btn btn-default dropdown-toggle btn-bar" data-toggle="dropdown" aria-expanded="false" id="advanced"><span class="caret"></span></button>
							<div class="dropdown-menu dropdown-menu-right keepopen" id="advanced_popup" role="menu">
								<h4>Advanced Search</h4>
								<div class="checkbox">
									<label>
										<input type="checkbox" value="1" name="exact_check"/>
										Exact match?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" value="1" name="followers"/>
										Only include followers?
									</label>
								</div>

								<h4>Movies</h4>

								<div class="form-group">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="1" name="watched_by_check"/>
											Watched by:
										</label>
									</div>
									<div class="input-group">
										<span class="input-group-btn btn-group ">
							                <button type="button" class="btn btn-default dropdown-toggle condition-bar" data-toggle="dropdown" id="filter">
												<span name="watched_by_operator" id="search_concept">&gt;=</span>
											</button>
							                <ul class="dropdown-menu mini-popup" role="menu">
													<li value="<"><a href="#<"  value="<" placeholder="">&lt;&nbsp;</a></li>
													<li value="<="><a href="#<=" value="<=" placeholder="">&lt;=</a></li>
													<li value="="><a href="#=" value="=" placeholder="">=&nbsp;</a></li>
													<li value=">="><a href="#>="  value=">=" placeholder="">&gt;=</a></li>
													<li value=">"><a href="#>" value=">" placeholder="">&gt;</a></li>
						                	</ul>
						                </span>
						                <input type="hidden" name="watched_by_operator" value=">=" id="condition_param">
						                <input type="text" name="watched_by_number" class="form-control conditionText condition-bar">
						                <label class="input-group-addon condition-bar text">Users</label>
						            </div>
						        </div>

								<div class="form-group">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="1" name="rated_by_check"/>
											Rated by:
										</label>
									</div>
									<div class="input-group">
										<span class="input-group-btn btn-group ">
							                <button type="button" class="btn btn-default dropdown-toggle condition-bar" data-toggle="dropdown" id="filter">
												<span name="rated_by_operator" id="search_concept">&gt;=</span>
											</button>
							                <ul class="dropdown-menu mini-popup" role="menu">
													<li value="<"><a href="#<"  value="<" placeholder="">&lt;&nbsp;</a></li>
													<li value="<="><a href="#<=" value="<=" placeholder="">&lt;=</a></li>
													<li value="="><a href="#=" value="=" placeholder="">=&nbsp;</a></li>
													<li value=">="><a href="#>="  value=">=" placeholder="">&gt;=</a></li>
													<li value=">"><a href="#>" value=">" placeholder="">&gt;</a></li>
						                	</ul>
						                </span>
						                <input type="hidden" name="rated_by_operator" value=">=" id="condition_param">
						                <input type="text" name="rated_by_number" class="form-control conditionText condition-bar">
						                <label class="input-group-addon condition-bar text">Users</label>
						            </div>
						        </div>

						        <!-- <h4>Professionals</h4> -->

						        <h4>All</h4>

								<div class="form-group">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="1" name="sort_check"/>
											Sort by:
										</label>
										<button type="button" class="btn btn-default dropdown-toggle btn-span" data-toggle="dropdown" id="filter">
													<span name="operator" id="search_concept">Title</span>
										</button>
										<ul class="dropdown-menu mini-popup popup-span" role="menu">
											<li class="dropdown-header">Movies</li>
												<li value="title"><a href="#Title"  value="title">Title</a></li>
												<li value="genre"><a href="#Genre" value="genre">Genre</a></li>
												<li value="year"><a href="#Year" value="year">Year</a></li>
												<li value = "avg_rating"><a href="#Average User Rating" value="avg_rating">Average User Rating</a></li>
												<li value = "num_watches"><a href="#Number of Watches" value="num_watches">Number of Watches</a></li>
												<li value = "num_ratings"><a href="#Number of Ratings" value="num_ratings">Number of Ratings</a></li>
											<li class="divider"></li>
											<li class="dropdown-header">Professionals</li>
												<li value="pro_name"><a href="#Name" value="pro_name">Name</a></li>
											<li class="divider"></li>
											<li class="dropdown-header">Users</li>
												<li value="email_address"><a href="#Email" value="email_address">Email</a></li>
												<li value = "num_watches"><a href="#Number of Watches" value="num_watches">Number of Watches</a></li>
												<li value = "num_ratings"><a href="#Number of Ratings" value="num_ratings">Number of Ratings</a></li>
										</ul>
									</div>
								</div>
								<div class="form-group">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="1" name="limit_check" id="limit_check"/>
											Limit result by:
										</label>
									</div>
									<input class="form-control" type="text" name="limit_number" value="500" placeholder:"Ex: 445"/>
								</div>
								<br>
								<br>
								<button class="btn btn-default btn-block" id="add_button"><span class="glyphicon glyphicon-plus"></span></button>
							</div>
						</div>

						<button class="btn btn-primary btn-bar" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                    </div>
            	</div>
            </form>
        <!-- </div> -->
	<!-- </div> -->
<!--</div>-->

<script>
$(document).ready(function(e){
	//automatic settings to limit quiries (increase performance)
	$('.limit_check').click(function(e) {
		$(this).click();
		$(this).val('400');
	});

	//if you are not on results page or index page manually click the button
	if(!($("#buttonFlag").length > 0)) {
    	$('.btn-bar').click(function(e) {
			$(this).parent().toggleClass('open');
		});
	}

	//choose basic query
    $('.search-panel .dropdown-menu').find('a').click(function(e) {
		e.preventDefault();
		var concept = $(this).text();
		var param = $(this).attr("href").replace("#","");
		$('.search-panel span#search_concept').text(concept);
		$('.input-group #search_param').val(param);
		//update placeholder	
		$('#search').attr('placeholder',$(this).attr('placeholder'));
	});

    //advanced popup will not go away immediately
	$('#advanced_popup').click(function(e) {
        e.stopPropagation();
    });

    $('#advanced_popup .dropdown-toggle').click(function(e) {
        e.preventDefault();
        var aria = $(this).attr('aria-expanded');
        if(aria === 'true'){
        	aria = 'false';
        }
        else aria = 'true';
        $(this).parent().toggleClass('open');
    });

    $('.mini-popup').find('a').click(function(e) {
    	var param = $(this).attr("href").replace("#","");
		$(this).parent().parent().prev().val(param);
		$(this).parent().parent().prev().text(param);
		$(this).parent().parent().parent().next().val(param);
	});

	//add input field in advanced popup
    var max_fields      = 10; //maximum input boxes allowed
    var add_button      = $("#add_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(add_button).before(); //add input box
        }
    });
    
    $('#advanced_popup').on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>