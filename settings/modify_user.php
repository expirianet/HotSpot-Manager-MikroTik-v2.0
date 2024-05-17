<?php 
session_start();
require 'global.php';
$conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE, $DATABASE_PORT);
if (isset($_POST['passadm'])){
  $pass = password_hash($_POST['passadm'], PASSWORD_DEFAULT);
  $stmt = $conn->prepare("update users set username = ?, hash = ? where username = ?");
  $stmt->bind_param("sss", $_POST['useradm'], $pass, $_SESSION['MIKHMON']);
}else{
  $stmt = $conn->prepare("update users set username = ? where username = ?");
  $stmt->bind_param("ss", $_POST['useradm'], $_SESSION['MIKHMON']);
}
$stmt->execute();
$stmt-> close();
$_SESSION['MIKHMON'] = $_POST['useradm'];
echo "<meta http-equiv='refresh'/>";

      