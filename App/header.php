
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <title>Fuel Predictor</title>
    <!-- jQuery + Bootstrap JS -->

	<link rel="stylesheet" type="text/css" href="./assets/css/jquery.datetimepicker.min.css"/ >
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script src="./assets/js/jquery.datetimepicker.full.min.js"></script>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Fuel Predictor</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02"
            aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

		<?php if(empty($_SESSION)){ ?>

			 <div class="collapse navbar-collapse" id="navbarColor02">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="./login_view.php">Sign in</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="./signup_view.php">Sign up</a>
					</li>
				</ul>
			</div>

		<?php } else { ?>
		
			 <div class="collapse navbar-collapse" id="navbarColor02">
				<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					   <a class="nav-link" href="./profile_view.php">Profile</a>
					</li>
					<li class="nav-item">
					   <a class="nav-link" href="./fuel_qoutes_history_view.php">Fuel Qoutes History</a>
					</li>
					<li class="nav-item">
					   <a class="nav-link" href="./fuel_qoutes_view.php">Calculate Fuel Cost</a>
					</li>
					<li class="nav-item">
					   <a class="btn btn-danger btn-block" href="./logout.php">Log out</a>
					</li>
				</ul>
			</div>

		<?php 
			}
		?>
       
    </div>
</nav>