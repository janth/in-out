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
<script>
window.oncontextmenu = function(event) {
    event.preventDefault();
    event.stopPropagation();
    return false;
};
</script>
<script src="functions.js"></script>
<?php
if ($settings['refresh-rate'] > 0) {
  echo('<meta http-equiv="refresh" content="'.$settings['refresh-rate'].'">');
}

$criteria = '';

switch($settings['page']) {

case 'regional'   : $criteria = 'floor in (7,8)';
		    break;
		  
case 'external'   : $criteria = 'floor = 6';
		    break;
		  
case 'keyholders' : $criteria = 'keyholder = 1';
		    break;
		  
case 'inbuilding' : $criteria = 'status = 1';
		    break;
		    
case 'all' :        $criteria = '1 = 1';
                    $settings['columns-update'] += 2; // Hacky
		    break;
		  
default :           $settings['page'] = 'headoffice';
                    $criteria = 'floor in (0,1,2,3,4,5) OR status = 1';
		    break;
}

?>

</head>

<body>

<div class="side-menu">

<?php
// Show current time
echo('<p style="margin-top:.5em;text-align:center;font-weight:bold;font-size:2em;">' . date("g:i") . '<span style="font-size:60%;">' . date("A") . '</span><br /><span style="font-size:40%">' . date("l F\&\\n\b\s\p\;jS") . '</span></p>');

// Show various options
displaySideMenuItem('Head office<br /><span style="font-size:.5em;">(and all signed-in people)</span>', 'headoffice');
displaySideMenuItem('Regional staff', 'regional');
displaySideMenuItem('Volunteers and External', 'external');
displaySideMenuItem('Keyholders', 'keyholders');
displaySideMenuItem('In the building', 'inbuilding');
displaySideMenuItem('All people', 'all');
?>

</div>


<div class="main-section">
<?php // Just print Everyone
	$list = getEmployees($criteria, 'firstname, surname');
	if (count($list)>0) {
		displayGroupListFlexAjax($list, null, $settings['columns-update'], 1);
	} else {
	      echo('<p>Nothing to display</p>');
	}
?>

</div>

</body>


</html>
