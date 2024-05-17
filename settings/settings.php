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

// hide all error
error_reporting(0);

// if (!isset($_SESSION["MIKHMON"])) {
//   header("Location:../admin.php?id=login");
// } else {

//   if ($id == "settings" && explode("-",$router)[0] == "new") {
//     $data = '$data';
//     $f = fopen('./include/config.php', 'a');
//     fwrite($f, "\n'$'data['".$router."'] = array ('1'=>'".$router."!','".$router."@|@','".$router."#|#','".$router."%','".$router."^','".$router."&Rp','".$router."*10','".$router."(1','".$router.")','".$router."=10','".$router."@!@disable');");
//     fclose($f);
//     $search = "'$'data";
//     $replace = (string)"$data";
//     $file = file("./include/config.php");
//     $content = file_get_contents("./include/config.php");
//     $newcontent = str_replace((string)$search, (string)$replace, "$content");
//     file_put_contents("./include/config.php", "$newcontent");
//     echo "<script>window.location='./admin.php?id=settings&session=" . $router . "'</script>";
//   }

//  else {
//       $sreload = $sreload;
//     }
//     $siface = ($_POST['iface']);
//     $sinfolp = implode(unpack("H*", $_POST['infolp']));
//     //$sinfolp = encrypt($_POST['infolp']);
//     //$sinfolp = ($_POST['infolp']);
//     $sidleto = ($_POST['idleto']);

//     $sesname = (preg_replace('/\s+/', '-', $_POST['sessname']));
//     $slivereport = ($_POST['livereport']);

//     $search = array('1' => "$session!$iphost", "$session@|@$userhost", "$session#|#$passwdhost", "$session%$hotspotname", "$session^$dnsname", "$session&$currency", "$session*$areload", "$session($iface", "$session)$infolp", "$session=$idleto", "'$session'", "$session@!@$livereport");

//     $replace = array('1' => "$sesname!$siphost", "$sesname@|@$suserhost", "$sesname#|#$spasswdhost", "$sesname%$shotspotname", "$sesname^$sdnsname", "$sesname&$scurrency", "$sesname*$sreload", "$sesname($siface", "$sesname)$sinfolp", "$sesname=$sidleto", "'$sesname'", "$sesname@!@$slivereport");

//     for ($i = 1; $i < 15; $i++) {
//       $file = file("./include/config.php");
//       $content = file_get_contents("./include/config.php");
//       $newcontent = str_replace((string)$search[$i], (string)$replace[$i], "$content");
//       file_put_contents("./include/config.php", "$newcontent");
//     }
//     $_SESSION["connect"] = "";
//     echo "<script>window.location='./admin.php?id=settings&session=" . $sesname . "'</script>";
//   }
//   if ($currency == "") {
//     echo "<script>window.location='./admin.php?id=settings&session=" . $session . "'</script>";
//   }
// }

// EXPIRIA VERSION
$operators = [];
  if (isset($_GET["edit"])){
  $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE, $DATABASE_PORT);
  $id = $_GET["edit"];  
  $stmt= $conn->prepare("select * from routers where id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($fetch = mysqli_fetch_array($result)){
    $session_name = $fetch["session_name"];
    $ip_mikrotik = $fetch["ip_mikrotik"];
    $username = $fetch["username"];
    $password = $fetch["password"];
    $hotspot_name = $fetch["hotspot_name"];
    $dns_name = $fetch["dns_name"];
    $currency = $fetch["currency"];
    $auto_load = $fetch["auto_load"];
    $idle_timeout = $fetch["idle_timeout"];
    $traffic_interface = $fetch["traffic_interface"];
    $live_report = $fetch["live_report"];
  }
  $stmt= $conn->prepare("select user_id from user_router where router_id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt-> close();
  while ($fetch = mysqli_fetch_array($result)){
    $operators[] = $fetch["user_id"];
 }
}
?>
<script>
  function PassMk(){
    var x = document.getElementById('passmk');
    if (x.type === 'password') {
    x.type = 'text';
    } else {
    x.type = 'password';
    }}
    function PassAdm(){
    var x = document.getElementById('passadm');
    if (x.type === 'password') {
    x.type = 'text';
    } else {
    x.type = 'password';
  }}
  
