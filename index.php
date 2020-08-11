<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title>URL Shortener</title>
	<meta content="small-url" name="keywords">
	<meta content="Small-URL is a url shortener to reduce a long link. Use our tool to shorten links for free and then share them anywhere" name="description">
	<meta property="og:url" content="https://www.small-url.tk/">
	<meta property="og:title" content="Small-URL - URL Shortener">
	<meta property="og:type" content="website">
	<!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style1.css">
</head>
<body style="background-color: #e6ebff">
<!--/ Nav Start /-->
  <nav class="navbar navbar-b navbar-trans navbar-expand-md fixed-top" id="mainNav">
    <div class="container block">
      <a class="navbar-brand js-scroll" href="/">Small URL</a>
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
        aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <div class="navbar-collapse collapse justify-content-end" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link js-scroll active" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll" href="clicks_counter.php">Clicks-Counter</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div style="margin-bottom: 60px"></div>
  <!--/ Nav End /-->
<div class="container pt-4 block"><!-- 
	<div class="row mb-3"><div class="col-sm-12 text-center text-primary"><h1 id="title"><a href="/">Small URL</a></h1></div></div> -->
	<div class="jumbotron bg-light shadow p-5 rounded main">
		<form id='login_form'>
			<h2 class="text-center mb-3">Enter the URL to be shortened</h2>
			<div class="form-group">
			    <input type="text" class="form-control" placeholder="Enter URL" id="url" name="url">
			</div>
			<div class="form-group">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Enter the captcha" id="captcha" name="captcha">
				    <span class="input-group-append"><img src="api/captcha_image.php" id="captcha_image" alt="Failed to load captcha" /></span>
				</div>
			</div>
			<div class="form-group text-center">
				<button type="submit" class="btn btn-primary mr-2">Short it</button>
				<button type="reset" class="btn btn-primary ml-2">Reset</button>
			</div>
		</form>
		<br/>
		<div class="list-group">
			<div class="list-group-item bg-warning mb-2 text-center d-none" id="message"></div>
		</div>
		<div class="list-group">
			<div class="list-group-item d-none" id="link"></div>
		</div>
		<div class="list-group text-center" id="QR">
			
		</div>
	</div>
</div>
<script src="js/main.js"></script>
</body>
</html>