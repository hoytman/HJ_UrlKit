<?php

/**
 *
 * This content is released under the MIT License (MIT)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package         UrlKit
 * @author          Hoyt Jolly
 * @license         https://opensource.org/licenses/MIT	
 * @link	
 * @filesource
 */

/**
 * UrlKit Class
 *
 * This class is designed to help with many URL related features 
 * and manipulations
 *
 * @author		Hoyt Jolly
 * @link		https://github.com/hoytman/uniqueCharacterString
 */

class HJ_UrlKit {
    
    /**
    * List of all characters used in url segment generation
    *
    * @var	String
    */
    private $key_string;
    
    /**
    * A unique number used to identify the server.
    *
    * @var	int
    */
    private $server_key;
    
    /**
    * Class Constructor
    *
    * Sets up the initial variables for the class
    *
    * @param	int	$server_key     identifier for the server
    *
    * @return	none
    */
    public function __construct($server_key = 1234) {
        
        $this->server_key = $server_key;
        $this->key_string = $this->shuffleString(
                "1234567890abcdefghijklmnopqrstuvwxyz", $server_key);
        
    }
    
    /**
     * Get Unique String
     * 
     * returns a unique mircotime() based string of 20 characters
     * The function was intended to return a unique string of characters which 
     * could be added to a URL like this:
     *
     *   http://www.mysite.com?temp_user=dd5vbrk4ax4v4o09l2bm
     * 
     * 1)The function was designed to fill the following specifications:
     * 2)Every call must generate a unique string of alpha numeric characters.
     * 3)Most important: Zero chance of string duplication.
     * 4)It should be 20 characters long (secure, but not awkwardly long.)
     * 5)Repeat calls should reflect a high degree of dissimilarity.
     * 6)Character usage should appear as random as possible.
     * 
     * @return string 
     */
    
    public function getUniqueString(){
        
        
        $letters = $this->key_string;
        
	$microtime = microtime();
	$microtime_array = explode(' ', substr($microtime,2));
	$code = '';
	
	$time_element = (int)($microtime_array[0]/100);
  
        //Stores three lists of number based on microtime
        
	$digit_list_for_ones = substr(10000000000 + $time_element * 9973,-10);
	$digit_list_for_tens = strrev($microtime_array[1]);
	$digit_list_for_hundreds = strrev($digit_list_for_ones);
  

	for($i = 0; $i <10; $i++){

                //created a number between 0 and 999.
            
		$num = ((int)$digit_list_for_ones[$i]);
		$num += ((int)$digit_list_for_tens[$i])*10; 
		$num += ((int)$digit_list_for_hundreds[$i])*100;

                //converts number to base 36 (the number of characters used)
                
                $ones_place    = $num % 36;
		$upper_place   = (int)($num / 36);		
    
		if($upper_place < 9 && mt_rand(0,1)){
			$upper_place += 27;
		}
                
                //converts the base 36 numeber into 2 characters.
	
		$code  .= $letters[$upper_place].$letters[$ones_place];
	}

	return $code;

    }
    
    /**
     * Shuffle String
     * 
     * returns a string that's a reordered version of the parameter string.
     * The reordering process is controlled by the second variable.
     * If the function is called again with the same string and a different 
     * number, a different string will be returned.  However, if the string 
     * and the integer do not change, repeat calls to this function will 
     * always return the same string. 
     *
     * @param	string	arbitrary sting of characters
     * @param	int	a seed number to control the process
     * 
     * @return	string  reordered version of the passed string
     */
    
    
    public function shuffleString($inputString, $seed = 1234){
    
        $strLength = strlen($inputString);
        $newString = "";
        $factor = 3 + (int)($seed / $strLength);

        while($strLength > 0){

            // loops through $inputString, picks a character, adds it to
            // $newString, then removes that char from $inputString.
            
            $seed += $factor;

            if($seed >= $strLength){
                $seed = $seed % $strLength; 
            }
            
            //$seed in basically the index of the character that is selected
            //this index is advanced by $factor each pass.

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

        }

        return $newString.$inputString;
    
    }

}
