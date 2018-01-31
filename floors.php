<?php
require('settings.php');
require('functions.php');
require('data.php');
?>

<html>
<head>
<title><?php Title('floor'); ?></title>
<link rel="stylesheet" href="style.css" />

<?php
if ($settings['refresh-rate'] > 0) {
  echo('<meta http-equiv="refresh" content="'.$settings['refresh-rate'].'">');
}

?>

</head>

<body>
<?php Menu(); ?>
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
