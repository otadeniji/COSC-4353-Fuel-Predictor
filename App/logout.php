<?php     
	session_start();
	$_SESSION['id'] = '';

    session_destroy();

    header("Location: ./login_view.php")
;?>