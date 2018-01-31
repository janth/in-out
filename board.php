<?php
require('settings.php');
require('functions.php');
require('data.php');
?>

<html>
<head>
<title>Employee Sign-in Board</title>
<link rel="stylesheet" href="style.php" />
<link rel="stylesheet" href="style-update.php" />

<?php
if ($settings['refresh-rate'] > 0) {
  echo('<meta http-equiv="refresh" content="'.$settings['refresh-rate'].'">');
}

?>

</head>

<body>

<?php // Just print Everyone
	$list = getEmployees(null, 'firstname, surname');
	if (count($list)>0) {
		displayGroupList($list, null, $settings['columns-update']);
	}
?>

</body>


</html>
