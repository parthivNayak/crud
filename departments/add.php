<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 9/3/15
 * Time: 10:33 AM
 * To change this template use File | Settings | File Templates.
 */
include_once('../config.php');
if(isset($_POST['submit']) && !empty($_POST['submit'])) {

    $name   = $_POST['dept_name'];

    $data = array(
        'name'          => $name,
        'created'       => date('Y-m-d', time()),
        'modified'      => date('Y-m-d', time())
    );
    if($_POST['action'] == 'add_dept') {
        //Check if data is inserted or not.
        if($db->insert('departments', $data)) {

            header('Location:../index.php');
        }
    } else if($_POST['action'] == 'edit_dept') {
        $db->update('departments', $data, 'id ="'.$_POST['dept_id'].'"');
        header('Location:../index.php');
    }

}
