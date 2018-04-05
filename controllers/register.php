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

array_filter( $_POST, 'trim_value' );

$users = json_decode( file_get_contents( '../users.json' ), true );

$users = is_null( $users ) ? [] : $users;

if ( in_array( $_POST['uname'], array_keys( $users ) ) ) {
	$_SESSION['msg']['exists'] = 'The username already exists.';
	redirect();
}

$users[$_POST['uname']] = password_hash( $_POST['upw'], PASSWORD_DEFAULT );

file_put_contents( '../users.json', json_encode( $users ) );

redirect( '?login' );


/**
 * Functions
 */
function trim_value( &$value ) {
	$value = trim($value);
}
function redirect( $target = null ) {
	header( 'Location: ../' . $target );
	exit;
}