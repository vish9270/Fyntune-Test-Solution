<?php
	session_start();
	session_unset();
	session_destroy();
	session_commit();
	session_start();

	header('Location: index.php?id=3');
	exit;
?>