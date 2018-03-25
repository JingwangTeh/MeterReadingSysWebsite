<?php
	require 'parseDetails.php';
	use Parse\ParseClient;
	use Parse\ParseUser;
	use Parse\ParseObject;
	use Parse\ParseQuery;
	use Parse\ParseGeoPoint;
?>

<?php
	try {
		$currentUser = ParseUser::getCurrentUser();
		if ($currentUser) {
			// No redirect if logged in
		} else {
			// Redirect if user has not logged in
			header('Location: '.'login.php');
		}
	} catch (Exception $error) {
		//echo $error;
	}

?>


<!DOCTYPE HTML>
<html>
<head>

<!-- Common Meta & Fav-ico, 
	 Libraries (w3.css, bootstrap, jQuery, jQueryUI), 
	 Common CSS (reset, loader, layout)
	 Common JS (note: Priority before Page Loads) -->
	<?php //include $_SERVER['DOCUMENT_ROOT'].'/phpCommons/layoutCommonTop_otherPage.php'; ?>
	<?php include 'phpCommons/layoutCommonTop_otherPage.php'; ?>

<!-- Page CSS -->

	<!-- Content Wrapper -->
	<!--<link rel="stylesheet" type="text/css" href="/css/contentProfile.css" />-->
	<link rel="stylesheet" type="text/css" href="css/contentMeterReading.css" />
	<!-- Misc -->
	<!--<link rel="stylesheet" type="text/css" href="/css/style.css" />-->
	<link rel="stylesheet" type="text/css" href="css/style.css" />

<!-- TITLE -->
	<title>Snappy : Meter Reading</title>

<!-- Internal JavaScript -->

	<script>
	</script>

</head>
<body id="home">

<!-- Page Loader -->
<div id="loading-screen"><div id="loader"></div></div>



<!-- --------------------Page Wrapper-------------------- -->
<!--<div id="page-wrapper" class="animate-bottom">-->
<div id="page-wrapper">
	
	<div id="mapWrapper">
		<div id="googleMap"></div>
		<span onclick="hideMap()">X</span>
	</div>
	
	<!-- SIDEBAR -->
	<?php //include $_SERVER['DOCUMENT_ROOT'].'/phpCommons/layoutHeader_otherPage.php'; ?>
	<?php include 'phpCommons/layoutHeader_otherPage.php'; ?>
	
	<!-- CONTENT -->
	<section id="content">
		
		<!-- some content -->
		<div>
			<div id="meter_nav">
				<ul>
					<li onclick="showMeterChart('mainMeterWrapper')">MAIN METER</li>
					<li onclick="showMeterChart('peakMeterWrapper')">PEAK METER</li>
					<li onclick="showMeterChart('solarMeterWrapper')">SOLAR METER</li>
				</ul>
			</div>
			<div id="meterChart">
				<div class="meterWrapper meterWrapperDisplay" id="mainMeterWrapper">
					<div>
						<!-- Group By Setting -->
						<div id="mainMeterChart_groupBy">
							<button onclick="groupAndPopulate(0)">GROUP BY DAY</button>
							<button onclick="groupAndPopulate(0,0)">GROUP BY MONTH</button>
							<button onclick="groupAndPopulate(0,1)">GROUP BY YEAR</button>
						</div>
						<!-- Chart -->
						<canvas id="mainChart"></canvas>
						<!-- Table -->
						<div><table id="mainMeterEntries">
							<thead><tr>
								<!--<th>Label<span class="th_border_bottom"></span></th>-->
								<th>Meter Value<span class="th_border_bottom"></span></th>
								<th>Location<span class="th_border_bottom"></span></th>
								<th>Date<span class="th_border_bottom"></span></th>
							</tr></thead>
							<tbody>
							</tbody>
						</table></div>
					</div>
				</div>
				<div class="meterWrapper" id="peakMeterWrapper">
					<div>
						<!-- Group By Setting -->
						<div id="mainMeterChart_groupBy">
							<button onclick="groupAndPopulate(1)">GROUP BY DAY</button>
							<button onclick="groupAndPopulate(1,0)">GROUP BY MONTH</button>
							<button onclick="groupAndPopulate(1,1)">GROUP BY YEAR</button>
						</div>
						<!-- Chart -->
						<canvas id="peakChart"></canvas>
						<!-- Table -->
						<div><table id="peakMeterEntries">
							<thead><tr>
								<!--<th>Label<span class="th_border_bottom"></span></th>-->
								<th>Meter Value<span class="th_border_bottom"></span></th>
								<th>Location<span class="th_border_bottom"></span></th>
								<th>Date<span class="th_border_bottom"></span></th>
							</tr></thead>
							<tbody>
							</tbody>
						</table></div>
					</div>
				</div>
				<div class="meterWrapper" id="solarMeterWrapper">
					<div>
						<!-- Group By Setting -->
						<div id="mainMeterChart_groupBy">
							<button onclick="groupAndPopulate(2)">GROUP BY DAY</button>
							<button onclick="groupAndPopulate(2,0)">GROUP BY MONTH</button>
							<button onclick="groupAndPopulate(2,1)">GROUP BY YEAR</button>
						</div>
						<!-- Chart -->
						<canvas id="solarChart"></canvas>
						<!-- Table -->
						<div><table id="solarMeterEntries">
							<thead><tr>
								<!--<th>Label<span class="th_border_bottom"></span></th>-->
								<th>Meter Value<span class="th_border_bottom"></span></th>
								<th>Location<span class="th_border_bottom"></span></th>
								<th>Date<span class="th_border_bottom"></span></th>
							</tr></thead>
							<tbody>
							</tbody>
						</table></div>
					</div>
				</div>
			</div>
		</div>
		
	</section>
	
	
	
	<!-- FOOTER -->
	<?php //include $_SERVER['DOCUMENT_ROOT'].'/phpCommons/layoutFooter_otherPage.php'; ?>
	<?php //include 'phpCommons/layoutFooter_otherPage.php'; ?>
