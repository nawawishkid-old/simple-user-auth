<?php
	$success = isset( $_SESSION['msg']['success']['update'] )
					? '<p class="p-3 text-white bg-success">' . $_SESSION['msg']['success']['update'] . '</p>' : '';

	$err = isset( $_SESSION['msg']['error']['update'] )
					? '<p class="p-3 text-white bg-danger">' . $_SESSION['msg']['error']['update'] . '</p>' : '';

	$err_username = isset( $_SESSION['msg']['error']['update_username_required'] )
					? '<p class="p-3 text-white bg-danger">' . $_SESSION['msg']['error']['update_username_required'] . '</p>' : '';

	$err_old_password = isset( $_SESSION['msg']['error']['update_old_password_required'] )
					? '<p class="p-3 text-white bg-danger">' . $_SESSION['msg']['error']['update_old_password_required'] . '</p>' : '';

	$err_new_password = isset( $_SESSION['msg']['error']['update_new_password_required'] )
					? '<p class="p-3 text-white bg-danger">' . $_SESSION['msg']['error']['update_new_password_required'] . '</p>' : '';

	$err_old_password_invalid = isset( $_SESSION['msg']['error']['update_old_password_invalid'] )
					? '<p class="p-3 text-white bg-danger">' . $_SESSION['msg']['error']['update_old_password_invalid'] . '</p>' : '';
?>

<h3 class="text-center">Settings</h3>
<?php echo $success; ?>
<?php echo $err; ?>
<form action="controllers/handle.php" method="POST" class="mx-auto my-5">
	<div class="form-group">
		<label for="uname">Username</label>
		<?php echo $err_username; ?>
		<input class="form-control" type="text" name="uname" placeholder="Username" value="<?php echo $_SESSION['username']; ?>">
	</div>
	<div class="form-group">
		<label for="old-upw">Password</label>
		<?php echo $err_old_password; ?>
		<?php echo $err_old_password_invalid; ?>
		<input class="form-control" type="password" name="old-upw" placeholder="Password">
	</div>
	<div class="form-group">
		<label for="new-upw">New password</label>
		<?php echo $err_new_password; ?>
		<input class="form-control" type="password" name="new-upw" placeholder="New password">
	</div>
	<input type="hidden" name="method" value="PATCH">
	<button class="btn btn-primary">Save</button>
</form>
<hr>
<form action="controllers/handle.php" method="POST">
	<input type="hidden" name="method" value="DELETE">
	<button class="btn btn-danger">Delete account</button>
	Permanently delete this account.
</form>