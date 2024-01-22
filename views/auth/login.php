<section class="login-section">
	<h1>Login</h1>
	
	<?php 
		include_once __DIR__ . "/../templates/alerts.php";
	?>
	
	<form class="form" method="POST" action="/">
		<div class="field">
			<label for="email">Email</label>
			<input
				type="email"
				id="email"
				placeholder="example@example.com"
				name="email"
			/>
		</div>
	
		<div class="field">
			<label for="password">Password</label>
			<input 
				type="password"
				id="password"
				name="password"
			/>
		</div>
	
		<input type="submit" value="Login">
	</form>
	
	<a class="create-account-anchor" href="/create-account">¿Don't have an account yet? Create account</a>
</section>