</div>
<!-- --------------------End Page-------------------- -->



<!-- Common JS (note: After Page Loads) -->
	<?php //include $_SERVER['DOCUMENT_ROOT'].'/phpCommons/layoutCommonBottom.php'; ?>
	<?php include 'phpCommons/layoutCommonBottom.php'; ?>
	
<!-- Internal JavaScript -->
	<script>
		
		/*
		 * Chart Data Structure
		 */
		 
		var chartData = {
			'main' : {
				'label'		: [], // label
				'data'		: [], // data
				'location'	: [], // location
				'date'		: []  // date
			},
			'peak' : { 
				'label'		: [], // label
				'data'		: [], // data
				'location'	: [], // location
				'date'		: []  // date
			},
			'solar' : { 
				'label'		: [], // label
				'data'		: [], // data
				'location'	: [], // location
				'date'		: []  // date
			}
		};
		
		var chartData_filtered = {
			'main' : {
				'label'		: [], // label
				'data'		: [], // data
				'location'	: [], // location
				'date'		: []  // date
			},
			'peak' : { 
				'label'		: [], // label
				'data'		: [], // data
				'location'	: [], // location
				'date'		: []  // date
			},
			'solar' : { 
				'label'		: [], // label
				'data'		: [], // data
				'location'	: [], // location
				'date'		: []  // date
			}
		};

		var meter_types = ['main', 'peak', 'solar'];
		
		var meter_types_tables = [document.getElementById("mainMeterEntries"),
								  document.getElementById("peakMeterEntries"),
								  document.getElementById("solarMeterEntries")];
								  
		var meter_types_charts = [document.getElementById("mainChart"),
								  document.getElementById("peakChart"),
								  document.getElementById("solarChart")];
		
		var groupBySettingArray = ['month', 'year'];

		
		
		/*
		 * AJAX Call to Get Data to Populate Chart
		 */
		 
		$(document).ready(function () {
			hideMap();
			
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					//console.log(this.responseText);
					var meterReadingsJSON = JSON.parse(this.responseText);
					//console.log(meterReadingsJSON);
					
					// main meter readings
					chartData.main.label = meterReadingsJSON.main[0];
					chartData.main.data = meterReadingsJSON.main[1];
					chartData.main.location = meterReadingsJSON.main[2];
					chartData.main.date = meterReadingsJSON.main[3];
					
					// peak meter readings
					chartData.peak.label = meterReadingsJSON.peak[0];
					chartData.peak.data = meterReadingsJSON.peak[1];
					chartData.peak.location = meterReadingsJSON.peak[2];
					chartData.peak.date = meterReadingsJSON.peak[3];
					
					// solar meter readings
					chartData.solar.label = meterReadingsJSON.solar[0];
					chartData.solar.data = meterReadingsJSON.solar[1];
					chartData.solar.location = meterReadingsJSON.solar[2];
					chartData.solar.date = meterReadingsJSON.solar[3];
					
					// Group Readings, Populate Charts, Populate Meter Entries
					groupAndPopulate();
				}
			};
			
			
			// url to respond to AJAX call for progressive facet search
			var url = "chart_retrieveMeterReadings.php";
		
			// open POST request
			xmlhttp.open("POST", url, true);
			// set header for POST request
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
			// convert array to JSON string
			//var jsonString = JSON.stringify(test);
			var var_send = "";//"chart_type="+encodeURIComponent(jsonString);
