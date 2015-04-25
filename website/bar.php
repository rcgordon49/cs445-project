<head>
	<!-- JQuery hosted by Google -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>

<div class="container">
<div class="row">
<div class="col-lg-6">
    <form method="POST" action="action.php" class="input-group">
	<input type="text" name="search" class="form-control" aria-label="..."></input>

	<select name = "query_type" id="query_type">
		<option value="title">Title</option>
		<option value="professional">Professional</option>
		<option value="genre">Genre</option>
		<option value="year">Year</option>
		<option value = "user">User</option>
	</select>

	<input type="submit" value="Search" align="right">
</form>
</div><!-- .col-lg-6 -->
</div><!-- .row -->
</div>

<div class="container">
<div class="row">
<div class="col-lg-6">
    <form method="POST" action="action.php" class="input-group">
		<input type="text" name="search" class="form-control" aria-label="..."></input>
		<div class="input-group-btn">
			<select name = "query_type" id="query_type" class="form-control">
				<option value="title">Title</option>
				<option value="professional">Professional</option>
				<option value="genre">Genre</option>
				<option value="year">Year</option>
				<option value = "user">User</option>
			</select>

			<input type="submit" value="Search" align="right"></input>
  		</div><!-- /btn-group -->
    </form><!-- /input-group -->
  </div><!-- .col-lg-6 -->
</div><!-- .row -->
</div>


<div class="container">
<div class="row">
  <div class="col-lg-6">
    <form method="POST" action="action.php" class="input-group">
      <input type="text" class="form-control" aria-label="...">
      <div class="input-group-btn">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action <span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-menu-right" role="menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </div><!-- /btn-group -->
    </form><!-- /input-group -->
  </div><!-- .col-lg-6 -->
</div><!-- .row -->
</div>