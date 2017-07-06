<?php

	$city=$_GET['city'];

	//replace spaces with hyphen via str_replace
	$city=str_replace(" ","-", $city);

	//get content from weather-forecast.com and input our city
	$contents=file_get_contents("http://www.weather-forecast.com/locations/".$city."/forecasts/latest");

	//match element containing '3 Day Weather...etc and using (.*?) to get all rest in element from contents, storing in $matches var'
	preg_match('/3 Day Weather Forecast Summary:<\/b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">(.*?)</s', $contents, $matches);

	//in this case matches[1] is the forecast details we want
	echo($matches['1']);

?>
