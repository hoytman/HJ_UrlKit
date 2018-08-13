<?php 

require_once('UrlKit.php');
$MyUrlKit = new UrlKit();

?>

<html>
    <head>
        <style>
            p {margin: 30px;}
            h1{color: #00a;}
            div{margin: 10px; font-size: 18px;}
            .output{ background: #fdd; padding: 20px;}
        </style>
    </head>
    <body>

        
    <h1>A unique URL segment</h1>

    <p>
        The function was intended to return a unique string of 
        characters which could be added to a url like this:<br /><br />

        http://www.mysite.com?temp_user=dd5vbrk4ax4v4o09l2bm<br /><br />

        My function had the following criteria:
    </p>
        
    <ul>
        <li>Every call must generate a unique string of alpha numeric characters.</li>
        <li>Most important: Zero chance of string duplication.</li>
        <li>It should be 20 characters long (secure, but not awkwardly long.)</li>
        <li>Repeat calls should reflect a high degree of dissimilarity.</li>
        <li>Character usage should appear as random as possible.</li>
    </ul>
    <div class="output">

<?php
        
    echo 'uniqueUrlSegment(); = '. $MyUrlKit->getUniqueString() .'<br />';
    echo 'uniqueUrlSegment(); = '. $MyUrlKit->getUniqueString() .'<br />';
    echo 'uniqueUrlSegment(); = '. $MyUrlKit->getUniqueString() .'<br />';
    
?>
        
    </div>

    <h1>A good example of shuffleString()</h1>

    <p>
        shuffleString() is designed to accept a string of characters 
    and an integer. The function returns a string that's a reordered version 
    of the original string. The reordering process is controlled by the second 
    variable. If the function is called again with the same string and a 
    different number, a different string will be returned. However, if the 
    string and the integer do not change, repeat calls to this function will 
    always return the same string. as the integer changes, the returned strings 
    should not appear to be similar. I have tested this function on the 
    following string, with integer values between 0 and 40000 without finding 
    a duplicate returned string.
    
    </p>
    
    <div class="output">
        
<?php
  
$dataStr = "1234567890abcdefghijklmnopqrstuvwxyz";

    echo 'shuffleString($dataStr, 1234); = '.$MyUrlKit->shuffleString($dataStr, 1234). '<br />';  
    echo 'shuffleString($dataStr, 1234); = '.$MyUrlKit->shuffleString($dataStr, 1234). '<br />';
    echo 'shuffleString($dataStr, 1234); = '.$MyUrlKit->shuffleString($dataStr, 1234). '<br />';
    echo 'shuffleString($dataStr, 1234); = '.$MyUrlKit->shuffleString($dataStr, 1234). '<br />';
    echo 'shuffleString($dataStr, 5678); = '.$MyUrlKit->shuffleString($dataStr, 5678). '<br />';
    echo 'shuffleString($dataStr, 5678); = '.$MyUrlKit->shuffleString($dataStr, 5678). '<br />';
    echo 'shuffleString($dataStr, 5678); = '.$MyUrlKit->shuffleString($dataStr, 5678). '<br />';

?>

    </div>
    
    <h1>A good test of shuffleString()</h1>

    <div class="output">

<?php
        
    for($i=0; $i<10; $i++){
        $dataStr = "1234567890abcdefghijklmnopqrstuvwxyz";
        for($j=0; $j<2000; $j++){
            $dataStr = $MyUrlKit->shuffleString($dataStr, ord($dataStr[0]));
        }
        echo $dataStr . '<br />';
    }

?>

    </div>

</body>
</html>