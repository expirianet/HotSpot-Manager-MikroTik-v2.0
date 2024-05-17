<script>
  function Pass(id){
    var x = document.getElementById(id);
    if (x.type === 'password') {
    x.type = 'text';
    } else {
    x.type = 'password';
    }}
</script>

<div style="width:50%;">
  <form autocomplete="off" method="post" action="settings/create_operator.php">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fa fa-user-circle"></i> <?= $_new_operator ?></h3>
      </div>
      <div class="card-body">
        <table class="table table-sm">
          <tr>
            <td class="align-middle"><?= $_user_name ?> </td><td><input class="form-control" id="useradm" type="text" size="10" name="userop" required="1"/></td>
          </tr>

          <tr>
            <td class="align-middle"><?= $_password ?> </td>
            <td>
              <div class="input-group">
                <div class="input-group-11 col-box-10">
                  <input class="group-item group-item-l" id="passadm" type="password" size="10" name="passop" title="Password Admin"/>
                </div>

                <div class="input-group-1 col-box-2">
                  <div class="group-item group-item-r pd-2p5 text-center">
                  <input title="Show/Hide Password" type="checkbox" onclick="Pass('passadm')">
                </div>
              </div>
            </td>
        </tr>
        <tr id= "operators">
          <td>Routers</td>
          <td class="operators"><details>
            <summary>
            Routers
            </summary>
          <?php 
            $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE, $DATABASE_PORT);
            $stmt = $conn->prepare("select id, session_name from routers");
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt-> close();
            while ($fetch = mysqli_fetch_array($result)){
              $router = $fetch['session_name'];
              $router_id = $fetch['id'];
              echo <<<EOL
                <input id=$router_id type="checkbox" name="routers[]" title="routers" value="$router_id"/>
                <label for="$router_id">$router</label>
              EOL;   
            }
            ?>
            
          </details></td>
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
  
  </div>
<!-- Recogida de formulario -->
<?php
if (isset($_POST['save'])){
  $id = $_POST['id']; 
  $delete_links = "delete from user_router where user_id = $id";
  $conn->execute_query($delete_links);
  if (isset($_POST['routers'])) {
    $routers = $_POST['routers'];
    $stmt = $conn->prepare("insert into user_router values(?, ?)");
    $i = 0;
    while ($i < count($routers)){
        $stmt->bind_param("ii", $id, $routers[$i] );
        $stmt->execute();
        $i ++;
    }
}

  include('settings/modify_user.php');

 } elseif (isset($_POST['delete'])){
  $id = $_POST['id'];
  $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE, $DATABASE_PORT);
  $stmt = $conn->prepare("delete from users where id = $id");
  $stmt->execute();
  $stmt = $conn->prepare("delete from user_router where user_id = $id");
  $stmt->execute();
  
}
?>
<!-- aqui -->




<!-- MANAGE OPERATORS  -->
<div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fa fa-user-circle"></i> <?= $_operator_list ?></h3>
      </div>
    <div class="card-body">

<table id="dataTable" class="table table-bordered table-hover text-nowrap">
  <thead>
  <tr>
    <th style="min-width:50px;" class="align-middle text-center" id="cuser"><?= $_user_name; ?></th>
    <th style="min-width:50px;" class="pointer"> <?= $_password; ?></th>
    <th style="min-width:50px;" class="pointer">Routers</th>
    <th class="pointer"><?= $_admin ?></th>
    <th class="pointer"></i> <?= $_delete ?></th>
	  <th class="pointer"> update</th>
    </tr>
  </thead>
  <tbody id="tbody">
<?php
$conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE, $DATABASE_PORT);
$generate_table = $conn->prepare("select * from users where username != 'admin' ");
$generate_table->execute();
$elements_table = $generate_table->get_result();
$generate_table-> close();
while ($fetch_table = mysqli_fetch_array($elements_table)){
$username = $fetch_table["username"];
$admin = $fetch_table["admin"];
$id = $fetch_table["id"];
if ($admin == 1){
  $isadmin="Yes";
} else{
  $isadmin= "No";
}
 echo <<<EOL
  <form method = "post" action= "">
  <tr>
  <td> <input class="form-control" type = "text" name = "useradm" value = "$username"> </td>
  <td> <input class="form-control" type = "pasasword" name="passadm "></td>
  <td> <details>
        <summary>
        Routers
        </summary>
  EOL;
  $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE, $DATABASE_PORT);
            $stmt = $conn->prepare("select id, session_name from routers");
            $stmt->execute();
            $result = $stmt->get_result();

            while ($fetch = mysqli_fetch_array($result)){
              $router = $fetch["session_name"];
              $router_id = $fetch["id"];
              $stmt = $conn->prepare("select * from user_router where user_id=? and router_id = ?");
              $stmt->bind_param("ii", $id, $router_id);
              $stmt->execute();
              $result2 = $stmt->get_result();
              if($fetch2 = mysqli_fetch_array($result2)){
                echo <<<  EOL
                <input id=$router_id type="checkbox" name="routers[]" title="routers" value="$router_id" checked/>
                <label for="$router_id">$router</label></td>
                EOL;
              } else{
                echo <<<  EOL
                <input id=$router_id type="checkbox" name="routers[]" title="routers" value="$router_id"/>
                <label for="$router_id">$router</label></td>
                EOL;
                }
 
            }
    echo <<<EOL
  </details> </td>
 <td> <select class="form-control name="admin">
 <option  value = "$admin">$isadmin</option>
 <option value="1">Si</option>
 <option value="0">No</option></td>
 </select>
 <td> <input class="form-control" type = "submit" name="delete" value="delete"> </td>
 <td> <input class="form-control" type="submit"name="save" value="save"</td>
 <input class="form-control" type = "hidden" name="id" value="$id">
 </tr>
 </form>
 EOL;
}

?>
  </tr>
  </tbody>
</table>
</div>
</div>
  </form>
</div>