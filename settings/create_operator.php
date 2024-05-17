<?php
session_start();
$username = $_POST["userop"];
$password = $_POST["passop"];
$password = password_hash($password, PASSWORD_DEFAULT);
$session = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));
include 'global.php';
$conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE, $DATABASE_PORT);
$stmt = $conn->prepare("insert into users(username, hash, admin, session) values(?, ?, '0', ?)");
$stmt->bind_param("sss", $username, $password, $session);
$stmt->execute();
if (isset($_POST['routers'])) {
    $take_last_id = "select id from users order by id desc limit 1";
    $result = $conn->query($take_last_id);
    $fetch = $result->fetch_assoc();
    $user_id= $fetch["id"];
    $routers = $_POST["routers"];
    $stmt = $conn->prepare("insert into user_router values(?, ?)");
    $i= 0;
    while ($i < count($routers)){
        $stmt->bind_param("ii", $user_id, $routers[$i] );
        $stmt->execute();
        $i ++;
    }
}
$stmt-> close();
echo "<meta http-equiv='refresh' content='0;url=../' />";

