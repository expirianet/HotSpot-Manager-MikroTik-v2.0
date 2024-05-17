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
//error_reporting(0);
if (!isset($_SESSION["MIKHMON"])) {
  header("Location:../admin.php?id=login");
} else {

// array color
  $color = array('1' => 'bg-blue', 'bg-indigo', 'bg-purple', 'bg-pink', 'bg-red', 'bg-yellow', 'bg-green', 'bg-teal', 'bg-cyan', 'bg-grey', 'bg-light-blue');

  if (isset($_POST['save'])) {

    $suseradm = ($_POST['useradm']);
    $spassadm = encrypt($_POST['passadm']);
    $logobt = ($_POST['logobt']);
    $qrbt = ($_POST['qrbt']);

    $cari = array('1' => "MIKHMON<|<$useradm", "MIKHMON>|>$passadm");
    $ganti = array('1' => "MIKHMON<|<$suseradm", "MIKHMON>|>$spassadm");

    for ($i = 1; $i < 3; $i++) {
      $file = file("./include/config.php");
      $content = file_get_contents("./include/config.php");
      $newcontent = str_replace((string)$cari[$i], (string)$ganti[$i], "$content");
      file_put_contents("./include/config.php", "$newcontent");
    }

  
  $gen = '<?php $qrbt="' . $qrbt . '";?>';
          $key = './include/quickbt.php';
          $handle = fopen($key, 'w') or die('Cannot open file:  ' . $key);
          $data = $gen;
          fwrite($handle, $data);
    echo "<script>window.location='./admin.php?id=sessions'</script>";
  }

}
?>
<script>
  function Pass(id){
    var x = document.getElementById(id);
    if (x.type === 'password') {
    x.type = 'text';
    } else {
    x.type = 'password';
    }}
</script>

