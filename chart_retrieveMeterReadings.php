<?php
	require './vendor/parse/autoload.php';
	session_start();

	use Parse\ParseClient;
	use Parse\ParseUser;
	use Parse\ParseObject;
	use Parse\ParseQuery;
	use Parse\ParseGeoPoint;
	
	$app_id = '8mAHLrA77NSsHIOO1RjkUZR20ispu5otVdNahwgU';
	$rest_key = 'PbPoCeCVJ1ApHZIZgomnPJJe3Qp5uO6oNlIMtnUb';
	$master_key = 'MyLnALFqUjZTkIMzDV4HzyqopVlkol4ysRxDyXWM';
	
	ParseClient::initialize( $app_id, $rest_key, $master_key );
	// Users of Parse Server will need to point ParseClient at their remote URL and Mount Point:
	ParseClient::setServerURL('https://parseapi.back4app.com', '/');
	
	
	class readings {
		public $main = [
			[], // label
			[], // data
			[], // location
			[]  // date
		];
		public $peak = [
			[], // label
			[], // data
			[], // location
			[]  // date
		];
		public $solar = [
			[], // label
			[], // data
			[], // location
			[]  // date
		];
		public $other = [
			[], // label
			[], // data
			[], // location
			[]  // date
		];
	}
	$meterReadings = new Readings;
	
	try {
		$currentUser = ParseUser::getCurrentUser();
		if ($currentUser) {
			// If user is already logged in	
			try {
				
				// Decode JSON variables
				//$someArray = json_decode($_POST['someVariable'], true);
				
				// Query Meter Class/Table
				$query = new ParseQuery("Meter");
				$query->ascending("date");
				
				// Retrieve Data Rows
				$results = $query->find();
				//echo count($results) . " rows retrieved.<br/>";

				
				// Get Values of Meter Readings
				for ($i = 0; $i < count($results); $i++) {
					$object = $results[$i];
					
					// meter type
					$meterType = $object->get('type');
					
					// meter date & meter label
					$meterDate_str = $object->get('date');
					if (!empty($meterDate_str)){
						$meterDate = strtotime($meterDate_str);
						$meterLabel = date('D-d-M-Y', $meterDate);
					} else {
						$meterDate = '';
						$meterLabel = '';
					}
					// meter value
					$meterValue = $object->get('value1');
					// meter location
					$userGeoPoint = $object->get('location');
					if(!empty($userGeoPoint)){
						$meterLocation = [$userGeoPoint->getLatitude(),$userGeoPoint->getLongitude()];
					} else {
						$meterLocation = '';
					}
					
					// store values
					if (strpos($meterType, 'Main') !== false) {
						$meterReadings->main[0][] = $meterLabel;
						$meterReadings->main[1][] = $meterValue;
						$meterReadings->main[2][] = $meterLocation;
						$meterReadings->main[3][] = $meterDate;
					} else if (strpos($meterType, 'Controlled') !== false) {
						$meterReadings->peak[0][] = $meterLabel;
						$meterReadings->peak[1][] = $meterValue;
						$meterReadings->peak[2][] = $meterLocation;
						$meterReadings->peak[3][] = $meterDate;
					} else if (strpos($meterType, 'Solar') !== false) {
						$meterReadings->solar[0][] = $meterLabel;
						$meterReadings->solar[1][] = $meterValue;
						$meterReadings->solar[2][] = $meterLocation;
						$meterReadings->solar[3][] = $meterDate;
					} else {
						echo $meterType;
						$meterReadings->other[0][] = $meterLabel;
						$meterReadings->other[1][] = $meterValue;
						$meterReadings->other[2][] = $meterLocation;
						$meterReadings->other[3][] = $meterDate;
					}
				}
				
				// send readings
				echo json_encode($meterReadings);
			} catch (Exception $error){
				//echo $error->getMessage();
				echo json_encode(new Readings);
			}
		} else {
			echo '';
		}
	} catch (Exception $error) {
		//echo $error->getMessage();
	}

?>