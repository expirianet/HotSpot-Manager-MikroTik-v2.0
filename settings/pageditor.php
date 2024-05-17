
<?php
/*
 *  Copyright (C) 2018 Laksamadi Guko.
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
session_start();
?>
<?php
error_reporting(0);
if (!isset($_SESSION["MIKHMON"])) {
	header("Location:../admin.php?id=login");
} else {
// load session MikroTik
	$session = $_GET['session'];

// load config
include('../include/config.php');
include('../include/readcfg.php');

$url = $_SERVER['REQUEST_URI'];
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrapesJS Editor</title>
    <link rel="stylesheet" href="settings/dist/css/grapes.min.css">
    <link rel="stylesheet" href="settings/css/styles.css">
</head>

<body>
	<div id="editor"></div>
    <script src="settings/dist/js/grapes.min.js"></script>
    <script src="settings/js/script.js"></script>
</body>

<?php } ?>