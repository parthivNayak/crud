<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 5/3/15
 * Time: 2:41 PM
 * To change this template use File | Settings | File Templates.
 */
include_once('../config.php');
$id = stripslashes($_GET['emp_id']);
//Get single record of selected user
//$empData = $db->selectOne('employees', 'id="'.$id.'"');
$sql        = 'select employees.id as emp_id, employees.name as emp_name, employees.manager_id, employees.dob, employees.gender, employees.hire_date, departments.id as dept_id, departments.name as dept_name, job_titles.id as title_id, job_titles.title as emp_title from employees inner join departments inner join dept_employees inner join job_titles inner join employee_titles on departments.id=dept_employees.department_id and job_titles.id=employee_titles.job_title_id and dept_employees.employee_id=employees.id and employee_titles.employee_id=employees.id where employees.id ="'.$id.'"';
$emp        = $db->query($sql);
foreach($emp as $empData) {
if($empData['emp_id'] == $id) { ?>
<html>
<head>
    <title> Edit Employee </title>
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

            //Custom method to validate employee name with alpha numeric value
            $.validator.addMethod("specialChars", function( value, element ) {
                var regex = new RegExp("^[a-zA-Z0-9\\-\\s]+$");
                var key = value;

                if (!regex.test(key)) {
                    return false;
                }
                return true;
            }, "please use only alphanumeric or alphabetic characters");
            $('#editEmp').validate(
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
    </script>
</head>

<body>
<form method="post" action="add.php" id="editEmp">
    <input type="hidden" value="edit_emp" name="action">
    <input type="hidden" value="<?php echo $id;?>" name="emp_id">
    <table>
        <tr>
            <td> Employee Name : </td>
            <td><input type="text" name="emp_name" value="<?php echo $empData['emp_name'];?>" class="required"></td>
        </tr>
        <tr>
            <td> Gender : </td>
            <td>
                <select name="gender" class="required">
                    <option value=""> Select </option>
                    <?php if($empData['gender'] == 'male') { ?>
                    <option value="male" selected="selected"> Male</option>
                    <?php } else if($empData['gender'] == 'female') { ?>
                    <option value="female" selected="selected"> Female </option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td> Is he/she selected as a Manager? <input type="checkbox" id="check"  onchange="showManager();"> </td>
            <td id="showEmp"> </td>
        </tr>

        <tr>
            <td> Date of Birth : </td>
            <td><input type="text" name="dob" class="required" id="dob" value="<?php echo $empData['dob']; ?>"></td>
        </tr>
        <tr>
            <td> Date of Joining : </td>
            <td><input type="text" name="doj" class="required" id="doj" value="<?php echo $empData['hire_date']; ?>"></td>
        </tr>
        <tr>
            <td>Department : </td>
            <td><select name="department_id" class="required">
                <option value=""> Select</option>
                <?php
                    $deptData = $db->select('departments');
                    foreach($deptData as $department) { ?>
                    <option value="<?php echo $department['id'];?>" <?php  if($department['id'] == $empData['dept_id']) echo 'selected="selected"'; ?>> <?php echo $department['name']; ?></option>
                    <?php } ?>
            </select></td>
        </tr>
        <tr>
            <td>Job Title :</td>
            <td><select name="title_id" class="required"> <option value=""> Select</option>
                <?php
                $jobData = $db->select('job_titles');
                foreach($jobData as $job) {
                    ?>
                    <option value="<?php echo $job['id'];?>" <?php  if($job['id'] == $empData['title_id']) echo 'selected="selected"'; ?>> <?php echo $job['title']; ?></option>
                    <?php } ?>
            </select></td>
        </tr>
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
    <?php } else { header('Location:../index.php'); } } ?>