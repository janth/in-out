<?php


function getAllTemplates () {
	global $db_connection;
	$sql = 'SELECT * FROM `templates` ORDER BY `name`';
	$results = mysql_query($sql);
	$templates = array();
	while ($result = mysql_fetch_array($results)) {
		$templates[] = $result;
	}
	return $templates;
}


function getAllColours () {
	global $db_connection;
	$sql = 'SELECT * FROM `colours` ORDER BY `name`';
	$results = mysql_query($sql);
	$colours = array();
	while ($result = mysql_fetch_array($results)) {
		$colours[] = $result;
	}
	return $colours;
}

function getAllFonts () {
	global $db_connection;
	$sql = 'SELECT * FROM `fonts` ORDER BY `name`';
	$results = mysql_query($sql);
	$fonts = array();
	while ($result = mysql_fetch_array($results)) {
		$fonts[] = $result;
	}
	return $fonts;
}


function getTemplateFields ($template_id) {
	global $db_connection;
	$sql = 'SELECT * FROM `fields` WHERE `template_id` = '.$template_id.' ORDER BY `name`';
	$results = mysql_query($sql);
	$fields = array();
	while ($result = mysql_fetch_array($results)) {
		$fields[] = $result;
	}
	return $fields;
}



?>