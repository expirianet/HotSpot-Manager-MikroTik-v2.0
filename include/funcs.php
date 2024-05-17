<?php
function isadmin(){
    include 'settings/global.php';

    $user_session = $_SESSION['user_session'];

    $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE, $DATABASE_PORT);
    $stmt= $conn->prepare("select admin from users where session = ?");
    $stmt->bind_param("s", $user_session);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt-> close();

    if ($reg = mysqli_fetch_array($result)) {
        if ($reg['admin']) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}