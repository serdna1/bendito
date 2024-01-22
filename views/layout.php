<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ben Dito</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@0;1&family=Roboto+Mono:ital@0;1&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="/css/app.css">
</head>
<body>

	<?php 
    include_once __DIR__ . "/templates/navbar.php";
	?>

	<?php echo $content; ?>

	<?php
		echo $script ?? '';
	?>
			
</body>
</html>
