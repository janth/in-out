<?php


$db_server = 'localhost:3306';
$db_database = 'signin';
$db_user = 'signinuser';
$db_password = 'signinpw';



$settings['columns'] = 8;
$settings['columns-public'] = 8;
$settings['columns-tablet'] = 5;
$settings['columns-update'] = 7;


$settings['refresh-rate'] = 60; // Number of seconds between updates (0 = never)
$settings['refresh-rate-public'] = 15; // Number of seconds between updates
$settings['refresh-rate-tablet'] = 120; // Number of seconds between updates
$settings['refresh-rate-update'] = 3000; // Number of seconds between updates





if (isset($_GET['page'])) {

$settings['page'] = $_GET['page'];

        switch ($settings['page']) {

                case 'public' :
			$settings['columns'] = $settings['columns-public'];
			$settings['refresh-rate'] = $settings['refresh-rate-public'];
                        break;

                case 'tablet' :
			$settings['columns'] = $settings['columns-tablet'];
			$settings['refresh-rate'] = $settings['refresh-rate-tablet'];
                        break;

        }

} else {

        $settings['page'] = 'everyone';
}
