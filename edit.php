<?php
require('settings.php');
require('functions.php');
require('data.php');
?>

<html>
<head>
<title>Employee Sign-in Board</title>
<link rel="stylesheet" href="style.php" />

</head>
<body>

<!--
<div class="menu-bar">
<p style="float:right;">
<a style="color:#dddddd" href="edit.php" title="Update board">EDIT BOARD</a> 
</p>

<p>
<a href="index.php?page=everyone" title="View everyone">VIEW EVERYONE</a> | 
<a href="index.php?page=public" title="View everyone">PUBLIC DISPLAY</a> | 
<a href="index.php?page=floor" title="View by floor">VIEW BY FLOOR</a> | 
<a href="index.php?page=keys" title="View keyholders">VIEW KEYHOLDERS</a> | 
<a href="index.php?page=in" title="View people currently in the building">CURRENTLY IN THE BUILDING</a>
</p>

</div>
-->

<h1>Edit sign-in board</h1>

<?php

// Process input

// Delete person
if (isset($_GET['remove'])) {

$sql = 'SELECT * FROM `employees` WHERE `id` = ' . $_GET['remove'];

$results = mysql_query($sql);
$employee = mysql_fetch_assoc($results);

if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {

$sql = 'DELETE FROM `employees` WHERE `id` = '.$_GET['remove'];

      $query = mysql_query($sql);

      if(!$query) {
      echo('An error occurred removing "'.$employee['firstname'].' '.$employee['surname'].'" - please check settings');
      };
      

} else { // Print confirm screen

echo('<h2>Confirm removal</h2>');
echo('<div class="group">');
echo('<p>Are you sure you want to remove "'.$employee['firstname'].' '.$employee['surname'].'"?</p>');
echo('<p><a href="edit.php?remove='.$_GET['remove'].'&confirm=yes">YES</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="edit.php">NO</a></p>');
echo('<br class="clear" />');
echo('</div>');

}


}


// New person

if (isset($_POST['new_firstname'])
      && $_POST['new_firstname'] != ''
      && $_POST['new_surname'] != ''
      && $_POST['new_floor'] != '') {

      $sql = 'INSERT INTO `employees` (`firstname`, `surname`, `floor`, `status`, `keyholder`, `team`, `phone`, `department`, `linemanager`) VALUES ('.
      '"'.addslashes($_POST['new_firstname']).'", '.
      '"'.addslashes($_POST['new_surname']).'", '.
      addslashes($_POST['new_floor']).', '.
      '0, '.
      (isset($_POST['new_keyholder'])?1:0).', '.
      addslashes($_POST['new_team']).', '.
      '"'.addslashes($_POST['new_phone']).'",'.
      addslashes($_POST['new_department']).', '.
      addslashes($_POST['new_linemanager']).
      ')';

      $query = mysql_query($sql);

      if(!$query) {
      echo('An error occurred saving new person "'.$_POST['new_firstname'].' '.$_POST['new_surname'].'" - please check settings');
      };
      
}



if (isset($_POST['save']) && isset($_POST['employeeCount'])) {

for ($i = 0 ; $i < $_POST['employeeCount'] ; $i++) {

$sql = 'UPDATE `employees` SET `firstname` = "'.addslashes($_POST[$i.'_firstname']).'", `surname` = "'.addslashes($_POST[$i.'_surname']).'", `floor` = '.addslashes($_POST[$i.'_floor']).', `keyholder` = '.(isset($_POST[$i.'_keyholder'])?1:0).', `status` = '.(($_POST[$i.'_status']>=0)?addslashes($_POST[$i.'_status']):'`status`').', `team` = '.addslashes($_POST[$i.'_team']).', `phone` = "'.addslashes($_POST[$i.'_phone']).'", `department` = '.addslashes($_POST[$i.'_department']).', `linemanager` = '.addslashes($_POST[$i.'_linemanager']).' WHERE `id` = '.$_POST[$i.'_id'];

$query = mysql_query($sql);

if(!$query) {
 echo('An error occurred saving "'.$_POST[$i.'_firstname'].' '.$_POST[$i.'_surname'].'" - please check settings<br />');
};


}




}

// Refresh employee list to reflect changes
$allEmployees = getEmployees();


// Generate form

echo('<h2>Add a new person</h2>');

echo('<div class="group">');

echo('<form action="edit.php" method="POST">');

