<?php
$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if($method == 'POST'){
    $requestBody = file_get_contents('php://input');
    $json = json_decode($requestBody);
    $text = $json->result->parameters->text;

    if (isset($text) && !empty($text)){
        switch ($text) {
            case 'hi babe':
                $speech = "Hi, Nice to meet you";
                break;

            case 'bye bye':
                $speech = "Bye, good night";
                break;

            case 'anything':
                $speech = "Yes, you can type anything here.";
                break;

            case 'comment on fait':
                $speech = "Debrouille toi !!";
                break;

            case 'londres':
                $speech = getlocation();
                break;

            default:
                $speech = "Sorry, I didnt get that. Please ask me something else.";
                break;
        }
    }

    $response = new \stdClass();
    $response->speech = $speech;
    $response->displayText = $speech;
    $response->source = "webhook";
    echo json_encode($response);
}
else
{
    echo "Method not allowed";
}



function getlocation(){
    echo '<script type="text/javascript">
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function(position){
                var positionInfo = "Your current position is (" + "Latitude: " + position.coords.latitude + ", " + "Longitude: " + position.coords.longitude + ")";
                document.getElementById("result").innerHTML = positionInfo;
            });
        } else{
            alert("Sorry, your browser does not support HTML5 geolocation.");
        }
        
    </script>';
}