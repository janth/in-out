<?php


function getAllTemplates () {
	global $db_connection;
	$sql = 'SELECT * FROM `templates` ORDER BY `name`';
	$results = $db_connection->query($sql);
	$templates = array();
	while ($result = $result->fetch_array(MYSQLI_ASSOC)) {
		$templates[] = $result;
	}
	return $templates;
}


function getAllColours () {
	global $db_connection;
	$sql = 'SELECT * FROM `colours` ORDER BY `name`';
	$results = $db_connection->query($sql);
	$colours = array();
	while ($result = $result->fetch_array(MYSQLI_ASSOC)) {
		$colours[] = $result;
	}
	return $colours;
}

function getAllFonts () {
	global $db_connection;
	$sql = 'SELECT * FROM `fonts` ORDER BY `name`';
	$results = $db_connection->query($sql);
	$fonts = array();
	while ($result = $result->fetch_array(MYSQLI_ASSOC)) {
		$fonts[] = $result;
	}
	return $fonts;
}


function getTemplateFields ($template_id) {
	global $db_connection;
	$sql = 'SELECT * FROM `fields` WHERE `template_id` = '.$template_id.' ORDER BY `name`';
	$results = $db_connection->query($sql);
	$fields = array();
	while ($result = $result->fetch_array(MYSQLI_ASSOC)) {
		$fields[] = $result;
	}
	return $fields;
}



?>
