<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP Login system</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style type="text/css">
		.top-nav-bar {
			background-color: pink;
		}
	</style>
</head>
<body>

	<div class="top-nav-bar row no-gutters p-3">
		<div class="col-4">LOGO</div>
		<div class="col-4 text-center"></div>
		<div class="col-4 d-flex justify-content-end">
			<?php if ( ! empty( $_SESSION['username'] ) ) : ?>
				<form action="controllers/logout.php" method="GET">
					<button class="btn btn-primary">Log out</button>
				</form>
			<?php endif; ?>
		</div>
	</div>