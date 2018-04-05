<?php
session_start();

// $errName = ! empty( $_SESSION['msg']['uname'] ) ? $_SESSION['msg']['uname'] : '';
// $errPw = ! empty( $_SESSION['msg']['upw'] ) ? $_SESSION['msg']['upw'] : '';
// $errInvalid = ! empty( $_SESSION['msg']['invalid'] ) ? $_SESSION['msg']['invalid'] : '';

$is_login = isset( $_GET['login'] );

require_once 'header.php';
?>

	<?php
		if ( ! empty( $_SESSION['username'] ) ) {
			echo "<h3 class='text-center py-5'>Welcome, {$_SESSION['username']}</h3>";
			include_once 'views/admin/index.php';
		} else {
			echo "<h3 class='text-center py-5'>You're not logged in.</h3>";
			include_once $is_login ? 'views/login.php' : 'views/signup.php';
		}
	?>

<?php require_once 'footer.php'; ?>
