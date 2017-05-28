<!DOCTYPE html>
<html>
<head lang="en">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="robots" content="all,follow">
      <meta name="googlebot" content="index,follow,snippet,archive">
      
      <!-- link the connector stylsheet -->
      <link rel="stylesheet" href="style.css">
      
      <!-- link google font -->
      <link href="https://fonts.googleapis.com/css?family=Yrsa" rel="stylesheet">
      
      <title><?php if(isset($page_title)) echo $page_title; ?> | User authenication system</title>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li>
						<a href="index.php">
							Home
						</a>
					</li>
					<li>
						<a href="register.php">
							Register
						</a>
					</li>
					<li>
						<a href="login.php">
							Login
						</a>
					</li>
					
				</ul>
			</div>
		</div>
	</nav>
