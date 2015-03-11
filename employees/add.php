<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 9/3/15
 * Time: 10:33 AM
 * To change this template use File | Settings | File Templates.
 */
include_once('../config.php');
if(isset($_POST['submit']) && !empty($_POST['submit'])) {
//    echo "<pre>";
//    print_r($_POST); exit;

    $name   = $_POST['emp_name'];
    $dob    = $_POST['dob'];
    $doj    = $_POST['doj'];
    $gender = $_POST['gender'];
    if($_POST['manager_id']!="") {
        $manager_id = $_POST['manager_id'];
    } else {
        $manager_id = '';
    }
    $empDetails = array(
        'name'          => $name,
        'manager_id'    => $manager_id,
        'dob'           => $dob,
        'gender'        => $gender,
        'hire_date'     => $doj,
        'created'       => date('Y-m-d', time()),
        'modified'      => date('Y-m-d', time())
    );



    if($_POST['action'] == 'add_emp') {

        //Check if data is inserted or not.
        $db->insert('employees', $empDetails);
        $empDeptDetails = array(
            'employee_id'   =>  $db->lastInsertId(),
            'department_id' => $_POST['department_id'],
            'from_date'     => $doj,
            'to_date'       => date('d/m/Y'),
            'created'       => date('Y-m-d', time()),
            'modified'      => date('Y-m-d', time())
        );

        $empTitleDetails = array(
            'employee_id'   => $db->lastInsertId(),
            'job_title_id'  => $_POST['title_id'],
            'from_date'     => $doj,
            'to_date'       => date('d/m/Y'),
            'created'       => date('Y-m-d', time()),
            'modified'      => date('Y-m-d', time())
        );
        $db->insert('dept_employees', $empDeptDetails);
        $db->insert('employee_titles', $empTitleDetails);

            header('Location:../index.php');

    } else if($_POST['action'] == 'edit_emp') {
        $updateEmpDeptDetails = array(
                'employee_id'   => $_POST['emp_id'],
                'department_id' => $_POST['department_id'],
                'from_date'     => $doj,
                'to_date'       => date('d/m/Y'),
                'created'       => date('Y-m-d', time()),
                'modified'      => date('Y-m-d', time())
            );

        $updateEmpTitleDetails = array(
            'employee_id'   => $_POST['emp_id'],
            'job_title_id'  => $_POST['title_id'],
            'from_date'     => $doj,
            'to_date'       => date('d/m/Y'),
            'created'       => date('Y-m-d', time()),
            'modified'      => date('Y-m-d', time())
        );

        $db->update('employees', $empDetails, 'id="'.$_POST['emp_id'].'"');
        $db->update('dept_employees', $updateEmpDeptDetails, 'employee_id="'.$_POST['emp_id'].'"');
        $db->update('employee_titles', $updateEmpTitleDetails, 'employee_id="'.$_POST['emp_id'].'"');
        header('Location:../index.php');
    }

}
