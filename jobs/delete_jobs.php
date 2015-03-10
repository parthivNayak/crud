<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 10/3/15
 * Time: 3:57 PM
 * To change this template use File | Settings | File Templates.
 */
include_once('../config.php');
if($_POST['id']!="") {

    $checkJobs = $db->selectOne("job_titles", "id ='".$_POST['id']."'");
    if($checkJobs['id'] == $_POST['id']) {
        $deleteJob = $db->delete("job_titles", "id ='".$checkJobs['id']."'");
        header('Location:../index.php');
    }
}