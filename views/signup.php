<?php
	$err_existed = isset( $_SESSION['msg']['error']['register_username_existed'] )
					? '<p class="text-danger">' . $_SESSION['msg']['error']['register_username_existed'] . '</p>' : '';

	$err_username = isset( $_SESSION['msg']['error']['register_username_required'] )
					? '<p class="text-danger">' . $_SESSION['msg']['error']['register_username_required'] . '</p>' : '';

	$err_password = isset( $_SESSION['msg']['error']['register_password_required'] )
					? '<p class="text-danger">' . $_SESSION['msg']['error']['register_password_required'] . '</p>' : '';
?>

<form action="controllers/handle.php" method="POST" class="col-6 mx-auto my-5">
	<div class="form-group">
		<label for="uname">username</label>
		<?php echo $err_username; ?>
		<?php echo $err_existed; ?>
		<input class="form-control" type="text" name="uname" placeholder="Username">
	</div>
	<div class="form-group">
		<label for="upw">password</label>
		<?php echo $err_password; ?>
		<input class="form-control" type="password" name="upw" placeholder="Password">
	</div>
	<input type="hidden" name="will" value="register">
	<button class="btn btn-primary">Sign up</button>
	<span>
		Have an account?
		<a href="?login">Log in</a>
	</span>
</form>