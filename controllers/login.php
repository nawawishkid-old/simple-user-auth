<?php
session_start();

if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
	//header( 'Status: ' );
	http_response_code( 405 );
	exit( 'Method not allowed!' );
}

$uname = $_POST['uname'];
$upw = $_POST['upw'];

$_SESSION['msg'] = [];

if ( empty( $uname ) || empty( $upw ) ) {
	$_SESSION['msg']['uname'] = 'Username is required!';
	$_SESSION['msg']['upw'] = 'Password is required!';
	redirect();
}

$users = json_decode( file_get_contents( '../users.json' ), true );

if ( in_array( $uname, array_keys( $users ) ) && password_verify( $upw, $users[$uname] ) ) {
	$_SESSION['username'] = $uname;
	redirect();
} else {

	// $attempt = isset( $_COOKIE['login_attempt'] ) ? $_COOKIE['login_attempt'] : 0;
	// setcookie( 'login_attempt', $attempt + 1, time() + 3600 );

	$_SESSION['msg']['invalid'] = 'Given username or password is invalid!';
	redirect();
}



/**
 * Functions 
 */
function redirect() {
	header( 'Location: ../index.php' );
	exit;
}

?>