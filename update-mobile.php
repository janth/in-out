<?php
require('settings.php');
require('functions.php');
require('data.php');
?>

<html>
<head>

<title>Employee Sign-in Board</title>

<link rel="stylesheet" href="style.css" />
<link rel="stylesheet" href="style-update.php" />

<link rel="manifest" href="manifest.json">

<meta name="mobile-web-app-capable" content="yes">
<meta name="viewport" content="user-scalable=no" />

<meta name="application-name" content="<?php echo $settings['Company']; ?> Sign-in Board">

<link rel="shortcut icon" sizes="196x196" href="/signin_icon.png">


<script>
window.oncontextmenu = function(event) {
    event.preventDefault();
    event.stopPropagation();
    return false;
};
</script>
<script src="functions.js"></script>

</head>

<body>

<div class="main-section-mobile">
<?php // Just print Everyone
	$list = getEmployees('floor in (0,1,2,3,4,5,7,8)', 'firstname, surname');
	if (count($list)>0) {
		displayGroupListFlexAjax($list, null, 5, 1);
	} else {
	      echo('<p>Nothing to display</p>');
	}
?>

</div>

</body>


</html>
