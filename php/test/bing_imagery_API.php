<?php // Save the base URL for the Imagery API to a string
$imageryBaseURL = "http://dev.virtualearth.net/REST/v1/Imagery/Map";

// Setup the parameters for the Imagery API request (using a center point)
$imagerySet = "Aerial";
$centerPoint = "49.3611,7.67088";
$pushpin = $centerPoint.";4;ID";
$zoomLevel = "19";
$key = "%20AtL_IfzZokvO-Fo1PhVFbWNAoAKNiLn_kKvSkTiX7pcN-jBWLkQ-2zqiO5xHYILf";

// Display the image in the browser
echo "<img src='".$imageryURL = $imageryBaseURL."/".$imagerySet."/".$centerPoint."/".$zoomLevel."?pushpin=".$pushpin."&key=".$key."'>";


//http://dev.virtualearth.net/REST/v1/Imagery/Map/road/49.36093,7.67316/zoomLevel=5&mapSize=720,720&pushpin=49.36093,7.67316&mapLayer=TrafficFlow&key=%20AtL_IfzZokvO-Fo1PhVFbWNAoAKNiLn_kKvSkTiX7pcN-jBWLkQ-2zqiO5xHYILf

?>