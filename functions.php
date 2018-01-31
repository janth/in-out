<?php

#$db_connection = mysql_connect($db_server, $db_user, $db_password) or die(mysql_error());
#$db_connection = new mysqli($db_server, $db_user, $db_password, $db_database, $db_port, $db_socket)
$db_connection = new mysqli($db_server, $db_user, $db_password, $db_database)
	or die ('Could not connect to the database server: ' . $db_connection->connection_errno . ' ' . $db_connection->connection_error);
/*
mysql_query($sql) -> $db_connection->query($sql)
mysql_fetch_array($result) -> $result->fetch_array(MYSQLI_ASSOC)
*/
error_log("Connected to db ok");

$tmp_msg_str = sprintf("Initial character set: %s\n", $db_connection->character_set_name());
error_log($tmp_msg_str);

/* change character set to utf8 */
if (!$db_connection->set_charset("utf8")) {
   printf("Error loading character set utf8: %s\n", $db_connection->error);
   exit();
} #else { printf("Current character set: %s\n", $db_connection->character_set_name()); }

function Menu() {
   global $settings;
   $company = $settings['Company'];
   echo <<<EOT

<div class="menu-bar">

<a href="edit.php">edit</a> |
<a href="update-flexbox.php">update-flexbox</a> |
<a href="update-mobile.php">update-mobile</a> |

<a href="index-menu.html">index menu</a>
</div>

<div class="content">
   <h1>$company Staff currently signed in</h1>
   <hr>
EOT;
/*
<a href="edit.php" title="Update board">EDIT BOARD</a> |
<a href="index.php?page=everyone" title="View everyone">VIEW EVERYONE</a> | 
<a href="index.php?page=public" title="View everyone">PUBLIC DISPLAY</a> | 
<a href="floors.php" title="View by floor">VIEW BY FLOOR</a> | 
<a href="treams.php" title="View by team">VIEW BY TEAM</a> | 
<a href="index.php?page=keys" title="View keyholders">VIEW KEYHOLDERS</a> | 
<a href="index.php?page=in" title="View people currently in the building">CURRENTLY IN THE BUILDING</a> |
<a href="board.php">board</a> |
<a href="checklist.php">checklist</a> |
<a href="phone.php">phone</a> |
<a href="signin.php">signin</a> |
<a href="update.php">update</a> |
<a href="style.php">style</a> |
<a href="style-update.php">style-update</a> |
<a href="style-public.php">style-public</a> |
<a href="style-tablet.php">style-tablet</a> |
*/
}

function Title($page) {
   global $settings;
   $company = $settings['Company'];
   /* <title><?php echo $settings['Company']; ?> Staff in the building (by floor)</title> */
   echo <<<EOT
   IBM I/O - $page
EOT;
}

function getDepartmentName($departmentID) {
	global $departments;

	// Not efficient!
	$departmentName = '';
	foreach ($departments as $department) {
		if ($department['id'] == $departmentID) {
			$departmentName = $department['name'];
		}
}

	return $departmentName;
}

function getTeamName($teamID) {
	global $teams;

	// Not efficient!
	$teamName = '';
	foreach ($teams as $team) {
		if ($team['id'] == $teamID) {
			$teamName = $team['name'];
		}
}

	return $teamName;
}

function getStatusColour($statusID) {
	global $statuses;

	// Not efficient!
	$colour = 'eb7ac2';
	foreach ($statuses as $status) {
		if ($status['id'] == $statusID) {
			$colour = $status['colour'];
		}
}

	return $colour;
}

function getStatusText($statusID) {
	global $statuses;

	// Not efficient!
	$text = '';
	
	if ($statusID >= 2) {
		foreach ($statuses as $status) {
			if ($status['id'] == $statusID) {
				$text = '(' . $status['text'] . ')';
			}
		}
	}

	return $text;
}