<div class="row">
	<div class="col-12">
  	<div class="card">
  		<div class="card-header">
  			<h3 class="card-title"><i class="fa fa-gear"></i> <?php if(isadmin()){echo $_admin_settings;} else{echo $_operator_settings;} ?> &nbsp; | &nbsp;&nbsp;<i onclick="location.reload();" class="fa fa-refresh pointer " title="Reload data"></i></h3>
  		</div>
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-server"></i> <?= $_router_list ?></h3>
              </div>
            <div class="card-body">
            <div class="row router-list">
               <!-- GENERACIÓN PARA ADMINS -->
               <?PHP
               if (isadmin()){
               $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE, $DATABASE_PORT);
               $list = "select session_name, hotspot_name, id from routers ";
               $result = $conn->query($list);
               while ($fetch = $result->fetch_assoc()) {
                 $router_id = $fetch["id"];
                 $_hotspot_name_value = $fetch["hotspot_name"];
                 $_session_name_value = $fetch["session_name"];
                 ?>
               <!-- //AQUÍ LA GENERACIÓN DEL EDIT -->
               <div class="col-12">
               <div class="box bmh-75 box-bordered <?= $color[rand(1, 11)]; ?>">
                       <div class="box-group">
                         
                         <div class="box-group-icon">
                           <span data-id="<?= $router_id; ?>" class="connect pointer" id="<?= $value; ?>">
                           <i class="fa fa-server"></i>
                           </span>
                         </div>
                       
                         <div class="box-group-area">
                           <span>
                             <?= $_hotspot_name ?> : <?= $_hotspot_name_value; ?><br>
                             <?= $_session_name ?> : <?= $_session_name_value; ?><br>
                             <span data-id="<?= $router_id; ?>" class="connect pointer"  id="<?= $_session_name_value; ?>"><i class="fa fa-external-link"></i> <?= $_open ?></span>&nbsp;
                             <a href="./admin.php?id=settings&session=<?= $_session_name_value;?>&edit=<?=$router_id;?>"><i class="fa fa-edit"></i> <?= $_edit ?></a>&nbsp;
                             <a href="settings/delete_router.php?router_id=<?=$router_id?>" onclick="if(confirm('Are you sure to delete data <?= $_session_name_value; ?>')}else{}"><i class="fa fa-remove"></i> <?= $_delete ?></a>
                           </span>
                         </div>
                       </div>
                     
                   </div>
                 </div>
               <?php }} else{ 
              // AQUÍ MODIFICAR ROUTER LIST PARA GENERAR PERSONALIZADAMENTE
              $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE, $DATABASE_PORT);
              $list = "select session_name, hotspot_name, id from routers r join user_router ur on r.id=ur.router_id where ur.user_id = '".$_SESSION['user_id']."'";
              $result = $conn->query($list);
              while ($fetch = $result->fetch_assoc()) {
                $router_id = $fetch["id"];
                $_hotspot_name_value = $fetch["hotspot_name"];
                $_session_name_value = $fetch["session_name"];
                ?>
              <!-- //AQUÍ LA GENERACIÓN DEL EDIT -->
              <div class="col-12">
              <div class="box bmh-75 box-bordered <?= $color[rand(1, 11)]; ?>">
                      <div class="box-group">
                        
                        <div class="box-group-icon">
                          <span class="connect pointer" id="<?= $_session_name_value; ?>">
                          <i class="fa fa-server"></i>
                          </span>
                        </div>
                      
                        <div class="box-group-area">
                          <span>
                            <?= $_hotspot_name ?> : <?= $_hotspot_name_value; ?><br>
                            <?= $_session_name ?> : <?= $_session_name_value; ?><br>

                             <span data-id="<?= $router_id; ?>" class="connect pointer"  id="<?= $_session_name_value; ?>"><i class="fa fa-external-link"></i> <?= $_open ?></span>&nbsp;
                          </span>
                        </div>
                      </div>
                    
                  </div>
                </div>
              <?php } }?>  
              </div>
            </div>
          </div>
        </div>
			    <div class="col-6">
          <form autocomplete="off" method="post" action="">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-user-circle"></i> <?php if (isadmin()){ echo $_admin;}else{echo $_operator_name;} ?></h3>
              </div>
            <div class="card-body">
      <table class="table table-sm">
        
        <tr>
          <td class="align-middle"><?= $_user_name ?> </td><td><input class="form-control" id="useradm" type="text" size="10" name="useradm" title="User Admin" value="<?= $_SESSION['MIKHMON']; ?>" required="1"/></td>
        </tr>
        <tr>
          <td class="align-middle"><?=$_change," ", $_password ?> </td>
          <td>
            <div class="input-group">
              <div class="input-group-11 col-box-10">
                <input class="group-item group-item-l" id="passadm" type="password" size="10" name="passadm" title="Password Admin"/>
              </div>

              <div class="input-group-1 col-box-2">
                <div class="group-item group-item-r pd-2p5 text-center">
                <input title="Show/Hide Password" type="checkbox" onclick="Pass('passadm')">
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td class="align-middle"><?= $_quick_print ?> QR</td>
          <td>
            <select class="form-control" name="qrbt">
            <option><?= $qrbt ?></option>
              <option>enable</option>
              <option>disable</option>
            </select>
          </td>
        </tr>
        <tr>
          <td></td><td class="text-right">
              <div class="input-group-4">
                  <input class="group-item group-item-l" type="submit" style="cursor: pointer;" name="save" value="<?= $_save ?>"/>
                </div>
                <div class="input-group-2">
                  <div style="cursor: pointer; height:31px" class="group-item group-item-r pd-2p5 text-center" title="Reload Data"><i class="fa fa-refresh"></i></div>
                </div>
                </div>
          </td>
        </tr>
      </table>
      <div id="loadV">v<?= $_SESSION['v']; ?> </div>
      <div><b id="newVer" class="text-green"></b></div>
    </div>
    </div>
    </form>
    <?php
    if (isset($_POST['save'])){
      include "settings/modify_user.php";
    }
  ?>
  </div>
</div>
</div>
</div>
</div>
</div>




