<?php
require('settings.php');
require('functions.php');
require('data.php');


switch($_GET['action']) {

// --------------------------------------------------------------------------------
case 'toggle' :   // Returns new BG colour on success

  if (isset($_GET['id']) && $_GET['id'] != '') {
    
    $employee = getEmployee($_GET['id']);
    
    if ($employee['status'] == 1) {
      updateEmployeeStatus($employee['id'], 0);
    } else {
      updateEmployeeStatus($employee['id'], 1);
    }
    
    $employee = getEmployee($_GET['id']);
    
    $newColour = getStatusColour($employee['status']);
    
    echo($newColour);
    
    
  }



}
