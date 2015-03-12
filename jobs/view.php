<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 10/3/15
 * Time: 2:58 PM
 * To change this template use File | Settings | File Templates.
 */
include '../config.php';
$id = stripslashes($_GET['id']);

//Check if id is blank or anything else, then redirect to index page
if($id == '' || $id == NULL) {
    header('Location:../index.php');
}
$jobData = $db->selectOne('job_titles', 'id="'.$id.'"');

//Check id requested id and database id gets match or not
if($jobData['id'] == $id) {
    ?>
<html>
<head>
    <title> View Job Title </title>
</head>
<table>
    <tr>
        <td> Job Title : </td>
        <td><input type="text" name="title_name" value="<?php echo $jobData['title'];?>" readonly="readonly"></td>
    </tr>
    <tr>
        <td>
            <input type="button" value="Back" onclick="window.history.back();"/>
        </td>
    </tr>
</table>
</html>
<?php } else { header('Location:../index.php'); } ?>