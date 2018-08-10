<html>
<head>
    <style>
        p {margin: 30px;}
        h1{color: #00a;}
        div{margin: 10px; font-size: 18px;}
    </style>
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

echo '<h1>A unique URL segment</h1>';

echo "<p>The function was intended to return a unique string of 
    characters which could be added to a url like this:<br /><br />

http://www.mysite.com?temp_user=dd5vbrk4ax4v4o09l2bm<br /><br />

My function had the following criteria:
<ul>
<li>Every call must generate a unique string of alpha numeric characters.</li>
<li>Most important: Zero chance of string duplication.</li>
<li>It should be 20 characters long (secure, but not awkwardly long.)</li>
<li>Repeat calls should reflect a high degree of dissimilarity.</li>
<li>Character usage should appear as random as possible.</li>
</ul>
</p>";

echo '<div>';
echo 'uniqueUrlSegment(); = '.uniqueUrlSegment();
echo '</div>';

echo '<h1>A good example of shuffleString()</h1>';
echo "<p>shuffleString() is designed to accept a string of characters 
    and an integer. The function returns a string that's a reordered version 
    of the original string. The reordering process is controlled by the second 
    variable. If the function is called again with the same string and a 
    different number, a different string will be returned. However, if the 
    string and the integer do not change, repeat calls to this function will 
    always return the same string. as the integer changes, the returned strings 
    should not appear to be similar. I have tested this function on the 
    following string, with integer values between 0 and 40000 without finding 
    a duplicate returned string.</p>";

  
$dataStr = "1234567890abcdefghijklmnopqrstuvwxyz";

echo '<div>';
echo 'shuffleString($dataStr, 1234); = '.shuffleString($dataStr, 1234). '<br />';
echo 'shuffleString($dataStr, 1234); = '.shuffleString($dataStr, 1234). '<br />';
echo 'shuffleString($dataStr, 1234); = '.shuffleString($dataStr, 1234). '<br />';
echo 'shuffleString($dataStr, 5678); = '.shuffleString($dataStr, 5678). '<br />';
echo 'shuffleString($dataStr, 5678); = '.shuffleString($dataStr, 5678). '<br />';
echo 'shuffleString($dataStr, 5678); = '.shuffleString($dataStr, 5678). '<br />';
echo '</div>';

echo '<h1>A good test of shuffleString()</h1>';

echo '<div>';
for($i=0; $i<10; $i++){
    $dataStr = "1234567890abcdefghijklmnopqrstuvwxyz";
    for($j=0; $j<2000; $j++){
        $dataStr = shuffleString($dataStr, ord($dataStr[0]));
    }
    echo $dataStr . '<br />';
}
echo '</div>';

?>

</body>
</html>