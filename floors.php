<?php
require('settings.php');
require('functions.php');
require('data.php');
?>

<html>
<head>
<title>LLR Staff in the building (by floor)</title>
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

	foreach ($floors as $floor) {
		$list = getEmployees('status = 1 AND floor = ' . $floor['id'], 'firstname, surname');
		if (count($list)>0) {
				displayFloorPresenceSolo($list, $floor['name']);
		}
	}

?>

</body>


</html>