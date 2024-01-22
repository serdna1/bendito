<div class="alerts-container">
	<?php
		foreach($alerts as $key => $messages):
			foreach($messages as $message):
	?>
		<div class="alert">
			<?php echo $message; ?>
		</div>
	<?php
			endforeach;
		endforeach;
	?>
</div>