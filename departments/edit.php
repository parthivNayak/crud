<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 10/3/15
 * Time: 11:21 AM
 * To change this template use File | Settings | File Templates.
 */
include_once('../config.php');
$id = stripslashes($_GET['id']);

//Get single record of selected user
$deptData = $db->selectOne('departments', 'id="'.$id.'"');
if($deptData['id'] == $id) {
?>
<html>
<head>
    <title> Edit Department </title>
    <?php include '../includes/header.php'; ?>
    <script type="text/javascript" lang="javascript">
        $(function() {
            $.validator.addMethod("specialChars", function( value, element ) {
                var regex = new RegExp("^[a-zA-Z0-9\\-\\s]+$");
                var key = value;

                if (!regex.test(key)) {
                    return false;
                }
                return true;
            }, "please use only alphanumeric or alphabetic characters");
            $('#editDept').validate(
                    {
                        rules: {
                            dept_name : {
                                specialChars : true
                            }
                        }
                    }
            );
        });


    </script>
</head>

<body>
<form method="post" action="add.php" id="editDept">
    <input type="hidden" value="edit_dept" name='action'/>
    <input type="hidden" value="<?php echo $deptData['id']; ?>" name="dept_id" />
    <table>
        <tr>
            <td> Department Name : </td>
            <td><input type="text" name="dept_name" value="<?php echo $deptData['name'];?>" class="required"></td>
        <tr>
            <td>
                <input type="submit" value="Edit" name="submit" />
                <input type="button" value="Back" onclick="window.history.back();"/>
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<?php } else {
    header('Location:../index.php');
} ?>