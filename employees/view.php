<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 9/3/15
 * Time: 2:41 PM
 * To change this template use File | Settings | File Templates.
 */
    include '../config.php';
    $id = stripslashes($_GET['emp_id']);
    //Check if, id is blank or anythig else, redirect it to index page
    if($id == '' || $id == NULL) {
        header('Location:../index.php');
    }

    $getEmpData = $db->selectOne('employees', 'id="'.$id.'"');
    //Check if requested id and database id gets match or not
    if($getEmpData['id'] != $id) {
        header('Location:../index.php');
    }
    $sql        = 'select employees.id as emp_id, employees.name as emp_name, employees.manager_id, employees.dob, employees.gender, employees.hire_date, departments.id as dept_id, departments.name as dept_name, job_titles.id as title_id, job_titles.title as emp_title from employees inner join departments inner join dept_employees inner join job_titles inner join employee_titles on departments.id=dept_employees.department_id and job_titles.id=employee_titles.job_title_id and dept_employees.employee_id=employees.id and employee_titles.employee_id=employees.id where employees.id ="'.$id.'"';
    $emp        = $db->query($sql);

    foreach($emp as $empData) { ?>
    <html>
        <head>
        <title> View Employee </title>
    </head>

    <table>
        <tr>
            <td> Employee Name : </td>
            <td><input type="text" name="emp_name" value="<?php echo $empData['emp_name'];?>" readonly="readonly"></td>
        </tr>
        <tr>
            <td> Gender : </td>
            <td>
                <select name="gender" readonly="readonly">
                    <?php if($empData['gender'] == 'male') { ?>
                        <option value="male" selected="selected"> Male</option>
                     <?php } else if($empData['gender'] == 'female') { ?>
                        <option value="female" selected="selected"> Female </option>
                     <?php } ?>
                </select>
            </td>
        </tr>
        <?php
            if($getEmpData['manager_id'] > 0) {
                $managerData = $db->selectOne('employees', 'id="'.$empData['manager_id'].'"');

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
            <td><input type="text" name="dob" value="<?php echo $empData['dob']; ?>" readonly="readonly" ></td>
        </tr>
        <tr>
            <td> Date of Joining : </td>
            <td><input type="text" name="doj" value="<?php echo $empData['hire_date']; ?>" readonly="readonly"></td>
        </tr>
        <tr>
            <td>Department : </td>
            <td><select name="department_id" class="required">
                <option value=""> Select</option>
                <?php
                $deptData = $db->select('departments');
                foreach($deptData as $department) { ?>
                    <option disabled="disabled" value="<?php echo $department['id'];?>" <?php  if($department['id'] == $empData['dept_id']) echo 'selected="selected"'; ?>> <?php echo $department['name']; ?></option>
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
                    <option disabled="disabled" value="<?php echo $job['id'];?>" <?php  if($job['id'] == $empData['title_id']) echo 'selected="selected"'; ?>> <?php echo $job['title']; ?></option>
                    <?php } ?>
            </select></td>
        </tr>
        <tr>
            <td>
                <input type="button" value="Back" onclick="window.history.back();"/>
            </td>
        </tr>
    </table>
</html>
<?php } ?>