<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 9/3/15
 * Time: 2:38 PM
 * To change this template use File | Settings | File Templates.
 */
    include_once('../config.php');
if($_POST['id']!="") {

    $checkDept = $db->selectOne("departments", "id ='".$_POST['id']."'");
    if($checkDept['id']!='') {
            $deleteDept = $db->delete("departments", "id ='".$checkDept['id']."'");
            header('Location:../index.php');
        }

}

