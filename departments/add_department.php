<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 5/3/15
 * Time: 2:41 PM
 * To change this template use File | Settings | File Templates.
 */
//include_once('../config.php');
?>

<html>
<head>
    <title> Add Department </title>
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
            $('#addDept').validate(
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
<form method="post" action="add.php" id="addDept">
    <input type="hidden" value="add_dept" name='action'/>
    <table>
        <tr>
            <td> Department Name : </td>
            <td><input type="text" name="dept_name" class="required"></td>
        <tr>
            <td>
                <input type="submit" value="Add" name="submit" />
                <input type="button" value="Back" />
            </td>
        </tr>
    </table>
</form>
</body>
</html>