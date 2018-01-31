<?php

if (isset($_GET['action'])) { // perform action

  switch ($_GET['action']) {
  		
    case 'update':
		updateEmployeeStatus($_GET['employeeID'], (isset($_GET['newStatus'])?$_GET['newStatus']:0));
		  
          default:
		break;    
  }

}

if ($settings['floors'] === 1) { $floors = getFloors(); }
$statuses = getStatuses();
$teams = getTeams();
$departments = getDepartments();
$allEmployees = getEmployees();

