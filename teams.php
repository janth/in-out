<?php
require('settings.php');
require('functions.php');
require('data.php');
?>

<html>
<head>
<title><?php Title('teams'); ?></title>
<link rel="stylesheet" href="style.php" />

<?php
if ($settings['refresh-rate'] > 0) {
  echo('<meta http-equiv="refresh" content="'.$settings['refresh-rate'].'">');
}

?>

</head>

<body>
<?php Menu(); ?>
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
