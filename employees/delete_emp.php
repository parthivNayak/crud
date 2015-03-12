<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 9/3/15
 * Time: 11:40 AM
 * To change this template use File | Settings | File Templates.
 */

include_once('../config.php');
if($_POST['id']!="") {

    $checkUser = $db->selectOne("employees", "id ='".$_POST['id']."'");
    if($checkUser['id'] == $_POST['id']) {
        $deleteUser = $db->delete("employees", "id ='".$checkUser['id']."'");
        header('Location:../index.php');
    }
}
