<?php

/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/

if (isset($_POST['zip'])){
	if ($_POST['zip']!=''){
		$zip = str_replace(' ', '%20', $_POST['zip']) ;
		
	
		$zipurl = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$zip;
		$json_zip_string = file_get_contents($zipurl);
		$parsed_arr = json_decode($json_zip_string,true);
		
		$lant = $parsed_arr['results'][0]['geometry']['location']['lat'];
		$long = $parsed_arr['results'][0]['geometry']['location']['lng'];
		$key = '{YOUR API KEY}';
		$url = 'https://maps.googleapis.com/maps/api/timezone/json?location='.$lant.','.$long.'&timestamp=1458000000&key='.$key;
		
		$json_string = file_get_contents($url);
		$parsed_arr = json_decode($json_string,true);
		echo($parsed_arr['timeZoneId']).'<br>';
	}else{
		echo('Please enter a valid zip code!<br>');
	}
}
?>

<form method="post" action="">
	<input type="text" name="zip" value="<?php echo str_replace('%20', ' ', $zip) ?>"/>
	<input type="submit" value="submit"/>
</form>
