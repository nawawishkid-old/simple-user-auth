<?php
	$success = isset( $_SESSION['msg']['success']['register'] )
					? '<p class="p-3 text-white bg-success">' . $_SESSION['msg']['success']['register'] . '</p>' : '';

	$err_invalid = isset( $_SESSION['msg']['error']['login_invalid'] )
					? '<p class="p-3 text-white bg-danger">' . $_SESSION['msg']['error']['login_invalid'] . '</p>' : '';

	$err_username = isset( $_SESSION['msg']['error']['login_username_required'] )
					? '<p class="p-3 text-white bg-danger">' . $_SESSION['msg']['error']['login_username_required'] . '</p>' : '';

	$err_password = isset( $_SESSION['msg']['error']['login_password_required'] )
					? '<p class="p-3 text-white bg-danger">' . $_SESSION['msg']['error']['login_password_required'] . '</p>' : '';
?>
<?php echo $err_invalid; ?>
<?php echo $success; ?>
<form action="controllers/handle.php" method="POST" class="col-6 mx-auto my-5">
	<div class="form-group">
		<label for="uname">username</label>
		<?php echo $err_username; ?>
		<input class="form-control" type="text" name="uname" placeholder="Username">
	</div>
	<div class="form-group">
		<label for="upw">password</label>
		<?php echo $err_password; ?>
		<input class="form-control" type="password" name="upw" placeholder="Password">
	</div>
	<div class="form-check">
		<input type="checkbox" name="rememberme">
		<label for="rememberme">Keep me logged in.</label>
	</div>
	<input type="hidden" name="will" value="login">
	<button class="btn btn-primary">Log in</button>
</form>