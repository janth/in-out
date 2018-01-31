<?php
require('settings.php');
require('functions.php');
require('data.php');

if (!isset($_GET['selection']) || $_GET['selection'] == '') {
   // Set default selection (all floors in head office, no teams or departments)
   $_GET['selection'] = "0-1-2-3-4-5//";
   // Nah, set it to empty
   $_GET['selection'] = "";
}

$selection_input = explode('/', $_GET['selection']);


// Code to build selection array as needed
$selection = Array('floors' => Array(), 'teams' => Array(), 'departments' => Array());

if (isset($selection_input[0]) && $selection_input[0] != '') {
  foreach (explode('-', $selection_input[0]) as $value) {
    $selection['floors'][] = $value;
  }
}

if (isset($selection_input[1]) && $selection_input[1] != '') {
  foreach (explode('-', $selection_input[1]) as $value) {
    $selection['teams'][] = $value;
  }
}

if (isset($selection_input[2]) && $selection_input[2] != '') {
  foreach (explode('-', $selection_input[2]) as $value) {
    $selection['departments'][] = $value;
  }
}


// Generate WHERE clause, starting with always-untrue (1=2) so that OR sections can be appended
$where_clause = '`phone` IS NOT NULL AND `phone` <> "" AND (1=2';

foreach ($selection['floors'] as $floor) {
  $where_clause .= ' OR `floor` = ' . $floor;
}
foreach ($selection['teams'] as $team) {
  $where_clause .= ' OR `team` = ' . $team;
}
foreach ($selection['departments'] as $department) {
  $where_clause .= ' OR `department` = ' . $department;
}

// Only display people with numbers
$where_clause .= ')';

//$order_by = '`floor`, `surname`, `firstname`';
$order_by = '`firstname`, `surname`';

$list = getEmployees($where_clause, $order_by);

?>

<html>
<head>
<title>Employee Phonelist</title>
<link rel="stylesheet" href="style.php" />
</head>
<body>




<h1 class="checklist"><?php echo $settings['Company']; ?> Phonelist</h1>


<?php showSelector($selection); ?>

<?php
if (count($list)>0) {
  displayPhonelist($list, null, 1);
} else {
  echo('<p style="text-align: center;">Select required group(s) from the list.</p>');
}
?>

</body>
</html>
