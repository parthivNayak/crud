<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 10/3/15
 * Time: 2:58 PM
 * To change this template use File | Settings | File Templates.
 */

    include '../config.php';
    $id = $_GET['id'];

    //Check if id is blank or anything else, then redirect to index page
    if($id == '' || $id == NULL) {
        header('Location:../index.php');
    }

    $jobData = $db->selectOne('job_titles', 'id ="'.$id.'"');
    if($jobData['id'] == $id) {
?>
<html>
<head>
    <title> Edit Job Title </title>
    <?php include '../includes/header.php'; ?>
    <script type="text/javascript">
        $(function() {
            $.validator.addMethod("specialChars", function( value, element ) {
                var regex = new RegExp("^[a-zA-Z0-9/s]+$");
                var key = value;

                if (!regex.test(key)) {
                    return false;
                }
                return true;
            }, "please use only alphanumeric or alphabetic characters");
            $('#jobTitle').validate(
                    {
                        rules: {
                            job_title : {
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
    <input type="hidden" name="action" value="edit_job" />
    <input type="hidden" name="job_id" value="<?php echo $jobData['id']; ?>" />
    <table cellspacing="5" cellpadding="5">
        <tr>
            <td> Job Title : </td>
            <td> <input name="title" id="job_title" value="<?php echo $jobData['title']; ?>" class="required"> </td>
        </tr>
        <tr>
            <td> <input type="submit" value="edit" name="submit"></td>
            <td> <input type="button" onclick="window.history.back();" value="Back" ></td>
        </tr>
    </table>
</form>
</body>
</html>
<?php } else { header('Location:../index.php'); } ?>