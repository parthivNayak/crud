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

    $name   = $_POST['emp_name'];
    $dob    = $_POST['dob'];
    $doj    = $_POST['doj'];
    $gender = $_POST['gender'];
    if($_POST['manager_id']!="") {
        $manager_id = $_POST['manager_id'];
    } else {
        $manager_id = '';
    }
    $data = array(
        'name'          => $name,
        'manager_id'    => $manager_id,
        'dob'           => $dob,
        'gender'        => $gender,
        'hire_date'     => $doj,
        'created'       => date('Y-m-d', time()),
        'modified'      => date('Y-m-d', time())
    );

    if($_POST['action'] == 'add_emp') {

        //Check if data is inserted or not.
        if($db->insert('employees', $data)) {

            header('Location:../index.php');
        }
    } else if($_POST['action'] == 'edit_emp') {
        if($db->update('employees', $data, 'id="'.$_POST['emp_id'].'"')) {
            header('Location:../index.php');
        }
    }

}
