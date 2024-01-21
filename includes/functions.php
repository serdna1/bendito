<?php

function debug($variable) : string {
	echo "<pre>";
	var_dump($variable);
	echo "</pre>";
	exit;
}

// Escape / Sanitize the HTML
function s($html) : string {
	$s = htmlspecialchars($html);
	return $s;
}

// Checks if the user is authenticated.
// If not, redirects to /
function isAuth() : void {
	if(!isset($_SESSION['login'])) {
		header('Location: /');
	}
}