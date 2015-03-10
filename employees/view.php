<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 9/3/15
 * Time: 2:41 PM
 * To change this template use File | Settings | File Templates.
 */
    include '../config.php';
    $id = stripslashes($_GET['id']);

    //Check if, id is blank or anythig else, redirect it to index page
    if($id == '' || $id == NULL) {
        header('Location:../index.php');
    }

    $getEmpData = $db->selectOne('employees', 'id="'.$id.'"');
    //Check if requested id and database id gets match or not
    if($getEmpData['id'] == $id) {
    ?>
    <html>
        <head>
        <title> View Employee </title>
    </head>

    <table>
        <tr>
            <td> Employee Name : </td>
            <td><input type="text" name="emp_name" value="<?php echo $getEmpData['name'];?>" readonly="readonly"></td>
        </tr>
        <tr>
            <td> Gender : </td>
            <td>
                <select name="gender" readonly="readonly">
                    <?php if($getEmpData['gender'] == 'male') { ?>
                        <option value="male" selected="selected"> Male</option>
                     <?php } else if($getEmpData['gender'] == 'female') { ?>
                        <option value="female" selected="selected"> Female </option>
                     <?php } ?>
                </select>
            </td>
        </tr>
        <?php
            if($getEmpData['manager_id'] > 0) {
                $managerData = $db->selectOne('employees', 'id="'.$getEmpData['manager_id'].'"');

        ?>
            <tr>
                <td> Manager :</td>
                <td>
                    <select>
                        <option value=""><?php echo $managerData['name'];?></option>
                    </select>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td> Date of Birth : </td>
            <td><input type="text" name="dob" value="<?php echo $getEmpData['dob']; ?>" readonly="readonly" ></td>
        </tr>
        <tr>
            <td> Date of Joining : </td>
            <td><input type="text" name="doj" value="<?php echo $getEmpData['hire_date']; ?>" readonly="readonly"></td>
        </tr>
        <tr>
            <td>
                <input type="button" value="Back" onclick="window.history.back();"/>
            </td>
        </tr>
    </table>
</html>
<?php } else { header('Location:../index.php'); } ?>