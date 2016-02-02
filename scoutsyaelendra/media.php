<?php
	//start session
	ob_start();
	session_start();
	error_reporting(0);
	//require system files
	include "josys/koneksi.php";
	include "josys/library.php";
	include "josys/fungsi_rupiah.php";
	include "josys/fungsi_indotgl.php";
	include "josys/fungsi_pagingzi.php";
	include "template.php";
?>
