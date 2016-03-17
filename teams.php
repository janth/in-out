<?php
require('settings.php');
require('functions.php');
require('data.php');
?>

<html>
<head>
<title>LLR Staff in the building</title>
<link rel="stylesheet" href="style.css" />

<?php
if ($settings['refresh-rate'] > 0) {
  echo('<meta http-equiv="refresh" content="'.$settings['refresh-rate'].'">');
}

?>

</head>

<body>
<h1>LLR Staff currently signed in</h1>
<p>(&nbsp;&nbsp;&nbsp;<a href="floors.php">View by floor</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="teams.php">View by team</a>&nbsp;&nbsp;&nbsp;)<br /><br /></p>

<?php 

	$listExec = getEmployees('team = 17 AND status = 1', 'department, team, firstname, surname');
	if (count($listExec)>0) {
		displayTeamPresenceSolo($listExec, 'Executive');
	}
	$listOthers = getEmployees('team <> 17 AND status = 1', 'department, team, firstname, surname');
	if (count($listOthers)>0) {
		displayTeamPresence($listOthers);
	}
?>

</body>


</html>