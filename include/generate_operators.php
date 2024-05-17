<?php
// <!-- When press save -->
if (isset($_POST['save'])){
    $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE, $DATABASE_PORT);
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
    include('settings/modify_operators.php');
// When press delete
 }  elseif (isset($_POST['delete'])){
        $id = $_POST['id'];
        $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE, $DATABASE_PORT);
        $stmt = $conn->prepare("delete from users where id = $id");
        $stmt->execute();
        $stmt = $conn->prepare("delete from user_router where user_id = $id");
        $stmt->execute();
  
    }
?>
<!-- Show pass script -->

<script>
  function Pass(id){
    var x = document.getElementById(id);
    if (x.type === 'password') {
    x.type = 'text';
    } else {
    x.type = 'password';
    }}
</script>
<div>
<!-- Operator creation form -->
    <div class="card" style="width:50%;">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-user-circle"></i> <?=$_new_operator?> </h3>
        </div>
        <div class="card-body">
            <table class="table table-sm">
            <form autocomplete="off" method="post" action="settings/create_operator.php">
                <tr>
                    <td class="align-middle"><?= $_user_name ?> </td>
                    <td><input class="form-control" id="useradm" type="text" size="10" name="userop" required="1"/></td>
                </tr>
                <tr>
                    <td class="align-middle"><?= $_password ?></td>
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
                        </div>
                    </td>
                </tr>
                <tr id= "operators">
                    <td>Routers</td>
                    <td class="operators">
                        <details>
                            <summary>Routers</summary>
                            <?php
                                $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE, $DATABASE_PORT);
                                $routers_query = $conn->prepare("select id, session_name from routers");
                                $routers_query->execute();
                                $result_query = $routers_query->get_result();
                                $routers_query-> close();
                                while ($fetch_query = mysqli_fetch_array($result_query)){
                                    $router = $fetch_query['session_name'];
                                    $router_id = $fetch_query['id'];
                                    echo <<<EOL
                                        <input id=$router_id type="checkbox" name="routers[]" title="routers" value="$router_id"/>
                                        <label for="$router_id">$router</label>
                                    EOL;
                                }
                            ?>
                        </details>
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <div class="input-group-4">
                            <input class="group-item group-item-l" type="submit" style="cursor: pointer;" name="save_new_op" value="<?= $_save ?>"/>
                        </div>
                    </td>
                </tr>
            </form>
            </table>
        </div>
    </div>
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
                        $generate_table = $conn->prepare("select * from users where id != 1 ");
                        $generate_table->execute();
                        $elements_table = $generate_table->get_result();
                        $generate_table-> close();
                        while ($fetch_table = mysqli_fetch_array($elements_table)){
                            $username = $fetch_table["username"];
                            $admin = $fetch_table["admin"];
                            $id = $fetch_table["id"];
                            if ($admin == 1){
                            $isadmin = $_yes;
                            } else{
                            $isadmin = $_no;
                            }
                            echo <<<EOL
                            <form method = "post" action= "">
                            <tr>
                                <td> <input class="form-control" type = "text" name = "userop" value = "$username"> </td>
                                <td> <input class="form-control" type = "password" name="passop "></td>
                                <td>
                                    <details>
                                    <summary>Routers</summary>
                            EOL;
                            $stmt_routers = $conn->prepare("select id, session_name from routers");
                            $stmt_routers->execute();
                            $result_routers = $stmt_routers->get_result();
                            while ($fetch_routers = mysqli_fetch_array($result_routers)){
                                $router = $fetch_routers["session_name"];
                                $router_id = $fetch_routers["id"];
                                $stmt = $conn->prepare("select * from user_router where user_id=? and router_id = ?");
                                $stmt->bind_param("ii", $id, $router_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if($fetch = mysqli_fetch_array($result)){
                                    echo <<<  EOL
                                        <input id=$router_id type="checkbox" name="routers[]" title="routers" value="$router_id" checked/>
                                        <label for="$router_id">$router</label></td>
                                    EOL;
                                }else{
                                    echo <<<  EOL
                                        <input id=$router_id type="checkbox" name="routers[]" title="routers" value="$router_id"/>
                                        <label for="$router_id">$router</label></td>
                                    EOL;
                                }
                            }
                            echo <<<EOL
                                    </details>
                                </td>
                                <td>
                                    <select class="form-control" name="admin">
                                        <option  value ="$admin">$isadmin</option>
                                        <option value="1">$_yes</option>
                                        <option value="0">$_no</option>
                                    </select>
                                </td>
                                <td> <input class="form-control" type = "submit" name="delete" value="delete"> </td>
                                <td> <input class="form-control" type="submit" name="save" value="$_save"</td>
                                <input class="form-control" type = "hidden" name="id" value="$id">
                            </tr>
                            </form>
                            EOL; 
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>






</div>