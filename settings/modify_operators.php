<?php 
require 'global.php';
$conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE, $DATABASE_PORT);
$id = $_POST['id'];
$username = $_POST['userop'];
$admin = $_POST['admin'];
if (isset($_POST['passop'])){
  $pass = password_hash($_POST['passop'], PASSWORD_DEFAULT);
  $stmt = $conn->prepare("update users set username = ?, hash = ?, admin = ? where id = ?");
  $stmt->bind_param("ssii", $username, $pass, $admin, $id);
}else{
  $stmt = $conn->prepare("update users set username = ?, admin = ? where id = ?");
  $stmt->bind_param("sii", $username, $admin, $id);
}
$stmt->execute();
$stmt-> close();