function updateEmployeeStatus($employeeID, $newStatus = 1) {
  global $db_connection;
  $sql = 'UPDATE `employees` SET `status` = '.$newStatus.' WHERE id = ' . $employeeID;
  $results = $db_connection->query($sql);
}


function displayEmployeeStatus ($employee, $displayType = 0) {
global $settings;



	$isLink = ($displayType > 0)?1:0;//($displayType = 1)?true:false;// && $employee['status'] <= 1);

	if ($isLink) {
		echo('<a href="'.$_SERVER['SCRIPT_NAME'].'?page='.$settings['page'].'&action=update&employeeID='.$employee['id'].'&newStatus='.($employee['status']==1?0:1).'" onclick="getElementById(\'employee_'.$employee['id'].'\').style.opacity = 0.2;" >');
	}

	echo('<div class="employee-data'.($employee['keyholder']?' employee-data-keyholder':'').'" id="employee_' . $employee['id'] . '" style="background-color: #' . getStatusColour($employee['status']) . '">');
	
	echo('<div class="employee-data-section">');
		echo('<p class="employee-firstname">' . $employee['firstname'] . '</p>');
		echo('<p class="employee-surname">' . $employee['surname'] . '<span class="employee-status">&nbsp;' . getStatusText($employee['status']) . '</span></p>');
	echo('</div>');
	
	
	echo('<br class="clear" />');
	
	echo('</div>');
	
	if ($isLink) {
		echo('</a>');
	}
}

function displayTeamPresence($list) {

$dept = '';
$team = '';

foreach ($list as $employee) {
	if ($dept != $employee['department']) {
		if ($team != '') {
			echo('</div>');
		}
		echo("\n\n" . '<h2>'. getDepartmentName($employee['department']) . '</h2>');
		$dept = $employee['department'];
	}
	if ($team != $employee['team']) {
		if ($team != '') {
			echo('</div>');
		}
		echo("\n" . '<div class="team-display"><h3>'. getTeamName($employee['team']) . '</h3>');
		$team = $employee['team'];
	}
	if($employee['keyholder'] == 1) {
		echo ('<strong>'.$employee['firstname'].' '.$employee['surname'].'</strong><br />');
	} else {
		echo ($employee['firstname'].' '.$employee['surname'].'<br />');
	}
}

// Close final team div
echo('</div>');

}

function displayTeamPresenceSolo($list, $title) {

	echo("\n\n" . '<h2>'. $title . '</h2><div class="team-display">');
	foreach ($list as $employee) {

	if($employee['keyholder'] == 1) {
		echo ('<strong>'.$employee['firstname'].' '.$employee['surname'].'</strong><br />');
	} else {
		echo ($employee['firstname'].' '.$employee['surname'].'<br />');
	}
	}

	echo('</div>');

}

function displayFloorPresenceSolo($list, $title) {

	echo('<div class="floor-display"><h2>'. $title . '</h2>');
	foreach ($list as $employee) {

	if($employee['keyholder'] == 1) {
		echo ('<strong>'.$employee['firstname'].' '.$employee['surname'].'</strong><br />');
	} else {
		echo ($employee['firstname'].' '.$employee['surname'].'<br />');
	}
	}

	echo('</div>');

}

