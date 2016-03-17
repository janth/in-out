
<?php
 header('Content-type: text/css');
 require('settings.php');
?>

body {
font-size: .8em;
}

.group-column {
width: <?php echo(100/$settings['columns-public']); ?>%;
}

.employee-data {
height: 3em;
//text-shadow: 1px 1px #000;
}

.employee-notes-section {
display: none;
}

.menu-bar {
display: none;
}
