<?php 
session_start();
if (empty($_SESSION['username']) OR empty($_SESSION['level'])) {
	header('location: '.BASE_URL.'/admin/');
}else{

	if ($_SESSION['level'] !='Admin' AND $_SESSION['level'] != 'Bendahara' ) {
	header('location: '.BASE_URL.'/admin/'); 
	}
}