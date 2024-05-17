<?php
/*
 *		Copyright (C) 2018 Laksamadi Guko.
 *
 *		This program is free software; you can redistribute it and/or modify
 *		it under the terms of the GNU General Public License as published by
 *		the Free Software Foundation; either version 2 of the License, or
 *		(at your option) any later version.
 *
 *		This program is distributed in the hope that it will be useful,
 *		but WITHOUT ANY WARRANTY; without even the implied warranty of
 *		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.		See the
 *		GNU General Public License for more details.
 *
 *		You should have received a copy of the GNU General Public License
 *		along with this program.		If not, see <http://www.gnu.org/licenses/>.
 */
session_start();
 // hide all error
error_reporting(0);
include('./lang/isocodelang.php');
include('include/funcs.php');
include('settings/global.php')
 
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ExpiriaNet Admin Page <?= $hotspotname; ?></title>
		<meta charset="utf-8">
		<meta http-equiv="cache-control" content="private" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=1">	
		
		<!-- MIKHMON UI -->
		<link rel="stylesheet" href="css/MIKHMON-ui.<?= $theme; ?>.min.css">
		<!-- jQuery -->
		<script src="js/jquery.min.js"></script>
		<!-- Expirianet headers -->
		<!-- loader-->
		<!-- <link href="expirianet/css/pace.min.css" rel="stylesheet"/>
		<script src="expirianet/js/pace.min.js"></script> -->
		<!--favicon-->
		<link rel="icon" href="expirianet/images/favicon.ico" type="image/x-icon">
		<!-- Bootstrap core CSS-->
		<link href="expirianet/css/bootstrap.min.css" rel="stylesheet"/>
		<link href="expirianet/css/icons.css" rel="stylesheet"/>
		<!-- animate CSS-->
		<link href="expirianet/css/animate.css" rel="stylesheet" type="text/css"/>
		<!-- Icons CSS-->
		<link href="expirianet/css/icons.css" rel="stylesheet" type="text/css"/>
		<!-- Custom Style-->
		<link href="expirianet/css/app-style.css" rel="stylesheet"/>
		<!-- simplebar CSS-->
		<link href="expirianet/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
		<!-- Sidebar CSS-->
		<link href="expirianet/css/sidebar-menu.css" rel="stylesheet"/>
		
	</head>
	<body class="bg-theme <?php if (!$_COOKIE["theme"]){
		echo "bg-theme1"; } else{
				echo $_COOKIE["theme"];} ?>">
		<div class="wrapper">