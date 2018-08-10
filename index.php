<html>
<head>

</head>
<body>

<?php 

    /**
     * returns a unique mircotime() based string of 20 characters
     * 
     * To improve randomness, change the $seed variable
     *
     * @return string 
     */

function uniqueUrlSegment(){

	$letters =  "1234567890abcdefghijklmnopqrstuvwxyz";
        $seed = 1234;
        
        $letters = shuffleString($letters, $seed);
        
	$microtime = microtime();
	$microtime_array = explode(' ', substr($microtime,2));
	$code = '';
	
	$time_element = (int)($microtime_array[0]/100);
  
	$digit_list_for_ones = substr(10000000000 + $time_element * 9973,-10);
	$digit_list_for_tens = strrev($microtime_array[1]);
	$digit_list_for_hundreds = strrev($digit_list_for_ones);
  

	for($i = 0; $i <10; $i++){

		$num = ((int)$digit_list_for_ones[$i]);
		$num += ((int)$digit_list_for_tens[$i])*10; 
		$num += ((int)$digit_list_for_hundreds[$i])*100;

		$mult   = (int)($num / 36);
		$mod    = $num - ($mult * 36);
    
		if($mult < 9 && mt_rand(0,1)){
			$mult += 27;
		}
	
		$code  .= $letters[$mult].$letters[$mod];
	}

	return $code;

}

    /**
     * returns a string that's a reordered version of the passed string.
     * The reordering process is controlled by the second variable.
     * If the function is called again with the same string and a different 
     * number, a different string will be returned.  However, if the string 
     * and the integer do not change, repeat calls to this function will 
     * always return the same string. 
     *
     * @param	string	arbitrary sting of characters
     * @param	int	a seed number to control the process
     * @return	string  reordered version of the passed string
     */

function shuffleString($inputString, $seed = 2000){
    
    $strLength = strlen($inputString);
    $newString = "";
    $factor = 3 + (int)($seed / $strLength);
    

    while($strLength > 0){
        
        $seed += $factor;

        if($seed >= $strLength){
            $seed = $seed % $strLength; 
        }
        
        $newString .= $inputString[$seed];
        
        $tempStr = "";
        
        $strLength --;
        
        if($seed != 0){
            $tempStr = substr($inputString,0,$seed);
        }
        if($seed != $strLength){
            $tempStr .= substr($inputString,$seed+1);
        }
        $inputString = $tempStr;
        //echo $inputString,"<br/>";
        
    }

    return $newString.$inputString;
                  
}


echo uniqueUrlSegment();


?>

</body>
</html>