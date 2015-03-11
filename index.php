<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 5/3/15
 * Time: 11:35 AM
 * To change this template use File | Settings | File Templates.
 */
    
    include_once('config.php');
?>
<html>
    <title> Home Page</title>
    <head>
        <!-- Include javascripts -->
        <?php include 'includes/header.php'; ?>
        <script type="text/javascript" language="javascript">

            //Function to delete employee detail - Start
            function deleteEmp(id) {
                if(confirm('Are you sure you want to delete this user?')) {
                    if(id!='') {
                        $.ajax({
                            type        : "POST",
                            url         : 'employees/delete_emp.php',
                            data        :  'id='+id,
                           success     :function(data)
                            {
                                //Refresh table content
                                location.reload();
                            }
                        });
                    }
                } else {
                    //Do nothing
                }
            }
            //End function

            //Function to delete department detail - start
            function deleteDept(id) {
                if(confirm('Are you sure you want to delete this department?')) {
                    if(id!="") {
                        $.ajax({
                            type        : "POST",
                            url         : 'departments/delete_dept.php',
                            data        :  'id='+id,
                            success     :function(data)
                            {
                                //Refresh table content
                                location.reload();

                            }
                        });
                    } else {
                        //Do nothing
                    }
                }
            }
            //End function

            //Function to delete job title detail - start
            function deleteJob(id) {
                if(confirm('Are you sure you want to delete this job title?')) {
                    if(id!="") {
                        $.ajax({
                            type        : "POST",
                            url         : 'jobs/delete_jobs.php',
                            data        :  'id='+id,
                            success     :function(data)
                            {
                                //Refresh table content
                                location.reload();
                            }
                        });
                    } else {
                        //Do nothing
                    }
                }
            }
            //End function

        </script>
    </head>
    <body>
    <a href="employees/add_employee.php"> Add Employee Detail </a> <br/>
    <a href="departments/add_department.php"> Add Department Detail </a> <br>
    <a href="jobs/add.php"> Add Job Title </a>
    <table cellpadding="5" cellspacing="5" border="2" id="updateResult">
        <th> Id </th>
        <th> Employee Name </th>
        <th> Date of Birth </th>
        <th> Gender </th>
        <th> Hire Date </th>
        <th> Department </th>
        <th> Job Title </th>
        <th> Salary </th>
        <th> Action </th>
        <?php
            /*$results        = 'CALL empDetails()';
            $statement_emp  = $db->query($results);
            $empData        = $statement_emp->fetchAll(PDO::FETCH_ASSOC);*/
            $sql        = 'select employees.id as emp_id, employees.name as emp_name, employees.manager_id, employees.dob, employees.gender, employees.hire_date, departments.id as dept_id, departments.name as dept_name, job_titles.id as title_id, job_titles.title as emp_title, salaries.salary from employees inner join departments inner join dept_employees inner join job_titles inner join employee_titles inner join salaries on departments.id=dept_employees.department_id and job_titles.id=employee_titles.job_title_id and dept_employees.employee_id=employees.id and employee_titles.employee_id=employees.id and salaries.employee_id=employees.id where employees.id';
            $emp        = $db->query($sql);
            foreach($emp as $employee) {
            ?>
                <tr>
                    <td> <?php echo $employee['emp_id']; ?> </td>
                    <td> <?php echo $employee['emp_name']; ?> </td>
                    <td> <?php echo $employee['dob']; ?> </td>
                    <td> <?php echo $employee['gender']; ?> </td>
                    <td> <?php echo date('M d, Y', strtotime($employee['hire_date'])); ?> </td>
                    <td> <?php echo $employee['dept_name'];?> </td>
                    <td> <?php echo $employee['emp_title'];?> </td>
                    <td> <?php echo $employee['salary'];?> </td>
                    <td> <a href="employees/view.php?emp_id=<?php echo $employee['emp_id']; ?>"> View</a>  / <a href="employees/edit.php?emp_id=<?php echo $employee['emp_id']; ?>"> Edit</a> / <a href="javascript:void(0);" onclick="deleteEmp(<?php echo $employee['emp_id'];?>);"> Delete</a> </td>
                </tr>
            <?php } $statement_emp->nextRowset(); ?>
    </table>
    hifhifhohiohfihfoh
</body>
</html>