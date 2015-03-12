<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 5/3/15
 * Time: 2:41 PM
 * To change this template use File | Settings | File Templates.
 */
    include_once('../config.php');
?>

<html>
    <head>
        <title> Add Employee </title>
        <?php include '../includes/header.php'; ?>
        <script type="text/javascript" lang="javascript">
            $(function() {
                $( "#dob" ).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    yearRange: '1970:2000'
                });
                $( "#doj" ).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    yearRange: '1970:2015'
                });
                $(function() {
                    $.validator.addMethod("specialChars", function( value, element ) {
                        var regex = new RegExp("^[a-zA-Z0-9\\-\\s]+$");
                        var key = value;

                        if (!regex.test(key)) {
                            return false;
                        }
                        return true;
                    }, "please use only alphanumeric or alphabetic characters");
                $('#addEmp').validate(
                    {
                        rules: {
                            emp_name: {
                            specialChars : true
                        },
                            //gender  : "required",
                            dob     : "required",
                            doj     : "required"
                        },
                        messages: {
                            emp_name: "Enter Employee Name",
                            //gender  : "Please Select gender",
                            dob     : "Please Select date of Birth",
                            doj     : "Please Select Date of Joining"
                        }
                    }
                );
            });

            //Function to show manager drop down if checkbox selected
            function showManager() {
                if($("#check" ).prop( "checked") == true) {
                    $.ajax({
                        type        : "GET",
                        url         : 'get_employees.php',
                        dataType    : 'HTML',
                        success     :function(data)
                        {
                            $('#showEmp').show();
                            $('#showEmp').html(data);
                        }
                    });
                } else {
                    $("#showEmp").hide();
                }

            }
        });
        </script>
    </head>

    <body>
        <form method="post" action="add.php" id="addEmp">
            <input type="hidden" value="add_emp" name="action">
            <table>
                <tr>
                    <td> Employee Name : </td>
                    <td><input type="text" name="emp_name" class="required"></td>
                </tr>
                <tr>
                    <td> Gender : </td>
                    <td>
                        <select name="gender" class="required">
                            <option value=""> Select </option>
                            <option value="male"> Male </option>
                            <option value="female"> Female</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td> Is he/she selected as a Manager? <input type="checkbox" id="check"  onchange="showManager();" /> </td>
                    <td id="showEmp"> </td>
                </tr>
                <tr>
                    <td> Department : </td>
                    <td> <select name="department_id" class="required">
                            <option value=""> Select </option>
                        <?php
                                $fetchDeptData   = 'CALL getDepartment()';
                                $statement_dept  = $db->query($fetchDeptData);
                                $deptData        = $statement_dept->fetchAll(PDO::FETCH_ASSOC);
                                //$fetchDeptData = $db->select('departments');
                                foreach($deptData as $department) {
                            ?>
                                <option value="<?php echo $department['id']; ?>"><?php echo $department['name']; ?></option>

                            <?php } $statement_dept->nextRowset();?> </select></td>
                </tr>
                <tr>
                    <td> Job Title : </td>
                    <td> <select name="title_id" class="required">
                            <option value=""> Select</option>
                            <?php
                                $titleData       = 'CALL jobTitles()';
                                $statement_job   = $db->query($titleData);
                                $jobData         = $statement_job->fetchAll(PDO::FETCH_ASSOC);
                                foreach($jobData as $jobs) {
                            ?>
                                <option value="<?php echo $jobs['id']; ?>"> <?php echo $jobs['title']; ?></option>
                            <?php }  $statement_job->nextRowset();  ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td> Salary: </td>
                    <td><input type="text" name="salary" class="number required" /></td>
                </tr>
                <tr>
                    <td> Date of Birth : </td>
                    <td><input type="text" name="dob" class="required" id="dob" /></td>
                </tr>
                <tr>
                    <td> Date of Joining : </td>
                    <td><input type="text" name="doj" class="required" id="doj" /></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Add" name="submit" />
                        <input type="button" value="Back" onclick="window.history.back();" />
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>