//			var_send += "&someVariable="+someValue;
			
			// send AJAX POST request
			xmlhttp.send(var_send);
		});
		
		
		
		function groupAndPopulate(meterSettingIndex = -1, groupBySettingIndex = -1){
			// Group SELECTED meter based on SELECTED groupBySettingIndex
			// , and populate SELECTED Chart and SELECTED Entries
			if (meter_types[meterSettingIndex] && groupBySettingArray[groupBySettingIndex]) {
				groupReadings(meter_types[meterSettingIndex], groupBySettingArray[groupBySettingIndex]);
				populateChart(meter_types[meterSettingIndex], meter_types_charts[meterSettingIndex]);
				populateEntries(meter_types[meterSettingIndex], meter_types_tables[meterSettingIndex]);
			} 
			// Group SELECTED meter based on DEFAULT groupBySetting
			// , and populate SELECTED Chart and SELECTED Entries
			else if (meter_types[meterSettingIndex]) {
				groupReadings(meter_types[meterSettingIndex], '');
				populateChart(meter_types[meterSettingIndex], meter_types_charts[meterSettingIndex]);
				populateEntries(meter_types[meterSettingIndex], meter_types_tables[meterSettingIndex]);
			} 
			// Group EVERY meter based on SELECTED groupBySettingIndex
			// , and populate ALL Charts and ALL Entries
			else if (groupBySettingArray[groupBySettingIndex]) {
				groupReadings('', groupBySettingArray[groupBySettingIndex]);
				populateChart();
				populateEntries();
			} 
			// Group EVERY meter based on DEFAULT groupBySetting
			// , and populate ALL Charts and ALL Entries
			else {
				groupReadings();
				populateChart();
				populateEntries();
			}
		}
		
		/*
		 * Function - Group Readings
		 * - Group all rows for the same label (different time but still same date)
		 * - Overwrite existing row with same label, overwrite with max value
		 */

		function groupReadings(meterSetting = '', groupBySetting = '') {
			
			if (meter_types.indexOf(meterSetting) != -1) {
				// empty selected meter array
				chartData_filtered[meterSetting] = {
					'label'		: [], // label
					'data'		: [], // data
					'location'	: [], // location
					'date'		: []  // date
				};
				
				// loop through records in SELECTED meter type
				for (var meter_i = 0; meter_i < chartData[meterSetting].data.length; meter_i++) {
					var tmp_label = chartData[meterSetting].label[meter_i];
					var objectIndex = -1;
					
					// ensure tmp_label is not empty, so that it can be processed
					if (tmp_label) {
						var tmp_label_array = tmp_label.split("-"); // (e.g. Mon-31-12-2017)
						
						// update tmp_label based on groupBySetting
						if (groupBySetting == groupBySettingArray[0]){
							tmp_label = tmp_label_array[2] + '-' + tmp_label_array[3];
						} else if (groupBySetting == groupBySettingArray[1]){
							tmp_label = 'Year-' + tmp_label_array[3];
						}
						
						// check if label exists in array array
						// if NOT found, objectIndex is -1
						// if found, returns the index
						objectIndex = chartData_filtered[meterSetting].label.findIndex(function (cur_label) {
							var cur_label_array = cur_label.split("-"); // (e.g. Mon-31-12-2017 or 12-2017 or Year-2017)
						
							// group based on label
							if (groupBySetting == groupBySettingArray[0]){
								return ((cur_label_array[0] == tmp_label_array[2]) && (cur_label_array[1] == tmp_label_array[3]));
							} else if (groupBySetting == groupBySettingArray[1]){
								return (cur_label_array[1] == tmp_label_array[3]);
							} else {
								// default group setting
								return cur_label == tmp_label;
							}
						});
					}
					// no label (no date)
					else {
						tmp_label = 'no label';
					}
					
					// if label not exist,
					if (objectIndex == -1) {
						
						// add to array
						chartData_filtered[meterSetting].label.push(tmp_label);
						chartData_filtered[meterSetting].data.push(chartData[meterSetting].data[meter_i]);
						chartData_filtered[meterSetting].location.push(chartData[meterSetting].location[meter_i]);
						chartData_filtered[meterSetting].date.push(chartData[meterSetting].date[meter_i]);
						
					}
					// label exists
					else {
						// overwrite data with max value
						if (chartData[meterSetting].data[meter_i] >= chartData_filtered[meterSetting].data[objectIndex]) {
							chartData_filtered[meterSetting].label[objectIndex] = tmp_label;
							chartData_filtered[meterSetting].data[objectIndex] = chartData[meterSetting].data[meter_i];
							chartData_filtered[meterSetting].location[objectIndex] = chartData[meterSetting].location[meter_i];
							chartData_filtered[meterSetting].date[objectIndex] = chartData[meterSetting].date[meter_i];
						}
						
					}
				}
			}
			// default if no groupBySetting or meterSetting is given
			// group by day, and group for all meter types in chartData_filtered
			else {
				// empty existing array
				chartData_filtered = {
					'main' : {
						'label'		: [], // label
						'data'		: [], // data
						'location'	: [], // location
						'date'		: []  // date
					},
					'peak' : { 
						'label'		: [], // label
						'data'		: [], // data
						'location'	: [], // location
						'date'		: []  // date
					},
					'solar' : { 
						'label'		: [], // label
						'data'		: [], // data
						'location'	: [], // location
						'date'		: []  // date
					}
				};
				
				// loop through each meter type
				for (var meter_types_i = 0; meter_types_i < meter_types.length; meter_types_i++) {
					// loop through records in each meter type
					for (var meter_i = 0; meter_i < chartData[meter_types[meter_types_i]].data.length; meter_i++) {
						var tmp_label = chartData[meter_types[meter_types_i]].label[meter_i];
						var objectIndex = -1;
						
						// ensure tmp_label is not empty, so that it can be processed
						if (tmp_label) {
							var tmp_label_array = tmp_label.split("-"); // (e.g. Mon-31-12-2017)
							
							// update tmp_label based on groupBySetting
							if (groupBySetting == groupBySettingArray[0]){
								tmp_label = tmp_label_array[2] + '-' + tmp_label_array[3];
							} else if (groupBySetting == groupBySettingArray[1]){
								tmp_label = 'Year-' + tmp_label_array[3];
							}
							
							// check if label exists in array array
							// if NOT found, objectIndex is -1
							// if found, returns the index
							objectIndex = chartData_filtered[meter_types[meter_types_i]].label.findIndex(function (cur_label) {
								var cur_label_array = cur_label.split("-"); // (e.g. Mon-31-12-2017 or 12-2017 or Year-2017)
							
								// group based on label
								if (groupBySetting == groupBySettingArray[0]){
									return ((cur_label_array[0] == tmp_label_array[2]) && (cur_label_array[1] == tmp_label_array[3]));
								} else if (groupBySetting == groupBySettingArray[1]){
									return (cur_label_array[1] == tmp_label_array[3]);
								} else {
									// default group setting
									return cur_label == tmp_label;
								}
							});
						}
						// no label (no date)
						else {
							tmp_label = 'no label';
						}
						
						// if label not exist,
						if (objectIndex == -1) {
							
							// add to array
							chartData_filtered[meter_types[meter_types_i]].label.push(tmp_label);
							chartData_filtered[meter_types[meter_types_i]].data.push(chartData[meter_types[meter_types_i]].data[meter_i]);
							chartData_filtered[meter_types[meter_types_i]].location.push(chartData[meter_types[meter_types_i]].location[meter_i]);
							chartData_filtered[meter_types[meter_types_i]].date.push(chartData[meter_types[meter_types_i]].date[meter_i]);
							
						}
						// label exists
						else {
							// overwrite data with max value
							if (chartData[meter_types[meter_types_i]].data[meter_i] >= chartData_filtered[meter_types[meter_types_i]].data[objectIndex]) {
								chartData_filtered[meter_types[meter_types_i]].label[objectIndex] = tmp_label;
								chartData_filtered[meter_types[meter_types_i]].data[objectIndex] = chartData[meter_types[meter_types_i]].data[meter_i];
								chartData_filtered[meter_types[meter_types_i]].location[objectIndex] = chartData[meter_types[meter_types_i]].location[meter_i];
								chartData_filtered[meter_types[meter_types_i]].date[objectIndex] = chartData[meter_types[meter_types_i]].date[meter_i];
							}
							
						}
					}
				}
			}
			//console.log(chartData_filtered);
			
		}
		
		/*
		 * Function - Populate Charts
		 * uses Function - Chart Data, and Function - Chart Option
		 */
		
		function populateChart(meterType='', chart_canvas='', chart_type='line') {
			if (meterType && chart_canvas) {
				if (chart_canvas){
					var selected_chart = new Chart(chart_canvas, {
						type: chart_type,
						data: getChartData(meterType),
						options: getChartOptions(meterType)
					});
				}
			} 
			// default to populate all charts
			else {
				for (var chart_i = 0; chart_i < meter_types_charts.length; chart_i++) {
					var chart_canvas = meter_types_charts[chart_i];
					if (chart_canvas){
						var cur_chart = new Chart(chart_canvas, {
							type: chart_type,
							data: getChartData(meter_types[chart_i]),
							options: getChartOptions(meter_types[chart_i])
						});
					}
				}
			}
		}
		
		/*
		 * Function - Populate Meter Entries
		 */
		 
		function populateEntries(meterType='', meter_table='') {
			if (meterType && meter_table) {
				if (meter_table.getElementsByTagName("tbody")[0]){
					// empty current records from tbody of the selected table
					var meter_table_contentWrapper = meter_table.getElementsByTagName("tbody")[0];
					meter_table_contentWrapper.innerHTML = '';
					
					// data exists for the meter
					if (chartData_filtered[meterType].data.length > 0) {
						// loop through records in each meter type
						for (var meter_i = 0; meter_i < chartData_filtered[meterType].data.length; meter_i++) {
							// insert new row
							var newMeterRow = meter_table_contentWrapper.insertRow(0);
							
							// insert new column
							// data column
							var cell_data = newMeterRow.insertCell(0);
							var text_data = document.createTextNode(chartData_filtered[meterType].data[meter_i]);
							cell_data.appendChild(text_data);
							// location column
							var cell_location = newMeterRow.insertCell(1);
							var cur_loc = chartData_filtered[meterType].location[meter_i];
							var text_location = document.createTextNode(cur_loc);
							cell_location.appendChild(text_location);
							if (cur_loc) {
								cell_location.insertAdjacentHTML('beforeend', '<p class="quick_map" onclick="displayMap('+cur_loc+')">Map</p>');
							}
							// label column
							var cell_label = newMeterRow.insertCell(2);
							var text_label = document.createTextNode(chartData_filtered[meterType].label[meter_i]);
							cell_label.appendChild(text_label);
							// date column
							/*
							var cell_date = newMeterRow.insertCell(2);
							var text_date = document.createTextNode(chartData_filtered[meterType].date[meter_i]);
							cell_date.appendChild(text_date);
							*/
						}
					}
					// if no data for the meter
					else {
						// insert new row
						var newMeterRow = meter_table_contentWrapper.insertRow(0);
						
						// insert new column
						// label column
						/*
						var cell_label = newMeterRow.insertCell(0);
						var text_label = document.createTextNode('No Label');
						cell_label.appendChild(text_label);
						*/
						// data column
						var cell_data = newMeterRow.insertCell(0);
						var text_data = document.createTextNode('No Data');
						cell_data.appendChild(text_data);
						// location column
						var cell_location = newMeterRow.insertCell(1);
						var text_location = document.createTextNode('No Location');
						cell_location.appendChild(text_location);
						// date column
						var cell_date = newMeterRow.insertCell(2);
						var text_date = document.createTextNode('No Date');
						cell_date.appendChild(text_date);
					}
				}
			}
			// default to populate all table entries
			else {
				// loop through each meter type
				for (var meter_types_i = 0; meter_types_i < meter_types.length; meter_types_i++) {
					if (meter_types_tables[meter_types_i].getElementsByTagName("tbody")[0]){
						// empty current records from tbody of the current table
						var meter_table_contentWrapper = meter_types_tables[meter_types_i].getElementsByTagName("tbody")[0];
						meter_table_contentWrapper.innerHTML = '';
					
						// data exists for the meter
						if (chartData_filtered[meter_types[meter_types_i]].data.length > 0){
							// loop through records in each meter type
							for (var meter_i = 0; meter_i < chartData_filtered[meter_types[meter_types_i]].data.length; meter_i++) {
								// insert new row
								var newMeterRow = meter_table_contentWrapper.insertRow(0);
								
								// insert new column
								// data column
								var cell_data = newMeterRow.insertCell(0);
								var text_data = document.createTextNode(chartData_filtered[meter_types[meter_types_i]].data[meter_i]);
								cell_data.appendChild(text_data);
								// location column
								var cell_location = newMeterRow.insertCell(1);
								var cur_loc = chartData_filtered[meter_types[meter_types_i]].location[meter_i];
								var text_location = document.createTextNode(cur_loc);
								cell_location.appendChild(text_location);
								if (cur_loc) {
									cell_location.insertAdjacentHTML('beforeend', '<p class="quick_map" onclick="displayMap('+cur_loc+')">Map</p>');
								}
								// label column
								var cell_label = newMeterRow.insertCell(2);
								var text_label = document.createTextNode(chartData_filtered[meter_types[meter_types_i]].label[meter_i]);
								cell_label.appendChild(text_label);
								// date column
								/*
								var cell_date = newMeterRow.insertCell(2);
								var text_date = document.createTextNode(chartData_filtered[meter_types[meter_types_i]].date[meter_i]);
								cell_date.appendChild(text_date);
								*/
							}
						}
						// if no data for the meter
						else {
							// insert new row
							var newMeterRow = meter_table_contentWrapper.insertRow(0);
							
							// insert new column
							// label column
							/*
							var cell_label = newMeterRow.insertCell(0);
							var text_label = document.createTextNode('No Label');
							cell_label.appendChild(text_label);
							*/
							// data column
							var cell_data = newMeterRow.insertCell(0);
							var text_data = document.createTextNode('No Data');
							cell_data.appendChild(text_data);
							// location column
							var cell_location = newMeterRow.insertCell(1);
							var text_location = document.createTextNode('No Location');
							cell_location.appendChild(text_location);
							// date column
							var cell_date = newMeterRow.insertCell(2);
							var text_date = document.createTextNode('No Date');
							cell_date.appendChild(text_date);
						}
					}
				}
			}
		}
		
		/*
		 * Function - Chart Data
		 */
		 
		function getChartData(chart) {
			var data = {
				main_data : {
					labels		: chartData_filtered.main.label,
					datasets	: [{
						label	: 'Main Meter',
						backgroundColor: 'rgba(0, 115, 128, 1)',
						borderColor: 'rgba(56, 197, 225, 1)',
						fill: false,
						data	: chartData_filtered.main.data
					}]
				},
				peak_data : {
					labels		: chartData_filtered.peak.label,
					datasets	: [{
						label	: 'Peak Meter',
						backgroundColor: 'rgba(0, 115, 128, 1)',
						borderColor: 'rgba(56, 197, 225, 1)',
						fill: false,
						data	: chartData_filtered.peak.data
					}]
				},
				solar_data : {
					labels		: chartData_filtered.solar.label,
					datasets	: [{
						label	: 'Solar Meter',
						backgroundColor: 'rgba(0, 115, 128, 1)',
						borderColor: 'rgba(56, 197, 225, 1)',
						fill: false,
						data	: chartData_filtered.solar.data
					}]
				}
			}
			
			if (chart == meter_types[0]) return data.main_data;
			else if (chart == meter_types[1]) return data.peak_data;
			else if (chart == meter_types[2]) return data.solar_data;
			else return {};
		}
		
		/*
		 * Function - Chart Option
		 */
		 
		function getChartOptions(chart='') {
			var options = {
				main_options : {
					title: {
						display: true,
						text: 'Main Chart'
					},
					animation: {
						easing: 'easeInOutSine',
						duration : 1000
					},
					layout: {
						padding: {
							left: 10,
							right: 10,
							top: 10,
							bottom: 10
						}
					},
					legend: {
						display: false,
						/*labels: {
							fontColor: 'rgb(255, 99, 132)'
						}*/
					},
					scales: {
						yAxes: [{
							scaleLabel: {
								display: true,
								labelString: 'Meter Value'
							}
						}],
						xAxes: [{
							scaleLabel: {
								display: true,
								labelString: 'Date'
							}
						}],
					}
				},
				peak_options : {
					title: {
						display: true,
						text: 'Peak Chart'
					},
					animation: {
						easing: 'easeInOutSine',
						duration : 1000
					},
					layout: {
						padding: {
							left: 10,
							right: 10,
							top: 10,
							bottom: 10
						}
					},
					legend: {
						display: false,
						/*labels: {
							fontColor: 'rgb(255, 99, 132)'
						}*/
					},
					scales: {
						yAxes: [{
							scaleLabel: {
								display: true,
								labelString: 'Meter Value'
							}
						}],
						xAxes: [{
							scaleLabel: {
								display: true,
								labelString: 'Date'
							}
						}],
					}
				},
				solar_options : {
					title: {
						display: true,
						text: 'Solar Chart'
					},
					animation: {
						easing: 'easeInOutSine',
						duration : 1000
					},
					layout: {
						padding: {
							left: 10,
							right: 10,
							top: 10,
							bottom: 10
						}
					},
					legend: {
						display: false,
						/*labels: {
							fontColor: 'rgb(255, 99, 132)'
						}*/
					},
					scales: {
						yAxes: [{
							scaleLabel: {
								display: true,
								labelString: 'Meter Value'
							}
						}],
						xAxes: [{
							scaleLabel: {
								display: true,
								labelString: 'Date'
							}
						}],
					}
				}
			}
			
			if (chart == meter_types[0]) return options.main_options;
			else if (chart == meter_types[1]) return options.peak_options;
			else if (chart == meter_types[2]) return options.solar_options;
			else return {};
		}
		
		
		function displayMap(latitude, longitude){
			document.getElementById('mapWrapper').style.display = 'block';
			var targetMap = document.getElementById("googleMap");
			
			var mapProp= {
				center:new google.maps.LatLng(latitude, longitude),
				zoom:18,
			};
			var map=new google.maps.Map(targetMap, mapProp);
		}
		
		function hideMap(){
			document.getElementById('mapWrapper').style.display = 'none';
		}
	</script>
	
	
	<!-- Google Map API -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9CwlgXrbQm8LrNg4IDkgLu16ZdqujPvU&callback=displayMap"></script>
	
</body>
</html>