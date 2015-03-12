<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 9/3/15
 * Time: 3:22 PM
 * To change this template use File | Settings | File Templates.
 */
    include '../config.php';
    $id = stripslashes($_GET['id']);

    //Check if id is blank or anything else, then redirect to index page
    if($id == '' || $id == NULL) {
       header('Location:../index.php');
    }
    $getDeptData = $db->selectOne('departments', 'id="'.$id.'"');

    //Check id requested id and database id gets match or not
    if($getDeptData['id'] == $id) {
?>
    <html>
        <head>
            <title> View Department </title>
        </head>
        <table>
            <tr>
                <td> Department Name : </td>
                <td><input type="text" name="dept_name" value="<?php echo $getDeptData['name'];?>" readonly="readonly"></td>
            </tr>
            <tr>
                <td>
                    <input type="button" value="Back" onclick="window.history.back();"/>
                </td>
            </tr>
        </table>
    </html>
    <?php } else { header('Location:../index.php'); } ?>