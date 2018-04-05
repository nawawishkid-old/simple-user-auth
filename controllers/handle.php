<?php
session_start();

$method = get_request_method();
$users = get_users();
$current_user = isset( $_SESSION['username'] ) ? $_SESSION['username'] : null;

/**
 * Log in
 */
if ( $method === 'POST' && $_POST['will'] === 'login' ) {
	if ( empty( $_POST['uname'] ) ) {
		msg( 'error', 'login_username_required', 'Username is required.' );
		// var_dump( $_SESSION['msg'] );
		redirect( '?login' );
	} elseif ( empty( $_POST['upw'] ) ) {
		msg( 'error', 'login_password_required', 'Password is required.' );
		redirect( '?login' );
	}

	if ( user_exist( $_POST['uname'] ) && password_verify( $_POST['upw'], $users[$_POST['uname']] ) ) {
		$_SESSION['username'] = $_POST['uname'];
		redirect();
	} else {
		msg( 'error', 'login_invalid', 'Given username or password is invalid.');
		redirect( '?login' );
	}

	exit;
}

/**
 * Register
 */
if ( $method === 'POST' && $_POST['will'] === 'register' ) {
	if ( empty( $_POST['uname'] ) ) {
		msg( 'error', 'register_username_required', 'Username is required.' );
		redirect();
	} elseif ( user_exist( $_POST['uname'] ) ) {
		msg( 'error', 'register_username_existed', 'The username is already existed.' );
		redirect();
	} elseif ( empty( $_POST['upw'] ) ) {
		msg( 'error', 'register_password_required', 'Password is required.' );
		redirect();
	}

	$users[$_POST['uname']] = password_hash( $_POST['upw'], PASSWORD_DEFAULT );

	if ( update_users( $users ) ) {
		msg( 'success', 'register', 'Thank you for registration. Let\'s log in!' );
		redirect( '?login' );
	}
}


if ( ! $current_user || ! user_exist( $current_user ) ) {
	http_response_code( 401 );
}

/**
 * Authenticated only area
 */
/**
 * Delete account
 */
if ( $method === 'DELETE' ) {
	if ( ! user_exist( $current_user ) ) {
		msg( 'error', 'delete', 'Error: user not found.' );
		redirect();
	}

	unset( $users[$current_user] );
	//pretty_print($users);

	if ( update_users( $users ) ) {
		$_SESSION = [];
		unset( $_SESSION );
		session_destroy();
		exit( 'Account deleted.' );
	}

	msg( 'error', 'delete', 'An error occured. Could not delete account.' );
	redirect();
}

/**
 * Update
 */
if ( $method === 'PATCH' ) {
	if ( empty( $_POST['uname'] ) ) {
		msg( 'error', 'update_username_required', 'Username is required.' );
		// var_dump( $_SESSION['msg'] );
		redirect( '?page=settings' );
	} elseif ( empty( $_POST['old-upw'] ) ) {
		msg( 'error', 'update_old_password_required', 'Password is required.' );
		redirect( '?page=settings' );
	} elseif ( empty( $_POST['new-upw'] ) ) {
		msg( 'error', 'update_new_password_required', 'New password is required.' );
		redirect( '?page=settings' );
	}

	if ( ! password_verify( $_POST['old-upw'], $users[$_POST['uname']] ) ) {
		msg( 'error', 'update_old_password_invalid', 'Old password is invalid.' );
		redirect( '?page=settings' );
	}

	$new = [
		$_POST['uname'] => password_hash( $_POST['new-upw'], PASSWORD_DEFAULT )
	];

	if ( update_users( array_merge( $users, $new ) ) ) {
		msg( 'success', 'update', 'Profile updated.' );
		redirect( '?page=settings' );
	} else {
		msg( 'error', 'update', 'Error occured. Could not update profile.' );
		redirect( '?page=settings' );
	}
}

/**
 * Functions
 */
function get_request_method() {
	$raw = strtoupper( $_SERVER['REQUEST_METHOD'] );

	if ( $raw === 'GET' )
		return 'GET';

	if ( ! empty( $_POST['method'] ) )
		return $_POST['method'];

	return 'POST';
}
function get_users() {
	$users = json_decode( file_get_contents( '../users.json' ), true );
	return is_null( $users ) ? [] : $users;
}
function update_users( $users ) {
	$success = file_put_contents( '../users.json', json_encode( $users ) );
	return $success === false ? false : true;
}

function user_exist( $username ) {
	global $users;
	return in_array( $username, array_keys( $users ) );
}

function msg( $type, $cat, $msg ) {
	if ( ! isset( $_SESSION['msg'] ) )
		$_SESSION['msg'] = [];

	if ( ! isset( $_SESSION['msg'][$type] ) )
		$_SESSION['msg'][$type] = [];

	$_SESSION['msg'][$type][$cat] = $msg;
	// var_dump( $_SESSION['msg']);
}

function redirect( $target = null ) {
	header( 'Location: ../' . $target );
	exit;
}

// for debugging
function pretty_print( $data, $is_dump = false ) {
	echo '<pre>';
	$is_dump ? var_dump( $data ) : print_r( $data );
	echo '</pre>';
}