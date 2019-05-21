<?php

/**
 * @copyright Philip Schulz
 */

//$kontext=stream_context_create(array("http" =>array(
//                                                "method" => "POST",
//                                                "header" => "Content-type: application/x-www-form-urlencoded",
//                                                "content" => "pattern=Streams&scope=quickref"
//                                              )
//                                    ));
//$daten = file_get_contents("http:php.net/search.php", false, $kontext);
//echo $daten; 

$sContext = stream_context_create(
        [
            'http' => [
                    'method' => 'post',
                    'Content-type: application/x-www-form-urlencoded',
                    'content' => http_build_query( ['pattern'=>'Streams', 'scope'=>'quickref'] )
                ]
        ]
    );


$sResult = file_get_contents( 'http://www.php.net/search.php', false, $sContext );

if ( $sResult )
    echo $sResult;   

?>