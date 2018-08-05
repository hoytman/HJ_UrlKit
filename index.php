<html>
<head>

</head>
<body>

<?php 

    /**
     * returns a unique mircotime based string of 20 characters
     *
     * @return string $code
     */

function uniqueCharacterString(){

	$letters =  "1234567890abcdefghijklmnopqrstuvwxyz";	
	$microtime = microtime();
	$microtime_array = explode(' ', substr($microtime,2));
	$code = '';
	
	$time_element = (int)($microtime_array[0]/100);
  
	$digit_list_for_ones .= $time_element. $time_element;
	$digit_list_for_tens = strrev($digit_list_for_ones);
	$digit_list_for_hundreds .= strrev($microtime_array[1]);

	for($i = 0; $i <10; $i++){

		$num = ((int)$digit_list_for_ones[$i]);
		$num += ((int)$digit_list_for_tens[$i])*10; 
		$num += ((int)$digit_list_for_hundreds[$i])*100;

		$mult   = (int)($num / 36);
		$mod    = $num - ($mult * 36);
	
		$code  .= $letters[$mult].$letters[$mod];
	}

	return $code;

}


echo uniqueCharacterString();

?>

</body>
</html>