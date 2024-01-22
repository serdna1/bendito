<nav>
	<?php 
		session_start();
		if (isset($_SESSION['login'])) { 
	?>
		<p>Hello, <?php echo $_SESSION['username'] ?? ''; ?></p>
		<a href="/logout">Logout</a>
	<?php } ?>
</nav>