function displayEmployeeStatusFlex ($employee, $displayType = 0) {
global $settings;

	// If it's an empty employee, generate placeholder
	if ($employee['firstname'] === 0) {
	    echo('<div class="employee-data employee-data-flex" style="background: none;"><div class="employee-data-section"><p class="employee-firstname">&nbsp;</p><p class="employee-surname">&nbsp;</p></div><div class="employee-notes-section"><p class="employee-status">&nbsp;</p></div><br class="clear" /></div>');
	} else {

	$isLink = ($displayType > 0)?1:0; // Redundant, should just use provided value but possibility of smarter checking in future


	echo('<div class="employee-data employee-data-flex'.($employee['keyholder']?' employee-data-keyholder':'').'" id="employee_' . $employee['id'] . '" style="background-color: #' . getStatusColour($employee['status']) . '">');
	
	echo('<div class="employee-data-section">');
		echo('<p class="employee-firstname">' . $employee['firstname'] . '</p>');
		echo('<p class="employee-surname">' . $employee['surname'] . '<span class="employee-status">&nbsp;' . getStatusText($employee['status']) . '</span></p>');
	echo('</div>');
	
	if ($isLink) {
		echo('<a href="'.$_SERVER['SCRIPT_NAME'].'?page='.$settings['page'].'&action=update&employeeID='.$employee['id'].'&newStatus='.($employee['status']==1?0:1).'" onclick="getElementById(\'employee_'.$employee['id'].'\').style.opacity = 0.2;"><span class="clickable-div-link"></span></a>');
	}	
	
	echo('<br class="clear" />');
	
	echo('</div>');
	
	if ($isLink) {
	}
	
    }
}

function displayEmployeeStatusFlexAjax ($employee, $displayType = 0) {
global $settings;

	// If it's an empty employee, generate placeholder
	if ($employee['firstname'] === 0) {
	    echo('<div class="employee-data employee-data-flex" style="background: none;"><div class="employee-data-section"><p class="employee-firstname">&nbsp;</p><p class="employee-surname">&nbsp;</p></div><div class="employee-notes-section"><p class="employee-status">&nbsp;</p></div><br class="clear" /></div>');
	} else {

	$isLink = ($displayType > 0)?1:0; // Redundant, should just use provided value but possibility of smarter checking in future


	echo('<div class="employee-data employee-data-flex" id="employee_' . $employee['id'] . '" style="background-color: #' . getStatusColour($employee['status']) . ';' . ($employee['status']==1?'background:linear-gradient(to bottom, rgba(248,191,0,1) 0%,rgba(248,191,0,1) 14.99%,rgba(116,188,9,1) 15%,rgba(116,188,9,1) 100%)':'')  .';">');

        if(!!$employee['keyholder']) {
          echo('<div class="keyholder-overlay"></div>');
        }
	
	echo('<div class="employee-data-section">');
		echo('<p class="employee-firstname">' . $employee['firstname'] . '</p>');
		echo('<p class="employee-surname">' . $employee['surname'] . '<span class="employee-status">&nbsp;' . getStatusText($employee['status']) . '</span></p>');
	echo('</div>');
	
	if ($isLink) {
		echo('<a href="#" onclick="updateDisplayedStatus('.$employee['id'].');"><span class="clickable-div-link"></span></a>');
	}	
	
	echo('<br class="clear" />');
	
	echo('</div>');
	
	if ($isLink) {
	}
	
    }
}

function displayGroupList($group, $groupName = '', $columns, $displayType = 0) {
global $settings;

$lists = splitGroupList($group, $columns);
		
	// Print group name if specified
	if ($groupName != '') {
		echo('<h2>' . $groupName . '</h2>');
	}

	echo('<div class="group">');
	
	// Cycle through the three lists and print each member
	foreach ($lists as $list) {
		echo('<div class="group-column">');
			foreach ($list as $employee) {
				displayEmployeeStatus($employee, $displayType);
			}
		echo('</div>');
	}
	
	echo('<br class="clear" />');
	echo('</div>');
}

function splitGroupList ($group, $columns) {

	$column_size = floor(count($group)/$columns);
	$number_of_tall_columns = count($group)%$columns;
	
	// Flip array so array_pop() is useful
	$group = array_reverse($group);
	
	$list = Array();
	$current_column = 0;
	$list[0] = Array();
	
	while(count($group)) {
	  $list[$current_column][count($list[$current_column])] = array_pop($group);	 
	  	  
	  if (count($list[$current_column]) >= ($column_size + (($current_column < $number_of_tall_columns)?1:0)) && $current_column+1 < $columns) {
	  
	    $list[++$current_column] = Array();
	  }
	}
	
	// Pad shorter lists with empty people (zeroes for all values)
	if ($number_of_tall_columns > 0) {
	for ($i = $number_of_tall_columns+1 ; $i <= $columns ; $i++) {
	      $list[$i-1][] = Array (	
		'id' => 0,
		'firstname' => 0,
		'surname' => 0,
		'team' => 0,
		'floor' => 0,
		'keyholder' => 0,
		'status' => 0,
		'phone' => 0,
		'department' => 0,
		'jobtitle' => 0,
		'linemanager' => 0
		);
	}
	}
	
	return $list;
	
}


