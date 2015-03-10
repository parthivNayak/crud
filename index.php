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
    <a href="departments/add_department.php"> Add Department Detail </a>
    <table cellpadding="5" cellspacing="5" border="2" id="updateResult">
        <th> Id </th>
        <th> Employee Name </th>
        <th> Date of Birth </th>
        <th> Gender </th>
        <th> Hire Date </th>
        <th> Action </th>
        <?php
            //$results    = 'CALL getEmployee()';
            //if($results!="") {
                //$users      = $db->query($results);
                //$users->setFetchMode(PDO::FETCH_ASSOC);
                //while($employee = $users->fetch()) {
                $emp = $db->select('employees');
                foreach($emp as $employee) {
            ?>
                <tr>
                    <td>
                        <?php echo $employee['id']; ?>
                    </td>
                    <td>
                        <?php echo $employee['name']; ?>
                    </td>
                    <td>
                        <?php echo $employee['dob']; ?>
                    </td>
                    <td>
                        <?php echo $employee['gender']; ?>
                    </td>
                    <td>
                        <?php echo date('M d, Y', strtotime($employee['hire_date'])); ?>
                    </td>
                    <td>
                        <a href="employees/view.php?id=<?php echo $employee['id']; ?>"> View</a>  / <a href="employees/edit.php?id=<?php echo $employee['id']; ?>"> Edit</a> / <a href="javascript:void(0);" onclick="deleteEmp(<?php echo $employee['id'];?>);"> Delete</a>
                    </td>
                </tr>
            <?php }   ?>
    </table>

    <table border="2" cellpadding="5" cellspacing="5">
        <th> Id </th>
        <th> Department Name </th>
        <th> Action </th>
        <?php
            //$result           = 'CALL getDepartment()';
            //if($result) {
                //$departments      = $db->query($result);
                //$departments->setFetchMode(PDO::FETCH_ASSOC);
                //while($department = $departments->fetch()) {
                $departments = $db->select('departments');
                if(!empty($departments)) { foreach($departments as $department) { ?>
                    <tr>
                        <td> <?php echo $department['id'];?> </td>
                        <td> <?php echo $department['name'];?> </td>
                    <td>
                        <a href="departments/view.php?id=<?php echo $department['id']; ?>"> View</a>  / <a href="departments/edit.php?id=<?php echo $department['id']; ?>"> Edit</a> / <a href="javascript:void(0);" onclick="deleteDept(<?php echo $department['id'];?>);"> Delete</a>
                    </td>
                </tr>
            <?php } //$result->close();
                } ?>
    </table>
    </body>
</html>



