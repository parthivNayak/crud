<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 10/3/15
 * Time: 2:58 PM
 * To change this template use File | Settings | File Templates.
 */

include '../config.php';
?>
<html>
    <head>
        <title> Add Job Title </title>
        <?php include '../includes/header.php'; ?>
        <script type="text/javascript">
            $(function() {
                $.validator.addMethod("specialChars", function( value, element ) {
                    var regex = new RegExp("^[a-zA-Z0-9\\-\\s]+$");
                    var key = value;

                    if (!regex.test(key)) {
                        return false;
                    }
                    return true;
                }, "please use only alphanumeric or alphabetic characters");
                $('#jobTitle').validate(
                        {
                            rules: {
                                title : {
                                    specialChars : true
                                }
                            }
                        }
                );
            });

        </script>
    </head>
    <body>
        <form method="post" id="jobTitle" action="add_job.php">
            <input type="hidden" name="action" value="add_job" />
            <table cellspacing="5" cellpadding="5">
                <tr>
                    <td> Job Title : </td>
                    <td> <input name="title" id="title" class="required"> </td>
                </tr>
                <tr>
                    <td> <input type="submit" value="Add" name="submit"></td>
                    <td> <input type="button" onclick="window.history.back();" value="Back" ></td>
                </tr>
            </table>
        </form>
    </body>
</html>