function displaySideMenuItem($text, $page) {
global $settings;
    echo('<div class="side-menu-item' . (($settings['page']==$page)?' side-menu-item-active':'') . '">');
    echo('' . $text . '');
    echo('<a href="' . $_SERVER['PHP_SELF'] . '?page=' . $page . '"><span class="clickable-div-link"></span></a>');
    echo('</div>');
}

function displayGroupListFlex($group, $groupName = '', $columns, $displayType = 0) {
global $settings;
		
	// Print group name if specified
	if ($groupName != '') {
		echo('<h2>' . $groupName . '</h2>');
	}
	
      $lists = splitGroupList($group, $columns);
      
	echo('<div class="group group-flex">');
	
	// Cycle through the lists and print each member
	foreach ($lists as $list) {
		echo('<div class="group-column column-flex" style="width:' . 100/$columns . '%;">');
			foreach ($list as $employee) {
				displayEmployeeStatusFlex($employee, $displayType);
			}
		echo('</div>');
	}
	
}



function displayGroupListFlexAjax($group, $groupName = '', $columns, $displayType = 0) {
global $settings;
		
	// Print group name if specified
	if ($groupName != '') {
		echo('<h2>' . $groupName . '</h2>');
	}
	
      $lists = splitGroupList($group, $columns);
      
	echo('<div class="group group-flex">');
	
	// Cycle through the lists and print each member
	foreach ($lists as $list) {
		echo('<div class="group-column column-flex" style="width:' . 100/$columns . '%;">');
			foreach ($list as $employee) {
				displayEmployeeStatusFlexAjax($employee, $displayType);
			}
		echo('</div>');
	}
	
}


function displayChecklist($group, $columns = 3) {
global $settings;
	
	echo('<div class="checklist-container">');
	
	// Cycle through the three lists and print each member
	foreach ($group as $person) {
		echo('<div class="checklist-item">');
		echo($person['firstname'] . ' <strong>' . $person['surname'] . '</strong>');
		echo('</div>');
	}
	
	echo('</div>');
}

function getSelectionURL($activeSelection, $id = null, $type = null) {
// Adds or removes the id from the selection and generates an appropriate string


if (!is_null($id) && !is_null($type)) {
  if(($key = array_search($id, $activeSelection[$type])) !== false) {
  // id is already in the selection -- remove it
      unset($activeSelection[$type][$key]);
  } else {
  // id is not in the selection -- add it
      $activeSelection[$type][] = $id;
  }
}

$outputString = '';
foreach ($activeSelection as $section) {
  foreach($section as $item) {
    $outputString .= $item . '-';
  }
    $outputString = rtrim($outputString, '-');
    $outputString .= '/';
}
$outputString = rtrim($outputString, '/');

return($_SERVER['PHP_SELF'] . '?selection=' .$outputString);

}


