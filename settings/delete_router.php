<?php
require_once("global.php");
$id= $_GET["router_id"];
$conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE, $DATABASE_PORT);
$stmt = $conn->prepare("delete from routers where id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$id= $_GET["router_id"];
$stmt = $conn->prepare("delete from user_router where router_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt-> close();
echo "<meta http-equiv='refresh' content='0;url=../' />";
