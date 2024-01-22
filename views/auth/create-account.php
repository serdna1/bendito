<section class="create-account-section">

	<h1>Create account</h1>

	<?php 
		include_once __DIR__ . "/../templates/alerts.php";
	?>

	<form class="form" method="POST" action="/create-account">
	
		<div class="field">
			<label for="username">Username</label>
			<input
				type="text"
				id="username"
				name="username"
				placeholder="javilopez"
				value="<?php echo s($user->username); ?>"
			/>
		</div>

		<div class="field">
			<label for="email">Email</label>
			<input
				type="email"
				id="email"
				name="email"
				placeholder="example@example.com"
				value="<?php echo s($user->email); ?>"
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

		<input type="submit" value="Create account">


	</form>

	<a class="create-account-anchor" href="/">¿Already have an account? Login</a>

</section>
