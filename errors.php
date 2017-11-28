<!-- 
	/* errors.php: used to display errors on various pages. 
	 * 
	 * If there are errors, create an errors div and output each error.
	 */
-->
<?php if (count($errors) > 0) : ?>
	<div class="error">
		<?php foreach ($errors as $error) : ?>
			<p><?php echo $error ?></p>
		<?php endforeach ?>
	</div>
<?php endif ?>