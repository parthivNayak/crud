<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 5/3/15
 * Time: 3:55 PM
 * To change this template use File | Settings | File Templates.
 */

include_once('../config.php');
?>
    <tr>
            <td>
                <select name="manager_id" class="required" id="listEmp">
                    <option value=""> Select </option>';

                    <?php $empData = $db->select('employees');
                    foreach($empData as $data) { ?>
                        <option value="<?php echo $data['id']; ?>"> <?php echo $data['name'];?> </option>

                    <?php } ?>
        </select></td></tr>


