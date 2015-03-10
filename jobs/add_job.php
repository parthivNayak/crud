<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 10/3/15
 * Time: 3:16 PM
 * To change this template use File | Settings | File Templates.
 */
include '../config.php';
if(isset($_POST['submit']) && !empty($_POST['submit'])) {
    $name       = $_POST['title'];

    $data = array(
        'title'         =>$name,
        'created'       => date('Y-m-d h:i:s'),
        'modified'      => date('Y-m-d h:i:s')
    );


    if($_POST['action']=='add_job') {
        if($db->insert('job_titles', $data)) {
            header('Location:../index.php');
        }

    } else if($_POST['action']=='edit_job') {
        $db->update('job_titles', $data, 'id ="'.$_POST['job_id'].'"');
        header('Location:../index.php');

    }
}