</script>
<?php
$conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE, $DATABASE_PORT);
$stmt = $conn->prepare("select * from user_router where user_id= ? and router_id= ? ");
$stmt->bind_param("ii", $_SESSION['user_id'], $id);
$stmt->execute();
$result = $stmt->get_result();
$fetch = mysqli_fetch_array($result);
$stmt-> close();
if (isadmin() || $fetch || !isset($_GET['edit'])){
?>

<form autocomplete="off" method="post" action="settings/session_settings_action.php" name="settings">  
  <?php   if (isset($_GET["edit"])){ echo "<input type='hidden' name='edit' value= $id />"; }?>
<div class="row">
	<div class="col-12">
  		<div class="card" >
  			<div class="card-header">
  				<h3 class="card-title"><i class="fa fa-gear"></i> <?= $_session_settings ?> &nbsp; | &nbsp;&nbsp;<i onclick="location.reload();" class="fa fa-refresh pointer " title="Reload data"></i></h3>
  			</div>
        <div class="card-body">
    	   <div class="row">
			     <div class="col-6">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"><?= $_session ?></h3>
                </div>
                <div class="card-body">
                  <table class="table">
                    <tr>
                      <td><?= $_session_name ?></td>
                      <td><input class="form-control" id="sessname" type="text" name="sessname" title="Session Name" value="<?php if( isset($session_name)){echo $session_name;} ?>" required="1"/></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-12">
				      <div class="card">
        	     <div class="card-header">
            	   <h3 class="card-title">MikroTik <?= $_SESSION["connect"]; ?></h3>
        	     </div>
        	     <div class="card-body">
				<table class="table table-sm">
					<tr>
	  					<td class="align-middle">IP MikroTik </td><td><input class="form-control" type="text" size="15" name="ipmik" title="IP MikroTik / IP Cloud MikroTik" value="<?=$ip_mikrotik; ?>" required="1"/></td>
					</tr>
					<tr>
						<td class="align-middle">Username  </td><td><input class="form-control" id="usermk" type="text" size="10" name="usermik" title="User MikroTik" value="<?= $username ; ?>" required="1"/></td>
					</tr>
					<tr>
						<td class="align-middle">Password  </td><td>
							<div class="input-group">
								<div class="input-group-11 col-box-10">
        						<input class="group-item group-item-l" id="passmk" type="password" name="passmik" title="Password MikroTik" value="<?= $password; ?>" required="1"/>
        						</div>
            					<div class="input-group-1 col-box-2">
            						<div class="group-item group-item-r pd-2p5 text-center align-middle">
                						<input title="Show/Hide Password" type="checkbox" onclick="PassMk()">
            						</div>
            					</div>
    						</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
								<div class="input-group-4">
									<input style="height: 31px;" class="group-item group-item-md" type="submit" style="cursor: pointer;" name="save" value="Save"/>
								</div>
								<div class="input-group-4">	
                  <span class="connect pointer group-item group-item-md pd-2p5 text-center align-middle" style="display:flex; height: 31px; align-items: center; justify-content:center;" id="<?= $session_name; ?>&c=settings">Connect</span>
								</div>
								<div class="input-group-3">	
                  <span class="pointer group-item group-item-md pd-2p5 text-center align-middle" style="display:flex;   height: 31px; align-items: center; justify-content:center;" id="ping_test">Ping</span>
              	</div>
              	<div class="input-group-1">	
									<div style="cursor: pointer; height: 31px;" class="group-item group-item-r pd-2p5 text-center" onclick="location.reload();" title="Reload Data"><i class="fa fa-refresh"></i></div>
								</div>
            		</div>	
    					</td>
    				</tr>
				</table>
			</div>
    </div>  	
    <div id="ping">
    </div>	
	</div>
</div>
<div class="col-6">
<div class="col-12">
	<div class="card">
        <div class="card-header">
            <h3 class="card-title">MIKHMON Data</h3>
        </div>
    <div class="card-body">    
	<table class="table table-sm">
	<tr>
	<td class="align-middle"><?= $_hotspot_name ?>  </td><td><input class="form-control" type="text" size="15" maxlength="50" name="hotspotname" title="Hotspot Name" value="<?= $hotspot_name; ?>" required="1"/></td>
	</tr>
	<tr>
	<td class="align-middle"><?= $_dns_name ?>  </td><td><input class="form-control" type="text" size="15" maxlength="500" name="dnsname" title="DNS Name [IP->Hotspot->Server Profiles->DNS Name]" value="<?=$dns_name;?>" required="1"/></td>
	</tr>
	<tr>
	<td class="align-middle"><?= $_currency ?>  </td><td><input class="form-control" type="text" size="3" maxlength="4" name="currency" title="currency" value="<?=$currency;?>" required="1"/></td>
	</tr>
	<tr> 
	<td class="align-middle"><?= $_auto_reload ?></td><td>
	<div class="input-group">
		<div class="input-group-10">
        	<input class="group-item group-item-l" type="number" min="10" max="3600" name="areload" title="Auto Reload in sec [min 10]" value="<?= $auto_load; ?>" required="1"/>
    	</div>
            <div class="input-group-2">
                <span class="group-item group-item-r pd-2p5 text-center align-middle"><?= $_sec ?></span>
            </div>
        </div>
	</td>
  </tr>
  <tr>
  <td class="align-middle"><?= $_idle_timeout ?></td>
  <td>
  <div class="input-group">
  <div class="input-group-9">
      <select class="group-item group-item-l" name="idleto" required="1">
          <option value="<?= $idle_timeout ?>"><?= $idle_timeout ?></option>
				  <option value="5">5</option>
          <option value="10">10</option>
          <option value="30">30</option>
          <option value="60">60</option>
          <option value="disable">disable</option>
      </select>
  </div>
  <div class="input-group-3">
                <span class="group-item group-item-r pd-3p5 text-center align-middle"><?= $_min ?></span>
            </div>
        </div>
    </td>
	</tr>
	<tr>
	<td class="align-middle"><?= $_traffic_interface ?></td><td><input class="form-control" type="number" min="1" max="99" name="iface" title="Traffic Interface" value="<?= $traffic_interface ?>" required="1"/></td>
	</tr>
  <?php if (empty($live_report)) {
  } else { ?>
  <tr>
    <td><?= $_live_report ?></td>
    <td>
      <select class="form-control" name="livereport" >
          <option value="<?= $live_report; ?>"><?= ucfirst($live_report); ?></option>
				  <option value="enable">Enable</option>
				  <option value="disable">Disable</option>
		  </select>
    </td>
  </tr>
  <?php 
} ?>
</table>
</div>
</div>
<?php if (isadmin()){  ?>
<div class= "row">
<div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Assign operators</h3>
                </div>
                <div class="card-body">
                  <table class="table">
                    <tr id= "operators">
                      <td><?= $_operator_name ?></td>
                      <td class="operators"><details>
                            <summary>
                            <?=$_operator_name?>
                            </summary>
                            <?php 
                            $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE, $DATABASE_PORT);
                            $stmt = $conn->prepare("select id, username from users where admin = 0 ");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $stmt-> close();
                            while ($fetch = mysqli_fetch_array($result)){
                              $operator = $fetch['username'];
                              $operator_id = $fetch['id'];
                              if (in_array($operator_id, $operators)){
                              echo <<<EOL
                                <input id=$operator_id type="checkbox" name="operators[]" title="Operators" value="$operator_id" checked />
                                <label for="$operator_id">$operator</label>
                              EOL;   
                              } else{
                                echo <<<EOL
                                <input id=$operator_id type="checkbox" name="operators[]" title="Operators" value="$operator_id" />
                                <label for="$operator_id">$operator</label>
                              EOL;
                              }
                            }
                            ?>
                          </td>
                    </tr>
                  </table>
                </div>
              </div>
              <?php } ?>
</div>
</div>
</div>
</div>
</form>
<?php
} else {
  echo "<meta http-equiv='refresh' content='0;url=../' />";


}