function showSelector ($activeSelection) {
global $floors, $teams, $departments;

echo('<div class="noprint" id="selector">');
echo('<h2>Show people from:</h2>');
echo('<ul><li><a href="' . $_SERVER['PHP_SELF'] . '">Clear all selections</a></li></ul>');

echo('<hr />');

echo('<ul>');
foreach ($floors as $floor) {
$link = '<a href="' . getSelectionURL($activeSelection, $floor['id'], 'floors') . '">' . $floor['name'] . '</a>';
  if (in_array($floor['id'], $activeSelection['floors'])) {
    echo('<li><strong>' . $link . '</strong></li>');
  } else {
    echo('<li>' . $link . '</li>');
  }
}
echo('</ul>');

echo('<hr />');

echo('<ul>');
foreach ($teams as $team) {
if($team['id'] > 0) {
$link = '<a href="' . getSelectionURL($activeSelection, $team['id'], 'teams') . '">' . $team['name'] . '</a>';
  if (in_array($team['id'], $activeSelection['teams'])) {
    echo('<li><strong>' . $link . '</strong></li>');
  } else {
    echo('<li>' . $link . '</li>');
  }
}
}
echo('</ul>');

echo('<hr />');

echo('<ul>');
foreach ($departments as $department) {
if($department['id'] > 0) {
$link = '<a href="' . getSelectionURL($activeSelection, $department['id'], 'departments') . '">' . $department['name'] . '</a>';
  if (in_array($department['id'], $activeSelection['departments'])) {
    echo('<li><strong>' . $link . '</strong></li>');
  } else {
    echo('<li>' . $link . '</li>');
  }
}
}
echo('</ul>');

echo('</div>');


}

function getFloors () {
	global $db_connection;
	$floors = array();
	$sql = 'SELECT * FROM floors';
   $results = $db_connection->query($sql);
   if ($results) {
      while ($result = $results->fetch_array(MYSQLI_ASSOC)) {
         $floors[] = $result;
      }
      return $floors;
   } else {
      error_log($db_connection->error);
      echo($db_connection->error);
      exit;
   }
}

function getStatuses () {
	global $db_connection;
	$statuses = array();
	$sql = 'SELECT * FROM statuses';
	$results = $db_connection->query($sql);
   if ($results) {
      while ($result = $results->fetch_array(MYSQLI_ASSOC)) {
         $statuses[] = $result;
      }
      return $statuses;
   } else {
      error_log($db_connection->error);
      echo($db_connection->error);
      exit;
   }
}

function getTeams () {
	global $db_connection;
	$teams = array();
	$teams[] = Array('id' => 0, 'name' => '');
	$sql = 'SELECT * FROM teams WHERE name != "Unassigned" ORDER BY name';
	$results = $db_connection->query($sql);
   if ($results) {
      while ($result = $results->fetch_array(MYSQLI_ASSOC)) {
         $teams[] = $result;
      }
      return $teams;
   } else {
      error_log($db_connection->error);
      echo($db_connection->error);
      exit;
   }
}

function getDepartments ($where = '1=1', $order = 'name') {
	global $db_connection;
	$departments = array();
	$departments[] = Array('id' => 0, 'name' => '');
	$sql = 'SELECT * FROM departments WHERE name != "Unassigned" AND (' . $where . ') ORDER BY ' . $order ;
	$results = $db_connection->query($sql);
   if ($results) {
      while ($result = $results->fetch_array(MYSQLI_ASSOC)) {
         $departments[] = $result;
      }
      return $departments;
   } else {
      error_log($db_connection->error);
      echo($db_connection->error);
      exit;
   }
}

function getEmployees ($where = '', $order = 'firstname, surname') {
	global $db_connection;
	$employees = array();
	$sql = 'SELECT * FROM employees' . ($where==''?'':' WHERE '.$where) . ' ORDER BY ' . $order;
	$results = $db_connection->query($sql);
   if ($results) {
      // echo("DBG: Fetcing results from query $sql\n<br><br>");
      while ($result = $results->fetch_array(MYSQLI_ASSOC)) {
         $employees[] = $result;
         // echo("result: $result\n\n");
      }
      return $employees;
   } else {
      error_log($db_connection->error);
      echo($db_connection->error);
      exit;
   }
}


function getEmployee ($id) {
	global $db_connection;
	$sql = 'SELECT * FROM employees WHERE id = ' . $id;
	$response = $db_connection->query($sql);
	$employee = $results->fetch_array(MYSQLI_ASSOC);
	return $employee;
}



?>
