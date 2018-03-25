<?php
	require 'vendor/parse/autoload.php';
	session_start();

	use Parse\ParseClient;
	
	$app_id = '8mAHLrA77NSsHIOO1RjkUZR20ispu5otVdNahwgU';
	$rest_key = 'PbPoCeCVJ1ApHZIZgomnPJJe3Qp5uO6oNlIMtnUb';
	$master_key = 'MyLnALFqUjZTkIMzDV4HzyqopVlkol4ysRxDyXWM';
	
	ParseClient::initialize( $app_id, $rest_key, $master_key );
	// Users of Parse Server will need to point ParseClient at their remote URL and Mount Point:
	ParseClient::setServerURL('https://parseapi.back4app.com', '/');
?>