echo('<table>');
    echo('<tr class="header">
    <td>First name</td>
    <td>Surname</td>
    <td>Phone</td>
    <td>Team</td>
    <td>Department</td>
    <td>Line Manager</td>
    <td>Floor</td>
    <td>Keys?</td>
    </tr>');
    
    
    // Row for new person
    
    echo('<tr>');
    
    echo('<input type="hidden" name="new_id" />');

    echo('<td><input type="text" name="new_firstname" /></td>');

    echo('<td><input type="text" name="new_surname" /></td>');
    
    echo('<td><input type="text" name="new_phone" /></td>');

    echo('<td><select name="new_team">');
      foreach ($teams as $team) {
	echo('<option value="'.$team['id'].'">'.$team['name'].'</option>');
      }
    echo('</select></td>');

    echo('<td><select name="new_department">');
      foreach ($departments as $department) {
	echo('<option value="'.$department['id'].'">'.$department['name'].'</option>');
      }
    echo('</select></td>');

    echo('<td><select name="new_linemanager">');
	echo('<option value="0"></option>');
      foreach ($allEmployees as $employeelist) {
	echo('<option value="'.$employeelist['id'].'">'.$employeelist['firstname'].' '.$employeelist['surname'].'</option>');
      }
    echo('</select></td>');

    echo('<td><select name="new_floor">');
      foreach ($floors as $floor) {
	echo('<option value="'.$floor['id'].'">'.$floor['name'].'</option>');
      }
    echo('</select></td>');

    echo('<td><input type="checkbox" name="new_keyholder"></td>');
    
    echo('</tr></table>');

    echo('<input class="button" type="submit" name="new" value="Create new person" />');

    echo('</form>');
    
    

    echo('<br class="clear" />');
    echo('</div>');
    
    
    
    
    
    
echo('<h2>Update existing people</h2>');

echo('<div class="group">');
    
echo('<form action="edit.php" method="POST">');

echo('<input class="button" type="submit" name="save" value="Save Changes" />');

echo('<input type="hidden" name="employeeCount" value="'.count($allEmployees).'" />');

echo('<table>');
    echo('<tr class="header">
    <td>&nbsp;</td>
    <td>First name</td>
    <td>Surname</td>
    <td>Phone</td>
    <td>Team</td>
    <td>Department</td>
    <td>Line Manager</td>
    <td>Floor</td>
    <td>Keys?</td>
    <td>Set new status</td>
    </tr>');
    

$count = 0;
    
foreach($allEmployees as $key => $employee) {

    echo('<tr>');
    
    echo('<td><a style="color:#990000;" href="edit.php?remove='.$employee['id'].'">[X]</a></td>');
    echo('<input type="hidden" name="'.$count.'_id" value="'.$employee['id'].'" />');

    echo('<td><input type="text" name="'.$count.'_firstname" value="'.$employee['firstname'].'" /></td>');

    echo('<td><input type="text" name="'.$count.'_surname" value="'.$employee['surname'].'" style="font-weight:900;" /></td>');

    echo('<td><input type="text" name="'.$count.'_phone" value="'.$employee['phone'].'" /></td>');

    echo('<td><select name="'.$count.'_team">');
      foreach ($teams as $team) {
	echo('<option value="'.$team['id'].'"'.($employee['team']==$team['id']?' selected="selected"':'').'>'.$team['name'].'</option>');
      }
    echo('</select></td>');

    echo('<td><select name="'.$count.'_department">');
      foreach ($departments as $department) {
	echo('<option value="'.$department['id'].'"'.($employee['department']==$department['id']?' selected="selected"':'').'>'.$department['name'].'</option>');
      }
    echo('</select></td>');

    echo('<td><select name="'.$count.'_linemanager">');
	echo('<option value="0"></option>');
      foreach ($allEmployees as $employeelist) {
	if ($employee['id'] != $employeelist['id']) {
	  echo('<option value="'.$employeelist['id'].'"'.($employee['linemanager']==$employeelist['id']?' selected="selected"':'').'>'.$employeelist['firstname'].' '.$employeelist['surname'].'</option>');
	}
      }
    echo('</select></td>');

    echo('<td><select name="'.$count.'_floor">');
      foreach ($floors as $floor) {
	echo('<option value="'.$floor['id'].'"'.($employee['floor']==$floor['id']?' selected="selected"':'').'>'.$floor['name'].'</option>');
      }
    echo('</select></td>');

    echo('<td><input type="checkbox" name="'.$count.'_keyholder"'.($employee['keyholder']>0?' checked="checked"':'').'></td>');

    echo('<td><select name="'.$count.'_status">');
	echo('<option value="-1"></option>');
      foreach ($statuses as $status) {
	echo('<option value="'.$status['id'].'">'.$status['text'].'</option>');
      }
    echo('</select></td>');

    echo('</tr>');
    
    $count++;

}

echo('</table>');

echo('<input class="button" type="submit" name="save" value="Save Changes" />');

echo('</form>');


echo('<br class="clear" />');
echo('</div>');

?>


</body>
</html>