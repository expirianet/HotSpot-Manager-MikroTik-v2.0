<?php
session_start();
include 'global.php';

$conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE, $DATABASE_PORT);
$session_name = $_POST['sessname'];
$ip_mikrotik = $_POST['ipmik'];
$username = $_POST['usermik'];
$password = $_POST['passmik'];
$hotspot_name = $_POST['hotspotname'];
$dns_name = $_POST['dnsname'];
$currency = $_POST['currency'];
$auto_load = $_POST['areload'];
$idle_timeout = $_POST['idleto'];
$traffic_interface = $_POST['iface'];
$live_report = $_POST['livereport'];
$id= $_POST['edit'];
if (isset($_POST['operators'])) {
    $operators = $_POST['operators'];
}else{
    $operators = [];
}
if (isset ($id)) {
    $stmt = $conn->prepare("update routers set session_name = ?, ip_mikrotik = ?, username = ?, password = ?, hotspot_name = ?, dns_name = ?, currency = ?, auto_load = ?, idle_timeout = ?, traffic_interface = ?, live_report = ? where id =?");
    $stmt->bind_param("sssssssiiisi", $session_name,$ip_mikrotik, $username, $password, $hotspot_name,$dns_name, $currency, $auto_load, $idle_timeout, $traffic_interface, $live_report, $id);
    $stmt->execute();
    $stmt-> close();
    $delete_links = "delete from user_router where router_id = $id";
    $conn->execute_query($delete_links);
    $i= 0;
    while ($i < count($operators)) {
        $add_links = "insert into user_router values($operators[$i], $id)";
        $conn->execute_query($add_links);
        $i ++;  
    }
    echo "<meta http-equiv='refresh' content='0;url=../admin.php?id=settings&session=$session_name&edit=$id' />";

} else {
    $stmt = $conn->prepare("insert into routers(session_name, ip_mikrotik, username, password, hotspot_name, dns_name, currency, auto_load, idle_timeout, traffic_interface, live_report) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'disable')");
    $stmt->bind_param("sssssssiii", $session_name,$ip_mikrotik, $username, $password, $hotspot_name,$dns_name, $currency, $auto_load, $idle_timeout, $traffic_interface);
    $stmt->execute();
    $stmt-> close();
    $take_last_id = "select id from routers order by id desc limit 1";
    $result = $conn->query($take_last_id);
    $fetch = $result->fetch_assoc();
    $router_id= $fetch["id"];
    $i= 0;
    $stmt = $conn->prepare("insert into user_router values(?, ?)");
    while ($i < count($operators)){
        $stmt->bind_param("ii", $operators[$i], $router_id );
        $stmt->execute();
        $i ++;
    }
    $stmt-> close();
    echo "<meta http-equiv='refresh' content='0;url=../admin.php?id=settings&session=$session_name&edit=$router_id' />";
}


 
// echo "<meta http-equiv='refresh' content='0;url=../' />";